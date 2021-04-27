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
            <h1>Registrar nuevo producto en inventario</h1>
            <form action="altaProducto.php" method="POST" autocomplete="off">
                <div class="form-group">
                    <label>Marca *</label>
                    <select name="marca" id="marca" class="form-control">
                        <option value="">** SELECCIONA **</option>
                        <option value="MIGUETT">MIGUETT</option>
                        <option value="AINHOA">AINHOA</option>
                        <option value="GERMAINE">GERMAINE</option>
                    </select>
                    <input type="text" class="form-control" id="centro" name="centro" value=<?php echo "'".$numeroSucursal['id_sucursal']."'"; ?> hidden="">
                </div>
                <div class="form-group">
                    <label>Linea *</label>
                    <select name='linea' id='linea' class='form-control'>
                      <option value=''>** SELECCIONA **</option>
                      <option value='PURITY'>PURITY</option>
                      <option value='WHITESS'>WHITESS</option>
                      <option value='OXYGEN'>OXYGEN</option>
                      <option value='SENSKIN'>SENSKIN</option>
                      <option value='COLLAGEN%2B'>COLLAGEN +</option>
                      <option value='MULTIVIT'>MULTIVIT</option>
                      <option value='BIOME CARE'>BIOME CARE</option>
                      <option value='OLIVE'>OLIVE</option>
                      <option value='SPECIFIC'>SPECIFIC</option>
                      <option value='HYALURONIC'>HYALURONIC</option>
                      <option value='SKIN PRIMES'>SKIN PRIMES</option>
                      <option value='BODY LINE UP'>BODY LINE UP</option>
                      <option value='CANNABI7'>CANNABI7</option>
                      <option value='SPA LUXURY'>SPA LUXURY</option>
                      <option value='OTRO'>OTRO</option>
                      <option value='PACKS'>PACKS</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Descripción *</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Ingresar la descripción del producto" required>
                </div>
                <div class="form-group">
                    <label>Presentación *</label>
                    <input type="text" class="form-control" id="presentacion" name="presentacion" placeholder="Ingresar la descripción del producto" required>
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
    <script src="../../Controller/Inventario/Util/validarCamposAltaProducto.js"></script>
</body>
</html>