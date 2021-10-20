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

        $sumaGeneralMetodos = floatval($tdc) + floatval($tdd) + floatval($transferencia) + floatval($deposito) + floatval($cheque) + floatval($efectivo);

        $sumaGeneralGastos = 0;
        foreach($total_gastos as $gasto){
            $sumaGeneralGastos += floatval($gasto);
        }

        $totalDelDia = $sumaGeneralMetodos - $sumaGeneralGastos;
       
        // if ($ModelUsuario->insertIntoCierreCaja($fecha, 'xxxxx', $id_cosmetologa, $id_sucursal, $efectivo, $num_efectivo, $tdc, $num_tdc, $tdd, $num_tdd, $transferencia, $num_transferencia, $deposito, $num_deposito, '00xxxx', $observaciones, $nombre_archivo)){
            $conceptos = [["Efectivo", $num_efectivo, $efectivo],
                     ["TDC", $num_tdc, $tdc],
                     ["TDD", $num_tdd, $tdd],
                     ["Transferencia", $num_transferencia, $transferencia],
                     ["Deposito", $num_deposito, $deposito],
                     [$sumaGeneralMetodos, $sumaGeneralGastos, $totalDelDia]];
            generarPDF($conceptos, $observaciones.json_encode($nombres_gastos).json_encode($total_gastos), $nombre_archivo);
            // header("Location: ../../index.php");
        // }else{
        //     //echo hubo un error;
        // }
        echo '<pre>';
        print_r($_POST);
        echo '</pre>';
    }
?>