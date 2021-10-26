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

  getHeadHTML("ProSkin - Clientes");
?>
<body style='background-color: #f9f3f3;'>
    <!-- <button type="button" class="btn btn-light"><a href="logout.php">Cerrar sesion</a></button> -->
    <?php
        require_once("../include/navbar.php");
        $fecha_para_corte_caja = getFechaFormatoCDMX();
        getNavbar($fecha_para_corte_caja, $fetch_info['name'], $ModeloUsuario->getNombreSucursalUsuario($email)['nombre_sucursal']);
    ?>
    <main role="main" class="container">
      <div class="container">
        <h1>Lista de tus clientes</h1>
        <div class='text-center'>
        <a href="altaCliente.php" class="btn btn-success">Nuevo Cliente</a>
        <a href="buscarCliente.php" class="btn btn-warning">Buscar Cliente</a>
        </div>
        <ul class="list-group">
        <?php
          $usuarios_sucursal = $ModelCliente->getAllUsuariosFromIdSucursal($id_sucursal);
          if(empty($usuarios_sucursal)){
            echo "<h3 class='text-center'>Aún no hay ningun cliente registrado</h3>";
          }else{
            foreach($usuarios_sucursal as $usuario){
              $statusCliente = $ModelCliente->getStatusCliente($usuario['id_cliente']);
              if($statusCliente[0]['status'] == 'activo'){
                echo "<li class='list-group-item d-flex justify-content-between align-items-center'>
                      <a href='informacionCliente.php?id=".$usuario['id_cliente']."' role='button'>{$usuario['nombre_cliente']} {$usuario['apellidos_cliente']}</a><span class='badge bg-success rounded-pill'>Activo</span>
                      </li>";
              }else{
                echo "<li class='list-group-item d-flex justify-content-between align-items-center'>
                      <a href='informacionCliente.php?id=".$usuario['id_cliente']."' role='button'>{$usuario['nombre_cliente']} {$usuario['apellidos_cliente']}</a><span class='badge bg-warning rounded-pill'>Inactivo</span>
                      </li>";
  
              }
            }
          }
        ?>
        </ul>
        <!-- <img src="../img/bg.webp" class="img-fluid" alt="Responsive image"> -->
      </div>
      
      <!-- <div class="container">
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
      </div> -->
    </main>
    <?php
      getFooter();
    ?>
</body>
</html>