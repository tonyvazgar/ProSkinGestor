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
        $fecha_para_corte_caja = date('Y-m-d');
        getNavbar($fecha_para_corte_caja, $fetch_info['name'], $ModeloUsuario->getNombreSucursalUsuario($email)['nombre_sucursal']);

        $date = new DateTime($fecha, new DateTimeZone('America/Mexico_City') );
        $timestamp = strtotime($date->format('Y-m-d H:i:s'));

        $beginOfDay = DateTime::createFromFormat('Y-m-d H:i:s', (new DateTime())->setTimestamp($timestamp)->format('Y-m-d 00:00:00'))->getTimestamp();
        $endOfDay = DateTime::createFromFormat('Y-m-d H:i:s', (new DateTime())->setTimestamp($timestamp)->format('Y-m-d 23:59:59'))->getTimestamp();

        print_r($beginOfDay." ---- ".$endOfDay);

        $total_efectivo = $ModeloUsuario->getTotalEfectivoWhereDia($beginOfDay, $endOfDay, $numeroSucursal);
        $total_tdc = $ModeloUsuario->getTotalTDCWhereDia($beginOfDay, $endOfDay, $numeroSucursal);
        $total_tdd = $ModeloUsuario->getTotalTDDWhereDia($beginOfDay, $endOfDay, $numeroSucursal);
        $total_transferencia = $ModeloUsuario->getTotalTransferenciaWhereDia($beginOfDay, $endOfDay, $numeroSucursal);
        $total_Deposito = $ModeloUsuario->getTotalDepositoWhereDia($beginOfDay, $endOfDay, $numeroSucursal);

        echo "<pre>";
        print_r($total_efectivo);echo "<br>----<br>----<br>";
        print_r($total_tdc);echo "<br>----<br>----<br>";
        print_r($total_tdd);echo "<br>----<br>----<br>";
        print_r($total_transferencia);echo "<br>----<br>----<br>";
        print_r($total_Deposito);echo "<br>----<br>----<br>";
        echo "</pre>";
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
                  <label for="diaCorteCaja" class="col-sm-2 col-form-label">Fecha</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" id="diaCorteCaja" name="diaCorteCaja" value="<?php echo date('Y-m-d'); ?>" readonly> 
                    <small id="passwordHelpBlock" class="form-text text-muted">
                      Esta es la fecha del día del corte de caja, no se puede cambiar ya que es automático
                    </small>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="total_efectivo" class="col-sm-2 col-form-label">Total en efectivo</label>
                  <div class="col-sm-10">
                    <div class='d-inline'>
                      <input type="number" class="form-control" id="total_efectivo" name="total_efectivo" placeholder="Total en efectivo"  value="<?php echo $total_efectivo[0] != '' ? $total_efectivo[0] : 0; ?>" readonly>
                      <input type="number" class="form-control" id="num_efectivo" name="num_efectivo" placeholder="Total en efectivo"  value="<?php echo $total_efectivo[0] != '' ? sizeof($total_efectivo[2]) : 0; ?>" readonly>
                    </div>
                    <small id="passwordHelpBlock" class="form-text text-muted" style="<?php echo $total_efectivo[0] == '' ? "display: none;": ''; ?>">
                      <div id="accordion">
                        <p>
                          <button class="btn btn-info collapsed" type="button" data-toggle="collapse" data-target="#collapseEfectivo"
                            aria-expanded="false" aria-controls="collapseEfectivo">Ver ventas</button>
                        </p>
                        <div class="form-group">
                          <div id="collapseEfectivo" class="collapse" aria-labelledby="headingOne" data-parent="#accordion" style="">
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
                <div class="form-group row">
                  <label for="total_tdc" class="col-sm-2 col-form-label">Total de tarjeta de crédito</label>
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
                          <div id="collapseTDC" class="collapse" aria-labelledby="headingOne" data-parent="#accordion" style="">
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
                <div class="form-group row">
                  <label for="total_tdd" class="col-sm-2 col-form-label">Total de tarjeta de débito</label>
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
                          <div id="collapseTDD" class="collapse" aria-labelledby="headingOne" data-parent="#accordion" style="">
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
                <div class="form-group row">
                  <label for="total_transferencia" class="col-sm-2 col-form-label">Total de transferencia</label>
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
                          <div id="collapseTransferencia" class="collapse" aria-labelledby="headingOne" data-parent="#accordion" style="">
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
                <div class="form-group row">
                  <label for="total_deposito" class="col-sm-2 col-form-label">Total de déposito</label>
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
                          <div id="collapseDeposito" class="collapse" aria-labelledby="headingOne" data-parent="#accordion" style="">
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


                <div class="form-group row">
                  <label for="total_deposito" class="col-sm-2 col-form-label">Observaciones</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" name="observaciones" id="observaciones" rows="2" placeholder="Observaciones que tengas del corte de caja de este día"></textarea>
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