<?php
    include_once  __DIR__."/Db.php";

    class Cliente {
        public function getAllUsuarios($initial_date, $end_date){
            $db = new DB();
            $query_string = "SELECT *
                            FROM Cliente, ClienteOpcional, ClienteStatus, Sucursal 
                            WHERE Cliente.id_cliente=ClienteOpcional.id_cliente 
                            AND ClienteOpcional.id_cliente=ClienteStatus.id_cliente
                            AND Sucursal.id_sucursal=Cliente.centro_cliente
                            AND creacion_cliente BETWEEN $initial_date AND $end_date";
            $account = $db->query($query_string)->fetchAll();
            $db->close();
            return $account;
        }

        public function getAllUsuariosParaResumen() {
            $db = new DB();
            $query_string = "SELECT *
                            FROM Cliente, ClienteOpcional, ClienteStatus, Sucursal 
                            WHERE Cliente.id_cliente=ClienteOpcional.id_cliente 
                            AND ClienteOpcional.id_cliente=ClienteStatus.id_cliente
                            AND Sucursal.id_sucursal=Cliente.centro_cliente";
                            
            $account = $db->query($query_string)->fetchAll();
            $db->close();
            return $account;
        }


        public function getAllUsuariosFromSucursalParaResumen($idSucursal) {
            $db = new DB();
            $query_string = "SELECT *
                            FROM Cliente, ClienteOpcional, ClienteStatus, Sucursal 
                            WHERE Cliente.id_cliente=ClienteOpcional.id_cliente 
                            AND ClienteOpcional.id_cliente=ClienteStatus.id_cliente
                            AND Sucursal.id_sucursal=Cliente.centro_cliente
                            AND Cliente.centro_cliente='$idSucursal'";
                            
            $account = $db->query($query_string)->fetchAll();
            $db->close();
            return $account;
        }

        public function getAllUsuariosFromIdSucursal($initial_date, $end_date, $id_sucursal){
            $db = new DB();
            $query_string = "SELECT *
                            FROM Cliente, ClienteOpcional, ClienteStatus, Sucursal 
                            WHERE Cliente.id_cliente=ClienteOpcional.id_cliente 
                            AND ClienteOpcional.id_cliente=ClienteStatus.id_cliente
                            AND Sucursal.id_sucursal=Cliente.centro_cliente
                            AND Cliente.centro_cliente='$id_sucursal'
                            AND creacion_cliente BETWEEN $initial_date AND $end_date";
            $account = $db->query($query_string)->fetchAll();
            $db->close();
            return $account;
        }

        public function analizeData($data) {
            $clientesPorFecha    = [];
            $clientesPorSucursal = [];
            $registrosCounter    = 0;

            foreach ($data as $usuario) {
                date_default_timezone_set('America/Mexico_City'); // Establece la zona horaria de Ciudad de México
                $fecha_cdmx_creacion = date('Y-m-d', $usuario['creacion_cliente']);
                $sucursalUsuario = $usuario['nombre_sucursal'];

                if (isset($clientesPorFecha[$fecha_cdmx_creacion])) {
                    $clientesPorFecha[$fecha_cdmx_creacion]++;
                } else {
                    $clientesPorFecha[$fecha_cdmx_creacion] = 1;
                }
                if (isset($clientesPorSucursal[$sucursalUsuario])) {
                    $clientesPorSucursal[$sucursalUsuario]++;
                } else {
                    $clientesPorSucursal[$sucursalUsuario] = 1;
                }

                $registrosCounter += 1;
            }

            // Obtener el mayor número del array
            $mayorNumero = max($clientesPorFecha);

            // Obtener la llave asociada al mayor número
            $llaveMayor = array_search($mayorNumero, $clientesPorFecha);

            $fechaMayor = [$llaveMayor => $mayorNumero];

            $resultados = [
                'registros_totales' => $registrosCounter,
                'registros_sucursales' => $clientesPorSucursal,
                'registros_fechas' => $clientesPorFecha,
                'registor_fecha_mayor' => $fechaMayor
            ];
            return $resultados;
        }

        public function analizeDataForResumenClientes($data) {
            
            $clientesTotales = 0;
            $clientesNuevos = 0;
            $clientesActivos = 0;
            $clientesInactivos = 0;

            $clientesTotalesPorSucursal = [];
            $clientesNuevosPorSucursal = [];
            $clientesActivosPorSucursal = [];
            $clientesInactivosPorSucursal = [];


            foreach ($data as $unCliente) {
                $clientesTotales += 1;
                $clienteStatus = $unCliente['status'];
                $clienteSucursal = $unCliente['nombre_sucursal'];
                $clienteCreacion = $unCliente['creacion_cliente'];

                date_default_timezone_set('America/Mexico_City'); // Establece la zona horaria de Ciudad de México
                $hoy = strtotime(date("Y-m-d"));
                
                $diferencia = $hoy - $clienteCreacion;
                $dias = floor($diferencia / (24 * 60 * 60 )); // convert to days
                if($dias <= 15){
                    $clientesNuevos += 1;
                    if (isset($clientesNuevosPorSucursal[$clienteSucursal])) {
                        $clientesNuevosPorSucursal[$clienteSucursal]++;
                    } else {
                        $clientesNuevosPorSucursal[$clienteSucursal] = 1;
                    }
                }
                
                if($clienteStatus == 'inactivo'){
                    $clientesInactivos += 1;
                    if (isset($clientesInactivosPorSucursal[$clienteSucursal])) {
                        $clientesInactivosPorSucursal[$clienteSucursal]++;
                    } else {
                        $clientesInactivosPorSucursal[$clienteSucursal] = 1;
                    }
                } else {
                    $clientesActivos += 1;
                    if (isset($clientesActivosPorSucursal[$clienteSucursal])) {
                        $clientesActivosPorSucursal[$clienteSucursal]++;
                    } else {
                        $clientesActivosPorSucursal[$clienteSucursal] = 1;
                    }
                }

                if (isset($clientesTotalesPorSucursal[$clienteSucursal])) {
                    $clientesTotalesPorSucursal[$clienteSucursal]++;
                } else {
                    $clientesTotalesPorSucursal[$clienteSucursal] = 1;
                }

            }

            $response = [
                'clientes_totales' => $clientesTotales,
                'clientes_nuevos' => $clientesNuevos,
                'clientes_activos' => $clientesActivos,
                'clientes_inactivos' => $clientesInactivos,
                'clientes_totales_por_sucursal' => $clientesTotalesPorSucursal,
                'clientes_activos_por_sucursal' => $clientesActivosPorSucursal,
                'clientes_inactivos_por_sucursal' => $clientesInactivosPorSucursal,
                'clientes_nuevos_por_sucursal' => $clientesNuevosPorSucursal
            ];

            return $response;
        }

        public function getProximaCitaFromIDCliente($id_cliente) {
            $db = new DB();
            $query_string = "SELECT * FROM `ClienteBitacora`
                                WHERE id_cliente='$id_cliente'
                                AND (id_tratamiento='DEP01' OR id_tratamiento='CAV01')
                                ORDER BY timestamp DESC
                                LIMIT 1";
            $account = $db->query($query_string)->fetchArray();
            $db->close();

            $id_tratamiento = $account['id_tratamiento'];
            $date_timestamp = $account['timestamp'];

            $proxima_cita = '';


            date_default_timezone_set('America/Mexico_City'); // Establece la zona horaria de Ciudad de México
            $timestamp = time(); // Obtiene el timestamp actual

            if($id_tratamiento == 'DEP01') {
                $timestampDespues = strtotime("+45 days", $date_timestamp); // Suma 45 días al timestamp actual

                $proxima_cita = date("Y-m-d", $timestampDespues); // Formatea el nuevo timestamp en formato Año-Mes-Día
            } else if ($id_tratamiento == 'CAV01') {
                $timestampDespues = strtotime("+20 days", $date_timestamp); // Suma 45 días al timestamp actual

                $proxima_cita = date("Y-m-d", $timestampDespues); // Formatea el nuevo timestamp en formato Año-Mes-Día
            }

            return $proxima_cita;
        }
    }

    function drawWidgetsFromData($data) {
        
        $registros_totales = $data['registros_totales'];
        $registos_fecha_mayor = key($data['registor_fecha_mayor']);
        $num_registos_fecha_mayor = current($data['registor_fecha_mayor']);
        $registros_sucursales = $data['registros_sucursales'];

        $sucursales_widgets = '';

        foreach ($registros_sucursales as $key => $value) {
            $sucursales_widgets .= 
                '<!-- Numero de ventas -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">'.$key.'</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">'.$value.'</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
        }

        $widgets = '<div class="container-fluid">
                            <div class="row">
                                <!-- Numero de ventas -->
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                        # registros en el periodo</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">'.$registros_totales.'</div>
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
                                                        Fecha con mayor registros</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">'.$registos_fecha_mayor.'</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i>'.$num_registos_fecha_mayor.'</i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                '.$sucursales_widgets.'
                            </div>
                        </div>';
        return $widgets;
    }

    // function printArrayPrety($array){
    //     print("<pre>".print_r($array,true)."</pre>");
    // }
?>