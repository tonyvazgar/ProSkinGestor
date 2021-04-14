<?php 
  require_once "../../Controller/Clientes/ClienteController.php"; 
  require_once "../../Controller/Inventario/InventarioController.php"; 
  require_once "../../Model/Clientes/Cliente.php";
  require_once "../../Controller/ControllerSesion.php";
  require_once "../../Model/Usuario/Usuario.php";
  require_once "../../Model/Inventario/Producto.php";

  $ModelCliente = new Cliente();
  $session = new ControllerSesion();
  $ModeloUsuario = new Usuario();
  
  $email    = $_SESSION['email'];
  $password = $_SESSION['password'];
  
  $fetch_info = $session->verificarSesion($ModeloUsuario, $email, $password);
  $numeroSucursal = $ModeloUsuario->getNumeroSucursalUsuario($email);  
  $id_cosmetologa = $ModeloUsuario->getIdCosmetologa($email);
  
  $ModelProducto = new Producto();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ProSkin - Venta individual de producto</title>
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
        
        getNavbar($fetch_info['name'], $ModeloUsuario->getNombreSucursalUsuario($email)['nombre_sucursal']);
    ?>
    <main role="main" class="container">
        <div class="container">
                <?php
                    $id = $_GET['id'];
                    $info = $ModelProducto->getProductoWereID($id);
                    foreach($info as $infoProducto){
                ?>
                    <h1>Detalles de la venta</h1>
                    <form action="ventaProducto.php" method="POST" autocomplete="">
                    <div class="form-group">
                        <label for="exampleInputEmail1">ID</label>
                        <input type="text" class="form-control" id="id" name="id" value=<?php echo $infoProducto['id_producto'];?> readonly>
                        <input type="text" class="form-control" id="centro" name="centro" value=<?php echo "'".$numeroSucursal['id_sucursal']."'"; ?> hidden>
                        <input type="text" class="form-control" id="idCosmetologa" name="idCosmetologa" value=<?php echo "'".$id_cosmetologa['id']."'";?> hidden>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value=<?php echo "'".$infoProducto['nombre_producto']."'";?> readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Descripción</label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos" value=<?php echo "'".$infoProducto['descripcion_producto']."'";?> readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Unidades disponibles</label>
                        <input type="text" class="form-control" id="stock" name="stock" value=<?php echo $infoProducto['stock_disponible_producto'];?> readonly>
                    </div>
                    <div class="form-group">
                        <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td>
                                    <label for="exampleInputEmail1">Precio por pieza</label>
                                    <input type="number" class="form-control" id="precioUnitario" name="precioUnitario" value=<?php echo $infoProducto['costo_unitario_producto'];?> readonly>
                                </td>
                                <td>
                                    <label for="exampleInputEmail1">Cantidad</label>
                                    <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Unidades a verder" required>
                                </td>
                            </tr>
                        </tbody></table>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Precio de venta</label>
                        <input type="text" class="form-control" id="total" name="total" readonly>
                    </div>
                    
                    <button type="submit" id="venderProducto" name="venderProducto" class="btn btn-success">Vender producto</button>
                <?php
                    }
                ?>
            </form>
        </div>
    </main>
    <?php
      getFooter();
    ?>
    <script src="../../Controller/Ventas/Util/validarCamposVentaProducto.js"></script>
</body>
</html>