<?php
    session_start();
    require_once "../Model/Session.php";
    include_once "../Model/Venta.php";
    $Session        = new Session();
    $ModelVenta     = new Venta();

    // Recepción de los datos enviados mediante POST desde el JS
    $opcion     = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
    $start_date = (isset($_POST['start_date'])) ? $_POST['start_date'] : '';
    $end_date   = (isset($_POST['end_date'])) ? $_POST['end_date'] : '';
    $chart_type = (isset($_POST['type'])) ? $_POST['type'] : '';


    $initialDateFront       = date_create_from_format('Y-m-d', $start_date);
    $initalDateWithFormat   = date_format($initialDateFront, 'Y-m-d');
    $finalDateFront         = date_create_from_format('Y-m-d', $end_date);
    $lastDateWithFormat     = date_format($finalDateFront, 'Y-m-d');
    $initalDateToSend       = strtotime($initalDateWithFormat);
    $lastDateToSend         = strtotime($lastDateWithFormat);

    $resultFromDB = [];
    
    if($chart_type === 'ventas_diarias') {
        
        if($Session->isAdminGlobal()) {
            $resultFromDB = $ModelVenta -> getTotalVentasDelDia($initalDateToSend, $lastDateToSend);
        }  else {
            $idSucursal = $Session -> getSucursalFromSession();
            $resultFromDB =$ModelVenta -> getTotalVentasDelDiaFromCentro($initalDateToSend, $lastDateToSend, $idSucursal);
        }
        
        //initialize the array to store the processed data
        $jsonArray = array();

        //check if there is any data returned by the SQL Query
        if (sizeof($resultFromDB) > 0) {
            foreach ($resultFromDB as $value) {
                $jsonArrayItem = array();
                date_default_timezone_set('America/Mexico_City'); // Establece la zona horaria de Ciudad de México
                $fecha_cdmx_creacion = date('Y-m-d', $value['timestamp']);
                $jsonArrayItem['label'] = $fecha_cdmx_creacion;
                $jsonArrayItem['value'] = $value['monto'];
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