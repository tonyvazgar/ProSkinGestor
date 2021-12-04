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
  $nombreSucursal = $ModeloUsuario->getNombreSucursalUsuario($email)['nombre_sucursal'];
  $numeroSucursal = $ModeloUsuario->getNumeroSucursalUsuario($email)['id_sucursal'];
  
  getHeadHTML("ProSkin - Corte de caja exitoso");
?>
<body style='background-color: #f9f3f3;'>
    <?php
        require_once("../include/navbar.php");
        $fecha_para_corte_caja = getFechaFormatoCDMX();
        getNavbar($fecha_para_corte_caja, $fetch_info['name'], $ModeloUsuario->getNombreSucursalUsuario($email)['nombre_sucursal']);

        $info_cierreCaja = $ModeloUsuario->getInformacionFromCierreCajaWhereID($_GET['id']);

        $fechaCorteCaja = date('d-m-Y', $info_cierreCaja['timestamp']);
        $total_ventas = number_format($info_cierreCaja['total_ingresos'], 2);
        $total_gastos = number_format($info_cierreCaja['total_gastos'], 2);
        $total_diferencia = number_format($info_cierreCaja['total_caja'], 2);
        $efectivo_a_entregar = number_format(json_decode($info_cierreCaja['efectivo'])[1] - $total_gastos, 2);


        $dominio = "https://www.proskingestor.com/";
        $rutaArchivo = "Documents/ReportesCierreCaja/".$ModeloUsuario -> getNombreArchivoFromCorteCajaWhereID($_GET['id']);

        $texto = "Corte de caja de {$nombreSucursal} con fecha de {$fechaCorteCaja}, con un total de ventas de $".$total_ventas.", de gastos de $".$total_gastos.". \n Con $".$efectivo_a_entregar." de efectivo a entregar. Disponible  en: ";


        $linkRuta = urlencode($texto).urlencode($dominio.$rutaArchivo);

        // $linkWA = "https://wa.me/+5212222122484?text=".$linkRuta;
        $linkWA = "https://wa.me/+5212222122484?text=".$linkRuta;

    ?>
    <main role="main" class="container"><br>
        <div class="container">
            <div class="col d-flex justify-content-center">
                <h1>Corte de caja exitoso!</h1>
            </div><br>
            <div class="col d-flex justify-content-center">
                <a class="btn btn-primary" href="../index.php" role="button">Regresar a inicio</a>
                <a class="btn btn-success" href="<?php echo $dominio.$rutaArchivo ?>" role="button">Ver Reporte</a>
                <!-- <a class="btn btn-success" href="<?php echo "../../".$rutaArchivo ?>" role="button">Ver Reporte</a> -->
            </div>
            <div class="col d-flex justify-content-center">
                <a class="btn btn-success" href="<?php echo $linkWA ?>" role="button">Notificar por <i class="fab fa-whatsapp"></i></a>
            </div>
        </div>
    </main>
    <?php
      getFooter();
    ?>
</body>
</html>