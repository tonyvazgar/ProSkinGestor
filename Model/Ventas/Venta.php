<?php
    class Venta {
        public function getAllVentas($id_centro){
            $db = new Db();
            //SELECT * FROM `Ventas` WHERE centro='2'

            $sql_statement = "SELECT * 
                              FROM `Ventas`, Tratamiento
                              WHERE centro='$id_centro'
                              AND Ventas.id_tratamiento=Tratamiento.id_tratamiento";
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
            $sql_statement = "SELECT * FROM Ventas
                              WHERE Ventas.id_venta='$id_venta'";
            $account = $db->query($sql_statement)->fetchAll();
            $db->close();
            return $account;
        }
    }
?>