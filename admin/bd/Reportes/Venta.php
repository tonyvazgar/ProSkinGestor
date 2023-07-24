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

    if ($opcion == 1) {
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
    }
    if ($opcion == 2) {
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
    }
    if ($opcion == 3) {
            if($Session->isAdminGlobal()) {
                $resultFromDB = $ModelVenta -> getTotalVentasDelDia($initalDateToSend, $lastDateToSend);
            }  else {
                $idSucursal = $Session -> getSucursalFromSession();
                $resultFromDB =$ModelVenta -> getTotalVentasDelDiaFromCentro($initalDateToSend, $lastDateToSend, $idSucursal);
            }

            $dataAnalized = $ModelVenta -> analizeVentas($resultFromDB);

            $widgetsTratamientos = '';
            $widgetsProductos    = '';
            $widgetsMetodosPago  = '';

            foreach ($dataAnalized['ventas_por_tratamiento'] as $idTratamiento => $value) {
                $nombreTratamiento = $ModelVenta -> getNombreTratamientoWhereID($idTratamiento);
                $brr = $dataAnalized['sum_ventas_por_tratamiento'];
                $widgetsTratamientos .= 
                '<!-- Numero de ventas -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">'.$nombreTratamiento.'</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">'.$value.' - $'.$brr[$idTratamiento].'</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
            }

            foreach ($dataAnalized['ventas_por_producto'] as $idProducto => $value) {
                $nombreProducto = $ModelVenta -> getNombreProductoWhereID($idProducto);
                $brr = $dataAnalized['sum_ventas_por_producto'];
                $widgetsProductos .= 
                '<!-- Numero de ventas -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">'.$nombreProducto.'</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">'.$value.' - $'.$brr[$idProducto].'</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
            }

            foreach ($dataAnalized['metodo_pago_cantidad'] as $idMetodoPago => $value) {
                $nombreMetodoPago = $ModelVenta -> getNombreMetodoPagoWhereID($idMetodoPago);
                $widgetsMetodosPago .= 
                '<!-- Numero de ventas -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">'.$nombreMetodoPago.'</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">$'.$value.'</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
            }

            $data .= '<div class="container-fluid">
                            <div class="row">
                                <!-- Numero de ventas -->
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                        # Ventas del periodo</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">'.$dataAnalized['total_ventas'].'</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Ganancias del periodo -->
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-success shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                        $ ingresos del periodo</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">'.$dataAnalized['monto_total'].'</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                '.$widgetsMetodosPago.'
                                <!-- Gastos del periodo -->
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-success shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                        # Ventas de tratamiento</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">'.$dataAnalized['total_tratamiento'].'</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Gastos del periodo -->
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-success shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                        $ ingresos por tratamiento</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">'.$dataAnalized['monto_total_tratamiento'].'</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                '.$widgetsTratamientos.'
                                <!-- Caja del periodo -->
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-success shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    # Ventas de producto</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">'.$dataAnalized['total_producto'].'</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Gastos del periodo -->
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-success shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                        $ ingresos por producto</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">'.$dataAnalized['monto_total_producto'].'</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                '.$widgetsProductos.'
                                <!-- Gastos del periodo -->
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-success shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                        # Ventas de monedero</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">'.$dataAnalized['sum_ventas_por_monedero'].'</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Gastos del periodo -->
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-success shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                        $ por monedero</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">'.$dataAnalized['monto_total_monedero'].'</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';


            $data .= '<div class="container-fluid">
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
                                                <th>MONTO</th>
                                                <th>SUCURSAL</th>
                                                <th>COSMETOLOGA</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                                            foreach($resultFromDB as $dat) {
                                                date_default_timezone_set('America/Mexico_City'); // Establece la zona horaria de Ciudad de México
                                                $fecha_cdmx_creacion = date('Y-m-d', $dat['timestamp']);
                                                
                                                $data .= '<tr>
                                                    <td><a href="/View/Ventas/detalleVenta.php?idVenta='.$dat['id_venta'].'" target="_blank">'.$dat['id_venta'].'</a></td>
                                                    <td>'.$dat['id_cliente'].'</td>
                                                    <td>'.$dat['nombre_cliente'].'</td>
                                                    <td>'.$fecha_cdmx_creacion.'</td>
                                                    <td>'.$dat['monto'].'</td>
                                                    <td>'.$dat['nombre_sucursal'].'</td>
                                                    <td>'.$dat['nombre_cosmetologa'].'</td>
                                                </tr>';
                                                }
                                        $data .= '</tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>';
    }
    if ($opcion === 'widgets15days') {
        if($Session->isAdminGlobal()) {
            $resultFromDB = $ModelVenta -> getTotalVentasDelDia($initalDateToSend, $lastDateToSend);
        }  else {
            $idSucursal = $Session -> getSucursalFromSession();
            $resultFromDB =$ModelVenta -> getTotalVentasDelDiaFromCentro($initalDateToSend, $lastDateToSend, $idSucursal);
        }
        $dataAnalized = $ModelVenta -> analizeVentas($resultFromDB);

        $widgetsTratamientos = '';
        $widgetsProductos    = '';
        $widgetsMetodosPago  = '';

        foreach ($dataAnalized['ventas_por_tratamiento'] as $idTratamiento => $value) {
            $nombreTratamiento = $ModelVenta -> getNombreTratamientoWhereID($idTratamiento);
            $brr = $dataAnalized['sum_ventas_por_tratamiento'];
            $widgetsTratamientos .= 
            '<!-- Numero de ventas -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">'.$nombreTratamiento.'</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">'.$value.' - $'.$brr[$idTratamiento].'</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        }

        foreach ($dataAnalized['ventas_por_producto'] as $idProducto => $value) {
            $nombreProducto = $ModelVenta -> getNombreProductoWhereID($idProducto);
            $brr = $dataAnalized['sum_ventas_por_producto'];
            $widgetsProductos .= 
            '<!-- Numero de ventas -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">'.$nombreProducto.'</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">'.$value.' - $'.$brr[$idProducto].'</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        }

        foreach ($dataAnalized['metodo_pago_cantidad'] as $idMetodoPago => $value) {
            $nombreMetodoPago = $ModelVenta -> getNombreMetodoPagoWhereID($idMetodoPago);
            $widgetsMetodosPago .= 
            '<!-- Numero de ventas -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Ingresos pagados con '.$nombreMetodoPago.'</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$'.$value.'</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        }

        $data = '<div class="container-fluid">
                        <div class="row">
                            <!-- Numero de ventas -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    # Ventas del periodo</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">'.$dataAnalized['total_ventas'].'</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Ganancias del periodo -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    $ ingresos totales del periodo</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">'.$dataAnalized['monto_total'].'</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            '.$widgetsMetodosPago.'
                            <!-- Gastos del periodo -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-dark shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                                    # Ventas de tratamiento</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">'.$dataAnalized['total_tratamiento'].'</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Gastos del periodo -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-dark shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                                    $ ingresos por tratamiento</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">'.$dataAnalized['monto_total_tratamiento'].'</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            '.$widgetsTratamientos.'
                            <!-- Caja del periodo -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                # Ventas de producto</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">'.$dataAnalized['total_producto'].'</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Gastos del periodo -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    $ ingresos por producto</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">'.$dataAnalized['monto_total_producto'].'</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            '.$widgetsProductos.'
                        </div>
                    </div>';
    }
    echo $data;
?>