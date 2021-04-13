<?php
    class Producto {
        public function altaProducto($id_producto, $nombre_producto, $descripcion_producto, $costo_unitario_producto, $stock_disponible_producto, $centro_producto){
            //INSERT INTO `Productos`(`id_producto`, `nombre_producto`, `descripcion_producto`, `costo_unitario_producto`, `stock_disponible_producto`, `centro_producto`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6])
            $db = new Db();
            $sql_statement = "INSERT INTO `Productos`(`id_producto`, `nombre_producto`, `descripcion_producto`, `costo_unitario_producto`, `stock_disponible_producto`, `centro_producto`) 
                              VALUES ('$id_producto', '$nombre_producto', '$descripcion_producto', '$costo_unitario_producto', '$stock_disponible_producto', '$centro_producto')";
            $query = $db->query($sql_statement);
            $db->close();
            if($query->affectedRows() >= 1){
                return true;
            }else{
                return false;
            }
        }
        public function getAllProductos(){
            $db = new Db();
            $sql_statement = "SELECT *
                              FROM Productos";
            $account = $db->query($sql_statement)->fetchAll();
            $db->close();
            return $account;
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