<?php
    class Tratamiento {
        function getAllTratamientos(){
            $db = new DB();
            $tratamientos = $db->query('SELECT * FROM Tratamiento')->fetchAll();
            $db->close();
            return $tratamientos;
        }

        function getPrecioTratamiento($id_tratamiento){
            $db = new DB();
            //SELECT * FROM `TratamientoPrecio` WHERE id_tratamiento = 'ACN10'
            $tratamientos = $db->query("SELECT * FROM `TratamientoPrecio` WHERE id_tratamiento = '$id_tratamiento'")->fetchAll();
            $db->close();
            return $tratamientos;

        }

        function getAllTratamientosEspecialesWhereCliente($id){
            $db = new DB();
            $tratamientos = $db->query("SELECT * FROM `ClienteTratamientoEspecial` WHERE id_cliente='$id'")->fetchAll();
            $db->close();
            return $tratamientos;
        }


        function getAllZonasCuerpo(){
            $db = new DB();
            $tratamientos = $db->query('SELECT * FROM `ZonasCuerpo` ORDER BY nombre_zona ASC')->fetchAll();
            $db->close();
            return $tratamientos;
        }

        function iniciarTratamientoCliente($id_cliente, $id_tratamiento, $sesiones, $zona, $firma, $timestamp){
            echo "Hola prros ". $id_cliente. ", ". $id_tratamiento. ", ".$sesiones.", ".$zona.", = ". $timestamp." firmado? -> ".$firma;
            //INSERT INTO `ClienteTratamiento`(`id_cliente`, `id_tratamiento`, `fecha_aplicacion`, `consentimiento`, `sesiones`, `zona_cuerpo`) VALUES
            $db = new DB();
            $sql_statement = "INSERT INTO `ClienteTratamiento`(`id_cliente`, `id_tratamiento`, `fecha_aplicacion`, `consentimiento`, `sesiones`, `zona_cuerpo`) VALUES
                              ('$id_cliente', '$id_tratamiento', '$timestamp', $firma, '$sesiones', '$zona')";
            $query = $db->query($sql_statement);
            $db->close();
            return $query->affectedRows();
        }


        function getUltimaDepilacionWhereIdCliente($id_cliente){
            //SELECT * FROM `ClienteTratamientoEspecial` WHERE id_cliente='LVG9405285' AND nombre_tratamiento='Depilacion' ORDER by timestamp DESC LIMIT 1

            $db = new DB();
            $tratamientos = $db->query("SELECT * FROM `ClienteTratamientoEspecial` WHERE id_cliente='$id_cliente' AND nombre_tratamiento='Depilacion' ORDER by timestamp DESC LIMIT 1")->fetchAll();
            $db->close();
            return $tratamientos;

        }

        function getUltimaCavitacionWhereIdCliente($id_cliente){
            //SELECT * FROM `ClienteTratamientoEspecial` WHERE id_cliente='LVG9405285' AND nombre_tratamiento='Cavitacion' ORDER by timestamp DESC LIMIT 1

            $db = new DB();
            $tratamientos = $db->query("SELECT * FROM `ClienteTratamientoEspecial` WHERE id_cliente='$id_cliente' AND nombre_tratamiento='Cavitacion' ORDER by timestamp DESC LIMIT 1")->fetchAll();
            $db->close();
            return $tratamientos;
            
        }
        
        //Insertar a venta
        function insertarVenta($id_venta, $id_cliente, $id_tratamiento, $metodo_pago, $monto, $timestamp, $centro){
            $db = new DB();
            $sql_statement = "INSERT INTO `Ventas`(`id_venta`, `id_cliente`, `id_tratamiento`, `metodo_pago`, `monto`, `timestamp`, `centro`) VALUES
                              ('$id_venta', '$id_cliente', '$id_tratamiento', $metodo_pago, '$monto', '$timestamp', '$centro')";
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
    }
?>