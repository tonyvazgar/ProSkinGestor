<?php
    include_once  __DIR__."/Db.php";

    class Venta {
        public function getAllVentasTratamiento($firtsDay, $lastDay)
        {
            $db = new DB();
            $sql_query = "SELECT ClienteBitacora.*, Tratamiento.*, Ventas.id_venta
                            FROM `ClienteBitacora`, usertable, Tratamiento, Ventas
                            WHERE ClienteBitacora.id_cosmetologa=usertable.id 
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
            $tratamientos = $db->query("SELECT ClienteBitacora.*, Tratamiento.*, Ventas.id_venta
                                        FROM `ClienteBitacora`, usertable, Tratamiento, Ventas
                                        WHERE ClienteBitacora.id_cosmetologa=usertable.id 
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
            $tratamientos = $db->query("SELECT Ventas.*, Productos.*
                                        FROM usertable, Ventas, Productos
                                        WHERE usertable.id=Ventas.id_cosmetologa
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
            $tratamientos = $db->query("SELECT Ventas.*, Productos.*
                                        FROM usertable, Ventas, Productos
                                        WHERE usertable.id=Ventas.id_cosmetologa
                                        AND Productos.centro_producto=Ventas.centro
                                        AND Ventas.id_productos=Productos.id_producto
                                        AND Ventas.id_productos!=''
                                        AND Ventas.timestamp BETWEEN $firtsDay AND $lastDay
                                        AND Ventas.centro='$idSucursal'
                                        ORDER by Ventas.timestamp DESC")->fetchAll();
            $db->close();
            return $tratamientos;
        }

        // TODO: LLAMAR ESTAS FUNCIONES PARA QUE RETORNEN DATA CON FECHAS Y HACER LAS TABLAS
        // TODO: ESTAS FUNCIONES SATISFACEN A LOS REPORTES DE TRATAMIENTOS APLICADOS, VENTAS E INVENTARIO

        public function getTotalVentasDelDia($beginOfDay, $endOfDay){
            
            $db = new Db();
            $sql_query = "SELECT Ventas.*, CONCAT(Cliente.nombre_cliente, ' ',Cliente.apellidos_cliente) AS nombre_cliente, Sucursal.nombre_sucursal, usertable.name AS nombre_cosmetologa
                            FROM Ventas, Cliente, Sucursal, usertable
                            WHERE Ventas.id_cliente=Cliente.id_cliente
                            AND Ventas.centro=Sucursal.id_sucursal
                            AND Ventas.id_cosmetologa=usertable.id
                            AND timestamp BETWEEN $beginOfDay AND $endOfDay";
            $tratamientos = $db->query($sql_query)->fetchAll();
            $db->close();
            return $tratamientos;
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
            $montoTotal              = 0;
            $montoTotalTratamientos  = 0;
            $montoTotalProductos     = 0;
            $montoTotalMonederos     = 0;

            // Iterar sobre el array de ventas
            foreach ($ventas as $venta) {
                $monto_esta_venta = str_replace(',', '', $venta['monto']);
                $monto_esta_venta = floatval($monto_esta_venta);
                $montoTotal += $monto_esta_venta;

                $idVenta       = $venta['id_venta'];
                $idTratamiento = $venta['id_tratamiento'];
                $idProductos   = $venta['id_productos'];

                // Contar ventas repetidas por id_venta y sumar montos
                if (isset($ventasRepetidas[$idVenta])) {
                    $ventasRepetidas[$idVenta]++;
                } else {
                    $ventasRepetidas[$idVenta] = 1;
                }

                // Contar ventas por id_tratamiento
                if($idTratamiento != '') {
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
                if($idProductos != '') {
                    $montoTotalProductos += $monto_esta_venta;
                    if (isset($sumVentasPorProducto[$idProductos])) {
                        $sumVentasPorProducto[$idProductos] += $monto_esta_venta;
                    } else {
                        $sumVentasPorProducto[$idProductos] = $monto_esta_venta;
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
                'ventas' => $ventasRepetidas,
                'total_ventas' => $totalVentas,
                'monto_total' => $montoTotal,
                'ventas_por_tratamiento' => $ventasPorTratamiento,
                'total_tratamiento' => $totalVentasTratamiento,
                'sum_total_tratamiento' => $sumVentasTratamiento,
                'sum_ventas_por_tratamiento' => $sumVentasPorTratamiento,
                'monto_total_tratamiento' => $montoTotalTratamientos,
                'ventas_por_producto' => $ventasPorProducto,
                'total_producto' => $totalVentasProducto,
                'sum_total_producto' => $sumVentasProducto,
                'sum_ventas_por_producto' => $sumVentasPorProducto,
                'monto_total_producto' => $montoTotalProductos,
                'monto_total_monedero' => $montoTotalMonederos,
                'sum_ventas_por_monedero' => $ventasPorMonedero,
                'metodo_pago_cantidad' => $mtpago
            ];
            return $resultados;
        }
    }
    function printArrayPrety($array){
        print("<pre>".print_r($array,true)."</pre>");
    }
?>