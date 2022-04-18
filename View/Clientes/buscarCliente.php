<script>if ( window.history.replaceState ) { window.history.replaceState( null, null, window.location.href );}</script>
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
  
  getHeadHTML("ProSkin - Busqueda Cliente");
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
            <h1>Busqueda de un cliente</h1>
            <div class="form-group text-center" id="cargandoLoader" style="display: none;">
                <br>
                <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                <br>
                <strong>Buscando cliente...</strong>
            </div>
            <form action="buscarCliente.php" method="POST" autocomplete="off">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nombre o Apellidos</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa nombre o apellidos a buscar" required>
                </div>
                <button type="submit" id="buscarCliente" name="buscarCliente" class="btn btn-success">Buscar</button>
            </form>
        </div>
    </main>
    <?php
      getFooter();
    ?>
    <script src="../../Controller/Clientes/Util/buscarCliente.js"></script>
</body>
</html>