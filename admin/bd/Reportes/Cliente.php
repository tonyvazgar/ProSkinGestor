<?php
    session_start();
    require_once __DIR__."/../../Model/Session.php";
    include_once __DIR__."/../../Model/Cliente.php";
    $Session        = new Session();
    $ModelCliente   = new Cliente();

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

            $cortes_de_caja = [];
            $is_admin = $Session->isAdminGlobal();
            if($is_admin) {
                $cortes_de_caja = $ModelCliente -> getAllUsuarios($primer_dia, $ultimo_dia);
            } else {
                $idSucursal = $Session -> getSucursalFromSession();
                $cortes_de_caja =$ModelCliente -> getAllUsuariosFromIdSucursal($primer_dia, $ultimo_dia, $idSucursal);
            }

            $results = $ModelCliente->analizeData($cortes_de_caja);
            

            $data = drawWidgetsFromData($results);
            
            $data .= '<div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table id="tablaPersonas" class="table table-striped table-bordered table-condensed"
                                        style="width:100%">
                                        <thead class="text-center">
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th># Telefono</th>
                                                <th>E-mail</th>
                                                <th>Sucursal</th>
                                                <th>Fecha Creación</th>
                                                <th>ÚLTIMA VISITA</th>
                                                <th>PROXIMA CITA</th>
                                                <th>ÚLTIMO TRATAMIENTO</th>
                                                <th>ÚLTIMA COSMETOLOGA</th>
                                                <th>Fecha nacimiento</th>
                                                <th>CP</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                                            foreach($cortes_de_caja as $dat) {
                                                date_default_timezone_set('America/Mexico_City'); // Establece la zona horaria de Ciudad de México
                                                $fecha_cdmx_creacion = date('Y-m-d', $dat['creacion_cliente']);
                                                $fecha_cdmx_visita = date('Y-m-d', $dat['ultima_visita_cliente']);
                                                $datosUltimaVisita = $ModelCliente -> getDatosUltimaVisitaCliente($dat['id_cliente']);
                                                $proxima_cita = $datosUltimaVisita['proxima_cita'];
                                                $ultima_venta = $datosUltimaVisita['ultima_venta'];
                                                $ultimo_tratamiento = $datosUltimaVisita['ultimo_tratamiento'];
                                                $ultima_cosmetologa = $datosUltimaVisita['ultima_cosmetologa'];
                                                $data .= '<tr>
                                                    <td><a href="/View/Clientes/informacionCliente.php?id='.$dat['id_cliente'].'" target="_blank">'.$dat['id_cliente'].'</a></td>
                                                    <td>'.$dat['nombre_cliente'].' '.$dat['apellidos_cliente'].'</td>
                                                    <td>'.$dat['telefono_cliente'].'</td>
                                                    <td>'.$dat['email_cliente'].'</td>
                                                    <td>'.$dat['nombre_sucursal'].'</td>
                                                    <td>'.$fecha_cdmx_creacion.'</td>
                                                    <td>'.$fecha_cdmx_visita.'</td>
                                                    <td>'.$proxima_cita.'</td>
                                                    <td>'.$ultimo_tratamiento.'</td>
                                                    <td>'.$ultima_cosmetologa.'</td>
                                                    <td>'.$dat['fecha_cliente'].'</td>
                                                    <td>'.$dat['cp_cliente'].'</td>
                                                    <td>'.$dat['status'].'</td>
                                                </tr>';
                                                }
                                        $data .= '</tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>';
            if($is_admin) {
                $data .= '<a style="text-decoration: none;" id="exportExcelClientesRegistrados">
                            <button type="button" class="btn btn-success">Reporte en Excel <i class="fas fa-file-excel" style="font-size:20px;"></i></button>
                        </a>';
            }        
            break;
        case 2: //Update Producto
            break;
    }

    echo $data; //enviar el array final en formato json a JS
    $conexion = NULL;
?>