<?php
    session_start();
    // require_once "../../Model/Inventario/Producto.php";
    require_once "../../Model/Usuario/Usuario.php";
    require_once "../../Controller/Usuario/Util/generadorPDF.php";

    $ModelUsuario = new Usuario();
    
    // $ModelProducto = new Producto();

    if (isset($_POST['confirmarCorteCaja'])) {
        $fecha = mysqli_real_escape_string($con, $_POST['diaCorteCaja']);
        $efectivo = mysqli_real_escape_string($con, $_POST['total_efectivo']);
        $num_efectivo = mysqli_real_escape_string($con, $_POST['num_efectivo']);

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
        $id_cosmetologa = mysqli_real_escape_string($con, $_POST['idCosmetologa']);
        $observaciones = mysqli_real_escape_string($con, $_POST['observaciones']);

        $nombre_archivo = "corteCaja".$id_sucursal."-".$fecha."-".$id_cosmetologa.".pdf";
        $id_corte_caja  = $id_sucursal.".".$id_cosmetologa.".".$fecha;

        $id_documento = intval($ModelUsuario -> numeroReportesFromSucursal($id_sucursal)) + 1;

        $sumaGeneralMetodos = floatval($tdc) + floatval($tdd) + floatval($transferencia) + floatval($deposito) + floatval($cheque) + floatval($efectivo);

        $sumaGeneralGastos = 0;
        foreach($total_gastos as $gasto){
            $sumaGeneralGastos += floatval($gasto);
        }

        $totalDelDia = $sumaGeneralMetodos - $sumaGeneralGastos;
       
        //($timestamp, $id_centro, $id_cosmetologa, $id_documento, $id_corte_caja, $total_ingresos, $total_gastos, $total_caja, $nombre_archivo, $observaciones, $efectivo, $tdc, $tdd, $transferencia, $deposito, $cheque, $gastos)
        if ($ModelUsuario->insertIntoCierreCaja($fecha, $id_sucursal, $id_cosmetologa, $id_documento, $id_corte_caja, $sumaGeneralMetodos, $sumaGeneralGastos, $totalDelDia, $nombre_archivo, $observaciones, json_encode([$num_efectivo, $efectivo]), json_encode([$num_tdc, $tdc]), json_encode([$num_tdd, $tdd]), json_encode([$num_transferencia, $transferencia]), json_encode([$num_deposito, $deposito]), json_encode([$num_cheque, $cheque]), json_encode([$nombres_gastos, $total_gastos]))){
            $conceptos = [["Efectivo", $num_efectivo, $efectivo],
                     ["TDC", $num_tdc, $tdc],
                     ["TDD", $num_tdd, $tdd],
                     ["Transferencia", $num_transferencia, $transferencia],
                     ["Deposito", $num_deposito, $deposito],
                     ["Cheque", $num_cheque, $cheque]];
            generarPDF($conceptos, $observaciones, $nombres_gastos, $total_gastos, $sumaGeneralMetodos, $sumaGeneralGastos, $totalDelDia, $nombre_archivo);
            header("Location: confirmacionCierreCaja.php?id=$id_corte_caja");
        }else{
            //echo hubo un error;
        }
        echo '<pre>';
        print_r($_POST);
        echo '</pre>';
    }
?>