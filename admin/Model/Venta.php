<?php
    include_once  __DIR__."/Db.php";

    class Venta {
        public function getAllVentasTratamiento($firtsDay, $lastDay)
        {
            $db = new DB();
            $sql_query = "SELECT DISTINCT ClienteBitacora.*, Tratamiento.*, Ventas.id_venta , Sucursal.nombre_sucursal, Cliente.nombre_cliente, Cliente.apellidos_cliente, usertable.name
                            FROM ClienteBitacora, usertable, Tratamiento, Ventas, Sucursal, Cliente
                            WHERE ClienteBitacora.id_cosmetologa=usertable.id
                            AND ClienteBitacora.id_cliente=Cliente.id_cliente
                            AND Sucursal.id_sucursal=ClienteBitacora.centro
                            AND ClienteBitacora.timestamp=Ventas.timestamp
                            AND Tratamiento.id_tratamiento=ClienteBitacora.id_tratamiento
                            AND Ventas.timestamp BETWEEN $firtsDay AND $lastDay
                            ORDER by ClienteBitacora.timestamp DESC";
            $tratamientos = $db->query($sql_query)->fetchAll();
            $db->close();
            return $tratamientos;
        }

        public function getAllVentasTratamientoFromIdSucursal($firtsDay, $lastDay, $idSucursal)
        {
            $db = new DB();
            $tratamientos = $db->query("SELECT DISTINCT ClienteBitacora.*, Tratamiento.*, Ventas.id_venta , Sucursal.nombre_sucursal, Cliente.nombre_cliente, Cliente.apellidos_cliente, usertable.name
                                        FROM ClienteBitacora, usertable, Tratamiento, Ventas, Sucursal, Cliente
                                        WHERE ClienteBitacora.id_cosmetologa=usertable.id
                                        AND ClienteBitacora.id_cliente=Cliente.id_cliente
                                        AND Sucursal.id_sucursal=ClienteBitacora.centro
                                        AND ClienteBitacora.timestamp=Ventas.timestamp
                                        AND Tratamiento.id_tratamiento=ClienteBitacora.id_tratamiento
                                        AND Ventas.timestamp BETWEEN $firtsDay AND $lastDay
                                        AND Ventas.centro='$idSucursal'
                                        ORDER by ClienteBitacora.timestamp DESC")->fetchAll();
            $db->close();
            return $tratamientos;
        }

        public function getAllVentasProducto($firtsDay, $lastDay)
        {
            $db = new DB();
            $tratamientos = $db->query("SELECT Ventas.*, Productos.*, usertable.name, Sucursal.nombre_sucursal
                                        FROM usertable, Ventas, Productos, Sucursal
                                        WHERE usertable.id=Ventas.id_cosmetologa
                                        AND Ventas.centro = Sucursal.id_sucursal
                                        AND Productos.centro_producto=Ventas.centro 
                                        AND Ventas.id_productos=Productos.id_producto 
                                        AND Ventas.id_productos!=''
                                        AND Ventas.timestamp BETWEEN $firtsDay AND $lastDay
                                        ORDER by Ventas.timestamp DESC")->fetchAll();
            $db->close();
            return $tratamientos;
        }

        public function getAllVentasProductoFromIdSucursal($firtsDay, $lastDay, $idSucursal)
        {
            $db = new DB();
            $sql_query = "SELECT Ventas.*, Productos.*, usertable.name, Sucursal.nombre_sucursal
                                        FROM usertable, Ventas, Productos, Sucursal
                                        WHERE usertable.id=Ventas.id_cosmetologa
                                        AND Ventas.centro = Sucursal.id_sucursal
                                        AND Productos.centro_producto=Ventas.centro 
                                        AND Ventas.id_productos=Productos.id_producto 
                                        AND Ventas.id_productos!=''
                                        AND Ventas.timestamp BETWEEN $firtsDay AND $lastDay
                                        AND Ventas.centro='$idSucursal'
                                        ORDER by Ventas.timestamp DESC";
            $tratamientos = $db->query($sql_query)->fetchAll();
            $db->close();
            return $tratamientos;
        }

        public function getTotalVentasDelDia($beginOfDay, $endOfDay){
            $db = new Db();
            $sql_query_normal = "SELECT Ventas.*, NULL AS nombre_cliente, Sucursal.nombre_sucursal, usertable.name AS nombre_cosmetologa
                                    FROM Ventas, Sucursal, usertable
                                    WHERE Ventas.centro = Sucursal.id_sucursal AND Ventas.id_cosmetologa = usertable.id 
                                    AND Ventas.id_cliente=''
                                    AND Ventas.timestamp BETWEEN $beginOfDay AND $endOfDay";

            $sql_query = "SELECT Ventas.*, CONCAT(Cliente.nombre_cliente, ' ',Cliente.apellidos_cliente) AS nombre_cliente, Sucursal.nombre_sucursal, usertable.name AS nombre_cosmetologa
                            FROM Ventas, Cliente, Sucursal, usertable
                            WHERE Ventas.id_cliente=Cliente.id_cliente
                            AND Ventas.centro=Sucursal.id_sucursal
                            AND Ventas.id_cosmetologa=usertable.id
                            AND timestamp BETWEEN $beginOfDay AND $endOfDay";
                            
            $tratamientos = $db->query($sql_query)->fetchAll();
            $tratamientos_normal = $db->query($sql_query_normal)->fetchAll();
            $resultado = array_merge($tratamientos, $tratamientos_normal);
            $db->close();
            return $resultado;
        }
        public function getTotalVentasDelDiaFromCentro($beginOfDay, $endOfDay, $numeroSucursal){
            
            $db = new Db();
            $sql_query = "SELECT Ventas.*, CONCAT(Cliente.nombre_cliente, ' ',Cliente.apellidos_cliente) AS nombre_cliente, Sucursal.nombre_sucursal, usertable.name AS nombre_cosmetologa
                            FROM Ventas, Cliente, Sucursal, usertable
                            WHERE Ventas.id_cliente=Cliente.id_cliente
                            AND Ventas.centro=Sucursal.id_sucursal
                            AND Ventas.id_cosmetologa=usertable.id
                            AND centro='$numeroSucursal'
                            AND timestamp BETWEEN $beginOfDay AND $endOfDay";
            $tratamientos = $db->query($sql_query)->fetchAll();
            $db->close();
            return $tratamientos;
        }



        public function getTotalEfectivoWhereDia($beginOfDay, $endOfDay, $sucursal){
            $db = new Db();
            $sql_statement_todo = "SELECT * 
                                   FROM Ventas 
                                   WHERE centro='$sucursal' AND metodo_pago LIKE '%[\"1\",%' AND timestamp BETWEEN $beginOfDay AND $endOfDay GROUP BY id_venta";
                                //    print_r($sql_statement_todo);
            $todo = $db->query($sql_statement_todo)->fetchAll();
            $total = obtenerTotalMetodoPago('1', $todo);
            $db->close();
            return [$total, $todo];
        }

        public function getTotalTDCWhereDia($beginOfDay, $endOfDay, $sucursal){
            $db = new Db();
            $sql_statement_todo = "SELECT * 
                                   FROM Ventas 
                                   WHERE centro='$sucursal' AND metodo_pago LIKE '%[\"3\",%' AND timestamp BETWEEN $beginOfDay AND $endOfDay GROUP BY id_venta";
            $todo = $db->query($sql_statement_todo)->fetchAll();
            $total = obtenerTotalMetodoPago('3', $todo);
            $db->close();
            return [$total, $todo];
        }

        public function getTotalTDDWhereDia($beginOfDay, $endOfDay, $sucursal){
            $db = new Db();
            $sql_statement_todo = "SELECT * 
                                   FROM Ventas 
                                   WHERE centro='$sucursal' AND metodo_pago LIKE '%[\"2\",%' AND timestamp BETWEEN $beginOfDay AND $endOfDay GROUP BY id_venta";
            $todo = $db->query($sql_statement_todo)->fetchAll();
            $total = obtenerTotalMetodoPago('2', $todo);
            $db->close();
            return [$total, $todo];
        }

        public function getTotalTransferenciaWhereDia($beginOfDay, $endOfDay, $sucursal){
            $db = new Db();
            $sql_statement_todo = "SELECT * 
                                   FROM Ventas 
                                   WHERE centro='$sucursal' AND metodo_pago LIKE '%[\"4\",%' AND timestamp BETWEEN $beginOfDay AND $endOfDay GROUP BY id_venta";
            $todo = $db->query($sql_statement_todo)->fetchAll();
            $total = obtenerTotalMetodoPago('4', $todo);
            $db->close();
            return [$total, $todo];
        }

        public function getTotalDepositoWhereDia($beginOfDay, $endOfDay, $sucursal){
            $db = new Db();
            $sql_statement_todo = "SELECT * 
                                   FROM Ventas 
                                   WHERE centro='$sucursal' AND metodo_pago LIKE '%[\"6\",%' AND timestamp BETWEEN $beginOfDay AND $endOfDay GROUP BY id_venta";
                                //    print_r($sql_statement_todo);
            $todo = $db->query($sql_statement_todo)->fetchAll();
            $total = obtenerTotalMetodoPago('6', $todo);
            $db->close();
            return [$total, $todo];
        }

        public function getTotalChequeWhereDia($beginOfDay, $endOfDay, $sucursal){
            $db = new Db();
            $sql_statement_todo = "SELECT * 
                                   FROM Ventas 
                                   WHERE centro='$sucursal' AND metodo_pago LIKE '%[\"5\",%' AND timestamp BETWEEN $beginOfDay AND $endOfDay GROUP BY id_venta";
                                //    print_r($sql_statement_todo);
            $todo = $db->query($sql_statement_todo)->fetchAll();
            $total = obtenerTotalMetodoPago('5', $todo);
            $db->close();
            return [$total, $todo];
        }

        public function getNombreTratamientoWhereID($idTratamiento) {
            $db = new DB();
            $nombre = $db->query("SELECT Tratamiento.nombre_tratamiento 
                                        FROM `Tratamiento`
                                        WHERE id_tratamiento='$idTratamiento'")->fetchArray();
            $db->close();
            return $nombre['nombre_tratamiento'];
        }

        public function getNombreProductoWhereID($idProducto) {
            $db = new DB();
            $nombre = $db->query("SELECT Productos.descripcion_producto
                                    FROM `Productos`
                                    WHERE id_producto='$idProducto'")->fetchArray();
            $db->close();
            return $nombre['descripcion_producto'];
        }

        public function getNombreMetodoPagoWhereID($idMetodoPago) {
            //TODO: Hacerlo con DB
            if($idMetodoPago == 1) {
                return "Efectivo";
            }
            if($idMetodoPago == 2) {
                return "TDC";
            }
            if($idMetodoPago == 3) {
                return "TDD";
            }
            if($idMetodoPago == 4) {
                return "Transferencia";
            }
            if($idMetodoPago == 5) {
                return "Cheque";
            }
            if($idMetodoPago == 6) {
                return "Deposito";
            }
            if($idMetodoPago == 7) {
                return "Monedero";
            }
        }

        public function analizeVentas($ventas) {
            $ventasRepetidas         = [];
            $ventasPorTratamiento    = [];
            $sumVentasPorTratamiento = [];
            $ventasPorProducto       = [];
            $sumVentasPorProducto    = [];
            $ventasPorMonedero       = 0;
            $metodoPagoCantidad      = [];
            $numeroVentasProductoPorSucursal = [];
            $sumatoriaVentasProductoPorSucursal = [];
            $montoTotal              = 0;
            $montoTotalTratamientos  = 0;
            $montoTotalProductos     = 0;
            $montoTotalMonederos     = 0;
            $sumatoriaTotalVentasPorSucursal = [];
            $conteoVentasPorSucursal = [];
            $conteoVentasPorCosmetologa = [];
            $sumatoriaDineroVentasPorCosmetologa = [];
            $ventasPorCosmetologa = [];

            // Iterar sobre el array de ventas
            foreach ($ventas as $venta) {
                $monto_esta_venta = str_replace(',', '', $venta['monto']);
                $monto_esta_venta = floatval($monto_esta_venta);
                $montoTotal += $monto_esta_venta;

                $idVenta       = $venta['id_venta'];
                $idTratamiento = $venta['id_tratamiento'];
                $idProductos   = $venta['id_productos'];
                $idCentroVenta = $venta['centro'];
                $nombreCentroVenta = $venta['nombre_sucursal'];
                $nombreCosmetologa = $venta['nombre_cosmetologa'];

                // Contar ventas repetidas por id_venta y sumar montos
                if (isset($ventasRepetidas[$idVenta])) {
                    $ventasRepetidas[$idVenta]++;
                } else {
                    $ventasRepetidas[$idVenta] = 1;
                }

                // Contar ventas por id_tratamiento
                if($idTratamiento != '' && $idProductos == '') {
                    $montoTotalTratamientos += $monto_esta_venta;
                    if (isset($sumVentasPorTratamiento[$idTratamiento])) {
                        $sumVentasPorTratamiento[$idTratamiento] += $monto_esta_venta;
                    } else {
                        $sumVentasPorTratamiento[$idTratamiento] = $monto_esta_venta;
                    }
                }
                if (isset($ventasPorTratamiento[$idTratamiento])) {
                    $ventasPorTratamiento[$idTratamiento]++;
                } else {
                    $ventasPorTratamiento[$idTratamiento] = 1;
                }

                // Contar ventas por id_productos
                if($idProductos != '' && $idTratamiento == '') {
                    $montoTotalProductos += $monto_esta_venta;
                    if (isset($sumVentasPorProducto[$idProductos])) {
                        $sumVentasPorProducto[$idProductos] += $monto_esta_venta;
                    } else {
                        $sumVentasPorProducto[$idProductos] = $monto_esta_venta;
                    }
                    
                    if (isset($numeroVentasProductoPorSucursal[$nombreCentroVenta])) {
                        $numeroVentasProductoPorSucursal[$nombreCentroVenta] += 1;
                    } else {
                        $numeroVentasProductoPorSucursal[$nombreCentroVenta] = 1;
                    }

                    if (isset($sumatoriaVentasProductoPorSucursal[$nombreCentroVenta])) {
                        $sumatoriaVentasProductoPorSucursal[$nombreCentroVenta] += $monto_esta_venta;
                    } else {
                        $sumatoriaVentasProductoPorSucursal[$nombreCentroVenta] = $monto_esta_venta;
                    }
                }
                if (isset($ventasPorProducto[$idProductos])) {
                    $ventasPorProducto[$idProductos]++;
                } else {
                    $ventasPorProducto[$idProductos] = 1;
                }



                if($idProductos == '' && $idTratamiento == '') {
                    $montoTotalMonederos += $monto_esta_venta;
                    $ventasPorMonedero += 1;
                }

                if (isset($conteoVentasPorSucursal[$nombreCentroVenta])) {
                    $conteoVentasPorSucursal[$nombreCentroVenta]++;
                } else {
                    $conteoVentasPorSucursal[$nombreCentroVenta] = 1;
                }

                if (isset($sumatoriaTotalVentasPorSucursal[$nombreCentroVenta])) {
                    $sumatoriaTotalVentasPorSucursal[$nombreCentroVenta] += $monto_esta_venta;
                } else {
                    $sumatoriaTotalVentasPorSucursal[$nombreCentroVenta] = $monto_esta_venta;
                }

                if (isset($conteoVentasPorCosmetologa[$nombreCosmetologa])) {
                    $conteoVentasPorCosmetologa[$nombreCosmetologa]++;
                } else {
                    $conteoVentasPorCosmetologa[$nombreCosmetologa] = 1;
                }

                if (isset($sumatoriaDineroVentasPorCosmetologa[$nombreCosmetologa])) {
                    $sumatoriaDineroVentasPorCosmetologa[$nombreCosmetologa] += $monto_esta_venta;
                } else {
                    $sumatoriaDineroVentasPorCosmetologa[$nombreCosmetologa] = $monto_esta_venta;
                }
                
                
                // if (isset($ventasPorCosmetologa[$nombreCosmetologa])) {
                //     array_push($ventasPorCosmetologa[$nombreCosmetologa], $idVenta);
                // } else {
                //     $ventasPorCosmetologa[$nombreCosmetologa] = [$idVenta];
                // }

                // Contar método de pago y sumar cantidades
                $metodosPagoVenta = json_decode($venta['metodo_pago'], true);
                foreach ($metodosPagoVenta as $metodoPago) {
                    $idMetodoPago = $metodoPago[0];
                    $cantidadMetodoPago = $metodoPago[1];
                    if (isset($metodoPagoCantidad[$idVenta][$idMetodoPago])) {
                        $metodoPagoCantidad[$idVenta][$idMetodoPago] = $cantidadMetodoPago;
                    } else {
                        $metodoPagoCantidad[$idVenta][$idMetodoPago] += $cantidadMetodoPago;
                    }
                }
            }

            unset($ventasPorTratamiento[""]);
            unset($ventasPorProducto[""]);

            arsort($ventasPorTratamiento);

            $mtpago = [];

            $totalVentas            = count($ventasRepetidas);
            $totalVentasTratamiento = count($ventasPorTratamiento);
            $sumVentasTratamiento   = array_sum($ventasPorTratamiento);
            $totalVentasProducto    = count($ventasPorProducto);
            $sumVentasProducto      = array_sum($ventasPorProducto);
            
            foreach ($metodoPagoCantidad as $key) {
                foreach ($key as $k => $value) {
                    if (isset($mtpago[$k])) {
                        $mtpago[$k] += $value;
                    } else {
                        $mtpago[$k] = $value;
                    }
                }
            }

            $resultados = [
                // 'ventas' => $ventasRepetidas,
                'total_ventas' => $totalVentas,
                'monto_total' => $montoTotal,
                'ventas_por_tratamiento' => $ventasPorTratamiento,
                'total_tratamiento' => $sumVentasTratamiento,
                'sum_total_tratamiento' => $sumVentasTratamiento,
                'sum_ventas_por_tratamiento' => $sumVentasPorTratamiento,
                'monto_total_tratamiento' => $montoTotalTratamientos,
                'ventas_deglosadas_por_producto' => $ventasPorProducto,
                'total_producto' => $totalVentasProducto,
                'sum_total_producto' => $sumVentasProducto,
                'sum_ventas_por_producto' => $sumVentasPorProducto,
                'monto_total_producto' => $montoTotalProductos,
                'monto_total_monedero' => $montoTotalMonederos,
                'sum_ventas_por_monedero' => $ventasPorMonedero,
                'metodo_pago_cantidad' => $mtpago,
                'conteo_ventas_por_sucursal' => $conteoVentasPorSucursal,
                'sumatoria_total_ventas_por_sucursal' => $sumatoriaTotalVentasPorSucursal,
                'conteo_ventas_por_cosmetologa' => $conteoVentasPorCosmetologa,
                'sumatoria_total_ventas_por_cosmetologa' => $sumatoriaDineroVentasPorCosmetologa,
                'ventas_cosmetologa' => $ventasPorCosmetologa,
                'num_ventas_producto_por_sucursal' => $numeroVentasProductoPorSucursal,
                'sum_ventas_producto_por_sucursal' => $sumatoriaVentasProductoPorSucursal
            ];
            
            return $resultados;
        }

        public function analizeAplicacionesTratamiento($tratamientosFromDB) {
            $registrosProcesados = 0;
            $grupoTratamientos  = [];
            $grupoCosmetologa   = [];
            $grupoSucursal      = [];
            $grupoFecha         = [];


            // Agregar arreglo para almacenar los tratamientos por sucursal
            $tratamientosPorSucursal = [];
            $tratamientosPorCosmetologa = [];
            $tratamientosPorfecha = [];
            
            foreach ($tratamientosFromDB as $aplicacion) {
                $registrosProcesados += 1;
                date_default_timezone_set('America/Mexico_City'); // Establece la zona horaria de Ciudad de México
                $id_tratamiento     = $aplicacion['nombre_tratamiento'];
                $nombre_cosmetologa = $aplicacion['name'];
                $sucursal           = $aplicacion['nombre_sucursal'];
                $fecha              = date('Y-m-d', $aplicacion['timestamp']);

                if (isset($grupoTratamientos[$id_tratamiento])) {
                    $grupoTratamientos[$id_tratamiento]++;
                } else {
                    $grupoTratamientos[$id_tratamiento] = 1;
                }

                if (isset($grupoCosmetologa[$nombre_cosmetologa])) {
                    $grupoCosmetologa[$nombre_cosmetologa]++;
                } else {
                    $grupoCosmetologa[$nombre_cosmetologa] = 1;
                }

                if (isset($grupoSucursal[$sucursal])) {
                    $grupoSucursal[$sucursal]++;
                } else {
                    $grupoSucursal[$sucursal] = 1;
                }

                if (isset($grupoFecha[$fecha])) {
                    $grupoFecha[$fecha]++;
                } else {
                    $grupoFecha[$fecha] = 1;
                }

                // Agregar los tratamientos por sucursal al arreglo tratamientosPorSucursal
                if (!isset($tratamientosPorSucursal[$sucursal])) {
                    $tratamientosPorSucursal[$sucursal][$id_tratamiento] = 1;
                } else {
                    $tratamientosPorSucursal[$sucursal][$id_tratamiento] += 1;
                }

                // Agregar los tratamientos por sucursal al arreglo tratamientosPorSucursal
                if (!isset($tratamientosPorCosmetologa[$nombre_cosmetologa])) {
                    $tratamientosPorCosmetologa[$nombre_cosmetologa][$id_tratamiento] = 1;
                } else {
                    $tratamientosPorCosmetologa[$nombre_cosmetologa][$id_tratamiento] += 1;
                }

                // Agregar los tratamientos por sucursal al arreglo tratamientosPorSucursal
                if (!isset($tratamientosPorfecha[$fecha])) {
                    $tratamientosPorfecha[$fecha][$id_tratamiento] = 1;
                } else {
                    $tratamientosPorfecha[$fecha][$id_tratamiento] += 1;
                }
            }

            // Obtener el mayor número del array
            $mayorNumero = max($grupoFecha);

            // Obtener la llave asociada al mayor número
            $llaveMayor = array_search($mayorNumero, $grupoFecha);

            $fechaMayor = [$llaveMayor => $mayorNumero];

            $result = [
                'registrosProcesados' => $registrosProcesados,
                'tratamientos' => $grupoTratamientos,
                'cosmetologas' => $grupoCosmetologa,
                'sucursales' => $grupoSucursal,
                // 'fechas' => $grupoFecha,
                'registor_fecha_mayor' => $fechaMayor,
                'registros_por_sucursal' => $tratamientosPorSucursal,
                'registros_por_cosmetologa' => $tratamientosPorCosmetologa,
                // 'registros_por_fecha' => $tratamientosPorfecha,
            ];
            // printArrayPrety($result);
            return $result;
        }
        
        public function analizeVentasInventario($inventarioFromDB) {
            
            $registrosProcesados     = 0;
            $montoTotal              = 0;
            $registrosPorFecha       = [];
            $registrosPorSucursal    = [];
            $registrosPorProducto    = [];
            $registrosPorCosmetologa = [];
            $registrosPorMarca       = [];


            foreach ($inventarioFromDB as $registro) {
                date_default_timezone_set('America/Mexico_City'); // Establece la zona horaria de Ciudad de México
                // printArrayPrety($registro);

                $monto = $registro['monto'];
                $fecha = date('Y-m-d', $registro['timestamp']);
                $centro = $registro['centro'];
                $costo_producto = $registro['costo_producto'];
                $id_cosmetologa = $registro['id_cosmetologa'];
                $id_producto = $registro['id_producto'];
                $marca_producto = $registro['marca_producto'];
                $descripcion_producto = $registro['descripcion_producto'];
                $linea_producto = $registro['linea_producto'];
                $centro_producto = $registro['centro_producto'];
                $name = $registro['name'];
                $nombre_sucursal = $registro['nombre_sucursal'];


                $registrosProcesados += 1;
                $montoTotal += $monto;
                if (isset($registrosPorFecha[$fecha])) {
                    $actual = $registrosPorFecha[$fecha];
                    $actual_sum = $actual[0];
                    $actual_monto = $actual[1];
                    $actual_sum += 1;
                    $actual_monto += $monto;
                    $registrosPorFecha[$fecha] = [$actual_sum, $actual_monto];
                } else {
                    $registrosPorFecha[$fecha] = [1, $monto];
                }

                if (isset($registrosPorMarca[$marca_producto])) {
                    // $registrosPorMarca[$marca_producto]++;
                    $actual = $registrosPorMarca[$marca_producto];
                    $actual_sum = $actual[0];
                    $actual_monto = $actual[1];
                    $actual_sum += 1;
                    $actual_monto += $monto;
                    $registrosPorMarca[$marca_producto] = [$actual_sum, $actual_monto];
                } else {
                    $registrosPorMarca[$marca_producto] = [1, $monto];
                }

                if (isset($registrosPorSucursal[$nombre_sucursal])) {
                    // $registrosPorSucursal[$nombre_sucursal]++;
                    $actual = $registrosPorSucursal[$nombre_sucursal];
                    $actual_sum = $actual[0];
                    $actual_monto = $actual[1];
                    $actual_sum += 1;
                    $actual_monto += $monto;
                    $registrosPorSucursal[$nombre_sucursal] = [$actual_sum, $actual_monto];
                } else {
                    $registrosPorSucursal[$nombre_sucursal] = [1, $monto];
                }

                if (isset($registrosPorCosmetologa[$name])) {
                    // $registrosPorCosmetologa[$name]++;
                    $actual = $registrosPorCosmetologa[$name];
                    $actual_sum = $actual[0];
                    $actual_monto = $actual[1];
                    $actual_sum += 1;
                    $actual_monto += $monto;
                    $registrosPorCosmetologa[$name] = [$actual_sum, $actual_monto];
                } else {
                    $registrosPorCosmetologa[$name] = [1, $monto];
                }

                if (isset($registrosPorProducto[$descripcion_producto])) {
                    // $registrosPorProducto[$descripcion_producto]++;
                    $actual = $registrosPorProducto[$descripcion_producto];
                    $actual_sum = $actual[0];
                    $actual_monto = $actual[1];
                    $actual_sum += 1;
                    $actual_monto += $monto;
                    $registrosPorProducto[$descripcion_producto] = [$actual_sum, $actual_monto];
                } else {
                    $registrosPorProducto[$descripcion_producto] = [1, $monto];
                }
            }

            $result = [
                'registros_procesados' => $registrosProcesados,
                'monto_total' => $montoTotal,
                // 'registros_por_fecha' => $registrosPorFecha,
                'registros_por_marca' => $registrosPorMarca,
                'registros_por_sucursal' => $registrosPorSucursal,
                'registros_por_cosmetologa' => $registrosPorCosmetologa,
                'registros_por_producto' => $registrosPorProducto
            ];

            return $result;
        }
    }
    function printArrayPrety($array){
        // print("<pre>".json_encode($array, JSON_PRETTY_PRINT)."</pre>");
        print("<pre>".print_r($array,true)."</pre>");
    }
?>