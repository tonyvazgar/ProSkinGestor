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
  
  $fetch_info = $session->verificarSesion($ModeloUsuario, $email, $password);
  
  $nombreSucursal = $ModeloUsuario->getNombreSucursalUsuario($email)['nombre_sucursal'];
  $numeroSucursal = $ModeloUsuario->getNumeroSucursalUsuario($email)['id_sucursal'];
  $id_cosmetologa = $ModeloUsuario->getIdCosmetologa($email)['id'];

  $ventas = $ModeloVenta->getAllVentas($numeroSucursal);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ProSkin - Ventas</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"
    integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g=="
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../include/navbar.css">
    <script src="../include/loadNavbar.js"></script>
</head>
<body style='background-color: #f9f3f3;'>
    <!-- <button type="button" class="btn btn-light"><a href="logout.php">Cerrar sesion</a></button> -->
    <?php
        require_once("../include/navbar.php");
        
        getNavbar($fetch_info['name'], $ModeloUsuario->getNombreSucursalUsuario($email)['nombre_sucursal']);
    ?>
    <main role="main" class="container">
      <div class="container">
        <h1>Listado de ventas</h1>
        <ul class="list-group">
          <?php
            foreach($ventas as $v){
              if($v['id_cliente'] == ''){
                $detallesVentaProducto = $ModeloVenta->getTodosLosDetallesVentaProducto($v['id_venta']);
                // print_r($detallesVentaProducto);
                echo "<li class='list-group-item'>
                      <a href='detalleVenta.php?idVenta=".$v['id_venta']."'>".$v['id_venta']."</a><br>".date("Y-m-d", $v['timestamp'])."
                      <br>$".number_format($v['monto'], 2)."</li>";
              }else{
                $detallesVentaTratamiento = $ModeloVenta->getTodosLosDetallesVentaTratamiento($v['id_venta']);
                // print_r($detallesVentaTratamiento);
                echo "<li class='list-group-item'>
                      <a href='detalleVenta.php?idVenta=".$v['id_venta']."'>".$v['id_venta']."</a><br>".date("Y-m-d", $v['timestamp'])."
                      <br>$".number_format($v['monto'], 2)."</li>";
              }
            }
          ?>
        </ul>
        <!-- <img src="../img/img2.jpg" class="img-fluid" alt="Responsive image"> -->
      </div>
    </main>
    <?php
      getFooter();
    ?>
</body>
</html>