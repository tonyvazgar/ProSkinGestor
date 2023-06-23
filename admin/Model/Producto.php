<?php
    include_once  __DIR__."/Db.php";
    class Producto
    {
        public function getAllProductosAsGlobalAdmin()
        {
            $db = new Db();
            $sql_statement = "SELECT Productos.*, Sucursal.nombre_sucursal FROM Productos, Sucursal WHERE Productos.centro_producto=Sucursal.id_sucursal";
            $account = $db->query($sql_statement)->fetchAll();
            $db->close();
            return $account;
        }

        public function getAllProductosAsLocalAdmin($id_sucursal)
        {
            $db = new Db();
            $sql_statement = "SELECT Productos.*, Sucursal.nombre_sucursal FROM Productos, Sucursal WHERE Productos.centro_producto=Sucursal.id_sucursal AND Productos.centro_producto='$id_sucursal'";
            $account = $db->query($sql_statement)->fetchAll();
            $db->close();
            return $account;
        }
        public function getAllSucursales()
        {
            $db = new Db();
            $sql_statement = "SELECT * FROM `Sucursal`";
            $account = $db->query($sql_statement)->fetchAll();
            $db->close();
            return $account;
        }


        public function getProductoWhere($id_producto, $centro_producto)
        {
            $db = new Db();
            $selectStatement = "SELECT * 
                                FROM `Productos`
                                WHERE id_producto='$id_producto' 
                                AND centro_producto='$centro_producto'";
            $account = $db->query($selectStatement)->fetchArray();
            $db->close();
            return $account;
        }

        public function updateInfoProducto($id_producto, $marca_producto, $linea_producto, $descripcion_producto, $presentacion_producto, $stock_disponible_producto, $costo_unitario_producto, $centro_producto)
        {
            $db = new DB();
            $sql_statement = "UPDATE `Productos`
                                SET `id_producto` = '$id_producto', `marca_producto` = '$marca_producto', `linea_producto` = '$linea_producto', `descripcion_producto` = '$descripcion_producto', `presentacion_producto` = '$presentacion_producto', `stock_disponible_producto` = '$stock_disponible_producto', `costo_unitario_producto` = '$costo_unitario_producto', `centro_producto` = '$centro_producto' 
                                WHERE `Productos`.`id_producto` = '$id_producto' AND `Productos`.`centro_producto` = '$centro_producto';";
            $account = $db->query($sql_statement);
            $db->close();
            return $account->affectedRows();
        }

        public function insertNewProducto($id_producto, $marca_producto, $linea_producto, $descripcion_producto, $presentacion_producto, $stock_disponible_producto, $costo_unitario_producto, $centro_producto)
        {
            $db = new DB();
            $sql_statement = "INSERT INTO 
                                `Productos`(`id_producto`, `marca_producto`, `linea_producto`, `descripcion_producto`, `presentacion_producto`, `stock_disponible_producto`, `costo_unitario_producto`, `centro_producto`) 
                                VALUES 
                                ('$id_producto', '$marca_producto', '$linea_producto', '$descripcion_producto', '$presentacion_producto', '$stock_disponible_producto', '$costo_unitario_producto', '$centro_producto')";
            $query = $db->query($sql_statement);

            $selectStatement = "SELECT * 
                                FROM `Productos`
                                WHERE id_producto='$id_producto' 
                                AND centro_producto='$centro_producto'";

            $account = $db->query($selectStatement)->fetchArray();
            $db->close();
            return $account;
        }
    }
    function printArrayPrety($array){
        print("<pre>".print_r($array,true)."</pre>");
    }
?>