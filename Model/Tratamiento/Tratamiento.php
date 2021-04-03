<?php
    class Tratamiento {
        function getAllTratamientos(){
            $db = new DB();
            $tratamientos = $db->query('SELECT * FROM Tratamiento')->fetchAll();
            $db->close();
            return $tratamientos;
        }


        function getAllZonasCuerpo(){
            $db = new DB();
            $tratamientos = $db->query('SELECT * FROM `ZonasCuerpo`')->fetchAll();
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
    }
?>