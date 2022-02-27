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
  
  getHeadHTML("ProSkin - Recarga de monedero");
  $idCliente = $_GET['idCliente'];
  $idMonedero = $_GET['idMonedero'];
?>
<body style='background-color: #f9f3f3;'>
    <?php
        require_once("../include/navbar.php");
        
        $fecha_para_corte_caja = getFechaFormatoCDMX();
        getNavbar($fecha_para_corte_caja, $fetch_info['name'], $ModeloUsuario->getNombreSucursalUsuario($email)['nombre_sucursal']);

        $infoClienteMonederoTratamiento = $ModelCliente->getMonederoWhereID($idMonedero)[0];
        $infoClienteMonederoDinero      = $ModelCliente->getMonederoDineroWhereID($idMonedero);

        $tipo_recarga           = $_GET['tipo'];
        $isReadOnlyTratamientos ='';
        $isReadOnlyDinero       = '';

        if($tipo_recarga == "tratamiento"){
            $isReadOnlyDinero='readonly';
        }
        if($tipo_recarga == "dinero") {
            $isReadOnlyTratamientos='readonly';
        }
    ?>

    <?php
        if(!empty($infoClienteMonederoTratamiento)) {
    ?>
    <main role="main" class="container">
        <div class="container">
            <h1>Recarga de tratamientos para monedero</h1>
            <hr/>
            <form action="recargarMonedero.php" method="POST" autocomplete="off">
                <?php
                    $id = $_GET['idCliente'];
                    $infoClienteDatos = $ModelCliente->getClienteWhereID($id)[0];
                ?>
                <div class="row">
                    <div class="col-sm">
                        <h3>ID Cliente</h3>
                        <p class="lead"><?php echo $infoClienteDatos['id_cliente'];?></p><input type="text" class="form-control" id="idCliente" name="idCliente" value=<?php echo $infoClienteDatos['id_cliente'];?> hidden readonly>
                        <input type="text" class="form-control" id="idCosmetologa" name="idCosmetologa" value=<?php echo "'".$id_cosmetologa['id']."'";?> hidden>
                    </div>
                    <div class="col-sm">
                        <h3>ID Monedero</h3>
                        <p class="lead"><?php echo $idMonedero;?></p><input type="text" class="form-control" id="idMonedero" name="idMonedero" value=<?php echo "'".$idMonedero."'";?> hidden readonly>
                        <input type="text" class="form-control" id="centro" name="centro" value=<?php echo "'".$numeroSucursal['id_sucursal']."'"; ?> hidden>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-sm">
                        <div class="form-inline">
                            <h3>Tratamientos actuales del monedero</h3>
                        </div>
                        <p class="lead" id="nombre" name="nombre">
                        <?php
                        if(json_decode($infoClienteMonederoTratamiento['tratamientos_inicial']) != ""){
                            $cantidad_tratamiento = array_map(null, json_decode($infoClienteMonederoTratamiento['tratamientos_inicial']), json_decode($infoClienteMonederoTratamiento['cantidad']));
                            foreach($cantidad_tratamiento as $elemento){
                                echo '<button type="button" class="btn btn-info" style="margin-right:5px" disabled>
                                            '.$ModelCliente -> getNombreTratamiento($elemento[0]).' <span class="badge badge-light">'.$elemento[1].'</span>
                                    </button>';
                            }
                        }else{
                            echo "NO HAY TRATAMIENTOS, SOLO SE REGISTRÓ DINERO";
                        }
                        ?>
                    </div>
                </div>
                <hr/>
                <div class="form-group">
                        <h3>Comentarios del monedero</h3>
                        <textarea  class="form-control" name="comentariosMonedero" id="comentariosMonedero" rows="2"  placeholder="Puedes escribir detalles como: precio individual de la sesión, descuentos, etc."><?php echo $infoClienteMonederoTratamiento['comentarios'];?></textarea>
                </div>
                <hr/>
                <hr/>
                <div class="form-group">
                    <h3>Selección de tratamientos nuevos:</h3>
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
                </div>
                <div class="form-group">
                    <div class="col-xs-4">
                        <div class="well well-sm">
                            <div class="form-group">
                                <label>Tratamiento a agregar a lista</label>
                                <select name="tratamiento[]" id="tratamiento" class="last_tratamiento form-control" <?php echo $isReadOnlyTratamientos;?>>
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
                    <input type="number" class="form-control" id="dineroTotal" name="dineroTotal" placeholder="Cantidad del valor de los nuevos tratamientos" autocomplete="off" <?php echo $isReadOnlyDinero;?> required>
                </div>
                <div class="form-group metodosPagoDiv" id="metodosPagoDiv">
                    <div class="form-inline">
                        <h4>Formas de pago&nbsp;</h4>
                        <input type="number" class="last_producto form-control" id="sumaTotalMetodosPago" name="sumaTotalMetodosPago" placeholder="Suma total métodos" hidden readonly>
                        <div class="form-inline justify-content-center">
                            <h4 id="sumaTotalMetodosPagoLabel" name="sumaTotalMetodosPagoLabel"> $0</h4>
                        </div>
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
                            </select>
                            <input type="text" class="form-control referencia_metodo1" id="referencia" name="referencia[]" placeholder="Número de referencia del pago" style="display: none;">
                            <input type="number" class="form-control totalMetodoPago1" id="totalMetodoPago" name="totalMetodoPago[]" placeholder="Cantidad de este método de pago" style="display: none;" step='any'>
                        </div>
                    </div>
                </div>
                <hr/>
                <div class='form-group' id="agregar_boton_pago_div">
                    <button class='btn btn-info' id="botonAgregarMetodoPago" type="button" disabled>Agregar método de pago <i class="fas fa-plus-circle"></i></button>
                </div>
                <hr>
                <button type="submit" id="recargaMonedero" name="recargaMonedero" class="btn btn-success">Recargar Monedero</button>
                <?php
                    echo '<a class="btn btn-danger" href="../../View/Clientes/informacionCliente.php?id='.$id.'" role="button">Cancelar registro</a>';
                ?>
            </form>
        </div>
    </main>
    <?php
        }
        if(!empty($infoClienteMonederoDinero)) {
    ?>
    <main role="main" class="container">
        <div class="container">
            <h1>Recarga de dinero para monedero</h1>
            <hr/>
            <form action="recargarMonedero.php" method="POST" autocomplete="off">
                <?php
                    $id = $_GET['idCliente'];
                    $infoClienteDatos = $ModelCliente->getClienteWhereID($id)[0];
                ?>
                <div class="row">
                    <div class="col-sm">
                        <h3>ID Cliente</h3>
                        <p class="lead"><?php echo $infoClienteDatos['id_cliente'];?></p><input type="text" class="form-control" id="idCliente" name="idCliente" value=<?php echo $infoClienteDatos['id_cliente'];?> hidden readonly>
                        <input type="text" class="form-control" id="idCosmetologa" name="idCosmetologa" value=<?php echo "'".$id_cosmetologa['id']."'";?> hidden>
                    </div>
                    <div class="col-sm">
                        <h3>ID Monedero</h3>
                        <p class="lead"><?php echo $idMonedero;?></p><input type="text" class="form-control" id="idMonedero" name="idMonedero" value=<?php echo "'".$idMonedero."'";?> hidden readonly>
                        <input type="text" class="form-control" id="centro" name="centro" value=<?php echo "'".$numeroSucursal['id_sucursal']."'"; ?> hidden>
                    </div>
                </div>
                <hr/>
                <div class="form-group text-center">
                    <div class="col-sm">
                        <h3>Dinero actual del monedero</h3>
                        <p class="lead" id="nombre" name="nombre">
                            <?php
                                $display_tratamientos = '';
                                $dinero_final = end(json_decode($infoClienteMonederoDinero['dinero']));
                                if(floatval($dinero_final) != 0){
                                    $display_tratamientos = 'style="display: none;"';
                                }else {
                                    echo '<input type="text" class="form-control" id="ultimoDineroParaPasarAtratamientos" name="ultimoDineroParaPasarAtratamientos" value='.$dinero_final.' hidden>';
                                }
                                echo "$".number_format($dinero_final, 2);
                            ?>
                        </p>
                    </div>
                </div>
                <hr/>
                <div class="form-group">
                        <h3>Comentarios del monedero</h3>
                        <textarea  class="form-control" name="comentariosMonedero" id="comentariosMonedero" rows="2"  placeholder="Puedes escribir detalles como: precio individual de la sesión, descuentos, etc."><?php echo $infoClienteMonederoDinero['comentarios'];?></textarea>
                </div>
                <hr/>
                <div <?php echo $display_tratamientos;?>>
                    <div class="form-group">
                        <h3>Selección de tratamientos nuevos:</h3>
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
                </div>
                <hr/>
                <div class="form-group">
                    <h3>Cantidad total:</h3>
                    <input type="number" class="form-control" id="dineroTotal" name="dineroTotal" placeholder="Cantidad del valor de los nuevos tratamientos" autocomplete="off" <?php echo $isReadOnlyDinero;?> required>
                </div>
                <div class="form-group metodosPagoDiv" id="metodosPagoDiv">
                    <div class="form-inline">
                        <h4>Formas de pago&nbsp;</h4>
                        <input type="number" class="last_producto form-control" id="sumaTotalMetodosPago" name="sumaTotalMetodosPago" placeholder="Suma total métodos" hidden readonly>
                        <div class="form-inline justify-content-center">
                            <h4 id="sumaTotalMetodosPagoLabel" name="sumaTotalMetodosPagoLabel"> $0</h4>
                        </div>
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
                            </select>
                            <input type="text" class="form-control referencia_metodo1" id="referencia" name="referencia[]" placeholder="Número de referencia del pago" style="display: none;">
                            <input type="number" class="form-control totalMetodoPago1" id="totalMetodoPago" name="totalMetodoPago[]" placeholder="Cantidad de este método de pago" style="display: none;" step='any'>
                        </div>
                    </div>
                </div>
                <hr/>
                <div class='form-group' id="agregar_boton_pago_div">
                    <button class='btn btn-info' id="botonAgregarMetodoPago" type="button" disabled>Agregar método de pago <i class="fas fa-plus-circle"></i></button>
                </div>
                <hr>
                <button type="submit" id="recargaMonedero" name="recargaMonedero" class="btn btn-success">Recargar Monedero</button>
                <?php
                    echo '<a class="btn btn-danger" href="../../View/Clientes/informacionCliente.php?id='.$id.'" role="button">Cancelar registro</a>';
                ?>
            </form>
        </div>
    </main>
    <?php
        }
    ?>

    <?php
      getFooter();
    ?>
    <script src="../../Controller/Clientes/Util/validarCamposRecargaMonedero.js"></script>
</body>
</html>