<?php

function getNavbar($fecha, $name, $sucursal){
    require_once("../../Model/Usuario/Usuario.php");
    $ModelUsuario   = new Usuario();
    $id_centro      = $ModelUsuario->getNumeroSucursalxNombre($sucursal);
    $email          = $_SESSION['email'];
    $id_cosmetologa = $ModelUsuario->getIdCosmetologa($email)['id'];
    
    echo "<nav class='navbar navbar-expand-lg navbar-light fixed-top' style='background-color: #f7d9d9;'>
                <a class='navbar-brand' href='../index.php'>
                    <img src='../../View/img/logoProSkin.png' height='30' class='d-inline-block align-top' alt=''>
                    $sucursal
                </a>
                <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarNav'
                    aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
                    <span class='navbar-toggler-icon'></span>
                </button>
                <div class='collapse navbar-collapse' id='navbarNav'>
                    <ul class='navbar-nav ml-auto'>";
                    getBotonCorteCaja($fecha, $id_centro, $id_cosmetologa);
                    echo "<li class='nav-item'>
                            <a class='nav-link' href='../../View/Clientes'>Clientes</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='https://calendar.google.com/' target='_blank'>Agenda</a>
                        </li>";
                        // <li class='nav-item'>
                        //     <a class='nav-link' href='../../View/Ventas/ventas.php'>Venta</a>
                        // </li>
                        echo "<li class='nav-item'>
                            <a class='nav-link' href='../../View/Inventario/'>Inventario/Productos</a>
                        </li>";
                        // echo "<li class='nav-item'>
                        //     <a class='nav-link' href='../../View/Recursos/'>Documentos</a>
                        // </li>";
                        // <li class='nav-item'>
                        //     <a class='nav-link' href='../../View/Reportes/reportes.php'>Reportes</a>
                        // </li>
                        // <li class='nav-item'>
                        //     <a class='nav-link' href='../../View/Recursos/recursos.php'>Recursos</a>
                        // </li>
                        // <li class='nav-item'>
                        //     <a class='nav-link' href='../../View/Administrador/administrador.php'>Administar usuarios</a>
                        // </li>
                        echo "<li class='nav-item'>
                            <a class='nav-link' href='../../View/Usuario/usuario.php'>$name</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='../../View/logout.php'>Cerrar sesion</a>
                        </li>
                    </ul>
                </div>
            </nav>";
}
function getVersion() {
    $hash = exec("git rev-list --tags --max-count=1");
    $ex = exec("git describe --tags $hash");
    if (!$ex){
        $ex = "1.4.0";
    }
    return $ex; 
}
function getGitBranch()
{
    $shellOutput = [];
    exec('git branch | ' . "grep ' * '", $shellOutput);
    foreach ($shellOutput as $line) {
        if (strpos($line, '* ') !== false) {
            return trim(strtolower(str_replace('* ', '', $line)));
        }
    }
    return null;
}
function getFooter(){
    echo "<footer class='footer'>
                <div class='container text-center'>
                    <span class='text-muted font-italic'>La belleza comienza en el momento en que decides ser tú misma.</span>
                    <br>
                    <span class='text-muted font-italic'>".getGitBranch()."<br>[".getVersion()."]</span>
                </div>
            </footer>";
}
function getBotonCorteCaja($fecha, $id_centro, $id_cosmetologa){
    require_once("../../Model/Usuario/Usuario.php");
    $ModelUsuario = new Usuario();
    $timestamp = strtotime($fecha);
    
    $ds = new DateTime('now', new DateTimeZone('America/Mexico_City') );
    $hora = $ds->format('H');

    cierreCajaDiaAnterior($ModelUsuario, $id_cosmetologa, new DateTime('now', new DateTimeZone('America/Mexico_City') ), $id_centro, 1);
    // cierreCajaDiaAnterior($ModelUsuario, new DateTime('now', new DateTimeZone('America/Mexico_City') ), $id_centro, 7);

    if($hora >= 13 && $hora <= 21){
        $corte = $ModelUsuario->existeCorteCaja($timestamp, $id_centro);
        if(!$corte){
            echo "<li class='nav-item'>
                    <a href='../../View/Usuario/corteCaja.php' class='btn btn-success'>Cierre de caja</a>
                  </li>";
        }
    }
}
function esMetodoPagoSolo($metodo, $referencia, $total)
{
    if (strlen($metodo) == 1) {
        return [[[$metodo, $total], $referencia]];
    } else {
        $array_metodos = json_decode($metodo);
        $array_referencia = json_decode($referencia);
        return array_map(null, $array_metodos, $array_referencia);
    }
}

function getFechaFormatoCDMX(){
    $date = new DateTime('now', new DateTimeZone('America/Mexico_City') );
    $fecha = $date->format('Y-m-d');
    return $fecha;
}

function unaSemanaAtras($fecha_de_hoy){
    $la_fecha = new DateTime($fecha_de_hoy, new DateTimeZone('America/Mexico_City') );
    $la_fecha->modify('-'.(7).' days');

    return $la_fecha->format('Y-m-d');
}

