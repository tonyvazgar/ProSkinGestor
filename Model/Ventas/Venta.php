<?php
    class Venta {
        public function getAllVentas($id_centro){
            $db = new Db();
            //SELECT * FROM `Ventas` WHERE centro='2'

            $sql_statement = "SELECT * 
                              FROM `Ventas`
                              WHERE centro='$id_centro'";
            $account = $db->query($sql_statement)->fetchAll();
            $db->close();
            return $account;
        }
        public function getTodosLosDetallesVentaTratamiento($id_venta){
            $db = new Db();
            $sql_statement = "SELECT * FROM Cliente, Ventas, ClienteBitacora, Tratamiento 
                              WHERE Ventas.id_venta='$id_venta'
                              AND Ventas.id_cliente=Cliente.id_cliente
                              AND Ventas.id_cliente=ClienteBitacora.id_cliente 
                              AND Ventas.timestamp=ClienteBitacora.timestamp 
                              AND Ventas.id_tratamiento=Tratamiento.id_tratamiento";
            $account = $db->query($sql_statement)->fetchAll();
            $db->close();
            return $account;
        }
        public function getTodosLosDetallesVentaProducto($id_venta){
            $db = new Db();
            $sql_statement = "SELECT * FROM Ventas, Cliente
                              WHERE Ventas.id_venta='$id_venta'
                              AND Ventas.id_cliente=Cliente.id_cliente";
            $account = $db->query($sql_statement)->fetchAll();
            $db->close();
            return $account;
        }
        public function getTodosLosDetallesVenta($id_venta){
            $db = new Db();
            $sql_statement = "SELECT * FROM Ventas
                              WHERE Ventas.id_venta='$id_venta'";
            $account = $db->query($sql_statement)->fetchAll();
            $db->close();
            return $account;
        }
        public function getDetallesTratamiento($id_tratamiento, $id_venta){
            $db = new Db();
            $sql_statement = "SELECT ClienteBitacora.*, Tratamiento.nombre_tratamiento
                              FROM ClienteBitacora, Tratamiento
                              WHERE ClienteBitacora.id_venta = '$id_venta' 
                              AND Tratamiento.id_tratamiento = '$id_tratamiento'
                              AND ClienteBitacora.id_tratamiento = Tratamiento.id_tratamiento";
            $account = $db->query($sql_statement)->fetchArray();
            $db->close();
            return $account;
        }
        public function getDetallesProducto($id_producto){
            $db = new Db();
            $sql_statement = "SELECT * 
                              FROM Productos
                              WHERE Productos.id_producto='$id_producto'";
            $account = $db->query($sql_statement)->fetchArray();
            $db->close();
            return $account;
        }
        
    }
    function getDesgloseProductosTratamientosVenta($array){
        $productos    = [];
        $tratamientos = [];
        $total = 0;
        $metodo_pago = "";
        $nombre = "";
        $id_venta = "";

        foreach ($array as $registro){
            $temp = [];
            if($registro['id_tratamiento']){
                array_push($temp, $registro['id_tratamiento'], $registro['metodo_pago'], $registro['monto'], $registro['costo_tratamiento']);
                array_push($tratamientos, $temp);
            }else{
                array_push($temp, $registro['id_productos'], $registro['metodo_pago'], $registro['monto'], $registro['costo_producto'], $registro['cantidad_producto']);
                array_push($productos, $temp);
            }
            $total += $registro['monto'];
            $metodo_pago = $registro['metodo_pago'];
            $nombre = $registro['nombre_cliente']." ".$registro['apellidos_cliente'];
            $id_venta = $registro['id_venta'];
        }
        return ["id_venta" => $id_venta,
                "nombre" => $nombre,
                "productos" => $productos, 
                "num_productos" => sizeof($productos), 
                "tratamientos" => $tratamientos, 
                "num_tratamientos" => sizeof($tratamientos), 
                "total" => number_format($total, 2),
                "metodo_pago" => $metodo_pago];
    }
?>