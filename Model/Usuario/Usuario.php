<?php
    class Usuario {
        public function getUsuarioWhereEmail($email){
            $db = new Db();
            $sql_statement = "SELECT * FROM usertable WHERE email = '$email'";
            $account = $db->query($sql_statement)->fetchArray();
            $db->close();
            return $account;
        }
        public function getNombreSucursalUsuario($email_usuario){
            $db = new Db();
            //SELECT Sucursal.nombre_sucursal FROM Sucursal, usertable WHERE Sucursal.id_sucursal = usertable.id_sucursal_usuario AND usertable.id=9

            $sql_statement = "SELECT Sucursal.nombre_sucursal 
                              FROM Sucursal, usertable 
                              WHERE Sucursal.id_sucursal = usertable.id_sucursal_usuario AND usertable.email = '$email_usuario'";
            $account = $db->query($sql_statement)->fetchArray();
            $db->close();
            return $account;
        }
        public function getNombreSucursalWhereIDSucursal($id_sucursal){
            $db = new Db();
            //SELECT Sucursal.nombre_sucursal FROM Sucursal, usertable WHERE Sucursal.id_sucursal = usertable.id_sucursal_usuario AND usertable.id=9

            $sql_statement = "SELECT nombre_sucursal 
                              FROM `Sucursal` 
                              WHERE id_sucursal='$id_sucursal'";
            $account = $db->query($sql_statement)->fetchArray();
            $db->close();
            return $account;
        }

        public function getIdCosmetologa($email){
            $db = new Db();
            $sql_statement = "SELECT id FROM usertable WHERE email = '$email'";
            $account = $db->query($sql_statement)->fetchArray();
            $db->close();
            return $account;
        }
        public function getNombreCosmetologaWhereID($id){
            $db = new Db();
            $sql_statement = "SELECT name FROM usertable WHERE id = '$id'";
            $account = $db->query($sql_statement)->fetchArray()['name'];
            $db->close();
            return $account;
        }

        public function getNumeroSucursalUsuario($email_usuario){
            $db = new Db();
            //SELECT Sucursal.nombre_sucursal FROM Sucursal, usertable WHERE Sucursal.id_sucursal = usertable.id_sucursal_usuario AND usertable.id=9

            $sql_statement = "SELECT Sucursal.id_sucursal 
                              FROM Sucursal, usertable 
                              WHERE Sucursal.id_sucursal = usertable.id_sucursal_usuario AND usertable.email = '$email_usuario'";
            $account = $db->query($sql_statement)->fetchArray();
            $db->close();
            return $account;
        }

        public function getNumeroSucursalxNombre($nombre){
            $db = new Db();
            $sql_statement = "SELECT id_sucursal
                              FROM Sucursal 
                              WHERE Sucursal.nombre_sucursal = '$nombre'";
            $account = $db->query($sql_statement)->fetchArray();
            $db->close();
            return $account['id_sucursal'];
        }

        // FUNCIONES PARA CORTE DE CAJA

        public function existeCorteCaja($fecha, $id_centro){
            $existe = 0;
            $db = new Db();
            $sql_statement = "SELECT * FROM `CorteDeCaja` WHERE timestamp='$fecha' AND id_centro='$id_centro'";
            $account = $db->query($sql_statement)->fetchArray();
            $db->close();
            if(!empty($account)){
                $existe = TRUE;
            }
            return $existe;
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

        public function getNumeroTotalVentasDelDiaFromCentro($beginOfDay, $endOfDay, $numeroSucursal){
            $db = new Db();
            $sql_statement_todo = "SELECT COUNT(*) as numVentasDia
                                   FROM (SELECT COUNT(*)
                                        FROM Ventas 
                                        WHERE centro='$numeroSucursal' AND timestamp BETWEEN $beginOfDay AND $endOfDay GROUP BY id_venta) AS Ventas";
            $todo = $db->query($sql_statement_todo)->fetchArray();
            $db->close();
            return $todo['numVentasDia'];
        }

        public function insertIntoCierreCaja($timestamp, $id_centro, $num_ventas_general, $id_cosmetologa, $id_documento, $id_corte_caja, $total_ingresos, $total_gastos, $total_caja, $nombre_archivo, $observaciones, $efectivo, $tdc, $tdd, $transferencia, $deposito, $cheque, $gastos){
            $db = new DB();
            $sql_statement = "INSERT INTO `CorteDeCaja`(`timestamp`, `id_centro`, `num_ventas_general`, `id_cosmetologa`, `id_documento`, `id_corte_caja`, `total_ingresos`, `total_gastos`, `total_caja`, `nombre_archivo`, `observaciones`, `efectivo`, `tdc`, `tdd`, `transferencia`, `deposito`, `cheque`, `gastos`) VALUES ('$timestamp', '$id_centro', '$num_ventas_general','$id_cosmetologa', '$id_documento', '$id_corte_caja', '$total_ingresos', '$total_gastos', '$total_caja', '$nombre_archivo', '$observaciones', '$efectivo', '$tdc', '$tdd', '$transferencia', '$deposito', '$cheque', '$gastos')";
            $query = $db->query($sql_statement);
            $db->close();
            return $query->affectedRows();
        }

        public function getInformacionFromCierreCajaWhereID($id_corte_caja){
            $db = new Db();
            $sql_statement_todo = "SELECT * FROM `CorteDeCaja` WHERE id_corte_caja='$id_corte_caja'";
            $info = $db->query($sql_statement_todo)->fetchArray();
            $db->close();
            return $info;
        }

        public function getNombreArchivoFromCorteCajaWhereID($id_corteCaja){
            $db = new Db();
            $sql_statement_todo = "SELECT * FROM `CorteDeCaja` WHERE id_corte_caja='$id_corteCaja'";
            $info = $db->query($sql_statement_todo)->fetchArray();
            $db->close();
            return $info['nombre_archivo'];
        }

        public function numeroReportesFromSucursal($id_sucursal){
            $db = new Db();
            $sql_statement_todo = "SELECT COUNT(*) AS numReportes FROM `CorteDeCaja` WHERE id_centro='$id_sucursal'";
            $info = $db->query($sql_statement_todo)->fetchArray();
            $db->close();
            return $info['numReportes'];
        }

        public function getCierresDeCajaFromCentro($id_sucursal, $primer_dia, $ultimo_dia){
            $db = new Db();
            $sql_statement_todo = "SELECT * FROM `CorteDeCaja` WHERE id_centro='$id_sucursal' AND timestamp BETWEEN $primer_dia AND $ultimo_dia";
            $info = $db->query($sql_statement_todo)->fetchAll();
            $db->close();
            return $info;
        }
        public function verificarMonedero($id_cliente){  


            // SE TIENE QUE MODIFICAR DEPENDIENDO DE LA ESTRUCTURA DE DINERO FINAL


            $db = new Db();
            //SELECT * FROM Monedero WHERE id_cliente = 'AJF00111231' AND dinero_final != '0'

            $sql_statement = "SELECT * 
                              FROM Monedero 
                              WHERE id_cliente = '$id_cliente'";
            $account = $db->query($sql_statement)->fetchArray();
            $db->close();
            return $account;
        }

        public function updateTratamientosMonederoToNewStructure($idMonedero, $timestampMonedero, $nuevosTratamientos) {
            
            $db = new DB();
            $sql_statement = "UPDATE `Monedero` 
                            SET `tratamientos_inicial` = '$nuevosTratamientos' 
                            WHERE `Monedero`.`id_monedero` = '$idMonedero'
                            AND `Monedero`.`timestamp_creacion` = '$timestampMonedero'";

            $account = $db->query($sql_statement);
            $db->close();
            return $account->affectedRows();
        }

        public function verificarMonederoDinero($id_cliente){  


            // SE TIENE QUE MODIFICAR DEPENDIENDO DE LA ESTRUCTURA DE DINERO FINAL


            $db = new Db();
            //SELECT * FROM Monedero WHERE id_cliente = 'AJF00111231' AND dinero_final != '0'

            $sql_statement = "SELECT * 
                              FROM MonederoDinero 
                              WHERE id_cliente = '$id_cliente'";
            $account = $db->query($sql_statement)->fetchArray();
            $db->close();
            return $account;
        }

        function getAllMonederosFromCliente($id_cliente){
            $db = new DB();
            $sql_statement = "SELECT * 
                              FROM Monedero 
                              WHERE id_cliente = '$id_cliente'
                              ORDER BY id_monedero DESC";
            $account = $db->query($sql_statement)->fetchAll();
            $db->close();
            return $account;
        }

        function getMonederoDineroFromCliente($id_cliente){
            $db = new DB();
            $sql_statement = "SELECT * 
                              FROM MonederoDinero 
                              WHERE id_cliente = '$id_cliente'
                              ORDER BY id_monedero DESC";
            $account = $db->query($sql_statement)->fetchArray();
            $db->close();
            return $account;
        }

        function getNombreZonaCuerpoWhereID($id_zona){
            $db = new DB();
            //SELECT * FROM `ZonasCuerpo` WHERE id_zona='17'
            $tratamientos = $db->query("SELECT * 
                                        FROM `ZonasCuerpo` 
                                        WHERE id_zona='$id_zona'")->fetchArray();
            $db->close();
            return $tratamientos['nombre_zona'];
        }

        function getListSucursales() {
            $db = new DB();
            $sql_statement = "SELECT * FROM `Sucursal`";
            $sucursales = $db->query($sql_statement)->fetchAll();
            $db->close();

            $sucursalesList = array();
            foreach ($sucursales as $sucursal) {
                $id = $sucursal['id_sucursal'];
                $nombre = $sucursal['nombre_sucursal'];
                $sucursalesList[$id] = $nombre;
            }
            return $sucursalesList;
        }
    }

    function obtenerTotalMetodoPago($metodoPago, $datos){
        $totalDelMetodoPago = 0;
        
        foreach($datos as $venta){
            $metodos_venta = json_decode($venta['metodo_pago']);
            foreach($metodos_venta as $individual){
                if($individual[0] == $metodoPago){
                    $totalDelMetodoPago += $individual[1];
                }
            }
        }
        return $totalDelMetodoPago;
    }
    function tratamientosMonederoToNewStructure($tratamientos) {
        $tratamientos_combinados = array_map(function ($value, $index) {
            if(!str_contains($value, "-")){
                return $value.'-'.$index;
            } else {
                return $value;
            }
        }, $tratamientos, array_keys($tratamientos));
        
        return $tratamientos_combinados;
    }
?>