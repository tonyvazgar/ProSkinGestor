<?php 
  require_once "../../Controller/Clientes/ClienteController.php"; 
  require_once "../../Controller/Inventario/InventarioController.php"; 
  require_once "../../Controller/ControllerSesion.php";
  require_once "../../Model/Usuario/Usuario.php";

  $session = new ControllerSesion();
  $ModeloUsuario = new Usuario();
  
  $email    = $_SESSION['email'];
  $password = $_SESSION['password'];
  
  $fetch_info = $session->verificarSesion($ModeloUsuario, $email, $password);
  $numeroSucursal = $ModeloUsuario->getNumeroSucursalUsuario($email);  
  
  getHeadHTML("ProSkin - Movimiento exitoso");
?>
<body style='background-color: #f9f3f3;'>
    <!-- <button type="button" class="btn btn-light"><a href="logout.php">Cerrar sesion</a></button> -->
    <?php
        require_once("../include/navbar.php");
        
        getNavbar($fetch_info['name'], $ModeloUsuario->getNombreSucursalUsuario($email)['nombre_sucursal']);
    ?>
    <main role="main" class="container">
        <div class="container">
                <div class="col d-flex justify-content-center">
                    <h1>Movimiento exitoso!</h1>
                    
                </div>
                <div class="col d-flex justify-content-center">
                    <a class="btn btn-primary" href="../../View/Inventario/" role="button">Regresar a inicio</a>
                </div>
        </div>
    </main>
    <?php
      getFooter();
    ?>
</body>
</html>