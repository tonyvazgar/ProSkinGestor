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
                                   WHERE centro='$sucursal' AND metodo_pago=1 AND timestamp BETWEEN $beginOfDay AND $endOfDay GROUP BY id_venta";
            $todo = $db->query($sql_statement_todo)->fetchAll();
            $sql_statement_total = "SELECT SUM(monto) 
                                    FROM Ventas 
                                    WHERE centro='$sucursal' AND metodo_pago=1 AND timestamp BETWEEN $beginOfDay AND $endOfDay";
            $todo = $db->query($sql_statement_todo)->fetchAll();
            $total = $db->query($sql_statement_total)->fetchArray()['SUM(monto)'];
            $db->close();
            return [$total, $todo];
        }

        public function getTotalTDCWhereDia($beginOfDay, $endOfDay, $sucursal){
            $db = new Db();
            $sql_statement_todo = "SELECT * 
                                   FROM Ventas 
                                   WHERE centro='$sucursal' AND metodo_pago=3 AND timestamp BETWEEN $beginOfDay AND $endOfDay GROUP BY id_venta";
            $todo = $db->query($sql_statement_todo)->fetchAll();
            $sql_statement_total = "SELECT SUM(monto) 
                                    FROM Ventas 
                                    WHERE centro='$sucursal' AND metodo_pago=3 AND timestamp BETWEEN $beginOfDay AND $endOfDay";
            $todo = $db->query($sql_statement_todo)->fetchAll();
            $total = $db->query($sql_statement_total)->fetchArray()['SUM(monto)'];
            $db->close();
            return [$total, $todo];
        }

        public function getTotalTDDWhereDia($beginOfDay, $endOfDay, $sucursal){
            $db = new Db();
            $sql_statement_todo = "SELECT * 
                                   FROM Ventas 
                                   WHERE centro='$sucursal' AND metodo_pago=2 AND timestamp BETWEEN $beginOfDay AND $endOfDay GROUP BY id_venta";
            $todo = $db->query($sql_statement_todo)->fetchAll();
            $sql_statement_total = "SELECT SUM(monto) 
                                    FROM Ventas 
                                    WHERE centro='$sucursal' AND metodo_pago=2 AND timestamp BETWEEN $beginOfDay AND $endOfDay";
            $todo = $db->query($sql_statement_todo)->fetchAll();
            $total = $db->query($sql_statement_total)->fetchArray()['SUM(monto)'];
            $db->close();
            return [$total, $todo];
        }

        public function getTotalTransferenciaWhereDia($beginOfDay, $endOfDay, $sucursal){
            $db = new Db();
            $sql_statement_todo = "SELECT * 
                                   FROM Ventas 
                                   WHERE centro='$sucursal' AND metodo_pago=4 AND timestamp BETWEEN $beginOfDay AND $endOfDay GROUP BY id_venta";
            $todo = $db->query($sql_statement_todo)->fetchAll();
            $sql_statement_total = "SELECT SUM(monto) 
                                    FROM Ventas 
                                    WHERE centro='$sucursal' AND metodo_pago=4 AND timestamp BETWEEN $beginOfDay AND $endOfDay";
            $todo = $db->query($sql_statement_todo)->fetchAll();
            $total = $db->query($sql_statement_total)->fetchArray()['SUM(monto)'];
            $db->close();
            return [$total, $todo];
        }

        public function getTotalDepositoWhereDia($beginOfDay, $endOfDay, $sucursal){
            $db = new Db();
            $sql_statement_todo = "SELECT * 
                                   FROM Ventas 
                                   WHERE centro='$sucursal' AND metodo_pago=6 AND timestamp BETWEEN $beginOfDay AND $endOfDay GROUP BY id_venta";
            $todo = $db->query($sql_statement_todo)->fetchAll();
            $sql_statement_total = "SELECT SUM(monto) 
                                    FROM Ventas 
                                    WHERE centro='$sucursal' AND metodo_pago=6 AND timestamp BETWEEN $beginOfDay AND $endOfDay";
            $todo = $db->query($sql_statement_todo)->fetchAll();
            $total = $db->query($sql_statement_total)->fetchArray()['SUM(monto)'];
            $db->close();
            return [$total, $todo];
        }

        public function insertIntoCierreCaja($timestamp, $id_documento, $id_cosmetologa, $id_centro, $total_efectivo, $num_ventas_efectivo, $total_tdc, $num_ventas_tdc, $total_tdd, $num_ventas_tdd, $total_transferencia, $num_ventas_transferencia, $total_deposito, $num_ventas_deposito, $id_corte_caja, $observaciones, $nombre_archivo){
            $db = new DB();
            $sql_statement = "INSERT INTO `CorteDeCaja`(`timestamp`, `id_documento`, `id_cosmetologa`, `id_centro`, `total_efectivo`, `num_ventas_efectivo`, `total_tdc`, `num_ventas_tdc`, `total_tdd`, `num_ventas_tdd`, `total_transferencia`, `num_ventas_transferencia`, `total_deposito`, `num_ventas_deposito`, `id_corte_caja`, `observaciones`, `nombre_archivo`) VALUES ('$timestamp', '$id_documento', '$id_cosmetologa', '$id_centro', '$total_efectivo', '$num_ventas_efectivo', '$total_tdc', '$num_ventas_tdc', '$total_tdd', '$num_ventas_tdd', '$total_transferencia', '$num_ventas_transferencia', '$total_deposito', '$num_ventas_deposito', '$id_corte_caja', '$observaciones', '$nombre_archivo')";
            $query = $db->query($sql_statement);
            $db->close();
            return $query->affectedRows();
        }
    }
?>