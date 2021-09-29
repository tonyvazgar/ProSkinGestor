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

        public function getNombreTratamientoDeVenta($id_tratamiento){
            $db = new Db();
            $sql_statement = "SELECT Tratamiento.nombre_tratamiento FROM Tratamiento WHERE id_tratamiento='$id_tratamiento'";
            $account = $db->query($sql_statement)->fetchArray();
            $db->close();
            return $account['nombre_tratamiento'];
        }

        public function getNombreProductoDeVenta($id_producto){
            $db = new Db();
            $sql_statement = "SELECT Productos.descripcion_producto FROM Productos WHERE id_producto='$id_producto'";
            $account = $db->query($sql_statement)->fetchArray();
            $db->close();
            return $account['descripcion_producto'];
        }

        public function getVentaFromDetallesEdicionVenta($id_venta){
            $db = new Db();
            $sql_statement = "SELECT * FROM `DetallesEdicionVenta` WHERE id_venta='$id_venta'";
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

        public function insertIntoDetallesEdicionVenta($id_venta, $timestamp_venta, $timestamp_edicion, $tipo_edicion, $antes, $despues){
            $db = new DB();
            //INSERT INTO `DetallesEdicionVenta`(`id_edicion`, `antes`, `despues`) VALUES ([value-1],[value-2],[value-3])
            //(NULL, 'd', 'f');
            $sql_statement = "INSERT INTO `DetallesEdicionVenta`(`id_venta`, `timestamp_venta`, `timestamp_edicion`, `tipo_edicion`, `antes`, `despues`) 
                              VALUES ('$id_venta', '$timestamp_venta', '$timestamp_edicion', '$tipo_edicion', '$antes', '$despues')";
            $query = $db->query($sql_statement);
            $db->close();
            return $query->affectedRows();
        }

        public function getInfoJSONVentas($id_venta, $timeStamp){
            $db = new Db();
            $sql_statement = "SELECT Ventas.metodo_pago, Ventas.referencia_pago 
                              FROM Ventas 
                              WHERE Ventas.id_venta='$id_venta' AND Ventas.timestamp='$timeStamp'";
            $account = $db->query($sql_statement)->fetchAll();
            $db->close();
            return json_encode($account);
        }

        public function getInfoJSONVentasProducto($id_venta, $timeStamp, $idProducto){
            $db = new Db();
            $sql_statement = "SELECT Ventas.id_productos, Ventas.costo_producto, Ventas.cantidad_producto
                              FROM Ventas 
                              WHERE Ventas.id_venta='$id_venta' AND Ventas.timestamp='$timeStamp' AND Ventas.id_productos='$idProducto'";
            $account = $db->query($sql_statement)->fetchAll();
            $db->close();
            return json_encode($account);
        }

        public function getInfoJSONVentasTratamiento($id_venta, $timeStamp, $id_tratamiento){
            $db = new Db();
            $sql_statement = "SELECT Ventas.id_tratamiento, Ventas.monto, Ventas.costo_tratamiento
                              FROM Ventas 
                              WHERE Ventas.id_venta='$id_venta' AND Ventas.timestamp='$timeStamp' AND Ventas.id_tratamiento='$id_tratamiento'";
            $account = $db->query($sql_statement)->fetchAll();
            $db->close();
            return json_encode($account);
        }

        public function getInfoJSONClienteTratamientoEspecial($id_tratamiento, $timeStamp){
            $db = new Db();
            $sql_statement = "SELECT ClienteTratamientoEspecial.zona, ClienteTratamientoEspecial.detalle_zona
                              FROM ClienteTratamientoEspecial 
                              WHERE ClienteTratamientoEspecial.id_tratamiento='$id_tratamiento' AND ClienteTratamientoEspecial.timestamp='$timeStamp'";
            $account = $db->query($sql_statement)->fetchAll();
            $db->close();
            return json_encode($account);
        }

        public function getInfoJSONClienteBitacora($id_venta, $timeStamp, $id_tratamiento){
            $db = new Db();
            $sql_statement = "SELECT ClienteBitacora.comentarios
                              FROM ClienteBitacora 
                              WHERE ClienteBitacora.id_venta='$id_venta' AND ClienteBitacora.id_tratamiento='$id_tratamiento' AND ClienteBitacora.timestamp='$timeStamp'";
            $account = $db->query($sql_statement)->fetchAll();
            $db->close();
            return json_encode($account);
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
                              SET costo_producto='$precioUnitarioProducto', cantidad_producto='$cantidadProducto', monto='$precioTotalProducto' 
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

    function getDiferenciaDeEdicion($antes, $despues, $tipo){

        $zonas_cuerpo_array = [ '**TODO EL CUERPO**' => 23, 'Abdomen' => 17, 'Antebrazos' => 3, 'Axilas' => 2, 'Brazos' => 4, 'Entrecejo' => 12, 'Espalda' => 18, 'Frente' => 13, 'Glúteos' => 10, 'Hombro' => 19, 'Ingles' => 7, 'LSMP' => 24, 'Labio Superior' => 14, 'Lumbares' => 21, 'Manos' => 5, 'Mentón' => 16, 'Muslo' => 8, 'Nuca' => 20, 'Orejas' => 22, 'Patillas' => 15, 'Pecho' => 1, 'Pierna' => 9, 'Pubis' => 6, 'Zona Alba' => 11 ];

        $array_antes = json_decode($antes, true);
        $array_despues = json_decode($despues, true);

        if($tipo == 'Pago' || $tipo == 'Producto'){
            if(!empty($array_despues)){
                $array_antes = array_unique($array_antes);
                $array_despues = array_unique($array_despues);
                $resultado_antes = array_diff_assoc($array_antes[0], $array_despues[0]);
                $resultado_despues = array_diff_assoc($array_despues[0], $array_antes[0]);
                
                if($tipo == 'Pago'){
                    return ['', JSONtoString(json_encode($resultado_antes)), JSONtoString(json_encode($resultado_despues))];
                }else{
                    return [$array_despues[0]['id_productos'], JSONtoString(json_encode($resultado_antes)), JSONtoString(json_encode($resultado_despues))];
                }
            }else{
                return [$array_antes[0]['id_productos'], JSONtoString($antes), "**** Eliminado ****"];
            }
        }else{
            if(!empty($array_despues)){
                $nombre = '';
                $resultado_antes = [];
                $resultado_despues = [];
                $size = sizeof($array_antes);
                for($a = 0; $a < $size; $a++){
                    $nombre = $array_despues[0][0]['id_tratamiento'];
                    if (array_key_exists('zona', $array_antes[$a][0])) {
                        $zonas = explode(",", $array_antes[$a][0]['zona']);
                        $string_de_zonas = '';
                        foreach($zonas as $zona){
                            $string_de_zonas .= array_search ($zona, $zonas_cuerpo_array).",";
                        }
                        $array_antes[$a][0]['zona'] = $string_de_zonas;
                    }
                    if (array_key_exists('zona', $array_despues[$a][0])) {
                        $zonas = explode(",", $array_despues[$a][0]['zona']);
                        $string_de_zonas = '';
                        foreach($zonas as $zona){
                            $string_de_zonas .= array_search ($zona, $zonas_cuerpo_array).",";
                        }
                        $array_despues[$a][0]['zona'] = $string_de_zonas;
                    }
                    array_push($resultado_antes, array_diff_assoc($array_antes[$a][0], $array_despues[$a][0]));
                    array_push($resultado_despues, array_diff_assoc($array_despues[$a][0], $array_antes[$a][0]));
                }
                return [$nombre, JSONtoString(json_encode($resultado_antes)), JSONtoString(json_encode($resultado_despues))];
            }else{
                return [$array_antes[0][0]['id_tratamiento'], JSONtoString($antes), "**** Eliminado ****"];
            }
            
        }
    }

    function JSONtoString($json){
        $array = json_decode($json, true);
        $ans = '';
        foreach($array as $arreglo => $valor){
            if(is_array($valor)){
                foreach($valor as $a => $v){
                    if(is_array($v)){
                        foreach($v as $d => $f){
                            if(is_array($f)){
                                $ans .= $d.' -> '.$f.' | ';
                            }else{
                                $ans .= $d.' -> '.$f.' | ';
                            }
                        }
                    }else{
                        $ans .= $a.' -> '.$v.' | ';
                    }
                }
            }else{
                $ans .= $arreglo.' -> '.$valor.' | ';
            }
        }
        return $ans;
    }
?>