function diferenciaFechas($fechaUno, $fechaDos){
    $date1 = new DateTime($fechaUno);
    $date2 = new DateTime($fechaDos);
    $interval = $date1->diff($date2);

    $diferenciaEnDias = $interval->days;
    // echo "difference " . $interval->y . " years, " . $interval->m." months, ".$interval->d." days "; 
    // // shows the total amount of days (not divided into years, months and days like above)
    // echo "difference " . $interval->days . " days ";
    // echo "<br>".$fechaUno."<br>".$fechaDos;

    return $diferenciaEnDias;
}

function cierreCajaDiaAnterior($ModeloUsuario, $idCosmetologa, $date_time, $numeroSucursal, $dias) {
    require_once "../../Controller/Usuario/Util/generadorPDF.php";
    
    $date_time -> modify('-'.($dias).' days');
    $fecha_a_verificar = $date_time->format('Y-m-d');
    $timestamp         = strtotime($fecha_a_verificar);

    if(!$ModeloUsuario->existeCorteCaja($timestamp, $numeroSucursal)){
        $beginOfDay = DateTime::createFromFormat('Y-m-d H:i:s', (new DateTime())->setTimestamp($timestamp)->format('Y-m-d 00:00:00'))->getTimestamp();
        $endOfDay   = DateTime::createFromFormat('Y-m-d H:i:s', (new DateTime())->setTimestamp($timestamp)->format('Y-m-d 23:59:59'))->getTimestamp();

    
        $total_efectivo      = $ModeloUsuario->getTotalEfectivoWhereDia($beginOfDay, $endOfDay, $numeroSucursal);
        $total_tdc           = $ModeloUsuario->getTotalTDCWhereDia($beginOfDay, $endOfDay, $numeroSucursal);
        $total_tdd           = $ModeloUsuario->getTotalTDDWhereDia($beginOfDay, $endOfDay, $numeroSucursal);
        $total_transferencia = $ModeloUsuario->getTotalTransferenciaWhereDia($beginOfDay, $endOfDay, $numeroSucursal);
        $total_Deposito      = $ModeloUsuario->getTotalDepositoWhereDia($beginOfDay, $endOfDay, $numeroSucursal);
        $total_cheque        = $ModeloUsuario->getTotalChequeWhereDia($beginOfDay, $endOfDay, $numeroSucursal);

        $numTotalVentasDia   = $ModeloUsuario -> getNumeroTotalVentasDelDiaFromCentro($beginOfDay, $endOfDay, $numeroSucursal);

        $nombre_centro       = $ModeloUsuario -> getNombreSucursalWhereIDSucursal($numeroSucursal)['nombre_sucursal'];
        $id_cosmetologa      = $idCosmetologa;
        $observaciones       = "*** REPORTE GENERADO AUTOMATICAMENTE SIN GASTOS ***";



        $efectivo          = $total_efectivo[0];
        $num_efectivo      = sizeof($total_efectivo[1]);

        $tdc               = $total_tdc[0];
        $num_tdc           = sizeof($total_tdc[1]);

        $tdd               = $total_tdd[0];
        $num_tdd           = sizeof($total_tdd[1]);

        $transferencia     = $total_transferencia[0];
        $num_transferencia = sizeof($total_transferencia[1]);

        $deposito          = $total_Deposito[0];
        $num_deposito      = sizeof($total_Deposito[1]);

        $cheque            = $total_cheque[0];
        $num_cheque        = sizeof($total_cheque[1]);


        $nombre_centro_sin_espacios = str_replace(' ', '', $nombre_centro);

        $nombre_archivo = $nombre_centro_sin_espacios."_corteCaja_".$fecha_a_verificar."_".$id_cosmetologa.".pdf";
        $id_corte_caja  = 'PS'.strtoupper($nombre_centro_sin_espacios).$timestamp;

        $id_documento = intval($ModeloUsuario -> numeroReportesFromSucursal($numeroSucursal)) + 1;

        $sumaGeneralMetodos = floatval($tdc) + floatval($tdd) + floatval($transferencia) + floatval($deposito) + floatval($cheque) + floatval($efectivo);


        if ($ModeloUsuario->insertIntoCierreCaja($timestamp, $numeroSucursal, $numTotalVentasDia, $id_cosmetologa, $id_documento, $id_corte_caja, $sumaGeneralMetodos, '0', $sumaGeneralMetodos, $nombre_archivo, $observaciones, json_encode([$num_efectivo, $efectivo]), json_encode([$num_tdc, $tdc]), json_encode([$num_tdd, $tdd]), json_encode([$num_transferencia, $transferencia]), json_encode([$num_deposito, $deposito]), json_encode([$num_cheque, $cheque]), json_encode(['', '']))){
            $conceptos = [["Efectivo", $efectivo],
                     ["TDC", $tdc],
                     ["TDD", $tdd],
                     ["Transferencia", $transferencia],
                     ["Deposito", $deposito],
                     ["Cheque", $cheque]];
            generarPDF($id_documento, $id_corte_caja, $fecha_a_verificar, $numTotalVentasDia, $nombre_centro, $conceptos, $observaciones, [], [], $sumaGeneralMetodos, 0, $efectivo, $nombre_archivo);
        }


    }
}
?>