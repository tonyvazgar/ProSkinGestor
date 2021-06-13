<?php
    class Producto {
        public function altaProducto($id_producto, $marca_producto, $linea_producto, $descripcion_producto, $presentacion_producto, $stock_disponible_producto, $costo_unitario_producto, $centro_producto){
            //INSERT INTO `Productos`(`id_producto`, `nombre_producto`, `descripcion_producto`, `costo_unitario_producto`, `stock_disponible_producto`, `centro_producto`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6])
            $db = new Db();
            $sql_statement = "INSERT INTO `Productos`(`id_producto`, `marca_producto`, `linea_producto`, `descripcion_producto`, `presentacion_producto`, `stock_disponible_producto`, `costo_unitario_producto`, `centro_producto`) 
                              VALUES ('$id_producto', '$marca_producto', '$linea_producto', '$descripcion_producto', '$presentacion_producto', '$stock_disponible_producto', '$costo_unitario_producto', '$centro_producto')";
            $query = $db->query($sql_statement);
            $db->close();
            if($query->affectedRows() >= 1){
                return true;
            }else{
                return false;
            }
        }
        //Insertar a venta
        function insertarVentaProducto($id_venta, $id_cliente, $id_tratamiento, $metodo_pago, $monto, $timestamp, $centro, $costo_tratamiento, $id_productos, $costo_producto, $cantidad_producto, $id_cosmetologa){
            //INSERT INTO `Ventas`(`id_venta`, `id_cliente`, `id_tratamiento`, `metodo_pago`, `monto`, `timestamp`, `centro`, `costo_tratamiento`, `id_productos`, `costo_producto`, `cantidad_producto`, `id_cosmetologa`) VALUES
            $db = new DB();
            $sql_statement = "INSERT INTO `Ventas`(`id_venta`, `id_cliente`, `id_tratamiento`, `metodo_pago`, `monto`, `timestamp`, `centro`, `costo_tratamiento`, `id_productos`, `costo_producto`, `cantidad_producto`, `id_cosmetologa`) 
                              VALUES
                              ('$id_venta', '$id_cliente', '$id_tratamiento', $metodo_pago, '$monto', '$timestamp', '$centro', '$costo_tratamiento', '$id_productos', '$costo_producto', '$cantidad_producto', '$id_cosmetologa')";
            $query = $db->query($sql_statement);
            $db->close();
            return $query->affectedRows();
        }


        function getSumVentas(){
            //SELECT COUNT(*) FROM Ventas
            $db = new DB();
            $tratamientos = $db->query('SELECT COUNT(*) AS numVentas FROM Ventas')->fetchAll();
            $db->close();
            return $tratamientos;
        }

        function updateStockProducto($id_producto, $nuevo_stock, $id_centro){
            //UPDATE `Productos` SET `stock_disponible_producto` = '70' WHERE `Productos`.`id_producto` = 'SHA3';
            $db = new DB();
            $sql_statement = "UPDATE `Productos` 
                              SET `stock_disponible_producto` = '$nuevo_stock' 
                              WHERE `Productos`.`id_producto` = '$id_producto'
                              AND `Productos`.`centro_producto` = '$id_centro';";

            $account = $db->query($sql_statement);
            $db->close();
            return $account->affectedRows();
        }

        public function getAllProductos(){
            $db = new Db();
            $sql_statement = "SELECT *
                              FROM Productos
                              ORDER BY descripcion_producto ASC";
            $account = $db->query($sql_statement)->fetchAll();
            $db->close();
            return $account;
        }

        public function getAllProductosFromMarca($marca, $id_centro){
            $db = new Db();
            $sql_statement = "SELECT *
                              FROM Productos
                              WHERE marca_producto = '$marca' 
                              AND centro_producto  = '$id_centro'
                              ORDER BY descripcion_producto ASC";
            $account = $db->query($sql_statement)->fetchAll();
            $db->close();
            return $account;
        }

        public function getAllProductosFromLinea($linea, $id_centro){
            $db = new Db();
            $sql_statement = "SELECT *
                              FROM Productos
                              WHERE linea_producto = '$linea'
                              AND centro_producto  = '$id_centro'
                              ORDER BY descripcion_producto ASC";
            $account = $db->query($sql_statement)->fetchAll();
            $db->close();
            return $account;
        }

        public function getProductoWereID($id_producto){
            $db = new Db();
            $sql_statement = "SELECT *
                              FROM Productos 
                              WHERE id_producto='$id_producto'";
            $account = $db->query($sql_statement)->fetchAll();
            $db->close();
            return $account;
        }
        public function getProductoWereDescripcion($descripcion){
            $db = new Db();
            $sql_statement = "SELECT *
                              FROM Productos 
                              WHERE BINARY descripcion_producto LIKE '%$descripcion%'";
            $account = $db->query($sql_statement)->fetchAll();
            $db->close();
            return $account;
        }
        function getAllVentasDeCosmetologa($email){
            $db = new DB();
            $tratamientos = $db->query("SELECT Ventas.* 
                                        FROM Ventas, usertable
                                        WHERE usertable.email='$email'
                                        AND Ventas.id_cosmetologa=usertable.id")->fetchAll();
            $db->close();
            return $tratamientos;
        }
        //-----------------------------------------------------------------------------------------------
        public function getNumProductosParaID(){
            $db = new Db();
            $sql_statement = "SELECT COUNT(*) AS numProductos
                              FROM Productos";
            $account = $db->query($sql_statement)->fetchArray();
            $db->close();
            return $account;
        }

        public function generateIdProducto($nombre_producto){
            $substr = strtoupper(substr($nombre_producto, 0, 3));
            $siguienteNumeroParaID = $this->getNumProductosParaID()['numProductos'] + 1;
            $id = $substr.$siguienteNumeroParaID;
            return $id;
        }
    }
?>