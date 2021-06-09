<?php 
  require_once "../../Controller/Clientes/ClienteController.php"; 
  require_once "../../Model/Clientes/Cliente.php";
  require_once "../../Controller/ControllerSesion.php";
  require_once "../../Model/Usuario/Usuario.php";
  require_once "../../Model/Tratamiento/Tratamiento.php";

  $ModelCliente = new Cliente();
  $session = new ControllerSesion();
  $ModeloUsuario = new Usuario();
  $ModelTratamiento = new Tratamiento();

  $tratamientos = $ModelTratamiento->getAllTratamientos();
  $zonasCuerpo = $ModelTratamiento->getAllZonasCuerpo();
  
  $email    = $_SESSION['email'];
  $password = $_SESSION['password'];
  
  $fetch_info = $session->verificarSesion($ModeloUsuario, $email, $password);
  $nombreSucursal = $ModeloUsuario->getNombreSucursalUsuario($email);
  $numeroSucursal = $ModeloUsuario->getNumeroSucursalUsuario($email);
  $id_cosmetologa = $ModeloUsuario->getIdCosmetologa($email);
  
  getHeadHTML("ProSkin - Registo de tratamiento");
?>
<body style='background-color: #f9f3f3;'>
    <!-- <button type="button" class="btn btn-light"><a href="logout.php">Cerrar sesion</a></button> -->
    <?php
        require_once("../include/navbar.php");
        
        getNavbar($fetch_info['name'], $ModeloUsuario->getNombreSucursalUsuario($email)['nombre_sucursal']);
    ?>
    <main role="main" class="container">
    <div class="container">
        <div class="row">
            </div>
            <div class="col-sm"></div>
        </div>
    </div>
        <div class="container">
            <h1>Registrar tratamiento</h1>
            <form action="iniciarTratamientoCliente.php" method="POST" autocomplete="">
                    <?php
                        $id = $_GET['id'];
                        $info = $ModelCliente->getClienteWhereID($id);
                        foreach($info as $infoCliente){
                    ?>
                            <div class="row">
                                <div class="col-sm">
                                    <label for="exampleInputEmail1">ID</label>
                                    <input type="text" class="form-control" id="idCliente" name="idCliente" value=<?php echo $infoCliente['id_cliente'];?> readonly>
                                    <input type="text" class="form-control" id="idCosmetologa" name="idCosmetologa" value=<?php echo "'".$id_cosmetologa['id']."'";?> hidden>
                                </div>
                                <div class="col-sm">
                                    <label for="exampleInputEmail1">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" value=<?php echo "'".$infoCliente['nombre_cliente']." ".$infoCliente['apellidos_cliente']."'";?> readonly>
                                </div>
                            </div>
                            <div class="form-group" hidden>
                                <label for="exampleInputEmail1">Sucursal</label>
                                <select name="id_centro" id="id_centro" class="form-control" readonly><option value=<?php echo "'".$numeroSucursal['id_sucursal']."'";?>> <?php echo $nombreSucursal['nombre_sucursal'];?></option>
                                </select>
                            </div>
                            <div id="tratamientos">
                                    <div class="col-xs-4">
                                        <h3 class='numTratamientos'>Tratamiento #1</h3>
                                        <div class="well well-sm">
                                            <div class="form-group">
                                                <label>Tratamiento a empezar</label>
                                                <select name="tratamiento[]" id="tratamiento" class="last form-control">
                                                    <option>*** SELECCIONA ***</option>
                                                    <option value="1">Depilación</option>
                                                    <option value="2">Cavitación</option>
                                                    <option value="3">Otros tratamientos</option>
                                                </select>
                                            </div>
                                            <div class="last form-group" id="otro" name="otro">
                                                
                                            </div>
                                            
                                            <div class="form-group" hidden>
                                                <label>Calificación</label>
                                                <select name="calificacion[]" id="calificacion" class="form-control" hidden>
                                                                    <option value="1">☆</option>
                                                                    <option value="2">☆☆</option>
                                                                    <option value="3">☆☆☆</option>
                                                                    <option value="4">☆☆☆☆</option>
                                                                    <option value="5">☆☆☆☆☆</option>
                                                </select>
                                            </div>

                                                    <div class="form-group">
                                                        <label>Comentarios</label>
                                                        <textarea name="comentarios[]" id="comentarios" cols="30" rows="5" class="form-control" maxlength='250' placeholder="Escribe algo relevante de este tratamiento"></textarea>
                                                    </div>

                                                    
                                                </div> 
                                            </div>   
                                        </div> 
                                    </div>   
                            </div>
                            <div class="col-sm">
                                    <div id="productos">
                                    
                                        
                                    </div>
                                </div>
                            <div class="form-group" id='div-agregarTratamiento' name='div-agregarTratamiento'>
                                <button id="btn-agregar-tratamiento" class="btn btn-warning btn-agregar-tratamiento" type="button">Agregar otro tratamiento</button> 
                                <button id="btn-agregar-producto" class="btn btn-warning btn-agregar-producto" type="button">Agregar producto</button> 
                            </div>
                            <div class="form-group">
                                <label>Método de pago: </label>
                                <select name='metodoPago' id='metodoPago' class='form-control'>
                                    <option value='1'>Efectivo</option>
                                    <option value='2'>[TDD]Tarjeta de débito</option>
                                    <option value='3'>[TDC]Tarjeta de crédito</option>
                                    <option value='4'>Transferencia</option>
                                    <option value='5'>Cheque de regalo</option>
                                </select>
                            </div>
                            <div class="form-group">
                                                <label>Firma requerida del cliente</label>
                                                <select name="aviso" id="aviso" class="form-control">
                                                    <option>*** SELECCIONA ***</option>
                                                    <option value="0">No firmado</option>
                                                    <option value="1">Ya se firmó</option>
                                                </select>
                                            </div>
                            <div class="form-group" id='botonComenzar' name='botonComenzar'>
                                <button type="submit" id="comenzarTratamiento" name="comenzarTratamiento" class="btn btn-success">Registar tratamiento</button>
                            </div>
                    <?php
                        }
                        ?>
            </form>
        </div>
    </main>
    <?php
      getFooter();
    ?>
    <script src="../../Controller/Tratamiento/Util/validarCamposIniciarCliente.js"></script>
</body>
</html>