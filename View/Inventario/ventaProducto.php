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
  getApartados();
?>
<body style='background-color: #f9f3f3;'>
    <?php
        require_once("../include/navbar.php");
        $fecha_para_corte_caja = date('Y-m-d');
        getNavbar($fecha_para_corte_caja, $fetch_info['name'], $ModeloUsuario->getNombreSucursalUsuario($email)['nombre_sucursal']);
    ?>
    <main role="main" class="container">
        <div class="container">
                <?php
                    $id = $_GET['id'];
                    $id_sucursal = $ModeloUsuario -> getNumeroSucursalUsuario($email)['id_sucursal'];
                    $infoProducto = $ModelProducto->getProductoWereID($id, $id_sucursal);
                ?>
                    <h1>Detalles de la venta</h1>
                    <hr/>
                    <h4>Nota: NO ACTUALIZAR LA PÁGINA NI PRESIONAR <i>F5</i></h4>
                    <hr/>
                    <form action="ventaProducto.php" method="POST" autocomplete="off">
                    <div class="productos">
                        <div class="plantilla">
                            <h2 class='numProductos'>Producto #1</h2>
                            <div class="form-group">
                                <table class="table table-borderless" style="table-layout: fixed;">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <h4>ID producto:</h4>
                                                <p class="last_producto lead"><?php echo $infoProducto['id_producto'];?></p><input type="text" class="last_producto form-control" id="id_producto_seleccionado" name="id_producto_seleccionado[]" value=<?php echo $infoProducto['id_producto'];?> hidden readonly>
                                                <input type="text" class="form-control" id="centro" name="centro" value=<?php echo "'".$numeroSucursal['id_sucursal']."'"; ?> hidden>
                                                <input type="text" class="form-control" id="idCosmetologa" name="idCosmetologa" value=<?php echo "'".$id_cosmetologa['id']."'";?> hidden>
                                            </td>
                                            <td>
                                                <h4>Unidades disponibles</h4>
                                                <p class="last_producto lead"><?php echo $infoProducto['stock_disponible_producto'];?></p><input type="text" class="last_producto form-control" id="stock_producto_seleccionado" name="stock_producto_seleccionado[]" value=<?php echo $infoProducto['stock_disponible_producto'];?> hidden readonly>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group">
                                <h4>Descripción:</h4>
                                <p class="last_producto lead"><?php echo $infoProducto['descripcion_producto'];?></p><input type="text" class="last_producto form-control" id="apellidos" name="apellidos" value=<?php echo "'".$infoProducto['descripcion_producto']."'";?> hidden readonly>
                            </div>
                            <div class="form-group">
                                <table class="table table-borderless" style="table-layout: fixed;">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <h4>Precio por pieza</h4>
                                                <input type="number" class="last_producto form-control" id="precioUnitario_producto_seleccionado" name="precioUnitario_producto_seleccionado[]" value=<?php echo $infoProducto['costo_unitario_producto'];?>>
                                            </td>
                                            <td>
                                                <h4>Cantidad</h4>
                                                <input type="number" class="last_producto form-control" id="cantidad_producto_seleccionado" name="cantidad_producto_seleccionado[]" placeholder="Unidades a verder" required>
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
                                                <h4>Precio de venta</h4>
                                                <p class="last_producto lead total_producto_seleccionado_label"></p><input type="text" class="last_producto form-control" id="total_producto_seleccionado" name="total_producto_seleccionado[]" hidden readonly>
                                            </td>
                                            <td>
                                                <h4>&nbsp;</h4>
                                                <button id="btn-apartar-producto" class="last_producto btn btn-success btn-apartar-producto" type="button" disabled="disabled">Apartar producto(s)</button> 
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id='div-agregarTratamiento' name='div-agregarTratamiento'>
                        <button id="btn-agregar-producto" class="btn btn-warning btn-agregar-producto" type="button" disabled="disabled">Agregar otro producto</button> 
                    </div>
                    <div class="form-group">
                        <td>
                            <h4>Método de pago:</h4>
                            <select name='metodoPago' id='metodoPago' class='form-control'>
                                <option value='6'>Depósito</option>
                                <option value='1'>Efectivo</option>
                                <option value='2'>[TDD]Tarjeta de débito</option>
                                <option value='3'>[TDC]Tarjeta de crédito</option>
                                <option value='4'>Transferencia</option>
                                <option value='5'>Cheque de regalo</option>
                            </select>
                            <input type="text" class="form-control" id="referencia" name="referencia" placeholder="Número de referencia del pago">
                        </td>
                    </div>
                    <button type="submit" id="venderProducto" name="venderProducto" class="btn btn-success">Vender producto</button>
            </form>
        </div>
    </main>
    <?php
      getFooter();
    ?>
    <script src="../../Controller/Ventas/Util/validarCamposVentaProducto.js"></script>
</body>
</html>