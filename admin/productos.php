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
    // $sucursalesList = $ModelCosmetologa -> getAllSucursales();
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
                        <table id="tablaPersonas" class="table table-striped table-bordered table-condensed"
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

        
    </div>
    <!--FIN del cont principal-->

<?php require_once "components/footer.php"?>