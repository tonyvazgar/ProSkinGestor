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
                $cortes_de_caja = $ModelVenta -> getAllVentasTratamiento($primer_dia, $ultimo_dia);
            }  else {
                $idSucursal = $Session -> getSucursalFromSession();
                $cortes_de_caja =$ModelVenta -> getAllVentasTratamientoFromIdSucursal($primer_dia, $ultimo_dia, $idSucursal);
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
                                            foreach($cortes_de_caja as $dat) {
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
            $fechaMonday = date_create_from_format('Y-m-d', $start_date);
            $monday = date_format($fechaMonday, 'Y-m-d');
            $fechaSunday = date_create_from_format('Y-m-d', $end_date);
            $sunday = date_format($fechaSunday, 'Y-m-d');
            $primer_dia = strtotime($monday);
            $ultimo_dia = strtotime($sunday);

            $cortes_de_caja = [];
            if($Session->isAdminGlobal()) {
                $cortes_de_caja = $ModelVenta -> getAllVentasProducto($primer_dia, $ultimo_dia);
            }  else {
                $idSucursal = $Session -> getSucursalFromSession();
                $cortes_de_caja =$ModelVenta -> getAllVentasProductoFromIdSucursal($primer_dia, $ultimo_dia, $idSucursal);
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
                                            foreach($cortes_de_caja as $dat) {
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
        case 3: //Busqueda de información
                $fechaMonday = date_create_from_format('Y-m-d', $start_date);
                $monday = date_format($fechaMonday, 'Y-m-d');
                $fechaSunday = date_create_from_format('Y-m-d', $end_date);
                $sunday = date_format($fechaSunday, 'Y-m-d');
                $primer_dia = strtotime($monday);
                $ultimo_dia = strtotime($sunday);
    
                $cortes_de_caja = [];
                if($Session->isAdminGlobal()) {
                    $cortes_de_caja = $ModelVenta -> getTotalVentasDelDia($primer_dia, $ultimo_dia);
                }  else {
                    $idSucursal = $Session -> getSucursalFromSession();
                    $cortes_de_caja =$ModelVenta -> getTotalVentasDelDiaFromCentro($primer_dia, $ultimo_dia, $idSucursal);
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
                                                foreach($cortes_de_caja as $dat) {
                                                    date_default_timezone_set('America/Mexico_City'); // Establece la zona horaria de Ciudad de México
                                                    $fecha_cdmx_creacion = date('Y-m-d', $dat['timestamp']);

                                                    // (
                                                    //     [id_venta] => MON23451686006388          <th>ID VENTA</th>
                                                    //     [id_cliente] => AA180815614              <th>ID CLIENTE</th>
                                                    //     [nombre_cliente] => AURI AURI            <th>NOMBRE CLIENTE</th>
                                                    //     [timestamp] => 1686006388                <th>FECHA</th>
                                                    //     [id_tratamiento] =>                      <th>ID TRATAMIENTO</th>
                                                    //     [metodo_pago] => [["1","1430"]]          <th>FORMAS DE PAGO</th>
                                                    //     [referencia_pago] => [""]                <th>REFERENCIA PAGO</th>
                                                    //     [monto] => 1430                          <th>MONTO</th>
                                                    //     [nombre_sucursal] => Sonata              <th>SUCURSAL</th>
                                                    //     [costo_tratamiento] =>                   <th>COSTO TRATAMIENTO</th>
                                                    //     [id_productos] =>                        <th>PRODUCTOS</th>
                                                    //     [costo_producto] =>                      <th>COSTO PRODUCTO</th>
                                                    //     [cantidad_producto] =>                   <th>CANTIDAD PRODUCTOS</th>
                                                    //     [id_cosmetologa] => 18
                                                    //     [nombre_cosmetologa] => Lizeth Tlachi    <th>COSMETOLOGA</th>
                                                    // <th>Acciones</th>
                                                    // )

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