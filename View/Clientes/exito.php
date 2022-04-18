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
  
  getHeadHTML("ProSkin - Alta exitosa");
?>
<body style='background-color: #f9f3f3;'>
    <?php
        require_once("../include/navbar.php");
        getLoader("Cargando...");
        $fecha_para_corte_caja = getFechaFormatoCDMX();
        getNavbar($fecha_para_corte_caja, $fetch_info['name'], $ModeloUsuario->getNombreSucursalUsuario($email)['nombre_sucursal']);
    ?>
    <main role="main" class="container">
        <div class="container">
                <div class="col d-flex justify-content-center">
                    <h1>Registro exitoso!</h1>
                </div><br>
                <div class="text-center">
                    <?php
                        $mensaje = $_GET['mensaje'];
                        $link    = $_GET['link'];
                        echo '<h2>'.$mensaje.'</h2>';
                        if($link != ''){
                            echo '<a class="btn btn-success" href="'.$link.'" role="button">Ver movimiento</a>';
                        }
                    ?>
                </div><br>
                <div class="col d-flex justify-content-center">
                    <a class="btn btn-primary" href="../index.php" role="button">Regresar a inicio</a>
                </div>
        </div>
    </main>
    <?php
      getFooter();
    ?>
</body>
</html>