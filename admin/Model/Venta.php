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
    }
    function printArrayPrety($array){
        print("<pre>".print_r($array,true)."</pre>");
    }
?>