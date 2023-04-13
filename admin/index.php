<?php 
    include_once "./components/header.php";
    include_once './Model/Cosmetologa.php';

    $ModelCosmetologa = new Cosmetologa();
    
    $data = $ModelCosmetologa -> getAllCometologas();
    $sucursalesList = $ModelCosmetologa -> getAllSucursales();
?>

<!--INICIO del cont principal-->
<div class="container">
    <h1>Lista de cosmetólogas</h1>

<div class="container">
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
                        <table id="tablaPersonas" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Usuario</th>
                                <th style="display: none;">Password</th>
                                <th>Code</th>  
                                <th>Status</th>
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
                                <td><?php echo $dat['id_sucursal_usuario'] ?></td>    
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
    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form id="formPersonas">    
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name" class="col-form-label">Nombre:</label>
                            <input type="text" class="form-control" id="name">
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-form-label">Usuario:</label>
                            <input type="text" class="form-control" id="username">
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-form-label">Contraseña:</label>
                            <input type="text" class="form-control" id="password">
                        </div>
                        <div class="form-group">
                            <label for="code" class="col-form-label">Code:</label>
                            <input type="text" class="form-control" id="code">
                        </div>
                        <div class="form-group">
                            <label for="status" class="col-form-label">Status:</label>
                            <input type="text" class="form-control" id="status">
                        </div>
                        <div class="form-group">
                            <label for="sucursal" class="col-form-label">Sucursal:</label>
                            <select name="sucursal" id="sucursal">
                                <option value="">--- Selecciona una sucursal ---</option>
                                <?php                            
                                    foreach($sucursalesList as $sucursal) {
                                ?>
                                    <option <?php echo 'value="'.$sucursal['id_sucursal'].'"'; ?>><?php echo $sucursal['nombre_sucursal'] ?></option>
                                <?php
                                    }
                                ?>
                            </select>
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

<?php require_once "components/footer.php"?>