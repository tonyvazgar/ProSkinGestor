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
  $id_cosmetologa_from_db = $divisionProductosTratamientos['cosmetologa'];
  
  $historial_ediciones= $ModeloVenta->getVentaFromDetallesEdicionVenta($id_venta);

  $ediciones_style = 'style="display: none;"';
  if(sizeof($historial_ediciones) != 0){
    $ediciones_style = '';
  }

  $esVentaEditada = $ModeloVenta->esVentaDesplazada($id_venta);
?>
<body style='background-color: #f9f3f3;'>
    <?php
        require_once("../include/navbar.php");
        getLoader("Cargando información de la venta...");
        $fecha_para_corte_caja = getFechaFormatoCDMX();
        getNavbar($fecha_para_corte_caja, $fetch_info['name'], $ModeloUsuario->getNombreSucursalUsuario($email)['nombre_sucursal']);
        $fecha_de_la_venta = strtotime(date('Y-m-d',$detalles[0]['timestamp']));
        $corteCajaHoy = $ModeloUsuario->existeCorteCaja($fecha_de_la_venta, $numeroSucursal);
    ?>
    <div class="container">
        <h1>Resumen de venta</h1>
        <?php
          if($esVentaEditada){
            echo '<h3>(Desplazada por cierre de caja)</h3>';
          }
        ?>
        <div id="accordion" <?php echo $ediciones_style;?>>
          <p>
            <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">Historial de ediciones</button>
          </p>
          <div class="form-group">
            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
              <div class="card-body">
                <?php
                // echo '<pre>';
                // print_r($historial_ediciones);
                // echo '</pre>';
                $tratamientosAplicados = $historial_ediciones;
                echo "<ul class='list-group'>";
                  foreach($tratamientosAplicados as $d){
                    $tipo_edicion = $d['tipo_edicion'];
                    $asd = getDiferenciaDeEdicion($d['antes'], $d['despues'], $tipo_edicion);
                    $nombre_general = '';
                    if($tipo_edicion == 'Tratamiento'){
                      $nombre_general = '-'.$ModeloVenta->getNombreTratamientoDeVenta($asd[0]);
                    }elseif($tipo_edicion == 'Producto'){
                      $nombre_general = '-'.$ModeloVenta->getNombreProductoDeVenta($asd[0]);
                    }
                    echo '<div class="card">
                          <div class="card-body">
                            <h5 class="card-title">'.$tipo_edicion.$nombre_general.'</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Antes:<br>'.$asd[1].'</h6>
                            <h6 class="card-subtitle mb-2 text-muted">Después:<br>'.$asd[2].'</h6>
                            <span class="badge bg-warning rounded-pill">'.date('Y-m-d H:i:s', $d['timestamp_edicion']).'</span>
                          </div>
                        </div>';
                  }
                  echo "</ul>";
                ?>
              </div>
            </div>
          </div>
          </div>
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
                    <p class="lead"><?php echo  "<a href='../Clientes/informacionCliente.php?id=".$divisionProductosTratamientos['id_cliente']."'>".$divisionProductosTratamientos['nombre']."</a>";?></a></p>
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
                      $referencia = $divisionProductosTratamientos['referencia_pago'];
                      $total = $divisionProductosTratamientos['total'];

                      $estandarizado = esMetodoPagoSolo($metodo_pago, $referencia, $total);

                      foreach($estandarizado as $elemento){
                        echo "*".getMetodoPagoNombre($elemento[0][0])." |".$elemento[1]."| - $".$elemento[0][1];
                        if($elemento[0][0] == 7){
                          $id_monedero = $ModeloUsuario -> getAllMonederosFromCliente($detalles[0]['id_cliente'])[0]['id_monedero'];
                          if(empty($id_monedero)){
                            $id_monedero = $ModeloUsuario -> getMonederoDineroFromCliente($detalles[0]['id_cliente'])['id_monedero'];
                          }
                          // print_r($id_monedero);
                          echo ' <a class="btn btn-info" href="../../View/Clientes/infoMonedero.php?id_monedero='.$id_monedero.'&id_cliente='.$detalles[0]['id_cliente'].'" role="button">Ver monedero</a>';
                        }
                        echo "<br>";
                      }
                      
                    ?> 
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

        <?php
          $diferencia = diferenciaFechas(date('Y-m-d',$detalles[0]['timestamp']), $fecha_para_corte_caja);
          if($id_cosmetologa == $id_cosmetologa_from_db && $diferencia <= 7){
            if($corteCajaHoy){
              echo '<div class="form-group text-center" id="notificaciones_div">
                      <p class="lead text-danger">IMPORTANTE</p>
                      <p class="lead text-danger">Ya se hizo el corte del día, si editas la venta NO se modificará el corte de caja</p>
                    </div>';
            }
            echo '<div class="form-group text-center"><a class="btn btn-warning" href="./editarVenta.php?idVenta='.$id_venta.'" role="button">Editar registro</a></div>';
          }
        ?>
      </div>
    <?php
      getFooter();
    ?>
    <script src="../../Controller/Ventas/Util/validarCamposEditarVenta.js"></script>
</body>
</html>