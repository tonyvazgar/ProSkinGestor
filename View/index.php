<?php 
  require_once "../Controller/Index/IndexController.php"; 
  require_once "../Controller/ControllerSesion.php";
  require_once "../Model/Usuario/Usuario.php";
  require_once "../Model/Db.php";
  require_once "../Model/Clientes/Cliente.php";

  $session = new ControllerSesion();
  $ModeloUsuario = new Usuario();
  verificarStatusClientes(90);

  $email    = $_SESSION['email'];
  $password = $_SESSION['password'];
  
  $fetch_info = $session->verificarSesion($ModeloUsuario, $email, $password);
  
  getHeadHTML("ProSkin - Inicio");
?>

<body style='background-color: #f9f3f3;'>
    <?php
        require_once("./include/navbar.php");
        getNavbar($fetch_info['name'], $ModeloUsuario->getNombreSucursalUsuario($email)['nombre_sucursal']);
    ?>
    <main role="main" class="container">
      <div class="container">
        <img src="../View/img/en_construccion.png" class="img-fluid" alt="Responsive image">
      </div>
      <!-- <div class="container">
        <h1>Eventos de hoy</h1>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Cliente</th>
              <th scope="col">Tratamiento</th>
              <th scope="col">Hora</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Sara F.</td>
              <td>Masaje relajador</td>
              <td>12:30-1:30</td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Claudia X</td>
              <td>Lorem ipsum dolor sit amet </td>
              <td>3:00-4:00</td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>Nombre Apellido</td>
              <td>Tratamiento de ejemplo</td>
              <td>Duarcion del tratamiento</td>
            </tr>
          </tbody>
        </table>
        <p class="lead">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iusto enim fugiat repudiandae incidunt, optio dicta et dolorem quos. Perferendis dolorem facere quae id veritatis alias est illum non, sequi saepe.</p>
        <img src="./img/bg.webp" class="img-fluid" alt="Responsive image">
      </div> -->
      <!-- <div class="container">
        <div class="row">
          <div class="col-md-4">
            <h2>Heading</h2>
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
            <img src="./img/bg.webp" class="img-fluid" alt="Responsive image">
            <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
          </div>
          <div class="col-md-4">
            <h2>Heading</h2>
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
            <img src="./img/bg.webp" class="img-fluid" alt="Responsive image">
            <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
          </div>
          <div class="col-md-4">
            <h2>Heading</h2>
            <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
            <img src="./img/bg.webp" class="img-fluid" alt="Responsive image">
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