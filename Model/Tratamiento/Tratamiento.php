<?php
    class Tratamiento {
        function getAllTratamientos(){
            $db = new DB();
            $tratamientos = $db->query('SELECT * FROM Tratamiento')->fetchAll();
            $db->close();
            return $tratamientos;
        }

        function iniciarTratamientoCliente($id_cliente, $id_tratamiento, $timestamp){
            echo "Hola prros ". $id_cliente. ", ". $id_tratamiento. ", = ". $timestamp;
        }
    }
?>