<?php 
    include_once "./components/header.php";
    include_once './Model/Tratamiento.php';
    require_once "./Model/Session.php";

    $Session = new Session();
    $ModelTratamiento = new Tratamiento();
    
    $idSucursal = $Session -> getSucursalFromSession();
    $data = [];
    if($Session->isAdminGlobal()) {
        $data = $ModelTratamiento -> getAllTratamientos();
        // printArrayPrety($data);
    }
    // $sucursalesList = $ModelCosmetologa -> getAllSucursales();
?>
    <!--INICIO del cont principal-->
    <div class="container">
        <div class="container">
            <h1>Lista de tratamientos</h1>

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
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Duración</th>
                                    <th>Consentimiento</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php                            
                                foreach($data as $dat) {
                                ?>
                                    <tr>
                                        <td><?php echo $dat['id_tratamiento'] ?></td>
                                        <td><?php echo $dat['nombre_tratamiento'] ?></td>
                                        <td><?php echo $dat['precio'] ?></td>
                                        <td><?php echo $dat['duracion_tratamiento'] ?></td>
                                        <td><?php echo $dat['consentimiento_tratamiento'] ?></td>
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
                    <form id="tratamientosForm" autocomplete="off" method="POST">
                        <div class="modal-body">
                            <div class="form-group mb-3 row">
                                <label for="tratamiento_id" class="col-sm-2 col-form-label">ID:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="tratamiento_id">
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <label for="tratamiento_name" class="col-sm-2 col-form-label">Nombre:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="tratamiento_name">
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <label for="tratamiento_price" class="col-sm-2 col-form-label">Precio:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="tratamiento_price">
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <label for="tratamiento_duration" class="col-sm-2 col-form-label">Duraci€on:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="tratamiento_duration">
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <label for="tratamiento_consentimiento" class="col-sm-2 col-form-label">Consentimiento:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="tratamiento_consentimiento">
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
    <script type="text/javascript" src="./js/Tratamiento/main.js"></script>';
?>