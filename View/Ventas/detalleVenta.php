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

  $detalles = $ModeloVenta->getTodosLosDetallesVenta($id_venta)[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ProSkin - Detalle Venta</title>
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
        <h1>Detalle de la venta</h1>

        <?php
            echo "<label>".$detalles['id_cliente']."</label><br>";
            echo "<label>".$detalles['nombre_cliente']."</label><br>";
            echo "<label>".$detalles['apellidos_cliente']."</label><br>";
            echo "<label>".$detalles['id_venta']."</label><br>";
            echo "<label>".$detalles['metodo_pago']."</label><br>";
            echo "<label>".$detalles['monto']."</label><br>";
            echo "<label>".$detalles['timestamp']."</label><br>";
            echo "<label>".$detalles['id_cosmetologa']."</label><br>";
            echo "<label>".$detalles['calificacion']."</label><br>";
            echo "<label>".$detalles['zona_cuerpo']."</label><br>";
            echo "<label>".$detalles['comentarios']."</label><br>";
            echo "<label>".$detalles['nombre_tratamiento']."</label><br>";
            print_r($detalles);
        ?>
        
        <!-- <img src="../img/img2.jpg" class="img-fluid" alt="Responsive image"> -->
      </div>
    </main>
    <?php
      getFooter();
    ?>
</body>
</html>