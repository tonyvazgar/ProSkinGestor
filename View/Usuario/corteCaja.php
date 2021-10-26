<?php 
  require_once "../../Controller/Clientes/ClienteController.php"; 
  require_once "../../Controller/ControllerSesion.php";
  require_once "../../Model/Usuario/Usuario.php";
  require_once "../../Model/Tratamiento/Tratamiento.php";
  require_once "../../Model/Inventario/Producto.php";
  require_once "../../Controller/Usuario/UsuarioController.php";

  $session          = new ControllerSesion();
  $ModeloUsuario    = new Usuario();
  $ModelTratamiento = new Tratamiento();
  $ModelProducto    = new Producto();

  // $corte = $ModelUsuario->existeCorteCaja($fecha, $id_centro);
  // if($corte != 0){
  //   header("Location: ../../index.php");
  // }
  
  $email    = $_SESSION['email'];
  $password = $_SESSION['password'];
  
  $fetch_info = $session->verificarSesion($ModeloUsuario, $email, $password);

  $nombreSucursal = $ModeloUsuario->getNombreSucursalUsuario($email);
  $numeroSucursal = $ModeloUsuario->getNumeroSucursalUsuario($email)['id_sucursal'];
  $id_cosmetologa = $ModeloUsuario->getIdCosmetologa($email);

  getHeadHTML("ProSkin - Corte de caja");
