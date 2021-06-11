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
  $nombreSucursal = $ModeloUsuario->getNombreSucursalUsuario($email);
  $numeroSucursal = $ModeloUsuario->getNumeroSucursalUsuario($email);
  
  getHeadHTML("ProSkin - Alta Cliente");
?>
<body style='background-color: #f9f3f3;'>
    <!-- <button type="button" class="btn btn-light"><a href="logout.php">Cerrar sesion</a></button> -->
    <?php
        require_once("../include/navbar.php");
        
        getNavbar($fetch_info['name'], $ModeloUsuario->getNombreSucursalUsuario($email)['nombre_sucursal']);
    ?>
    <main role="main" class="container">
        <div class="container">
            <h1>Nuevo Cliente</h1>
            <form action="altaCliente.php" method="POST" autocomplete="">
                <div class="form-group">
                    <label>Nombre *</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa nombre del cliente" required>
                </div>
                <div class="form-group">
                    <label>Apellidos *</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Ingresar apellidos del cliente" required>
                </div>
                <div class="form-group">
                    <label>E-mail *</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa correo electronico del cliente" autocomplete="off"  required>
                </div>
                <div class="form-group">
                    <label>Télefono *</label>
                    <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "10" class="form-control" id="numero" name="numero" placeholder="Télefono del cliente Ej. 2227883728" required>
                    <select name="tipo" id="tipo" class="form-control">
                        <option value="0">Celular</option>
                        <option value="1">Fijo</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Centro</label>
                    <select name="centro" id="centro" class="form-control" readonly>
                        <option value=<?php echo "'".$numeroSucursal['id_sucursal']."'";?>> <?php echo $nombreSucursal['nombre_sucursal'];?></option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Fecha de nacimiento</label>
                    <input type="date" class="form-control" id="fecha" name="fecha">
                </div>
                <div class="form-group">
                    <label>Código Postal</label>
                    <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "text" maxlength = "5" class="form-control" id="cp" name="cp" placeholder="Ingresa CP del cliente">
                </div>
                <div class="form-group">
                    <label>Aviso de privacidad</label>
                    <select name="aviso" id="aviso" class="form-control">
                        <option>*** SELECCIONA ***</option>
                        <option value="0">No firmado</option>
                        <option value="1">Ya se firmó</option>
                    </select>
                </div>
                <button type="submit" id="altaCliente" name="altaCliente" class="btn btn-success">Dar de alta</button>
            </form>
        </div>
    </main>
    <?php
      getFooter();
    ?>
    <script src="../../Controller/Clientes/Util/validarCamposAlta.js"></script>
</body>
</html>