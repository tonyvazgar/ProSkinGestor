<?php
    session_start();
    require_once __DIR__."/../../Model/Session.php";
    include_once __DIR__."/../../Model/Venta.php";
    require_once __DIR__."/../../Model/Cliente.php";
    $Session        = new Session();
    $ModelVenta     = new Venta();
    $ModelCliente   = new Cliente();

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
    
    if ($opcion === 'widgetsVentasTotales') {
        if($Session->isAdminGlobal()) {
            $resultFromDB = $ModelVenta -> getTotalVentasDelDia($initalDateToSend, $lastDateToSend);
        }  else {
            $idSucursal = $Session -> getSucursalFromSession();
            $resultFromDB =$ModelVenta -> getTotalVentasDelDiaFromCentro($initalDateToSend, $lastDateToSend, $idSucursal);
        }

        // printArrayPrety($resultFromDB);

        $dataAnalized = $ModelVenta -> analizeVentas($resultFromDB);

        // printArrayPrety($dataAnalized);

        $widgetsTratamientos = '';
        $widgetsMetodosPago  = '';
        $widgetsVentasPorSucursal = '';
        $widgetsVentasPorCosmetologa = '';
        $widgetsProductosPorSucursal = '';

        $counter_tratamientos = 0;
        foreach ($dataAnalized['ventas_por_tratamiento'] as $idTratamiento => $value) {
            if($counter_tratamientos < 3) {
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
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">'.$value.' - $'.number_format($brr[$idTratamiento]).'</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
                $counter_tratamientos += 1;
            }
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
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$'.number_format($value).'</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        }


        foreach ($dataAnalized['conteo_ventas_por_sucursal'] as $sucursal => $value) {
            $widgetsVentasPorSucursal .= 
                '<!-- Numero de ventas -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">'.$sucursal.'</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">'.$value.' - $'.number_format($dataAnalized['sumatoria_total_ventas_por_sucursal'][$sucursal]).'</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
                
        }

        foreach ($dataAnalized['num_ventas_producto_por_sucursal'] as $nombreSucursal => $value) {
            $brr = $dataAnalized['sum_ventas_producto_por_sucursal'];
            $widgetsProductosPorSucursal .= 
            '<!-- Numero de ventas -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">PRODUCTOS VENDIDOS EN '.$nombreSucursal.'</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">'.$value.' - $'.$brr[$nombreSucursal].'</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        }

        foreach ($dataAnalized['conteo_ventas_por_cosmetologa'] as $cosmetologa => $value) {
            $widgetsVentasPorCosmetologa .= 
                '<!-- Numero de ventas -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">'.$cosmetologa.'</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">'.$value.' - $'.number_format($dataAnalized['sumatoria_total_ventas_por_cosmetologa'][$cosmetologa]).'</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
                
        }


        $data = '<div class="container-fluid">
                            <h1>Ventas totales</h1>
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
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">$'.number_format($dataAnalized['monto_total']).'</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    <div class="container-fluid">
                        <h1>Tipos de pago</h1>
                        <div class="row">
                            '.$widgetsMetodosPago.'
                        </div>
                    </div>

                    <div class="container-fluid">
                        <h1>Ventas desglosadas</h1>
                        <div class="row">
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
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">$'.number_format($dataAnalized['monto_total_tratamiento']).'</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">$'.number_format($dataAnalized['monto_total_producto']).'</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="container-fluid">
                        <h1>Top tratamientos</h1>
                        <div class="row">
                            '.$widgetsTratamientos.'
                        </div>
                    </div>
                    
                    <div class="container-fluid">
                        <h1>Ventas por sucursal</h1>
                        <div class="row">
                            '.$widgetsVentasPorSucursal.'
                        </div>
                    </div>


                    <div class="container-fluid">
                        <h1>Ventas de producto por sucursal</h1>
                        <div class="row">
                            '.$widgetsProductosPorSucursal.'
                        </div>
                    </div>
                    

                    <div class="container-fluid">
                        <h1>Ventas por cosmetóloga</h1>
                        <div class="row">
                            '.$widgetsVentasPorCosmetologa.'
                        </div>
                    </div>
                    ';
    }

    if ($opcion === 'widgetsClientes') {
        $cortes_de_caja = [];
        if($Session->isAdminGlobal()) {
            $cortes_de_caja = $ModelCliente -> getAllUsuariosParaResumen();
        } else {
            $idSucursal = $Session -> getSucursalFromSession();
            $cortes_de_caja =$ModelCliente -> getAllUsuariosFromSucursalParaResumen($idSucursal);
        }
        $results = $ModelCliente->analizeDataForResumenClientes($cortes_de_caja);

        $widgetsClientesTotalesPorSucursal= '';
        foreach ($results['clientes_totales_por_sucursal'] as $unNombreSucursal => $value) {
            $widgetsClientesTotalesPorSucursal .= 
            '<!-- Numero de ventas -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">'.$unNombreSucursal.'</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">'.number_format($value).'</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        }

        $widgetsClientesActivosPorSucursal= '';
        foreach ($results['clientes_activos_por_sucursal'] as $unNombreSucursal => $value) {
            $widgetsClientesActivosPorSucursal .= 
            '<!-- Numero de ventas -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">'.$unNombreSucursal.'</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">'.number_format($value).'</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        }


        $widgetsClientesInactivosPorSucursal= '';
        foreach ($results['clientes_inactivos_por_sucursal'] as $unNombreSucursal => $value) {
            $widgetsClientesInactivosPorSucursal .= 
            '<!-- Numero de ventas -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">'.$unNombreSucursal.'</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">'.number_format($value).'</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        }

        $widgetsClientesNuevosPorSucursal= '';
        foreach ($results['clientes_nuevos_por_sucursal'] as $unNombreSucursal => $value) {
            $widgetsClientesNuevosPorSucursal .= 
            '<!-- Numero de ventas -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">'.$unNombreSucursal.'</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">'.number_format($value).'</div>
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
                                                    # clientes totales</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">'.$results['clientes_totales'].'</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Numero de ventas -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    # clientes nuevos</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">'.$results['clientes_nuevos'].'</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Numero de ventas -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    # clientes activos</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">'.$results['clientes_activos'].'</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Numero de ventas -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    # clientes inactivos</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">'.$results['clientes_inactivos'].'</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                        
                    
                    <div class="container-fluid">
                        <h1>Clientes totales por susucursal</h1>
                        <div class="row">
                            '.$widgetsClientesTotalesPorSucursal.'
                        </div>
                    </div>
                    
                    <div class="container-fluid">
                        <h1>Clientes activos por susucursal</h1>
                        <div class="row">
                            '.$widgetsClientesActivosPorSucursal.'
                        </div>
                    </div>

                    <div class="container-fluid">
                        <h1>Clientes inactivos por susucursal</h1>
                        <div class="row">
                            '.$widgetsClientesInactivosPorSucursal.'
                        </div>
                    </div>

                    <div class="container-fluid">
                        <h1>Clientes nuevos por susucursal</h1>
                        <div class="row">
                            '.$widgetsClientesNuevosPorSucursal.'
                        </div>
                    </div>
                    ';

    }
    
    echo $data;
?>