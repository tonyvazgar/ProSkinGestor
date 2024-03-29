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
        
        getNavbar($fetch_info['name'], $ModeloUsuario->getNombreSucursalUsuario($email)['nombre_sucursal']);
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
                <div class="form-group" style="display: none;" id="metodo_pago_div">
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
                <div class="form-group" style="display: none;" id="firma_div">
                    <label>Firma requerida del cliente</label>
                    <select name="aviso" id="aviso" class="form-control">
                        <option>*** SELECCIONA ***</option>
                        <option value="0">No firmado</option>
                        <option value="1">Ya se firmó</option>
                    </select>
                </div>
                <div class="form-group justify-content-center" id='botonComenzar' name='botonComenzar'>
                    <button type="submit" id="comenzarTratamiento" name="comenzarTratamiento" class="btn btn-success">Registar tratamiento</button>
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