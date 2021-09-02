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
            //BUGGGGGG
            $db = new Db();
            $sql_statement = "SELECT * 
                              FROM Productos
                              WHERE Productos.id_producto='$id_producto'";
            $account = $db->query($sql_statement)->fetchArray();
            $db->close();
            return $account;
        }

        //******* EDICION DE VENTA FUNCIONES *******/
        public function updateMetodoPago($id_venta, $timeStamp, $metodo_pago, $referencia_pago){
            //UPDATE `Ventas` SET `metodo_pago`='6',`referencia_pago`='Hola' WHERE Ventas.id_venta='JKS21071127DEP01115' AND Ventas.timestamp='1629917408'
            $db = new Db();
            $sql_statement = "UPDATE Ventas 
                              SET metodo_pago='$metodo_pago',referencia_pago='$referencia_pago' 
                              WHERE Ventas.id_venta='$id_venta' AND Ventas.timestamp='$timeStamp'";
            $account = $db->query($sql_statement);
            $db->close();
            return $account->affectedRows();
        }
        public function updatePrecioTotalVenta(){
            //UPDATE `Ventas` SET `metodo_pago`='6',`referencia_pago`='Hola' WHERE Ventas.id_venta='JKS21071127DEP01115' AND Ventas.timestamp='1629917408'
            $db = new Db();
            $sql_statement = "UPDATE Ventas 
                              SET metodo_pago='$metodo_pago',referencia_pago='$referencia_pago' 
                              WHERE Ventas.id_venta='$id_venta' AND Ventas.timestamp='$timeStamp'";
            $account = $db->query($sql_statement);
            $db->close();
            return $account->affectedRows();
        }

        public function updateProductoVenta($id_venta, $timeStamp, $idProducto, $precioUnitarioProducto, $cantidadProducto, $precioTotalProducto){
            // UPDATE `Ventas` 
            // SET `costo_producto`='360',`cantidad_producto`='2', `monto`='720' 
            // WHERE Ventas.id_venta='JKS21071127DEP01115' AND Ventas.timestamp='1629917408' AND Ventas.id_productos='PP02'

            $db = new Db();
            $sql_statement = "UPDATE Ventas
                              SET costo_producto='$precioTotalProducto', cantidad_producto='$cantidadProducto', monto='$precioUnitarioProducto' 
                              WHERE Ventas.id_venta='$id_venta' AND Ventas.timestamp='$timeStamp' AND Ventas.id_productos='$idProducto'";
            $account = $db->query($sql_statement);
            $db->close();
            return $account->affectedRows();
        }

        public function updateTratamientoNormalVenta($id_venta, $id_tratamiento, $timeStamp, $nuevoPrecio){
            //UPDATE `Ventas` SET `monto` = '700' WHERE `Ventas`.`id_cliente` = 'LVG96110722' AND `Ventas`.`id_tratamiento` = 'MAS41' AND `Ventas`.`timestamp` = '1626129539';
            $db = new Db();
            $sql_statement = "UPDATE Ventas 
                              SET Ventas.monto = '$nuevoPrecio', Ventas.costo_tratamiento = '$nuevoPrecio'
                              WHERE Ventas.id_venta = '$id_venta' AND Ventas.id_tratamiento = '$id_tratamiento' AND Ventas.timestamp = '$timeStamp'";
            $account = $db->query($sql_statement);
            $db->close();
            return $account->affectedRows();
        }

        public function updateCavitacionDepilacionVenta($id_venta, $id_tratamiento, $timeStamp, $nuevoPrecio){
            $db = new Db();
            $sql_statement = "UPDATE Ventas 
                              SET Ventas.monto = '$nuevoPrecio', Ventas.costo_tratamiento = '$nuevoPrecio'
                              WHERE Ventas.id_venta = '$id_venta' AND Ventas.id_tratamiento = '$id_tratamiento' AND Ventas.timestamp = '$timeStamp'";
            $account = $db->query($sql_statement);
            $db->close();
            return $account->affectedRows();
        }

        //UPDATE `ClienteTratamientoEspecial` SET `zona` = '18,23' WHERE `ClienteTratamientoEspecial`.`id_cliente` = 'PVR21071629' AND `ClienteTratamientoEspecial`.`zona` = '18,' AND `ClienteTratamientoEspecial`.`detalle_zona` = '0' AND `ClienteTratamientoEspecial`.`timestamp` = '1630395110';
        public function updateClienteTratamientoEspecial($id_tratamiento, $timeStamp, $zona_cuerpo, $numZonasTratamiento){
            $db = new Db();
            $sql_statement = "UPDATE ClienteTratamientoEspecial 
                              SET zona = '$zona_cuerpo', detalle_zona = '$numZonasTratamiento'
                              WHERE ClienteTratamientoEspecial.id_tratamiento = '$id_tratamiento' AND ClienteTratamientoEspecial.timestamp = '$timeStamp'";
            $account = $db->query($sql_statement);
            $db->close();
            return $account->affectedRows();
        }

        public function updateTratamientoEspecialBitacora($id_venta, $id_tratamiento, $timeStamp, $comentarios, $zona_cuerpo){
            //UPDATE `ClienteBitacora` SET `zona_cuerpo` = '18,23' WHERE `ClienteBitacora`.`id_cliente` = 'PVR21071629' AND `ClienteBitacora`.`id_tratamiento` = 'CAV01' AND `ClienteBitacora`.`id_cosmetologa` = '8' AND `ClienteBitacora`.`centro` = '1' AND `ClienteBitacora`.`calificacion` = '1' AND `ClienteBitacora`.`timestamp` = '1630395110';

            $db = new Db();
            $sql_statement = "UPDATE ClienteBitacora 
                              SET zona_cuerpo = '$zona_cuerpo', comentarios='$comentarios'
                              WHERE ClienteBitacora.id_venta = '$id_venta' AND ClienteBitacora.id_tratamiento = '$id_tratamiento' AND ClienteBitacora.timestamp = '$timeStamp'";
            $account = $db->query($sql_statement);
            $db->close();
            return $account->affectedRows();
        }



        public function updateTatamientoNormalBitacora($id_venta, $id_tratamiento, $timeStamp, $comentarios){
            //UPDATE `ClienteBitacora` SET `comentarios` = 'el masajito editado' WHERE `ClienteBitacora`.`id_cliente` = 'LVG96110722' AND `ClienteBitacora`.`id_tratamiento` = 'MAS41' AND `ClienteBitacora`.`id_cosmetologa` = '8' AND `ClienteBitacora`.`centro` = '1' AND `ClienteBitacora`.`calificacion` = '1' AND `ClienteBitacora`.`timestamp` = '1626129539';

            $db = new Db();
            $sql_statement = "UPDATE ClienteBitacora
                              SET ClienteBitacora.comentarios = '$comentarios'
                              WHERE ClienteBitacora.id_venta = '$id_venta' AND ClienteBitacora.id_tratamiento = '$id_tratamiento' AND ClienteBitacora.timestamp = '$timeStamp'";
            $account = $db->query($sql_statement);
            $db->close();
            return $account->affectedRows();
        }


        public function deleteProductoFromVenta($id_venta, $id_producto){
            $db = new DB();
            $tratamientos = $db->query("DELETE FROM Ventas
                                        WHERE Ventas.id_venta = '$id_venta' AND Ventas.id_productos = '$id_producto'")->affectedRows();
            $db->close();
            return $tratamientos;
        }

        public function deleteTratamientoFromVentas($id_tratamiento, $id_venta, $timeStamp){
            // DELETE FROM Ventas 
            // WHERE Ventas.id_venta = '$id_venta' 
            // AND Ventas.id_tratamiento = '$id_tratamiento' AND Ventas.timestamp = '$timeStamp'
            $db = new DB();
            $tratamientos = $db->query("DELETE FROM Ventas 
                                        WHERE Ventas.id_venta = '$id_venta' 
                                        AND Ventas.id_tratamiento = '$id_tratamiento' AND Ventas.timestamp = '$timeStamp'")->affectedRows();
            $db->close();
            return $tratamientos;
        }

        public function deleteTratamientoFromClienteTratamiento($id_tratamiento, $id_venta, $timeStamp){
            // DELETE FROM ClienteTratamiento 
            // WHERE ClienteTratamiento.id_cliente = 'LVG96110722' AND ClienteTratamiento.id_tratamiento = 'FAC19' AND ClienteTratamiento.fecha_aplicacion = '1629552472'
            $db = new DB();
            $tratamientos = $db->query("DELETE FROM ClienteTratamiento 
                                        WHERE ClienteTratamiento.fecha_aplicacion = '$timeStamp'
                                        AND ClienteTratamiento.id_tratamiento = '$id_tratamiento'")->affectedRows();
            $db->close();
            return $tratamientos;
        }
        public function deleteTratamientoFromClienteTratamientoEspecial($id_tratamiento, $id_venta, $timeStamp){
            // DELETE FROM ClienteTratamiento 
            // WHERE ClienteTratamiento.id_cliente = 'LVG96110722' AND ClienteTratamiento.id_tratamiento = 'FAC19' AND ClienteTratamiento.fecha_aplicacion = '1629552472'
            $db = new DB();
            $tratamientos = $db->query("DELETE FROM ClienteTratamientoEspecial
                                        WHERE ClienteTratamientoEspecial.timestamp = '$timeStamp'
                                        AND ClienteTratamientoEspecial.id_tratamiento = '$id_tratamiento'")->affectedRows();
            $db->close();
            return $tratamientos;
        }

        public function deleteTratamientoFromClienteBitacora($id_tratamiento, $id_venta, $timeStamp){
            // DELETE FROM ClienteBitacora
            // WHERE ClienteBitacora.id_cliente = 'LVG96110722' 
            // AND ClienteBitacora.id_tratamiento = 'FAC19' AND ClienteBitacora.id_cosmetologa = '8' AND ClienteBitacora.centro = '1' AND ClienteBitacora.calificacion = '1' AND ClienteBitacora.timestamp = '1629552472'
            $db = new DB();
            $tratamientos = $db->query("DELETE FROM ClienteBitacora
                                        WHERE ClienteBitacora.id_venta = '$id_venta' 
                                        AND ClienteBitacora.id_tratamiento = '$id_tratamiento' AND ClienteBitacora.timestamp = '$timeStamp'")->affectedRows();
            $db->close();
            return $tratamientos;
        }
        
    }
    function getDesgloseProductosTratamientosVenta($array){
        $productos    = [];
        $tratamientos = [];
        $total = 0;
        $metodo_pago = "";
        $referencia_pago = "";
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
            $referencia_pago = $registro['referencia_pago'];
            $nombre = $registro['nombre_cliente']." ".$registro['apellidos_cliente'];
            $id_venta = $registro['id_venta'];
            $id_cosmetologa = $registro['id_cosmetologa'];
        }
        return ["id_venta" => $id_venta,
                "cosmetologa" => $id_cosmetologa,
                "nombre" => $nombre,
                "productos" => $productos, 
                "num_productos" => sizeof($productos), 
                "tratamientos" => $tratamientos, 
                "num_tratamientos" => sizeof($tratamientos), 
                "total" => number_format($total, 2),
                "metodo_pago" => $metodo_pago,
                "referencia_pago" => $referencia_pago,
                "total_noFormat" => $total];
    }
?>