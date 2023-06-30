<?php
    session_start();
    require_once __DIR__."/../../Model/Session.php";
    include_once __DIR__."/../../Model/Venta.php";
    $Session        = new Session();
    $ModelVenta     = new Venta();

    // Recepción de los datos enviados mediante POST desde el JS
    $opcion     = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
    $start_date = (isset($_POST['start_date'])) ? $_POST['start_date'] : '';
    $end_date   = (isset($_POST['end_date'])) ? $_POST['end_date'] : '';
    $sucursal   = (isset($_POST['sucursal'])) ? $_POST['sucursal'] : '';


    $initialDateFront       = date_create_from_format('Y-m-d', $start_date);
    $initalDateWithFormat   = date_format($initialDateFront, 'Y-m-d');
    $finalDateFront         = date_create_from_format('Y-m-d', $end_date);
    $lastDateWithFormat     = date_format($finalDateFront, 'Y-m-d');
    $initalDateToSend       = strtotime($initalDateWithFormat);
    $lastDateToSend         = strtotime($lastDateWithFormat);

    $resultFromDB = [];

    switch($opcion) {
        case 1: //Busqueda de información
            if($Session->isAdminGlobal()) {
                $resultFromDB = $ModelVenta -> getAllVentasTratamiento($initalDateToSend, $lastDateToSend);
            }  else {
                $idSucursal = $Session -> getSucursalFromSession();
                $resultFromDB =$ModelVenta -> getAllVentasTratamientoFromIdSucursal($initalDateToSend, $lastDateToSend, $idSucursal);
            }
            
            $data = '<div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table id="tablaPersonas" class="table table-striped table-bordered table-condensed"
                                        style="width:100%">
                                        <thead class="text-center">
                                            <tr>
                                                <th>ID VENTA</th>
                                                <th>ID CLIENTE</th>
                                                <th>ID TRATAMIENTO</th>
                                                <th>COSMETOLOGA</th>
                                                <th>Sucursal</th>
                                                <th>Fecha</th>
                                                <th>ZONA CUERPO</th>
                                                <th>NOBRE TRATAMIENTO</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                                            foreach($resultFromDB as $dat) {
                                                date_default_timezone_set('America/Mexico_City'); // Establece la zona horaria de Ciudad de México
                                                $fecha_cdmx_creacion = date('Y-m-d', $dat['timestamp']);
                                                $data .= '<tr>
                                                    <td>'.$dat['id_venta'].'</td>
                                                    <td>'.$dat['id_cliente'].'</td>
                                                    <td>'.$dat['id_tratamiento'].'</td>
                                                    <td>'.$dat['id_cosmetologa'].'</td>
                                                    <td>'.$dat['centro'].'</td>
                                                    <td>'.$fecha_cdmx_creacion.'</td>
                                                    <td>'.$dat['zona_cuerpo'].'</td>
                                                    <td>'.$dat['nombre_tratamiento'].'</td>
                                                    <td></td>
                                                </tr>';
                                                }
                                        $data .= '</tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>';
                    
            break;
        case 2: //Update Producto
            if($Session->isAdminGlobal()) {
                $resultFromDB = $ModelVenta -> getAllVentasProducto($initalDateToSend, $lastDateToSend);
            }  else {
                $idSucursal = $Session -> getSucursalFromSession();
                $resultFromDB =$ModelVenta -> getAllVentasProductoFromIdSucursal($initalDateToSend, $lastDateToSend, $idSucursal);
            }
            
            $data = '<div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table id="tablaPersonas" class="table table-striped table-bordered table-condensed"
                                        style="width:100%">
                                        <thead class="text-center">
                                            <tr>
                                                <th>ID VENTA</th>
                                                <th>COSMETOLOGA</th>
                                                <th>Sucursal</th>
                                                <th>Fecha</th>
                                                <th>Producto</th>
                                                <th>Presentación</th>
                                                <th>$ Total</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                                            foreach($resultFromDB as $dat) {
                                                date_default_timezone_set('America/Mexico_City'); // Establece la zona horaria de Ciudad de México
                                                $fecha_cdmx_creacion = date('Y-m-d', $dat['timestamp']);
                                                $data .= '<tr>
                                                    <td>'.$dat['id_venta'].'</td>
                                                    <td>'.$dat['id_cosmetologa'].'</td>
                                                    <td>'.$dat['centro'].'</td>
                                                    <td>'.$fecha_cdmx_creacion.'</td>
                                                    <td>'.$dat['descripcion_producto'].'</td>
                                                    <td>'.$dat['presentacion_producto'].'</td>
                                                    <td>'.$dat['monto'].'</td>
                                                    <td></td>
                                                </tr>';
                                                }
                                        $data .= '</tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>';
                    
            break;
        case 3: //Busqueda de información
            if($Session->isAdminGlobal()) {
                $resultFromDB = $ModelVenta -> getTotalVentasDelDia($initalDateToSend, $lastDateToSend);
            }  else {
                $idSucursal = $Session -> getSucursalFromSession();
                $resultFromDB =$ModelVenta -> getTotalVentasDelDiaFromCentro($initalDateToSend, $lastDateToSend, $idSucursal);
            }
            $data = '<div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table id="tablaPersonas" class="table table-striped table-bordered table-condensed"
                                        style="width:100%">
                                        <thead class="text-center">
                                            <tr>
                                                <th>ID VENTA</th>
                                                <th>ID CLIENTE</th>
                                                <th>NOMBRE CLIENTE</th>
                                                <th>FECHA</th>
                                                <th>ID TRATAMIENTO</th>
                                                <th>FORMAS DE PAGO</th>
                                                <th>REFERENCIA PAGO</th>
                                                <th>MONTO</th>
                                                <th>SUCURSAL</th>
                                                <th>COSTO TRATAMIENTO</th>
                                                <th>PRODUCTOS</th>
                                                <th>COSTO PRODUCTOS</th>
                                                <th>CANTIDAD PRODUCTOS</th>
                                                <th>COSMETOLOGA</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                                            foreach($resultFromDB as $dat) {
                                                date_default_timezone_set('America/Mexico_City'); // Establece la zona horaria de Ciudad de México
                                                $fecha_cdmx_creacion = date('Y-m-d', $dat['timestamp']);
                                                
                                                $data .= '<tr>
                                                    <td>'.$dat['id_venta'].'</td>
                                                    <td>'.$dat['id_cliente'].'</td>
                                                    <td>'.$dat['nombre_cliente'].'</td>
                                                    <td>'.$fecha_cdmx_creacion.'</td>
                                                    <td>'.$dat['id_tratamiento'].'</td>
                                                    <td>'.$dat['metodo_pago'].'</td>
                                                    <td>'.$dat['referencia_pago'].'</td>
                                                    <td>'.$dat['monto'].'</td>
                                                    <td>'.$dat['nombre_sucursal'].'</td>
                                                    <td>'.$dat['costo_tratamiento'].'</td>
                                                    <td>'.$dat['id_productos'].'</td>
                                                    <td>'.$dat['costo_producto'].'</td>
                                                    <td>'.$dat['cantidad_producto'].'</td>
                                                    <td>'.$dat['nombre_cosmetologa'].'</td>
                                                    <td></td>
                                                </tr>';
                                                }
                                        $data .= '</tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>';
            break;
    }

    echo $data; //enviar el array final en formato json a JS
    $conexion = NULL;
?>