<?php 
  require_once "../../Controller/Clientes/ClienteController.php"; 
  require_once "../../Model/Clientes/Cliente.php";
  require_once "../../Controller/ControllerSesion.php";
  require_once "../../Model/Usuario/Usuario.php";

  $ModelCliente = new Cliente();
  $session = new ControllerSesion();
  $ModeloUsuario = new Usuario();
  
  $email    = $_SESSION['email'];
  $password = $_SESSION['password'];
  
  $fetch_info = $session->verificarSesion($ModeloUsuario, $email, $password);
  $id_sucursal = $ModeloUsuario->getNumeroSucursalUsuario($email)['id_sucursal'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ProSkin - Clientes</title>
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
        <h1>Lista de tus clientes</h1>
        <a href="altaCliente.php" class="btn btn-success">Nuevo Cliente</a>
        <a href="buscarCliente.php" class="btn btn-warning">Buscar Cliente</a>
        <ul class="list-group">
        <?php
          foreach($ModelCliente->getAllUsuariosFromIdSucursal($id_sucursal) as $d){
            $statusCliente = $ModelCliente->getStatusCliente($d['id_cliente']);
            if($statusCliente[0]['status'] == 'activo'){
              echo "<li class='list-group-item d-flex justify-content-between align-items-center'>
                    <a href='informacionCliente.php?id=".$d['id_cliente']."' role='button'>".$d['nombre_cliente']."</a><span class='badge bg-success rounded-pill'>Activo</span>
                    </li>";
            }else{
              echo "<li class='list-group-item d-flex justify-content-between align-items-center'>
                    <a href='informacionCliente.php?id=".$d['id_cliente']."' role='button'>".$d['nombre_cliente']."</a><span class='badge bg-warning rounded-pill'>Inactivo</span>
                    </li>";

            }
          }
        ?>
        </ul>
        <!-- <img src="../img/bg.webp" class="img-fluid" alt="Responsive image"> -->
      </div>
      
      <div class="container">
        <!-- Example row of columns -->
        <div class="row">
          <div class="col-md-4">
            <h2>Heading</h2>
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
            <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
          </div>
          <div class="col-md-4">
            <h2>Heading</h2>
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
            <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
          </div>
          <div class="col-md-4">
            <h2>Heading</h2>
            <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
            <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
          </div>
        </div>
    </main>
    <?php
      getFooter();
    ?>
</body>
</html>