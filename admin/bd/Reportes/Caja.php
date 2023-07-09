<?php
    session_start();
    include_once '../../Model/Sucursal.php';
    require_once __DIR__."/../../Model/Session.php";
    $ModelSucursal  = new Sucursal();
    $Session        = new Session();

    // Recepción de los datos enviados mediante POST desde el JS
    $opcion     = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
    $start_date = (isset($_POST['start_date'])) ? $_POST['start_date'] : '';
    $end_date   = (isset($_POST['end_date'])) ? $_POST['end_date'] : '';
    $sucursal   = (isset($_POST['sucursal'])) ? $_POST['sucursal'] : '';

    switch($opcion) {
        case 1: //Busqueda de información
            $fechaMonday = date_create_from_format('Y-m-d', $start_date);
            $monday = date_format($fechaMonday, 'Y-m-d');
            $fechaSunday = date_create_from_format('Y-m-d', $end_date);
            $sunday = date_format($fechaSunday, 'Y-m-d');
            $primer_dia = strtotime($monday);
            $ultimo_dia = strtotime($sunday);


            $diff  = abs($ultimo_dia - $primer_dia);
            $anos  = floor($diff / (365*60*60*24));
            $meses = floor(($diff - $anos * 365*60*60*24) / (30*60*60*24));
            $dias  = floor(($diff - $anos * 365*60*60*24 - $meses*30*60*60*24)/ (60*60*24));

            $cortes_de_caja = [];
            if($Session->isAdminGlobal()) {
                $cortes_de_caja = $ModelSucursal -> getCierresDeCaja($primer_dia, $ultimo_dia);
            } else {
                $idSucursal = $Session -> getSucursalFromSession();
                $cortes_de_caja = $ModelSucursal -> getCierresDeCajaFromCentro($idSucursal, $primer_dia, $ultimo_dia);
            }

            $sumNumDiasPeriodo   = $dias;
            $sumNumVentasPeriodo = 0;
            $sumGananciasPeriodo = 0;
            $sumGastosPeriodo    = 0;
            $sumCajaPeriodo      = 0;


            $rowsDatatable = '<tbody>';
            foreach($cortes_de_caja as $dat) {
                $ingresos = $dat['total_ingresos'];
                $gastos   = $dat['total_gastos'];
                $caja     = $dat['total_caja'];

                $ingresosParsed = str_replace(',', '', $ingresos);
                $ingresosNumVal = floatval($ingresosParsed);

                $gastosParsed = str_replace(',', '', $gastos);
                $gastosNumVal = floatval($gastosParsed);
                
                $cajaParsed = str_replace(',', '', $caja);
                $cajaNumVal = floatval($cajaParsed);

                $sumNumVentasPeriodo += $dat['num_ventas_general'];
                $sumGananciasPeriodo += $ingresosNumVal;
                $sumGastosPeriodo += $gastosNumVal;
                $sumCajaPeriodo += $cajaNumVal;
                date_default_timezone_set('America/Mexico_City'); // Establece la zona horaria de Ciudad de México
                $fecha_cdmx_creacion = date('Y-m-d', $dat['timestamp']);
                $rowsDatatable .= '<tr>
                    <td>'.$dat['id_corte_caja'].'</td>
                    <td>'.$dat['nombre_sucursal'].'</td>
                    <td>'.$dat['num_ventas_general'].'</td>
                    <td>'.$ingresos.'</td>
                    <td>'.$gastos.'</td>
                    <td>'.$caja.'</td>
                    <td>'.$fecha_cdmx_creacion.'</td>
                    <td></td>
                </tr>';
            }
            $rowsDatatable .= '</tbody>';

            
            $data = '<div class="container-fluid">

                        <div class="row">
                            <!-- Dias del periodo -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    # Días del periodo</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">'.$sumNumDiasPeriodo.'</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
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
                                                    # Ventas del periodo</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">'.$sumNumVentasPeriodo.'</div>
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
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">'.$sumGananciasPeriodo.'</div>
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
                                                    $ gastos del periodo</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">'.$sumGastosPeriodo.'</div>
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
                                                    $ caja del periodo</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">'.$sumCajaPeriodo.'</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table id="tablaPersonas" class="table table-striped table-bordered table-condensed"
                                        style="width:100%">
                                        <thead class="text-center">
                                            <tr>
                                                <th>ID</th>
                                                <th>Sucursal</th>
                                                <th># Ventas</th>
                                                <th>$ Ingresos</th>
                                                <th>$ Gastos</th>
                                                <th>$ Caja</th>
                                                <th>Fecha</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        '.$rowsDatatable.'
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>';
            break;
        case 2: //Update Producto
            break;
    }
    echo $data;
    $conexion = NULL;
?>