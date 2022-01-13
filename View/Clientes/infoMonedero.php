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
  
  $id_monedero = $_GET['id_monedero'];
  getHeadHTML("ProSkin - Información monedero #{$id_monedero}");
?>
<body style='background-color: #f9f3f3;'>
    <?php
        require_once("../include/navbar.php");
        
        $fecha_para_corte_caja = getFechaFormatoCDMX();
        getNavbar($fecha_para_corte_caja, $fetch_info['name'], $ModeloUsuario->getNombreSucursalUsuario($email)['nombre_sucursal']);
        $infoCliente = $ModelCliente->getMonederoWhereID($id_monedero)[0];
        // print_r($infoCliente);
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
        <div class="container">
            <?php
                echo "<h1>Información del monedero #{$id_monedero}</h1>";
            ?>
            <hr>
            <div class="row">
                <div class="col-sm">
                    <h3>ID cliente</h3>
                    <p class="lead" id="id" name="id"><?php echo $infoCliente['id_cliente'];?></p>
                </div>
                <div class="col-sm">
                    <h3>Vendido por</h3>
                    <p class="lead" id="status" name="status"><?php echo $ModeloUsuario ->getNombreCosmetologaWhereID($infoCliente['id_cosmetologa_venta']);?></p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm">
                    <h3>Fecha de venta</h3>
                    <p class="lead" id="fecha_registro" name="fecha_registro"><?php echo date( "Y-m-d H:m", $infoCliente['timestamp_creacion']);?></p>
                </div>
                <div class="col-sm">
                    <h3>Monto inicial</h3>
                    <p class="lead" id="fecha_visita" name="fecha_visita"><?php echo "$".number_format($infoCliente['dinero_inicial']);?></p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm">
                    <div class="form-inline">
                        <h3>Tratamientos del monedero</h3>
                        <a class="btn btn-success"  href=<?php echo "recargarMonedero.php?idCliente=".$infoCliente['id_cliente']."&idMonedero=".$id_monedero;?> role="button">Recargar monedero</a> <br>
                    </div>
                    <p class="lead" id="nombre" name="nombre">
                    <?php
                    if(json_decode($infoCliente['tratamientos_inicial']) != ""){
                        $cantidad_tratamiento = array_map(null, json_decode($infoCliente['tratamientos_inicial']), json_decode($infoCliente['cantidad']));
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
            <hr>
            <div id="accordion">
                <h3>Historial de uso</h3> 
                <?php
                if(!empty($historial)){
                    $tratamientosOriginales = json_decode($infoCliente['tratamientos_inicial']);
                    foreach($historial as $idmov => $movimiento) {
                        $inicial = '';
                        $tratamientos_aplicados_short = '';
                        if($idmov == 0) {
                            $inicial = " (Movimiento de creación)";
                            $tratamientos_aplicados = '';
                            foreach($tratamientosOriginales as $key => $val) {
                                $tratamientos_aplicados .= '<p class="font-weight-bold"> • '.$ModelCliente -> getNombreTratamiento($tratamientosOriginales[$key]).'</p>';
                            }
                        }else{
                            $tratamientos_aplicados_temp = array_diff_assoc($movimiento[1], $historial[$idmov-1][1]);
                            $tratamientos_aplicados = '';
                            foreach($tratamientos_aplicados_temp as $key => $val) {
                                $tratamientos_aplicados .= '<p class="font-weight-bold"> • '.$ModelCliente -> getNombreTratamiento($tratamientosOriginales[$key]).'</p>';
                                $tratamientos_aplicados_short .= $ModelCliente -> getNombreTratamiento($tratamientosOriginales[$key]).', ';
                            }
                        }
                        echo '
                            <div class="card">
                                    <div class="card-header" id="heading'.$movimiento[3].'">
                                    <h5 class="mb-0">
                                        <button class="btn btn-secondary" data-toggle="collapse" data-target="#collapse'.$movimiento[3].'" aria-expanded="true" aria-controls="collapse'.$movimiento[3].'">
                                        '.date('Y-m-d', $movimiento[3]).$inicial.' ('.$tratamientos_aplicados_short.')
                                        </button>
                                    </h5>
                                    </div>
            
                                    <div id="collapse'.$movimiento[3].'" class="collapse" aria-labelledby="heading'.$movimiento[3].'" data-parent="#accordion">
                                    <div class="card-body">
                                        <p class="font-weight-light">Tratamientos aplicados: '.$tratamientos_aplicados.'</p>
                                        <p class="font-weight-light">Monto final del monedero: <p class="font-weight-bold">$'.number_format($movimiento[0]).'</p></p>
                                        <p class="font-weight-light">Aplicado por: <p class="font-weight-bold">'.$ModeloUsuario -> getNombreCosmetologaWhereID($movimiento[2]).'</p></p>
                                    </div>
                                    </div>
                                </div>
                                ';
                    }
                }else{
                    echo "NO HAY HISTORIAL";
                }
                ?>
            </div>
        </div>
    </main>
    <?php
      getFooter();
    ?>
    <script src="../../Controller/Clientes/Util/validarCamposAlta.js"></script>
</body>
</html>