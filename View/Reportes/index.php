<?php 
  require_once "../../Controller/Clientes/ClienteController.php"; 
  require_once "../../Controller/ControllerSesion.php";
  require_once "../../Model/Usuario/Usuario.php";

  $session = new ControllerSesion();
  $ModeloUsuario = new Usuario();
  
  $email    = $_SESSION['email'];
  $password = $_SESSION['password'];
  
  $fetch_info = $session->verificarSesion($ModeloUsuario, $email, $password);
  
  getHeadHTML("ProSkin - Reportes");
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
        <h1>Reportes</h1>
        <div class="container px-4 py-5" id="featured-3">
          <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
            <div class="feature col">
              <h2>Reporte de cierre de día</h2>
              <p>
              En este reporte puedes consultar el total de tratamientos y ventas realizados en el día.
              </p>
              <a href="reporteCierreDia.php" class="btn btn-primary">
                Consultar
              </a>
            </div>
            <div class="feature col">
              <h2>Featured title</h2>
              <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
              <a href="#" class="btn btn-primary">
                Primary button
              </a>
            </div>
            <div class="feature col">
              <h2>Featured title</h2>
              <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
              <a href="#" class="btn btn-primary">
                Primary button
              </a>
            </div>
          </div>
        </div>
        <img src="../img/img2.jpg" class="img-fluid" alt="Responsive image">
      </div>
    </main>
    <?php
      getFooter();
    ?>
</body>
</html>