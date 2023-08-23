<?php 
    include_once "./components/header.php";
    include_once './Model/Cosmetologa.php';

    require_once "./Model/Session.php";
    $Session = new Session();

    $ModelCosmetologa = new Cosmetologa();

    $idSucursal = $Session -> getSucursalFromSession();
    $data = [];
    if($Session->isAdminGlobal()) {
        $data = $ModelCosmetologa -> getAllCometologasAsGlobalAdmin();
    } else {
        $data = $ModelCosmetologa -> getAllCometologasAsLocalAdmin($idSucursal);
    }
    $sucursalesList = $ModelCosmetologa -> getAllSucursales();
?>

    <!--INICIO del cont principal-->
    <div class="container">

        <div class="container">
            <h1>Lista de cosmetólogas</h1>
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
                                    <th>Nombre</th>
                                    <th>Usuario</th>
                                    <th style="display: none;">Password</th>
                                    <th>Code</th>
                                    <th>Status</th>
                                    <th style="display: none;">Sucursal</th>
                                    <th>Sucursal</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php                            
                                foreach($data as $dat) {
                                ?>
                                    <tr>
                                        <td><?php echo $dat['id'] ?></td>
                                        <td><?php echo $dat['name'] ?></td>
                                        <td><?php echo $dat['email'] ?></td>
                                        <td style="display: none;"><?php echo $dat['password'] ?></td>
                                        <td><?php echo $dat['code'] ?></td>
                                        <td><?php echo $dat['status'] ?></td>
                                        <td hidden><?php echo $dat['id_sucursal_usuario'] ?></td>
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
        <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <form id="formPersonas" autocomplete="off" method="POST">
                        <div class="modal-body">
                            <div class="form-group mb-3 row">
                                <label for="name" class="col-sm-2 col-form-label">Nombre:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" maxlength="20">
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <label for="username" class="col-sm-2 col-form-label">Usuario:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="username" maxlength="20">
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <label for="password" class="col-sm-2 col-form-label">Contraseña:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="password" maxlength="20">
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <label class="col-sm-2 col-form-label">Tipo de usuario:</label>
                                <div class="col-sm-10">
                                    <select name="status" id="status" class="form-control">
                                        <option value="admin">Administrador</option>
                                        <option value="user">Cosmetologa</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <label class="col-sm-2 col-form-label">Alcance:</label>
                                <div class="col-sm-10">
                                    <select name="code" id="code" class="form-control">
                                        <option value="local">Local</option>
                                        <option value="global">Global</option>
                                    </select>
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
    <script type="text/javascript" src="/admin/js/crudCosmetologas.js"></script>';
?>