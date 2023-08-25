<?php
    session_start();
    include_once '../../Model/Sucursal.php'; //'/admin/Model/Sucursal.php';
    require_once '../../Model/Session.php';
    $ModelSucursal  = new Sucursal();
    $Session        = new Session();

    // Recepción de los datos enviados mediante POST desde el JS
    $opcion     = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
    $start_date = (isset($_POST['start_date'])) ? $_POST['start_date'] : '';
    $end_date   = (isset($_POST['end_date'])) ? $_POST['end_date'] : '';
    $chart_type = (isset($_POST['type'])) ? $_POST['type'] : '';

    $fechaMonday = date_create_from_format('Y-m-d', $start_date);
    $monday = date_format($fechaMonday, 'Y-m-d');
    $fechaSunday = date_create_from_format('Y-m-d', $end_date);
    $sunday = date_format($fechaSunday, 'Y-m-d');
    $primer_dia = strtotime($monday);
    $ultimo_dia = strtotime($sunday);

    $cortes_de_caja = [];
    
    if($chart_type === 'numventas') {
        if($Session->isAdminGlobal()) {
            $cortes_de_caja = $ModelSucursal -> getCierresDeCaja($primer_dia, $ultimo_dia);
        } else {
            $idSucursal = $Session -> getSucursalFromSession();
            $cortes_de_caja = $ModelSucursal -> getCierresDeCajaFromCentro($idSucursal, $primer_dia, $ultimo_dia);
        }
    
        //initialize the array to store the processed data
        $jsonArray = array();
    
        //check if there is any data returned by the SQL Query
        if (sizeof($cortes_de_caja) > 0) {
            foreach ($cortes_de_caja as $value) {
                $jsonArrayItem = array();
                date_default_timezone_set('America/Mexico_City'); // Establece la zona horaria de Ciudad de México
                $fecha_cdmx_creacion = date('Y-m-d', $value['timestamp']);
                $jsonArrayItem['label'] = $fecha_cdmx_creacion;
                $jsonArrayItem['value'] = $value['num_ventas_general'];
                //append the above created object into the main array.
                array_push($jsonArray, $jsonArrayItem);
            }
        }
    }
    
    if ($chart_type === 'ingresos' ) {
        if($Session->isAdminGlobal()) {
            $cortes_de_caja = $ModelSucursal -> getCierresDeCaja($primer_dia, $ultimo_dia);
        } else {
            $idSucursal = $Session -> getSucursalFromSession();
            $cortes_de_caja = $ModelSucursal -> getCierresDeCajaFromCentro($idSucursal, $primer_dia, $ultimo_dia);
        }
        
        //initialize the array to store the processed data
        $jsonArray = array();
    
        //check if there is any data returned by the SQL Query
        if (sizeof($cortes_de_caja) > 0) {
            foreach ($cortes_de_caja as $value) {
                $jsonArrayItem = array();
                date_default_timezone_set('America/Mexico_City'); // Establece la zona horaria de Ciudad de México
                $fecha_cdmx_creacion = date('Y-m-d', $value['timestamp']);
                $jsonArrayItem['label'] = $fecha_cdmx_creacion;
                $jsonArrayItem['value'] = $value['total_ingresos'];
                //append the above created object into the main array.
                array_push($jsonArray, $jsonArrayItem);
            }
        }
    }

    if ($chart_type === 'gastos' ) {
        if($Session->isAdminGlobal()) {
            $cortes_de_caja = $ModelSucursal -> getCierresDeCaja($primer_dia, $ultimo_dia);
        } else {
            $idSucursal = $Session -> getSucursalFromSession();
            $cortes_de_caja = $ModelSucursal -> getCierresDeCajaFromCentro($idSucursal, $primer_dia, $ultimo_dia);
        }
        
        //initialize the array to store the processed data
        $jsonArray = array();
    
        //check if there is any data returned by the SQL Query
        if (sizeof($cortes_de_caja) > 0) {
            foreach ($cortes_de_caja as $value) {
                $jsonArrayItem = array();
                date_default_timezone_set('America/Mexico_City'); // Establece la zona horaria de Ciudad de México
                $fecha_cdmx_creacion = date('Y-m-d', $value['timestamp']);
                $jsonArrayItem['label'] = $fecha_cdmx_creacion;
                $jsonArrayItem['value'] = $value['total_gastos'];
                //append the above created object into the main array.
                array_push($jsonArray, $jsonArrayItem);
            }
        }
    }

    if ($chart_type === 'caja' ) {
        if($Session->isAdminGlobal()) {
            $cortes_de_caja = $ModelSucursal -> getCierresDeCaja($primer_dia, $ultimo_dia);
        } else {
            $idSucursal = $Session -> getSucursalFromSession();
            $cortes_de_caja = $ModelSucursal -> getCierresDeCajaFromCentro($idSucursal, $primer_dia, $ultimo_dia);
        }
        
        //initialize the array to store the processed data
        $jsonArray = array();
    
        //check if there is any data returned by the SQL Query
        if (sizeof($cortes_de_caja) > 0) {
            foreach ($cortes_de_caja as $value) {
                $jsonArrayItem = array();
                date_default_timezone_set('America/Mexico_City'); // Establece la zona horaria de Ciudad de México
                $fecha_cdmx_creacion = date('Y-m-d', $value['timestamp']);
                $jsonArrayItem['label'] = $fecha_cdmx_creacion;
                $jsonArrayItem['value'] = $value['total_caja'];
                //append the above created object into the main array.
                array_push($jsonArray, $jsonArrayItem);
            }
        }
    }

    //set the response content type as JSON
    header('Content-type: application/json');
    //output the return value of json encode using the echo function. 
    echo json_encode($jsonArray);
?>