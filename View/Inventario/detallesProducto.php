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
  
  $ModelProducto = new Producto();

  getHeadHTML("ProSkin - Detalles producto");
?>
<body style='background-color: #f9f3f3;'>
    <?php
        require_once("../include/navbar.php");
        $fecha_para_corte_caja = getFechaFormatoCDMX();
        getNavbar($fecha_para_corte_caja, $fetch_info['name'], $ModeloUsuario->getNombreSucursalUsuario($email)['nombre_sucursal']);
        $id_sucursal = $ModeloUsuario -> getNumeroSucursalUsuario($email)['id_sucursal'];
        $id = $_GET['id'];
        $infoProducto = $ModelProducto->getProductoWereID($id, $id_sucursal);
    ?>
    <main role="main" class="container">
        <form action="detallesProducto.php" method="POST" autocomplete="" onsubmit="return confirm('¿Estás seguro de modificar la información de este producto?');">
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <h1>Detalles del producto <br>
                            <em>
                                <?php echo $infoProducto['descripcion_producto'];?>
                            </em>
                        </h1>
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col-sm">
                        <h4>ID producto:</h4>
                        <p class="lead">
                            <?php echo $infoProducto['id_producto'];?>
                        </p>
                        <input type="text" class="form-control" id="id" name="id" value=<?php echo $infoProducto['id_producto'];?> hidden readonly>
                        <input type="text" class="form-control" id="idSucursal" name="idSucursal" value=<?php echo $id_sucursal;?> hidden readonly>
                    </div>
                    <div class="col-sm">
                        <h4>Marca</h4>
                        <p class="lead">
                            <?php echo $infoProducto['marca_producto'];?>
                        </p>
                        <input type="text" class="form-control" id="nombre" name="nombre" value=<?php echo "'".$infoProducto['marca_producto']."'";?> hidden readonly>
                    </div>
                    <div class="col-sm">
                        <h4>Linea</h4>
                        <p class="lead">
                            <?php echo $infoProducto['linea_producto'];?>
                        </p>
                        <input type="text" class="form-control" id="nombre" name="nombre" value=<?php echo "'".$infoProducto['linea_producto']."'";?> hidden readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <h4>Descripción</h4>
                        <p class="lead" id="descripcionLbl">
                            <em><?php echo $infoProducto['descripcion_producto'];?></em></p>
                            <textarea type="text" class="form-control" id="descripcion" name="descripcion" style="display: none;" readonly><?php echo $infoProducto['descripcion_producto'];?></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <h4>Presentación</h4>
                            <p class="lead" id="presentacionLbl">
                                <?php echo $infoProducto['presentacion_producto'];?>
                            </p>
                            <input type="text" class="form-control" id="presentacion" name="presentacion" value=<?php echo "'".$infoProducto['presentacion_producto']."'";?> style="display: none;" readonly>
                    </div>
                    <div class="col-sm">
                        <h4>Precio</h4>
                        <p class="lead" id="precioLbl">
                            <?php echo "$".number_format($infoProducto['costo_unitario_producto']);?>
                        </p>
                        <input type="number" class="form-control" id="precio" name="precio" value=<?php echo $infoProducto['costo_unitario_producto'];?> style="display: none;" readonly>
                    </div>
                    <div class="col-sm">
                        <h4>Unidades disponibles</h4>
                        <p class="lead" id="stockDisponibleLbl">
                            <?php echo $infoProducto['stock_disponible_producto'];?>
                        </p>
                        <input type="number" class="form-control" id="stockDisponible" name="stockDisponible" value=<?php echo $infoProducto['stock_disponible_producto'];?> style="display: none;" readonly>
                    </div>
                </div>
            </div>
                <div class="text-center">
                    <a href="../../View/Inventario/" class="btn btn-warning">Regresar</a>
                    <button type="button" id="cancelarAgregarStock" name="cancelarAgregarStock" class="btn btn-info" style="display: none;">Cancelar</button>
                    <button type="button" id="agregarStock" name="agregarStock" class="btn btn-info">Modificar Información</button>
                    <button type="submit" id="agregarStockSubmit" name="agregarStockSubmit" class="btn btn-success" style="display: none;">Confirmar Modificación</button>
                </div>
                <div class="text-center" id="buttonEliminarProductoDiv" style="display: none;">
                    <button type="submit" id="buttonEliminarProducto" name="buttonEliminarProducto" class="btn btn-danger">Eliminar Producto</button>
                </div>
        </form>
    </main>
    <?php
      getFooter();
    ?>
    <script src="../../Controller/Inventario/Util/validarCamposAltaProducto.js"></script>
</body>
</html>