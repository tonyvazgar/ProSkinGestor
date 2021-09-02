<?php
    // require_once "../../Model/Db.php";
    class Producto {
        
        function selectAllFromProductosApartados(){
            //SELECT * FROM `ProductosApartados` ORDER BY `timestamp_inicial` DESC
            $db = new DB();
            $productos = $db->query('SELECT * 
                                        FROM `ProductosApartados` 
                                        ORDER BY `timestamp_inicial` DESC')->fetchAll();
            $db->close();
            return $productos;
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

        public function generateIdProducto($nombre_producto){
            $substr = strtoupper(substr($nombre_producto, 0, 3));
            $siguienteNumeroParaID = $this->getNumProductosParaID()['numProductos'] + 1;
            $id = $substr.$siguienteNumeroParaID;
            return $id;
        }
        //--------------------------------------DELETES--------------------------------------------------
        function deleteProductoApartado($id_producto, $cantidad_producto, $timestamp_inicial){
            // DELETE FROM `ProductosApartados` 
            // WHERE `ProductosApartados`.`id_producto` = 'R2401' 
            // AND `ProductosApartados`.`cantidad_producto` = '2' 
            // AND `ProductosApartados`.`timestamp_inicial` = '1624401000'
            $db = new DB();
            $tratamientos = $db->query("DELETE FROM ProductosApartados 
                                        WHERE ProductosApartados.id_producto = '$id_producto' 
                                        AND ProductosApartados.cantidad_producto = '$cantidad_producto' 
                                        AND ProductosApartados.timestamp_inicial = '$timestamp_inicial'")->affectedRows();
            $db->close();
            return $tratamientos;
        }

        function deleteProductoApartadoFinalizar($id_producto, $cantidad_producto){
            $db = new DB();
            $tratamientos = $db->query("DELETE FROM ProductosApartados 
                                        WHERE ProductosApartados.id_producto = '$id_producto' 
                                        AND ProductosApartados.cantidad_producto = '$cantidad_producto'")->affectedRows();
            $db->close();
            return $tratamientos;
        }
        //-----------------------------------------------------------------------------------------------
        //--------------------------------------INSERT---------------------------------------------------
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
        function insertarVentaProducto($id_venta, $id_cliente, $id_tratamiento, $metodo_pago, $referencia , $monto, $timestamp, $centro, $costo_tratamiento, $id_productos, $costo_producto, $cantidad_producto, $id_cosmetologa){
            //INSERT INTO `Ventas`(`id_venta`, `id_cliente`, `id_tratamiento`, `metodo_pago`, `monto`, `timestamp`, `centro`, `costo_tratamiento`, `id_productos`, `costo_producto`, `cantidad_producto`, `id_cosmetologa`) VALUES
            $db = new DB();
            $sql_statement = "INSERT INTO `Ventas`(`id_venta`, `id_cliente`, `id_tratamiento`, `metodo_pago`, `referencia_pago`, `monto`, `timestamp`, `centro`, `costo_tratamiento`, `id_productos`, `costo_producto`, `cantidad_producto`, `id_cosmetologa`) 
                              VALUES
                              ('$id_venta', '$id_cliente', '$id_tratamiento', $metodo_pago, '$referencia', '$monto', '$timestamp', '$centro', '$costo_tratamiento', '$id_productos', '$costo_producto', '$cantidad_producto', '$id_cosmetologa')";
            $query = $db->query($sql_statement);
            $db->close();
            return $query->affectedRows();
        }

        //Insertar a ProductosApartados
        public function insertProductosApartados($id_producto, $centro_producto, $cantidad_producto, $id_cosmetologa, $timestamp_inicial, $timestamp_final){
            //INSERT INTO `ProductosApartados`(`id_producto`, `cantidad_producto`, `id_cosmetologa`, `timestamp_inicial`, `timestamp_final`) VALUES
            $db = new DB();
            $sql_statement = "INSERT INTO `ProductosApartados`(`id_producto`, `centro_producto`, `cantidad_producto`, `id_cosmetologa`, `timestamp_inicial`, `timestamp_final`) 
                              VALUES
                              ('$id_producto', '$centro_producto', '$cantidad_producto', '$id_cosmetologa', $timestamp_inicial, '$timestamp_final')";
            $query = $db->query($sql_statement);
            $db->close();
            return $query->affectedRows();
        }
        //-----------------------------------------------------------------------------------------------
        //--------------------------------------GETS-----------------------------------------------------
        function getProductoApartadoParaCerrarVenta($id_producto, $id_centro, $cantidad_producto, $id_cosmetologa, $timeStampInicial, $timeStampFinal){
    
        }

        function getSumVentas(){
            //SELECT COUNT(*) FROM Ventas
            $db = new DB();
            $tratamientos = $db->query('SELECT COUNT(*) AS numVentas FROM Ventas')->fetchAll();
            $db->close();
            return $tratamientos;
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

        public function getProductoWereID($id_producto, $id_centro){
            $db = new Db();
            $sql_statement = "SELECT *
                              FROM Productos 
                              WHERE id_producto='$id_producto' AND centro_producto='$id_centro'";
            $account = $db->query($sql_statement)->fetchArray();
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
        public function getNombreSucursalProducto($id_sucursal){
            $db = new Db();
            //SELECT Sucursal.nombre_sucursal FROM Sucursal, usertable WHERE Sucursal.id_sucursal = usertable.id_sucursal_usuario AND usertable.id=9

            $sql_statement = "SELECT Sucursal.nombre_sucursal 
                              FROM Sucursal
                              WHERE Sucursal.id_sucursal = '$id_sucursal'";
            $account = $db->query($sql_statement)->fetchArray();
            $db->close();
            return $account;
        }

        public function getNumProductosParaID(){
            $db = new Db();
            $sql_statement = "SELECT COUNT(*) AS numProductos
                              FROM Productos";
            $account = $db->query($sql_statement)->fetchArray();
            $db->close();
            return $account;
        }

        public function getStockProducto($id_producto, $id_centro){
            $db = new Db();
            $sql_statement = "SELECT Productos.stock_disponible_producto 
                              FROM Productos 
                              WHERE Productos.id_producto='$id_producto' AND Productos.centro_producto='$id_centro'";
            $account = $db->query($sql_statement)->fetchArray();
            $db->close();
            return $account['stock_disponible_producto'];
        }

        //-----------------------------------------------------------------------------------------------
    }

    function getApartados(){
        $productoModel = new Producto();
        $productosApartados = $productoModel->selectAllFromProductosApartados();   //Obtener todos los status de clientes en la BDD
        date_default_timezone_set('America/Mexico_City');
        $datetime = new DateTime();
        $timezone = new DateTimeZone('America/Mexico_City');
        $datetime->setTimezone($timezone);
        $hoy = strtotime($datetime->format('H:i'));

        foreach($productosApartados as $producto){
            $timestamp_final = $producto['timestamp_final'];         //la ultima visita del cliente
            $diferencia = $hoy - $timestamp_final;
            if($diferencia >= 5){
                //[id_producto] => R2401 [centro_producto] => 2 [cantidad_producto] => 2 [id_cosmetologa] => 9 [timestamp_inicial] => 1624401000 [timestamp_final] => 1624401300 
                $id_producto       = $producto['id_producto'];
                $centro_producto   = $producto['centro_producto'];
                $cantidad_producto = $producto['cantidad_producto'];
                $id_cosmetologa    = $producto['id_cosmetologa'];
                $timestamp_inicial = $producto['timestamp_inicial'];
                //Regresar al inventario el stock apartado
                $stock_original_producto = $productoModel -> getProductoWereID($id_producto, $centro_producto)['stock_disponible_producto'];
                $nuevo_stock_producto = $stock_original_producto + $cantidad_producto;
                $productoModel->updateStockProducto($id_producto, $nuevo_stock_producto, $centro_producto);

                //Borrar de tabla ProductosApartados el registro
                $productoModel -> deleteProductoApartado($id_producto, $cantidad_producto, $timestamp_inicial);
            }
        }
    }
?>