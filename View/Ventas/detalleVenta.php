<?php 
  require_once "../../Controller/Clientes/ClienteController.php"; 
  require_once "../../Controller/ControllerSesion.php";
  require_once "../../Model/Usuario/Usuario.php";
  require_once "../../Model/Ventas/Venta.php";

  $session = new ControllerSesion();
  $ModeloUsuario = new Usuario();
  $ModeloVenta = new Venta();
  
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
    <!-- <button type="button" class="btn btn-light"><a href="logout.php">Cerrar sesion</a></button> -->
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
                      echo getMetodoPagoNombre($metodo_pago);?> 
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
                    <p class="lead"><?php echo date('Y-m-d h:m',$detalles['timestamp']);?> </p>
                  </td>
                  <td>
                    <h3>Centro de belleza</h3>
                    <p class="lead"><?php echo $nombreSucursal;?> </p>
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
                            echo "•".$ModeloVenta->getDetallesProducto($prod[0])['descripcion_producto']." x ".$prod[4]."<br>";
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
                            echo "•".$ModeloVenta->getDetallesTratamiento($trat[0])['nombre_tratamiento']."<br>";
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
        <?php
            // print_r($detalles);
        ?>
        <div class="form-group text-center">
          <a class="btn btn-success" href="../index.php" role="button">Finalizar</a>
        </div>
      </div>
    <?php
      getFooter();
    ?>
</body>
</html>