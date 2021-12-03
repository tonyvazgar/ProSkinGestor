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
    <?php
        require_once("../include/navbar.php");
        $fecha_para_corte_caja = getFechaFormatoCDMX();
        getNavbar($fecha_para_corte_caja, $fetch_info['name'], $ModeloUsuario->getNombreSucursalUsuario($email)['nombre_sucursal']);
    ?>
    <main role="main" class="container">
        <div class="container">
            <h1>Registrar tratamiento</h1>
            <hr/>
            <h4>Nota: NO ACTUALIZAR LA PÁGINA NI PRESIONAR <i>F5</i></h4>
            <hr/>
            <form action="iniciarTratamientoCliente.php" method="POST" autocomplete="off">
                <?php
                    $id = $_GET['id'];
                    $info = $ModelCliente->getClienteWhereID($id);
                    foreach($info as $infoCliente){
                ?>
                <div class="row">
                    <div class="col-sm">
                        <h3>ID</h3>
                        <p class="lead"><?php echo $infoCliente['id_cliente'];?></p><input type="text" class="form-control" id="idCliente" name="idCliente" value=<?php echo $infoCliente['id_cliente'];?> hidden readonly>
                        <input type="text" class="form-control" id="idCosmetologa" name="idCosmetologa" value=<?php echo "'".$id_cosmetologa['id']."'";?> hidden>
                    </div>
                    <div class="col-sm">
                        <h3>Nombre</h3>
                        <p class="lead"><?php echo $infoCliente['nombre_cliente']." ".$infoCliente['apellidos_cliente'];?></p><input type="text" class="form-control" id="nombre" name="nombre" value=<?php echo "'".$infoCliente['nombre_cliente']." ".$infoCliente['apellidos_cliente']."'";?> hidden readonly>
                    </div>
                </div>
                <div class="form-group" hidden>
                    <label for="exampleInputEmail1">Sucursal</label>
                    <select name="id_centro" id="id_centro" class="form-control" readonly><option value=<?php echo "'".$numeroSucursal['id_sucursal']."'";?>> <?php echo $nombreSucursal['nombre_sucursal'];?></option></select>
                </div>
                <div class="form-group" id="elementos">

                </div>
                <hr/>
                <div class="form-group text-center" id='div-agregarTratamiento' name='div-agregarTratamiento'>
                    <button id="btn-agregar-tratamiento" class="btn btn-warning btn-agregar-tratamiento" type="button">Agregar otro tratamiento</button> 
                    <button id="btn-agregar-producto" class="btn btn-warning btn-agregar-producto" type="button">Agregar producto</button> 
                </div>
                <hr>
                    <div class="form-inline justify-content-center" id='div-sumaTotalPrecios' name='div-sumaTotalPrecios'>
                        <h4>Total de venta</h4>
                        <input type="number" class="last_producto form-control" id="sumaTotalPrecios" name="sumaTotalPrecios" readonly>
                    </div>
                <hr>
                <div class="form-group" style="display: none;">
                    <label>Método de pago: </label>
                    <select name='metodoPago' id='metodoPago' class='form-control'>
                        <option value='6'>Depósito</option>
                        <option value='1'>Efectivo</option>
                        <option value='2'>[TDD]Tarjeta de débito</option>
                        <option value='3'>[TDC]Tarjeta de crédito</option>
                        <option value='4'>Transferencia</option>
                        <option value='5'>Cheque de regalo</option>
                    </select>
                    <input type="text" class="form-control" id="referencia" name="referencia" placeholder="Número de referencia del pago">
                </div>
                <!--  -->
                    <div class="form-group metodosPagoDiv" id="metodo_pago_div" style="display: none;">
                        <div class='form-inline'>
                            <h3>Métodos de pago:</h3>
                            <input type="number" class="last_producto form-control" id="sumaTotalMetodosPago" name="sumaTotalMetodosPago" placeholder="Suma total métodos" readonly>
                        </div>
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
                                <input type="number" class="form-control totalMetodoPago1" id="totalMetodoPago" name="totalMetodoPago[]" style="display: none;" placeholder="Cantidad de este método de pago" step='any'>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class='form-group' style="display: none;" id="agregar_boton_pago_div">
                        <button class='btn btn-info' id="botonAgregarMetodoPago" type="button">Agregar método de pago <i class="fas fa-plus-circle"></i></button>
                    </div>
                    <hr>
                <!--  -->
                <div class="form-group" style="display: none;" id="firma_div">
                    <label>Firma requerida del cliente</label>
                    <select name="aviso" id="aviso" class="form-control">
                        <option>*** SELECCIONA ***</option>
                        <option value="0">No firmado</option>
                        <option value="1">Ya se firmó</option>
                    </select>
                </div>
                <div class="form-group text-center" id="notificaciones_div">
                    <?php
                        $corte = $ModeloUsuario->existeCorteCaja(strtotime($fecha_para_corte_caja), $numeroSucursal['id_sucursal']);
                        if($corte){
                            echo '<p class="lead text-danger">IMPORTANTE</p>
                            <p class="lead text-danger">Ya se hizo el corte de caja, esta venta se desplazará al siguiente día</p>';
                        }
                    ?>
                </div>
                <div class="form-group justify-content-center" id='botonComenzar' name='botonComenzar'>
                    <button type="submit" id="comenzarTratamiento" name="comenzarTratamiento" class="btn btn-success">Registrar tratamiento</button>
                </div>
                <div class="col d-flex justify-content-center">
                    <a class="btn btn-danger" href="index.php" role="button">Cancelar</a>
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