?>
<body style='background-color: #f9f3f3;'>
    <!-- <button type="button" class="btn btn-light"><a href="logout.php">Cerrar sesion</a></button> -->
    <?php
        require_once("../include/navbar.php");
        $date = new DateTime($fecha, new DateTimeZone('America/Mexico_City') );
        $timestamp = strtotime($date->format('Y-m-d H:i:s'));

        $beginOfDay = DateTime::createFromFormat('Y-m-d H:i:s', (new DateTime())->setTimestamp($timestamp)->format('Y-m-d 00:00:00'))->getTimestamp();
        $endOfDay = DateTime::createFromFormat('Y-m-d H:i:s', (new DateTime())->setTimestamp($timestamp)->format('Y-m-d 23:59:59'))->getTimestamp();

        $fecha_para_corte_caja = $date->format('Y-m-d');
        getNavbar($fecha_para_corte_caja, $fetch_info['name'], $ModeloUsuario->getNombreSucursalUsuario($email)['nombre_sucursal']);

        // print_r($beginOfDay." ---- ".$endOfDay);

        $total_efectivo = $ModeloUsuario->getTotalEfectivoWhereDia($beginOfDay, $endOfDay, $numeroSucursal);
        $total_tdc = $ModeloUsuario->getTotalTDCWhereDia($beginOfDay, $endOfDay, $numeroSucursal);
        $total_tdd = $ModeloUsuario->getTotalTDDWhereDia($beginOfDay, $endOfDay, $numeroSucursal);
        $total_transferencia = $ModeloUsuario->getTotalTransferenciaWhereDia($beginOfDay, $endOfDay, $numeroSucursal);
        $total_Deposito = $ModeloUsuario->getTotalDepositoWhereDia($beginOfDay, $endOfDay, $numeroSucursal);
        $total_cheque = $ModeloUsuario->getTotalChequeWhereDia($beginOfDay, $endOfDay, $numeroSucursal);
        $numeroTotalDeVentas = $ModeloUsuario -> getNumeroTotalVentasDelDiaFromCentro($beginOfDay, $endOfDay, $numeroSucursal);

        // echo "<pre>";
        // print_r($total_efectivo);echo "<br>----<br>----<br>";
        // print_r($total_tdc);echo "<br>----<br>----<br>";
        // print_r($total_tdd);echo "<br>----<br>----<br>";
        // print_r($total_transferencia);echo "<br>----<br>----<br>";
        // print_r($total_Deposito);echo "<br>----<br>----<br>";
        // echo "</pre>";
    ?>
    <main role="main" class="container">
        <div class="container">
            
            <h1>Corte de caja</h1>
            <div class="container">
              <form action="corteCaja.php" method="POST" autocomplete="off">
                <div class="form-group" hidden>
                    <label for="exampleInputEmail1">Sucursal</label>
                    <select name="id_centro" id="id_centro" class="form-control" readonly><option value=<?php echo "'".$numeroSucursal."'";?>> <?php echo $nombreSucursal['nombre_sucursal'];?></option></select>
                    <input type="text" class="form-control" id="idCosmetologa" name="idCosmetologa" value=<?php echo "'".$id_cosmetologa['id']."'";?> hidden>
                </div>
                <div class="form-group row">
                  <p for="diaCorteCaja" class="col-sm-2 lead">Fecha</p>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" id="diaCorteCaja" name="diaCorteCaja" value="<?php echo $fecha_para_corte_caja; ?>" readonly> 
                    <small id="passwordHelpBlock" class="form-text text-muted">
                      Esta es la fecha del día del corte de caja, no se puede cambiar ya que es automático
                    </small>
                  </div>
                </div>
                <div class="form-group row">
                  <p for="diaCorteCaja" class="col-sm-2 lead">Ventas del día</p>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="numTotalVentasDia" name="numTotalVentasDia" value="<?php echo $numeroTotalDeVentas; ?>" placeholder='Número de ventas del día de hoy' readonly> 
                    <small id="passwordHelpBlock" class="form-text text-muted">Número de ventas del día de hoy</small>
                  </div>
                </div>
                <hr>
                <div class="form-group row">
                  <p for="total_efectivo" class="col-sm-2 lead">Total en efectivo</p>
                  <?php //echo "<pre>Total Efectivo \n"; print_r($total_efectivo); echo "</pre>";?>
                  <div class="col-sm-10">
                    <div class='d-inline'>
                      <input type="number" class="form-control" id="total_efectivo" name="total_efectivo" placeholder="Total en efectivo"  value="<?php echo $total_efectivo[0] != '' ? $total_efectivo[0] : 0; ?>" readonly>
                      <input type="number" class="form-control" id="num_efectivo" name="num_efectivo" placeholder="Total en efectivo"  value="<?php echo $total_efectivo[0] != '' ? sizeof($total_efectivo[1]) : 0; ?>" readonly>
                    </div>
                    <small id="passwordHelpBlock" class="form-text text-muted" style="<?php echo $total_efectivo[0] == '' ? "display: none;": ''; ?>">
                      <div id="accordion">
                        <p>
                          <button class="btn btn-info collapsed" type="button" data-toggle="collapse" data-target="#collapseEfectivo"
                            aria-expanded="false" aria-controls="collapseEfectivo">Ver ventas</button>
                        </p>
                        <div class="form-group">
                          <div id="collapseEfectivo" class="collapse" aria-labelledby="headingOne" data-parent="#accordion" >
                            <div class="card-body">
                              <ul class="list-group">
                                <?php
                                  foreach($total_efectivo[1] as $venta){
                                    echo '<li class="list-group-item d-flex justify-content-between align-items-center">
                                            <a href="../../View/Ventas/detalleVenta.php?idVenta='.$venta['id_venta'].'" role="button">'.$venta['id_venta'].'</a>
                                          </li>';
                                  }
                                ?>
                                <!-- <li class="list-group-item d-flex justify-content-between align-items-center">
                                  <a href="../../View/Ventas/detalleVenta.php?idVenta=JKS21071127DEP01110" role="button">JKS21071127DEP01110 - $580</a>
                                  <span class="badge bg-warning rounded-pill">2021-08-25</span>
                                </li> -->
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </small>
                  </div>
                </div>
                <hr>
                <div class="form-group row">
                  <p for="total_tdc" class="col-sm-2 lead">Total de tarjeta de crédito</p>
                  <?php //echo "<pre>Total TDC \n"; print_r($total_tdc); echo "</pre>";?>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="total_tdc" name="total_tdc" placeholder="Total en tarjeta de crédito"  value="<?php echo $total_tdc[0] != '' ? $total_tdc[0] : 0; ?>" readonly>
                    <input type="number" class="form-control" id="num_tdc" name="num_tdc" placeholder="Total en tarjeta de crédito"  value="<?php echo $total_tdc[0] != '' ? sizeof($total_tdc[1]) : 0; ?>" readonly>
                    <small id="passwordHelpBlock" class="form-text text-muted" style="<?php echo $total_tdc[0] == '' ? "display: none;": ''; ?>">
                      <div id="accordion">
                        <p>
                          <button class="btn btn-info collapsed" type="button" data-toggle="collapse" data-target="#collapseTDC"
                            aria-expanded="false" aria-controls="collapseTDC">Ver ventas</button>
                        </p>
                        <div class="form-group">
                          <div id="collapseTDC" class="collapse" aria-labelledby="headingOne" data-parent="#accordion" >
                            <div class="card-body">
                              <ul class="list-group">
                                <?php
                                  foreach($total_tdc[1] as $venta){
                                    echo '<li class="list-group-item d-flex justify-content-between align-items-center">
                                            <a href="../../View/Ventas/detalleVenta.php?idVenta='.$venta['id_venta'].'" role="button">'.$venta['id_venta'].'</a>
                                          </li>';
                                  }
                                ?>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </small>
                  </div>
                </div>
                <hr>
                <div class="form-group row">
                  <p for="total_tdd" class="col-sm-2 lead">Total de tarjeta de débito</p>
                  <?php //echo "<pre>Total TDD \n"; print_r($total_tdd); echo "</pre>";?>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="total_tdd" name="total_tdd" placeholder="Total en tarjeta de débito"  value="<?php echo $total_tdd[0] != '' ? $total_tdd[0] : 0; ?>" readonly>
                    <input type="number" class="form-control" id="num_tdd" name="num_tdd" placeholder="Total en tarjeta de débito"  value="<?php echo $total_tdd[0] != '' ? sizeof($total_tdd[1]) : 0; ?>" readonly>
                    
                    <small id="passwordHelpBlock" class="form-text text-muted" style="<?php echo $total_tdd[0] == '' ? "display: none;": ''; ?>">
                      <div id="accordion">
                        <p>
                          <button class="btn btn-info collapsed" type="button" data-toggle="collapse" data-target="#collapseTDD"
                            aria-expanded="false" aria-controls="collapseTDD">Ver ventas</button>
                        </p>
                        <div class="form-group">
                          <div id="collapseTDD" class="collapse" aria-labelledby="headingOne" data-parent="#accordion" >
                            <div class="card-body">
                              <ul class="list-group">
                                <?php
                                  foreach($total_tdd[1] as $venta){
                                    echo '<li class="list-group-item d-flex justify-content-between align-items-center">
                                            <a href="../../View/Ventas/detalleVenta.php?idVenta='.$venta['id_venta'].'" role="button">'.$venta['id_venta'].'</a>
                                          </li>';
                                  }
                                ?>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </small>
                  </div>
                </div>
                <hr>
                <div class="form-group row">
                  <p for="total_transferencia" class="col-sm-2 lead">Total de transferencia</p>
                  <?php //echo "<pre>Total Transferencia \n"; print_r($total_transferencia); echo "</pre>";?>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="total_transferencia" name="total_transferencia" placeholder="Total en transferencia"  value="<?php echo $total_transferencia[0] != '' ? $total_transferencia[0] : 0; ?>" readonly>
                    <input type="number" class="form-control" id="num_transferencia" name="num_transferencia" placeholder="Total en transferencia"  value="<?php echo $total_transferencia[0] != '' ? sizeof($total_transferencia[1]) : 0; ?>" readonly>
                  
                    <small id="passwordHelpBlock" class="form-text text-muted" style="<?php echo $total_transferencia[0] == '' ? "display: none;": ''; ?>">
                      <div id="accordion">
                        <p>
                          <button class="btn btn-info collapsed" type="button" data-toggle="collapse" data-target="#collapseTransferencia"
                            aria-expanded="false" aria-controls="collapseTransferencia">Ver ventas</button>
                        </p>
                        <div class="form-group">
                          <div id="collapseTransferencia" class="collapse" aria-labelledby="headingOne" data-parent="#accordion" >
                            <div class="card-body">
                              <ul class="list-group">
                                <?php
                                  foreach($total_transferencia[1] as $venta){
                                    echo '<li class="list-group-item d-flex justify-content-between align-items-center">
                                            <a href="../../View/Ventas/detalleVenta.php?idVenta='.$venta['id_venta'].'" role="button">'.$venta['id_venta'].'</a>
                                          </li>';
                                  }
                                ?>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </small>
                  </div>
                </div>
                <hr>
                <div class="form-group row">
                  <p for="total_deposito" class="col-sm-2 lead">Total de déposito</p>
                  <?php //echo "<pre>Total Deposito \n"; print_r($total_Deposito); echo "</pre>";?>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="total_deposito" name="total_deposito" placeholder="Total en déposito"  value="<?php echo $total_Deposito[0] != '' ? $total_Deposito[0] : 0; ?>" readonly> 
                    <input type="number" class="form-control" id="num_deposito" name="num_deposito" placeholder="Total en déposito"  value="<?php echo $total_Deposito[0] != '' ? sizeof($total_Deposito[1]) : 0; ?>" readonly> 
                    
                    <small id="passwordHelpBlock" class="form-text text-muted" style="<?php echo $total_Deposito[0] == '' ? "display: none;": ''; ?>">
                      <div id="accordion">
                        <p>
                          <button class="btn btn-info collapsed" type="button" data-toggle="collapse" data-target="#collapseDeposito"
                            aria-expanded="false" aria-controls="collapseDeposito">Ver ventas</button>
                        </p>
                        <div class="form-group">
                          <div id="collapseDeposito" class="collapse" aria-labelledby="headingOne" data-parent="#accordion" >
                            <div class="card-body">
                              <ul class="list-group">
                                <?php
                                  foreach($total_Deposito[1] as $venta){
                                    echo '<li class="list-group-item d-flex justify-content-between align-items-center">
                                            <a href="../../View/Ventas/detalleVenta.php?idVenta='.$venta['id_venta'].'" role="button">'.$venta['id_venta'].'</a>
                                          </li>';
                                  }
                                ?>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </small>
                  </div>
                </div>
                <hr>
                <div class="form-group row">
                  <p for="total_deposito" class="col-sm-2 lead">Total de cheque</p>
                  <?php //echo "<pre>Total Deposito \n"; print_r($total_Deposito); echo "</pre>";?>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="total_cheque" name="total_cheque" placeholder="Total en cheque"  value="<?php echo $total_cheque[0] != '' ? $total_cheque[0] : 0; ?>" readonly> 
                    <input type="number" class="form-control" id="num_cheque" name="num_cheque" placeholder="Total en cheque"  value="<?php echo $total_cheque[0] != '' ? sizeof($total_cheque[1]) : 0; ?>" readonly> 
                    
                    <small id="passwordHelpBlock" class="form-text text-muted" style="<?php echo $total_cheque[0] == '' ? "display: none;": ''; ?>">
                      <div id="accordion">
                        <p>
                          <button class="btn btn-info collapsed" type="button" data-toggle="collapse" data-target="#collapseCheque"
                            aria-expanded="false" aria-controls="collapseCheque">Ver ventas</button>
                        </p>
                        <div class="form-group">
                          <div id="collapseCheque" class="collapse" aria-labelledby="headingOne" data-parent="#accordion" >
                            <div class="card-body">
                              <ul class="list-group">
                                <?php
                                  foreach($total_cheque[1] as $venta){
                                    echo '<li class="list-group-item d-flex justify-content-between align-items-center">
                                            <a href="../../View/Ventas/detalleVenta.php?idVenta='.$venta['id_venta'].'" role="button">'.$venta['id_venta'].'</a>
                                          </li>';
                                  }
                                ?>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </small>
                  </div>
                </div>
                <hr>
                <div class="form-group row">
                  <p for="total_deposito" class="col-sm-2 lead">Gastos del día</p>
                  <div class="col-sm-10" id="gastosdiv">
                    <!-- <div>
                      <label class="col-sm-2 col-form-label">Gasto #1</label>
                      <input class="form-control" type="text" id="nombreGasto[]" name="nombreGasto[]" placeholder="Nombre">
                      <input class="form-control" type="number" id="totalGasto[]" name="totalGasto[]" placeholder="Total">
                    </div> -->
                  </div>
                  <button class="btn btn-info" id="botonAgregarGasto" type="button"><i class="fas fa-plus-circle"></i></button>
                </div>
                <hr>
                <div class="form-group row">
                  <p for="total_deposito" class="col-sm-2 lead">Observaciones</p>
                  <div class="col-sm-10">
                    <textarea maxlength="250" class="form-control" name="observaciones" id="observaciones" rows="6" placeholder="Observaciones que tengas del corte de caja de este día"></textarea>
                  </div>
                </div>

                <button type="submit" class="form-control btn-success" style="display: none;" id="confirmarCorteCaja" name="confirmarCorteCaja" onclick='return confirm("¿Estás seguro de confirmar el corte de caja?")'>Confirmar corte</button>
              </form>
            </div>
        </div>
    </main>
    <?php
      getFooter();
    ?>
    <script src="../../Controller/Usuario/Util/validarCamposCorteCaja.js"></script>
</body>
</html>