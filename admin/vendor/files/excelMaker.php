<?php
    session_start();
    require_once '../../Model/Sucursal.php';
    require_once __DIR__."/../../Model/Session.php";
    require_once './excelGenerator.php';
    include_once "../../Model/Venta.php";
    include_once "../../Model/Cliente.php";
    $ModelCliente   = new Cliente();
    $ModelVenta     = new Venta();
    $ModelSucursal  = new Sucursal();
    $Session        = new Session();
    $Excel          = new ExcelGenerator();

    // Recepción de los datos enviados mediante POST desde el JS
    $tipoReporte     = (isset($_POST['type'])) ? $_POST['type'] : '';
    $start_date      = (isset($_POST['start_date'])) ? $_POST['start_date'] : '';
    $end_date        = (isset($_POST['end_date'])) ? $_POST['end_date'] : '';
    

    $fechaMonday = date_create_from_format('Y-m-d', $start_date);
    $monday      = date_format($fechaMonday, 'Y-m-d');
    $fechaSunday = date_create_from_format('Y-m-d', $end_date);
    $sunday      = date_format($fechaSunday, 'Y-m-d');
    $primer_dia  = strtotime($monday);
    $ultimo_dia  = strtotime($sunday);


    $is_admin    = $Session->isAdminGlobal();
    $id_sucursal = $Session -> getSucursalFromSession();

    if ($tipoReporte == 'exportExcelCorteCaja') {

        $dataFromDB = [];
        if($is_admin) {
            $dataFromDB = $ModelSucursal -> getCierresDeCaja($primer_dia, $ultimo_dia);
        } else {
            $dataFromDB = $ModelSucursal -> getCierresDeCajaFromCentro($id_sucursal, $primer_dia, $ultimo_dia);
        }
        
        $Excel -> createFile($dataFromDB);
    }

    if ($tipoReporte == 'exportExcelVentas') {

        $dataFromDB = [];
        if($is_admin) {
            $dataFromDB = $ModelVenta -> getTotalVentasDelDia($primer_dia, $ultimo_dia);
        }  else {
            $dataFromDB =$ModelVenta -> getTotalVentasDelDiaFromCentro($primer_dia, $ultimo_dia, $id_sucursal);
        }

        $Excel -> createFile($dataFromDB);
    }

    if ($tipoReporte == 'exportExcelTratamientosAplicados') {

        $dataFromDB = [];
        if($is_admin) {
            $dataFromDB = $ModelVenta -> getAllVentasTratamiento($primer_dia, $ultimo_dia);
        }  else {
            $dataFromDB =$ModelVenta -> getAllVentasTratamientoFromIdSucursal($primer_dia, $ultimo_dia, $id_sucursal);
        }

        $Excel -> createFile($dataFromDB);
    }

    if ($tipoReporte == 'exportExcelInventario') {

        $dataFromDB = [];
        if($is_admin) {
            $dataFromDB = $ModelVenta -> getAllVentasProducto($primer_dia, $ultimo_dia);
        }  else {
            $dataFromDB =$ModelVenta -> getAllVentasProductoFromIdSucursal($primer_dia, $ultimo_dia, $id_sucursal);
            $idSucursal = $Session -> getSucursalFromSession();
        }

        $Excel -> createFile($dataFromDB);
    }

    if ($tipoReporte == 'exportExcelClientesRegistrados') {

        $dataFromDB = [];
        if($is_admin) {
            $dataFromDB = $ModelCliente -> getAllUsuarios($primer_dia, $ultimo_dia);
        } else {
            $dataFromDB =$ModelCliente -> getAllUsuariosFromIdSucursal($primer_dia, $ultimo_dia, $id_sucursal);
        }

        $Excel -> createFile($dataFromDB);
    }
?>