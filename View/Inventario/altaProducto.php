<?php 
  require_once "../../Controller/Clientes/ClienteController.php"; 
  require_once "../../Controller/Inventario/InventarioController.php"; 
  require_once "../../Controller/ControllerSesion.php";
  require_once "../../Model/Usuario/Usuario.php";

  $session = new ControllerSesion();
  $ModeloUsuario = new Usuario();
  
  $email    = $_SESSION['email'];
  $password = $_SESSION['password'];
  
  $fetch_info = $session->verificarSesion($ModeloUsuario, $email, $password);
  $numeroSucursal = $ModeloUsuario->getNumeroSucursalUsuario($email);  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ProSkin - Alta en inventario</title>
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
    <?php
        require_once("../include/navbar.php");
        
        getNavbar($fetch_info['name'], $ModeloUsuario->getNombreSucursalUsuario($email)['nombre_sucursal']);
    ?>
    <main role="main" class="container">
        <div class="container">
            <h1>Nuevo Producto</h1>
            <form action="altaProducto.php" method="POST" autocomplete="">
                <div class="form-group">
                    <label>Nombre *</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa nombre del producto" required>
                    <input type="text" class="form-control" id="centro" name="centro" value=<?php echo "'".$numeroSucursal['id_sucursal']."'"; ?> hidden="">
                </div>
                <div class="form-group">
                    <label>Descripción *</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Ingresar la descripción del producto" required>
                </div>
                <div class="form-group">
                    <label>Precio *</label>
                    <input type="number" class="form-control" id="precio" name="precio" step=".01" placeholder="Precio unitario del producto" required>
                </div>
                <div class="form-group">
                    <label>Unidades disponibles *</label>
                    <input type="number" class="form-control" id="unidades" name="unidades" placeholder="Cantidad de unidades disponibles" required>
                </div>
                <button type="submit" id="altaInventario" name="altaInventario" class="btn btn-success">Dar de alta</button>
            </form>
        </div>
    </main>
    <?php
      getFooter();
    ?>
    <!-- <script src="../../Controller/Clientes/Util/validarCamposAlta.js"></script> -->
</body>
</html>