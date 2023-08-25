<?php 
    include_once "./components/header.php";
    include_once './Model/Sucursal.php';
    require_once "./Model/Session.php";

    $Session = new Session();
    $ModelSucursal = new Sucursal();
    
    if($Session->isAdminGlobal()) {
        $data = $ModelSucursal -> getAllSucursales();
    }
?>
    <!--INICIO del cont principal-->
    <div class="container">
        <div class="container">
            <h1>Lista de sucursales</h1>

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
                                    <th>Nombre sucursal</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php                            
                                foreach($data as $dat) {
                                ?>
                                    <tr>
                                        <td><?php echo $dat['id_sucursal'] ?></td>
                                        <td><?php echo $dat['nombre_sucursal'] ?></td>
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
        <div class="modal fade" id="modalSucursal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <form id="formSucursal">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="sucursal_id" class="col-form-label">ID:</label>
                                <input type="text" class="form-control" id="sucursal_id" disabled>
                            </div>
                            <div class="form-group">
                                <label for="sucursal_name" class="col-form-label">Nombre:</label>
                                <input type="text" class="form-control" id="sucursal_name">
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                                <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
                            </div>
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
    <script type="text/javascript" src="./js/Sucursal/main.js"></script>';
?>