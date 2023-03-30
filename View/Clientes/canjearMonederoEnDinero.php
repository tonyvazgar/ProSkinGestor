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
  $id_cosmetologa = $ModeloUsuario->getIdCosmetologa($email);
  
  
  $id_monedero = $_GET['idMonedero'];
  $id_cliente  = $_GET['idCliente'];
  getHeadHTML("ProSkin - Canje de monedero #{$id_monedero} a dinero disponible");
?>
<body style='background-color: #f9f3f3;'>
    <?php
        require_once("../include/navbar.php");
        
        $fecha_para_corte_caja = getFechaFormatoCDMX();
        getNavbar($fecha_para_corte_caja, $fetch_info['name'], $ModeloUsuario->getNombreSucursalUsuario($email)['nombre_sucursal']);
        $infoCliente = $ModelCliente->getMonederoWhereIDandCliente($id_monedero, $id_cliente);
        if(empty($infoCliente)){
            $infoCliente = $ModelCliente->getMonederoDineroWhereIDandCliente($id_monedero, $id_cliente);
        }
        if(json_decode($infoCliente['tratamientos_final']) == ''){
            $historial          = [];
        }else{
            $dinero_final       = json_decode($infoCliente['dinero_final']);
            $tratamientos_final = json_decode($infoCliente['tratamientos_final']);
            $id_cosmetologa_uso = json_decode($infoCliente['id_cosmetologa_uso']);
            $timestamp_uso      = json_decode($infoCliente['timestamp_uso']);

            $historial          = array_map(null, $dinero_final, $tratamientos_final, $id_cosmetologa_uso, $timestamp_uso);
        }
        
    ?>
    <main role="main" class="container">
        <form action="canjearMonederoEnDinero.php" method="post">
            <div class="container">
                <div class="form-inline">
                    <?php
                        echo "<h1>Canje de monedero #{$id_monedero} a dinero disponible</h1>";
                    ?>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm">
                        <h3>ID cliente</h3>
                        <p class="lead" id="id" name="id"><?php echo $infoCliente['id_cliente'];?></p>
                        <input type="text" class="form-control" id="idCliente" name="idCliente" value=<?php echo $infoCliente['id_cliente'];?> hidden readonly>
                        <input type="text" class="form-control" id="idCosmetologa" name="idCosmetologa" value=<?php echo $id_cosmetologa['id'];?> hidden readonly>
                        <input type="text" class="form-control" id="timeStampDelMonedero" name="timeStampDelMonedero" value=<?php echo $infoCliente['timestamp_creacion'];?> hidden readonly>
                    </div>
                    <div class="col-sm">
                        <h3>ID monedero</h3>
                        <p class="lead" id="fecha_visita" name="fecha_visita">
                            <?php echo $infoCliente['id_monedero'];?></p>
                        </p>
                        <input type="text" class="form-control" id="id_monedero" name="id_monedero" value=<?php echo $infoCliente['id_monedero'];?> hidden readonly>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm">
                        <div class="form-inline">
                            <h3>Tratamientos actuales en el monedero</h3>
                        </div>
                        <div>
                            <?php
                                if(json_decode($infoCliente['tratamientos_inicial']) != ""){
                                    $cantidad_tratamiento = array_map(null, json_decode($infoCliente['tratamientos_inicial']), json_decode($infoCliente['cantidad']), json_decode($infoCliente['num_zonas']), json_decode($infoCliente['zonas_tratamiento']));
                                    foreach($cantidad_tratamiento as $elemento){
                                        $id_shuffle = str_shuffle($elemento[0]);
                                        $nombreTratamiento = $elemento[0];
                                        if (strpos($nombreTratamiento, "-") !== false) {
                                            $nombreTratamiento = substr($nombreTratamiento, 0, strpos($nombreTratamiento, "-"));
                                        }
                                        echo '<button type="button" class="btn btn-info" style="margin-right:5px" disabled>
                                                    '.$ModelCliente -> getNombreTratamiento($nombreTratamiento).' <span class="badge badge-light">'.$elemento[1].'</span>
                                            </button>';
                                            if($nombreTratamiento == 'DEP01' || $nombreTratamiento== 'CAV01'){
                                                echo '<button type="button" class="btn btn-sm" data-toggle="collapse" data-target="#info'.$id_shuffle.'" aria-expanded="true" aria-controls="info'.$id_shuffle.'">
                                                        <i class="fas fa-info-circle"></i>
                                                    </button>';
                                                echo '<div class="collapse" id="info'.$id_shuffle.'">
                                                    <div class="card card-body">
                                                    Detalles del tratamiento:';
                                                    if($elemento[0] == 'DEP01'){
                                                        echo '<p class="font-weight-light">Número de zonas: '.$elemento[2].'</p>';
                                                        
                                                    }
                                                    $zonasFront = '';
                                                    foreach(explode(',', $elemento[3]) as $zonaParaString){
                                                        $zonasFront .= $ModeloUsuario -> getNombreZonaCuerpoWhereID($zonaParaString).', ';
                                                    }
                                                    echo '<p class="font-weight-light">Zonas: '.$zonasFront.'</p>';
                                                echo'</div></div>';
                                            }
                                    }
                                }else{
                                    echo "NO HAY TRATAMIENTOS, SOLO SE REGISTRÓ DINERO";
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm">
                        <div class="form-inline text-center">
                            <h2 class="text-center">¿Estás seguro de canjear estos tratamientos por dinero disponible?</h2>
                        </div>
                        <div class="col-sm text-center">
                            <h3>Monto a cambiar</h3>
                            <p class="lead" id="fecha_visita" name="fecha_visita">
                                <?php 
                                    if(empty($dinero_final)){
                                        echo "$".number_format($infoCliente['dinero_inicial'], 2);
                                        echo '<input type="text" class="form-control" id="dinero" name="dinero" value="'.$infoCliente['dinero_inicial'].'" hidden readonly>';
                                    }else{
                                        echo "$".number_format(end($dinero_final), 2);
                                        echo '<input type="text" class="form-control" id="dinero" name="dinero" value="'.floatval(end($dinero_final)).'" hidden readonly>';
                                    }
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-center">

                    <a class="btn btn-secondary" href="../" role="button">Cancelar</a>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">Confirmar canje</button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">¿Completamente seguro?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Recuerda que si lo cambias por dinero, los tratamientos disponibles de este monedero YA NO se podrán recurperar hasta que el dinero se termine.
                            </div>
                            <div class="modal-body">
                                Este movimiento es irreversible.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-danger" id="confirmarCajeMonederoButton" name="confirmarCajeMonederoButton">Canjear</button>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <hr>
                
            </div>
        </form>
    </main>
    <?php
      getFooter();
    ?>
    <script src="../../Controller/Clientes/Util/validarCamposAlta.js"></script>
</body>
</html>