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

  getHeadHTML("ProSkin - Venta individual de producto");
?>
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
                    <div class="form-group" id='div-agregarTratamiento' name='div-agregarTratamiento'>
                        <button id="btn-agregar-producto" class="btn btn-warning btn-agregar-producto" type="button">Agregar producto</button> 
                    </div>
                    <form action="ventaProducto.php" method="POST" autocomplete="">
                    <div class="productos">
                        <div class="plantilla">
                            <div class="form-group">
                                <label for="exampleInputEmail1">ID</label>
                                <input type="text" class="form-control" id="id_producto_seleccionado" name="id_producto_seleccionado[]" value=<?php echo $infoProducto['id_producto'];?> readonly>
                                <input type="text" class="form-control" id="centro" name="centro" value=<?php echo "'".$numeroSucursal['id_sucursal']."'"; ?> hidden>
                                <input type="text" class="form-control" id="idCosmetologa" name="idCosmetologa" value=<?php echo "'".$id_cosmetologa['id']."'";?> hidden>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Descripción</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" value=<?php echo "'".$infoProducto['descripcion_producto']."'";?> readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Unidades disponibles</label>
                                <input type="text" class="form-control" id="stock_producto_seleccionado" name="stock_producto_seleccionado[]" value=<?php echo $infoProducto['stock_disponible_producto'];?> readonly>
                            </div>
                            <div class="form-group">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label for="exampleInputEmail1">Precio por pieza</label>
                                                <input type="number" class="form-control" id="precioUnitario_producto_seleccionado" name="precioUnitario_producto_seleccionado[]" value=<?php echo $infoProducto['costo_unitario_producto'];?>>
                                            </td>
                                            <td>
                                                <label for="exampleInputEmail1">Cantidad</label>
                                                <input type="number" class="form-control" id="cantidad_producto_seleccionado" name="cantidad_producto_seleccionado[]" placeholder="Unidades a verder" required>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label for="exampleInputEmail1">Precio de venta</label>
                                                <input type="text" class="form-control" id="total_producto_seleccionado" name="total_producto_seleccionado[]" readonly>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <td>
                            <label>Método de pago: </label>
                            <select name='metodoPago' id='metodoPago' class='form-control'>
                                <option value='1'>Efectivo</option>
                                <option value='2'>[TDD]Tarjeta de débito</option>
                                <option value='3'>[TDC]Tarjeta de crédito</option>
                                <option value='4'>Transferencia</option>
                                <option value='5'>Cheque de regalo</option>
                            </select>
                        </td>
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