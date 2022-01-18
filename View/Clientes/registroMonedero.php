<?php 
  require_once "../../Controller/Clientes/ClienteController.php"; 
  require_once "../../Model/Clientes/Cliente.php";
  require_once "../../Controller/ControllerSesion.php";
  require_once "../../Model/Usuario/Usuario.php";

  $ModelCliente = new Cliente();
  $session = new ControllerSesion();
  $ModeloUsuario = new Usuario();
  
  $email    = $_SESSION['email'];
  $password = $_SESSION['password'];
  
  $fetch_info = $session->verificarSesion($ModeloUsuario, $email, $password);
  $nombreSucursal = $ModeloUsuario->getNombreSucursalUsuario($email);
  $numeroSucursal = $ModeloUsuario->getNumeroSucursalUsuario($email);
  $id_cosmetologa = $ModeloUsuario->getIdCosmetologa($email);
  
  getHeadHTML("ProSkin - Alta Monedero");
?>
<body style='background-color: #f9f3f3;'>
    <?php
        require_once("../include/navbar.php");
        
        $fecha_para_corte_caja = getFechaFormatoCDMX();
        getNavbar($fecha_para_corte_caja, $fetch_info['name'], $ModeloUsuario->getNombreSucursalUsuario($email)['nombre_sucursal']);
    ?>
    <main role="main" class="container">
        <div class="container">
            <h1>Registro nuevo monedero para cliente</h1>
            <hr/>
            <form action="registroMonedero.php" method="POST" autocomplete="off">
                <?php
                    $id = $_GET['idCliente'];
                    $infoCliente = $ModelCliente->getClienteWhereID($id)[0];
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
                        <input type="text" class="form-control" id="centro" name="centro" value=<?php echo "'".$numeroSucursal['id_sucursal']."'"; ?> hidden>
                    </div>
                </div>
                <hr/>
                <div class="form-group">
                    <h3>ID monedero:</h3>
                    <input type="text" class="form-control" id="idMonedero" name="idMonedero" placeholder="Ingresa el ID o número de la tarjeta física" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <h3>Tratamientos para el monedero:</h3>
                    <div id="listaTratamientos">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Tratamiento</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col"># de zonas</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Zonas</th>
                                </tr>
                            </thead>
                            <tbody id="listaTratamientosTabla">
                            </tbody>
                        </table>
                    </div>
                    <!-- <textarea class="form-control" id="tratamientos" name="tratamientos" rows="2" placeholder="Tratamientos especificos del monedero" autocomplete="off" required></textarea> -->
                </div>
                <div class="form-group">
                    <div class="col-xs-4">
                        <div class="well well-sm">
                            <div class="form-group">
                                <label>Tratamiento a agregar a lista</label>
                                <select name="tratamiento[]" id="tratamiento" class="last_tratamiento form-control">
                                    <option value="">*** SELECCIONA ***</option>
                                    <option value="1">Depilación</option>
                                    <option value="2">Cavitación</option>
                                    <option value="3">Otros tratamientos</option>
                                </select>
                            </div>
                            <div class="last_tratamiento form-group" id="otro" name="otro">
                                
                            </div>
                        </div>
                    </div>
                    <button id="btn-agregar-tratamiento" class="btn btn-warning btn-agregar-tratamiento" type="button">Agregar tratamiento a la lista de tratamientos para el monedero</button> 
                </div>
                <hr/>
                <div class="form-group">
                    <h3>Cantidad total:</h3>
                    <input type="number" class="form-control" id="dineroTotal" name="dineroTotal" placeholder="Cantidad del valor del monedero" autocomplete="off" required>
                </div>
                <div class="form-group metodosPagoDiv" id="metodosPagoDiv">
                    <h4>Forma de pago</h4>
                    <input type="number" class="last_producto form-control" id="sumaTotalMetodosPago" name="sumaTotalMetodosPago" placeholder="Suma total métodos" readonly>
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
                            </select>
                            <input type="text" class="form-control referencia_metodo1" id="referencia" name="referencia[]" placeholder="Número de referencia del pago" style="display: none;">
                            <input type="number" class="form-control totalMetodoPago1" id="totalMetodoPago" name="totalMetodoPago[]" placeholder="Cantidad de este método de pago" style="display: none;" step='any'>
                        </div>
                    </div>
                </div>
                <hr/>
                <div class='form-group' id="agregar_boton_pago_div">
                    <button class='btn btn-info' id="botonAgregarMetodoPago" type="button">Agregar método de pago <i class="fas fa-plus-circle"></i></button>
                </div>
                <hr>
                <button type="submit" id="altaMonederoCliente" name="altaMonederoCliente" class="btn btn-success">Dar monedero de alta</button>
                <?php
                    echo '<a class="btn btn-danger" href="../../View/Clientes/informacionCliente.php?id='.$id.'" role="button">Cancelar registro</a>';
                ?>
            </form>
        </div>
    </main>
    <?php
      getFooter();
    ?>
    <script src="../../Controller/Clientes/Util/validarCamposRegistroMonedero.js"></script>
</body>
</html>