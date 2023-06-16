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

            $cortes_de_caja = [];
            if($Session->isAdminGlobal()) {
                $cortes_de_caja = $ModelSucursal -> getCierresDeCaja($primer_dia, $ultimo_dia);
            } else {
                $idSucursal = $Session -> getSucursalFromSession();
                $cortes_de_caja = $ModelSucursal -> getCierresDeCajaFromCentro($idSucursal, $primer_dia, $ultimo_dia);
            }


            
            $data = '<div class="container">
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
                                                <th># Documento</th>
                                                <th>Archivo</th>
                                                <th>Observaciones</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>';                   
                                            foreach($cortes_de_caja as $dat) {
                                                $data .= '<tr>
                                                    <td>'.$dat['id_corte_caja'].'</td>
                                                    <td>'.$dat['id_centro'].'</td>
                                                    <td>'.$dat['num_ventas_general'].'</td>
                                                    <td>'.$dat['total_ingresos'].'</td>
                                                    <td>'.$dat['total_gastos'].'</td>
                                                    <td>'.$dat['total_caja'].'</td>
                                                    <td>'.$dat['timestamp'].'</td>
                                                    <td>'.$dat['id_documento'].'</td>
                                                    <td>'.$dat['nombre_archivo'].'</td>
                                                    <td>'.$dat['observaciones'].'</td>
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
            break;
    }

    echo $data; //enviar el array final en formato json a JS
    $conexion = NULL;
?>