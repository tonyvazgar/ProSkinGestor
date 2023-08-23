<?php 
    include_once "./components/header.php";
    include_once './Model/Producto.php';
    require_once "./Model/Session.php";

    $Session = new Session();
    $ModelProducto = new Producto();
    
    $idSucursal = $Session -> getSucursalFromSession();
    $data = [];
    if($Session->isAdminGlobal()) {
        $data = $ModelProducto -> getAllProductosAsGlobalAdmin();
        // printArrayPrety($data);
    } else {
        $data = $ModelProducto -> getAllProductosAsLocalAdmin($idSucursal);
        // printArrayPrety($data);
    }
    $sucursalesList = $ModelProducto -> getAllSucursales();
?>
    <!--INICIO del cont principal-->
    <div class="container">
        <div class="container">
            <h1>Lista de productos</h1>
            <div class="row">
                <div class="col-lg-12">
                    <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>
                </div>
            </div>
        </div>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table id="productsTable" class="table table-striped table-bordered table-condensed"
                            style="width:100%">
                            <thead class="text-center">
                                <tr>
                                    <th>ID</th>
                                    <th>Marca</th>
                                    <th>Linea</th>
                                    <th>Descripción</th>
                                    <th>Presentación</th>
                                    <th>Stock</th>
                                    <th>Costo</th>
                                    <th>Sucursal</th>
                                    <th style="display: none;">ID Sucursal</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php                            
                                foreach($data as $dat) {
                                ?>
                                    <tr>
                                        <td><?php echo $dat['id_producto'] ?></td>
                                        <td><?php echo $dat['marca_producto'] ?></td>
                                        <td><?php echo $dat['linea_producto'] ?></td>
                                        <td><?php echo $dat['descripcion_producto'] ?></td>
                                        <td><?php echo $dat['presentacion_producto'] ?></td>
                                        <td><?php echo $dat['stock_disponible_producto'] ?></td>
                                        <td><?php echo $dat['costo_unitario_producto'] ?></td>
                                        <td><?php echo $dat['nombre_sucursal'] ?></td>
                                        <td style="display: none;"><?php echo $dat['centro_producto'] ?></td>
                                        <td></td>
                                    </tr>
                                    <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!--Modal para CRUD-->
        <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <form id="productsForm" autocomplete="off" method="POST">
                        <div class="modal-body">
                            <div class="form-group mb-3 row">
                                <label for="product_id" class="col-sm-2 col-form-label">ID:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="product_id">
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <label for="product_brand" class="col-sm-2 col-form-label">Marca:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="product_brand">
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <label for="product_line" class="col-sm-2 col-form-label">Linea:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="product_line">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_description" class="form-label">Descripción</label>
                                <textarea class="form-control" id="product_description" rows="2"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="product_presentation" class="col-form-label">Presentación:</label>
                                <input type="text" class="form-control" id="product_presentation">
                            </div>
                            <div class="form-group mb-3 row">
                                <label for="product_stock" class="col-sm-2 col-form-label">Stock:</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="product_stock">
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <label for="product_cost" class="col-sm-2 col-form-label">Costo:</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="product_cost">
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <label for="sucursal" class="col-sm-2 col-form-label">Sucursal:</label>
                                <div class="col-sm-10">
                                <select name="sucursal" id="sucursal" class="form-control">
                                    <option value="">--- Selecciona una sucursal ---</option>
                                    <?php                            
                                    foreach($sucursalesList as $sucursal) {
                                ?>
                                    <option <?php echo 'value="' .$sucursal['id_sucursal'].'"'; ?>>
                                        <?php echo $sucursal['nombre_sucursal'] ?>
                                    </option>
                                    <?php
                                    }
                                ?>
                                </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                            <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--FIN del cont principal-->

<?php 
    require_once "components/footer.php";
    echo '<!-- código propio JS -->
    <script type="text/javascript" src="./js/Producto/main.js"></script>
    <script type="text/javascript" src="/admin/js/crudProducto.js"></script>';
?>