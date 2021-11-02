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
  
  getHeadHTML("ProSkin - Corte de caja exitoso");
?>
<body style='background-color: #f9f3f3;'>
    <?php
        require_once("../include/navbar.php");
        $fecha_para_corte_caja = getFechaFormatoCDMX();
        getNavbar($fecha_para_corte_caja, $fetch_info['name'], $ModeloUsuario->getNombreSucursalUsuario($email)['nombre_sucursal']);

        $rutaArchivo = "../../Documents/ReportesCierreCaja/".$ModeloUsuario -> getNombreArchivoFromCorteCajaWhereID($_GET['id']);
    ?>
    <main role="main" class="container"><br>
        <div class="container">
            <div class="col d-flex justify-content-center">
                <h1>Corte de caja exitoso!</h1>
            </div><br>
            <div class="col d-flex justify-content-center">
                <a class="btn btn-primary" href="../index.php" role="button">Regresar a inicio</a>
                <a class="btn btn-success" href="<?php echo $rutaArchivo ?>" role="button">Ver Reporte</a>
            </div>
        </div>
    </main>
    <?php
      getFooter();
    ?>
</body>
</html>