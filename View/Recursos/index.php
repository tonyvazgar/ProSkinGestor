<?php 
  require_once "../../Controller/Clientes/ClienteController.php"; 
  require_once "../../Controller/ControllerSesion.php";
  require_once "../../Model/Usuario/Usuario.php";
  require_once "../../Model/Tratamiento/Tratamiento.php";

  $session = new ControllerSesion();
  $ModeloUsuario = new Usuario();
  $ModelTratamiento = new Tratamiento();
  
  $email    = $_SESSION['email'];
  $password = $_SESSION['password'];
  
  $fetch_info = $session->verificarSesion($ModeloUsuario, $email, $password);

  $listaTratamientos = $ModelTratamiento->getListaTratamientosConPrecio();
  
  getHeadHTML("ProSkin - Recursos");
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
        <h1>Recursos</h1>
        <div class="container">
        <!-- Example row of columns -->
        <div class="row">
          <div class="col-md-4">
            <h2>Manuales</h2>
            <p>
              Manuales de uso de aparatos de la sucursal...
            </p>
            <p>
              <button class="btn btn-info collapsed" type="button" data-toggle="collapse" data-target="#collapseOne"
              aria-expanded="false" aria-controls="collapseOne">Ver manuales</button>
            </p>
          </div>
          <div class="col-md-4">
            <h2>Tratamientos</h2>
            <p>
              Listado de tratamientos con precios...
            </p>
            <p>
              <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
              aria-controls="collapseTwo">Ver lista de tratamientos</button>
            </p>
          </div>
          <div class="col-md-4">
            <h2>Archivos</h2>
            <p>
              Archivos de?...
            </p>
            <p>
              <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
              aria-controls="collapseThree">Ver archivos</button>
            </p>
          </div>
        </div>

        <hr>

        <div id="accordion">
          <div class="form-group">
            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion" style="">
            <ul class="list-group">
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="https://drive.google.com/drive/folders/1nwHaPfOO392ChMvl96KOfdv-Mh8uk1y_?usp=sharing" role="button">Manual de ProSkin Gestor</a>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="#" role="button">Documento n</a>
              </li> 
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="#" role="button">Documento n</a>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="#" role="button">Documento n</a>
              </li> 
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="#" role="button">Documento n</a>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="#" role="button">Documento n</a>
              </li> 
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="#" role="button">Documento n</a>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="#" role="button">Documento n</a>
              </li> 
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="#" role="button">Documento n</a>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="#" role="button">Documento n</a>
              </li> 
            </ul>
          </div>
        
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
              <div class="card-body">
                <ul class="list-group">
                  <?php
                    foreach($listaTratamientos as $tratamiento){
                      echo '<li class="list-group-item d-flex justify-content-between 
                              align-items-center">
                              <label>'.$tratamiento['nombre_tratamiento'].'</label>
                              <label>$'.number_format($tratamiento['precio']).'</label>
                            </li>';
                    }
                  ?>
                </ul>
              </div>
            </div>
        
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
              <div class="card-body">
              <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <a href="#" role="button">Archivo?</a>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <a href="#" role="button">Archivo?</a>
                </li> 
                
              </ul>
              </div>
            </div>
          </div>
        </div>

      </div>
      </div>
    </main>
    <?php
      getFooter();
    ?>
</body>
</html>