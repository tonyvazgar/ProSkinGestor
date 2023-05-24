<?php 
  require_once "../../Controller/Clientes/ClienteController.php"; 
  require_once "../../Model/Clientes/Cliente.php";
  require_once "../../Controller/ControllerSesion.php";
  require_once "../../Model/Usuario/Usuario.php";
  require_once "./Components/anniversaries.php";
  require_once "./Components/newMonthClients.php";

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
    <?php
        require_once("../include/navbar.php");
        getLoader("Cargando Información...");
        $fecha_para_corte_caja = getFechaFormatoCDMX();
        getNavbar($fecha_para_corte_caja, $fetch_info['name'], $ModeloUsuario->getNombreSucursalUsuario($email)['nombre_sucursal']);
    ?>
    <main role="main" class="container">
      <div class="container">
        <h1>Lista de tus clientes</h1>
        <?php getAniversariesDiv($ModelCliente, $id_sucursal); ?>
        <?php getNewMontlyUsers($ModelCliente, $id_sucursal); ?>
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
      </div>
    </main>
    <?php
      getFooter();
    ?>
    <script src="../../Controller/Clientes/Util/validarCamposAlta.js"></script>
</body>
</html>