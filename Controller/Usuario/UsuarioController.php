<?php
    session_start();
    // require_once "../../Model/Inventario/Producto.php";
    require_once "../../Model/Usuario/Usuario.php";
    require_once "../../Controller/Usuario/Util/generadorPDF.php";

    $ModelUsuario = new Usuario();
    
    // $ModelProducto = new Producto();

    if (isset($_POST['confirmarCorteCaja'])) {
        date_default_timezone_set('America/Mexico_City');
        if (version_compare(phpversion(), '7.1', '>=')) {
            ini_set( 'precision', 17 );
            ini_set( 'serialize_precision', -1 );
        }
        $fecha = mysqli_real_escape_string($con, $_POST['diaCorteCaja']);
        $timestamp = mysqli_real_escape_string($con, $_POST['timestamp']); //
        $efectivo = mysqli_real_escape_string($con, $_POST['total_efectivo']);
        $num_efectivo = mysqli_real_escape_string($con, $_POST['num_efectivo']);
        $efectivo_entregado = mysqli_real_escape_string($con, $_POST['efectivo_entregado']);
        $efectivo_pendiente = mysqli_real_escape_string($con, $_POST['efectivo_pendiente']);

        $tdc = mysqli_real_escape_string($con, $_POST['total_tdc']);
        $num_tdc = mysqli_real_escape_string($con, $_POST['num_tdc']);

        $tdd = mysqli_real_escape_string($con, $_POST['total_tdd']);
        $num_tdd = mysqli_real_escape_string($con, $_POST['num_tdd']);

        $transferencia = mysqli_real_escape_string($con, $_POST['total_transferencia']);
        $num_transferencia = mysqli_real_escape_string($con, $_POST['num_transferencia']);

        $deposito = mysqli_real_escape_string($con, $_POST['total_deposito']);
        $num_deposito = mysqli_real_escape_string($con, $_POST['num_deposito']);

        $cheque = mysqli_real_escape_string($con, $_POST['total_cheque']);
        $num_cheque = mysqli_real_escape_string($con, $_POST['num_cheque']);

        $temp_nombres_gasto = isset($_POST['nombreGasto']) ? $_POST['nombreGasto'] : []; 
        $temp_total_gasto   = isset($_POST['nombreGasto']) ? $_POST['totalGasto'] : []; 

        $nombres_gastos = explode(",",mysqli_real_escape_string($con, implode(",", $temp_nombres_gasto)));
        $total_gastos   = explode(",",mysqli_real_escape_string($con, implode(",", $temp_total_gasto))); 

        $id_sucursal = mysqli_real_escape_string($con, $_POST['id_centro']);
        $nombre_centro = $ModelUsuario -> getNombreSucursalWhereIDSucursal($id_sucursal)['nombre_sucursal'];
        $id_cosmetologa = mysqli_real_escape_string($con, $_POST['idCosmetologa']);
        $observaciones = mysqli_real_escape_string($con, $_POST['observaciones']);
        $numTotalVentasDia = mysqli_real_escape_string($con, $_POST['numTotalVentasDia']);//

        $nombre_centro_sin_espacios = str_replace(' ', '', $nombre_centro);

        $nombre_archivo = $nombre_centro_sin_espacios."_corteCaja_".$fecha."_".$id_cosmetologa.".pdf";
        $id_corte_caja  = 'PS'.strtoupper($nombre_centro_sin_espacios).$timestamp;

        $id_documento = intval($ModelUsuario -> numeroReportesFromSucursal($id_sucursal)) + 1;

        $sumaGeneralMetodos = floatval($tdc) + floatval($tdd) + floatval($transferencia) + floatval($deposito) + floatval($cheque) + floatval($efectivo);
        $sumaGeneralMetodos = number_format($sumaGeneralMetodos,2);

        if($num_efectivo == 0 && $num_tdc == 0 && $num_tdd == 0 && $num_transferencia == 0 && $num_deposito == 0 && $num_cheque == 0 && empty($temp_nombres_gasto) && empty($temp_total_gasto)){
            $observaciones = "NO HUBO MOVIMIENTOS EN EL DIA \n" . $observaciones;
        }

        $sumaGeneralGastos = 0;
        foreach($total_gastos as $gasto){
            $sumaGeneralGastos += floatval($gasto);
        }

        $totalDelDia = $sumaGeneralMetodos - $sumaGeneralGastos;
        $efectivo_a_entregar = $efectivo - $sumaGeneralGastos;
        $pendiente = $efectivo_entregado - $efectivo_a_entregar;
        //($timestamp, $id_centro, $id_cosmetologa, $id_documento, $id_corte_caja, $total_ingresos, $total_gastos, $total_caja, $nombre_archivo, $observaciones, $efectivo, $tdc, $tdd, $transferencia, $deposito, $cheque, $gastos)
        if ($ModelUsuario->insertIntoCierreCaja($timestamp, $id_sucursal, $numTotalVentasDia, $id_cosmetologa, $id_documento, $id_corte_caja, $sumaGeneralMetodos, $sumaGeneralGastos, $totalDelDia, $nombre_archivo, $observaciones, json_encode([$num_efectivo, $efectivo]), json_encode([$num_tdc, $tdc]), json_encode([$num_tdd, $tdd]), json_encode([$num_transferencia, $transferencia]), json_encode([$num_deposito, $deposito]), json_encode([$num_cheque, $cheque]), json_encode([$nombres_gastos, $total_gastos]))){
            $conceptos = [["Efectivo", $efectivo],
                     ["TDC", $tdc],
                     ["TDD", $tdd],
                     ["Transferencia", $transferencia],
                     ["Deposito", $deposito],
                     ["Cheque", $cheque]];
            generarPDF($id_documento, $id_corte_caja, $fecha, $numTotalVentasDia, $nombre_centro, $conceptos, $observaciones, $nombres_gastos, $total_gastos, $sumaGeneralMetodos, $sumaGeneralGastos, $efectivo_a_entregar, $efectivo_entregado, $pendiente, $nombre_archivo);
            header("Location: confirmacionCierreCaja.php?id=$id_corte_caja");
        }else{
            //echo hubo un error;
        }
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
    }
?>