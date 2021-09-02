<?php
  require_once "../../Controller/Clientes/ClienteController.php"; 
  require_once "../../Controller/ControllerSesion.php";
  require_once "../../Model/Usuario/Usuario.php";
  require_once "../../Model/Ventas/Venta.php";
  require_once "../../Model/Tratamiento/Tratamiento.php";

  $session = new ControllerSesion();
  $ModeloUsuario = new Usuario();
  $ModeloVenta = new Venta();
  $ModelTratamiento = new Tratamiento();
  
  $email    = $_SESSION['email'];
  $password = $_SESSION['password'];
  $id_venta = $_GET['idVenta'];
  
  $fetch_info = $session->verificarSesion($ModeloUsuario, $email, $password);
  
  $nombreSucursal = $ModeloUsuario->getNombreSucursalUsuario($email)['nombre_sucursal'];
  $numeroSucursal = $ModeloUsuario->getNumeroSucursalUsuario($email)['id_sucursal'];
  $id_cosmetologa = $ModeloUsuario->getIdCosmetologa($email)['id'];

  $detalles = $ModeloVenta->getTodosLosDetallesVentaProducto($id_venta);
  if(empty($detalles)){
    $detalles = $ModeloVenta->getTodosLosDetallesVenta($id_venta);
  }
  getHeadHTML("ProSkin - Resumen Venta");

  $divisionProductosTratamientos = getDesgloseProductosTratamientosVenta($detalles);
?>
<body style='background-color: #f9f3f3;'>
    <?php
        require_once("../include/navbar.php");
        
        getNavbar($fetch_info['name'], $ModeloUsuario->getNombreSucursalUsuario($email)['nombre_sucursal']);
    ?>
    <div class="container">
        <h1>Resumen de venta</h1>
          <div class="form-group">
            <table class='table table-borderless' style='table-layout: fixed;'>
              <tbody>
                <tr>
                  <td>
                    <h3>ID Venta</h3>
                    <p class="lead"><?php echo $divisionProductosTratamientos['id_venta'];?> </p>
                  </td>
                  <td>
                    <h3>Cliente</h3>
                    <p class="lead"><?php echo $divisionProductosTratamientos['nombre'];?> </p>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="form-group">
            <table class='table table-borderless' style='table-layout: fixed;'>
              <tbody>
                <tr>
                  <td>
                    <h3>Método de pago</h3>
                    <p class="lead">
                    <?php 
                      $metodo_pago = $divisionProductosTratamientos['metodo_pago'];
                      echo getMetodoPagoNombre($metodo_pago)." ".$divisionProductosTratamientos['referencia_pago'];?> 
                    </p>
                  </td>
                  <td>
                    <h3>Total de venta</h3>
                    <p class="lead"><?php echo "$".$divisionProductosTratamientos['total'];?></p>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="form-group">
            <!-- ---- -->
            <table class='table table-borderless' style='table-layout: fixed;'>
              <tbody>
                <tr>
                  <td>
                    <h3>Fecha</h3>
                    <p class="lead"><?php echo date('Y-m-d H:i:s',$detalles[0]['timestamp']);?> </p>
                  </td>
                  <td>
                    <h3>Centro de belleza</h3>
                    <p class="lead"><?php echo $nombreSucursal." [".$ModeloUsuario->getNombreCosmetologaWhereID($divisionProductosTratamientos['cosmetologa'])."]";?> </p>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="form-group">
            <table class='table table-borderless' style='table-layout: fixed;'>
              <tbody>
                <tr>
                  <td><h3>Productos</h3></td>
                  <td><h3>Tratamientos</h3></td>
                </tr>
                <tr>
                  <td>
                    <p class="lead">
                      <?php 
                        if($divisionProductosTratamientos['num_productos'] != 0){
                          foreach($divisionProductosTratamientos['productos'] as $prod){
                            echo '<div class="card">
                              <div class="card-body">
                                <h5 class="card-title">'.$ModeloVenta->getDetallesProducto($prod[0])['descripcion_producto'].'</h5>
                                <h5 class="card-title">$'.$prod[2].'</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Cantidad: '.$prod[4].' producto(s) | $'.$prod[3].'</h6>
                              </div>
                            </div>';
                          }
                        }else{
                          echo "NO HAY PRODUCTOS";
                        }
                      ?>
                    </p>
                  </td>
                  <td>
                    <p class="lead">
                      <?php 
                        if($divisionProductosTratamientos['num_tratamientos'] != 0){
                          foreach($divisionProductosTratamientos['tratamientos'] as $trat){
                            $informacion_gral_tratamiento = $ModeloVenta->getDetallesTratamiento($trat[0], $id_venta);
                            $str_zonas = [];
                            if(!empty($informacion_gral_tratamiento['zona_cuerpo'])){
                              $array_zonas = explode(",", $informacion_gral_tratamiento['zona_cuerpo']);
                              foreach($array_zonas as $num_zona){
                                $nombre_zona = $ModelTratamiento -> getNombreZonaCuerpoWhereID($num_zona)['nombre_zona'];
                                array_push($str_zonas, $nombre_zona);
                              }
                            }
                            echo '<div class="card">
                              <div class="card-body">
                                <h5 class="card-title">'.$informacion_gral_tratamiento['nombre_tratamiento']." - $".number_format($trat[2]).'</h5>
                                <h6 class="card-subtitle mb-2 text-muted">'.implode(", ", $str_zonas).'</h6>
                                <p class="card-text">'.$informacion_gral_tratamiento['comentarios'].'</p>
                              </div>
                            </div>';
                          }
                        }else{
                          echo "NO HAY TRATAMIENTOS";
                        }
                      ?>
                    </p>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        <div class="form-group text-center">
          <a class="btn btn-success" href="../index.php" role="button">Finalizar</a>
        </div>
        <div class="form-group text-center">
          <a class="btn btn-warning" href=<?php
            echo "'./editarVenta.php?idVenta=".$id_venta."'";
          ?>role="button">Editar registro</a>
        </div>
      </div>
    <?php
      getFooter();
    ?>
</body>
</html>