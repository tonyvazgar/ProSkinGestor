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
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ProSkin - Alta Cliente</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"
    integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g=="
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../include/navbar.css">
    <script src="../include/loadNavbar.js"></script>
</head>
<body style='background-color: #f9f3f3;'>
    <!-- <button type="button" class="btn btn-light"><a href="logout.php">Cerrar sesion</a></button> -->
    <?php
        require_once("../include/navbar.php");
        getNavbar($fetch_info['name']);
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
                    <select name="centro" id="centro" class="form-control">
                        <option value="1">Sonata</option>
                        <option value="2">Plaza Real</option>
                        <option value="3">La Paz</option>
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