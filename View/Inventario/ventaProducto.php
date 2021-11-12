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
    <?php
        require_once("../include/navbar.php");
        $fecha_para_corte_caja = getFechaFormatoCDMX();
        getNavbar($fecha_para_corte_caja, $fetch_info['name'], $ModeloUsuario->getNombreSucursalUsuario($email)['nombre_sucursal']);
        $corte = $ModeloUsuario->existeCorteCaja(strtotime($fecha_para_corte_caja), $numeroSucursal['id_sucursal']);
        getApartados();
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
                                                <input type="number" class="last_producto form-control" id="precioUnitario_producto_seleccionado" step='any' name="precioUnitario_producto_seleccionado[]" value=<?php echo $infoProducto['costo_unitario_producto'];?>>
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
                    <hr>
                    <div class="form-inline justify-content-center" id='div-sumaTotalPrecios' name='div-sumaTotalPrecios'>
                        <h4>Total de venta</h4>
                        <input type="number" class="last_producto form-control" id="sumaTotalPrecios" name="sumaTotalPrecios" readonly>
                    </div>
                    <hr>
                    <div class='form-inline'>
                        <h3>Métodos de pago:</h3>
                        <input type="number" class="last_producto form-control" id="sumaTotalMetodosPago" name="sumaTotalMetodosPago" placeholder="Suma total métodos" readonly>
                    </div>
                    <div class="form-group metodosPagoDiv" id="metodosPagoDiv">
                        <div class='form-inline'>
                            <h4>Método 1:</h4>
                            <div>
                                <select name='metodoPago[]' id='metodoPago' class='form-control select_metodo1'>
                                    <option value=''>*** Selecciona ***</option>
                                    <option value='6'>Depósito</option>
                                    <option value='1'>Efectivo</option>
                                    <option value='2'>[TDD]Tarjeta de débito</option>
                                    <option value='3'>[TDC]Tarjeta de crédito</option>
                                    <option value='4'>Transferencia</option>
                                    <option value='5'>Cheque de regalo</option>
                                </select>
                                <input type="text" class="form-control referencia_metodo1" id="referencia" name="referencia[]" placeholder="Número de referencia del pago" style="display: none;">
                                <input type="number" class="form-control" id="totalMetodoPago" name="totalMetodoPago[]" placeholder="Cantidad de este método de pago" step='any'>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class='form-group'>
                        <button class='btn btn-info' id="botonAgregarMetodoPago" type="button">Agregar método de pago <i class="fas fa-plus-circle"></i></button>
                    </div>
                    <div class="form-group text-center" id="notificaciones_div">
                        <?php
                            if($corte){
                                echo '<p class="lead text-danger">IMPORTANTE</p>
                                <p class="lead text-danger">Ya se hizo el corte de caja, esta venta se desplazará al siguiente día</p>';
                            }
                        ?>
                    </div>
                    <hr>
                    <button type="submit" id="venderProducto" name="venderProducto" class="btn btn-success" disabled>Vender producto</button>
            </form>
        </div>
    </main>
    <?php
      getFooter();
    ?>
    <script src="../../Controller/Ventas/Util/validarCamposVentaProducto.js"></script>
</body>
</html>