<?php 
  require_once "../../Controller/Clientes/ClienteController.php"; 
  require_once "../../Controller/ControllerSesion.php";
  require_once "../../Model/Usuario/Usuario.php";

  $session = new ControllerSesion();
  $ModeloUsuario = new Usuario();
  
  $email    = $_SESSION['email'];
  $password = $_SESSION['password'];
  
  $fetch_info = $session->verificarSesion($ModeloUsuario, $email, $password);
  
  getHeadHTML("ProSkin - Reporte cierre del día");
?>
<body style='background-color: #f9f3f3;'>
    <!-- <button type="button" class="btn btn-light"><a href="logout.php">Cerrar sesion</a></button> -->
    <?php
        require_once("../include/navbar.php");
        $fecha_para_corte_caja = date('Y-m-d');
        getNavbar($fecha_para_corte_caja, $fetch_info['name'], $ModeloUsuario->getNombreSucursalUsuario($email)['nombre_sucursal']);
    ?>
    <main role="main" class="container">
      <div class="container">
        <h1>
            <?php
                //echo "Hola ".$fetch_info['name']."! <br> hoy ".date("d")." de ".date("M")." hiciste lo siguiente:";
            ?>
        </h1>
        <div class="row">
          <div class="col-sm">
            <h3>XXX tratamientos = $xx,xxx.xx</h3>
            <ul class="list-group">
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="../../View/Ventas/detalleVenta.php?idVenta=LF09041513FAC1614">Depilaciones</a>
                <span class="badge bg-info rounded-pill">7</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="../../View/Ventas/detalleVenta.php?idVenta=LF09041513FAC1614">Cavitaciones</a>
                <span class="badge bg-info rounded-pill">2</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="../../View/Ventas/detalleVenta.php?idVenta=LF09041513FAC1614">Facial Premium C.Proof</a>
                <span class="badge bg-info rounded-pill">1</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="../../View/Ventas/detalleVenta.php?idVenta=LF09041513FAC1614">Masaje</a>
                <span class="badge bg-info rounded-pill">1</span>
              </li>
            </ul>
          </div>
          <div class="col-sm">
            <h3>XXX ventas = $xx,xxx.xx</h3>
              <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <a href="../../View/Ventas/detalleVenta.php?idVenta=AVG9602283ACN1129">FIRST ESSENCE EXCEL THERAPY</a>
                  <span class="badge bg-info rounded-pill">2</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Dropdown button
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </li>
              </ul>
          </div>
        </div>
        <br>
        <a href="index.php" class="btn btn-info">Regresar</a>
      </div>
    </main>
    <?php
      getFooter();
    ?>
</body>
</html>