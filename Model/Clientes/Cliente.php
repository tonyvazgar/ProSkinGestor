<?php
    include "../../Model/Db.php";

    class Cliente {
        public function getAllUsuarios(){
            $db = new Db('localhost', 'root', '', 'prosking_gestor');
            $account = $db->query('SELECT * FROM Cliente')->fetchAll();
            $db->close();
            return $account;
        }
        public function insertUsuario($array){
            $db = new Db('localhost', 'root', '', 'prosking_gestor');
            $sql_statement = "INSERT INTO `Cliente`(`Nombre`, `Edad`, `Numero`) 
                            VALUES ('$array[0]', $array[1], '$array[2]')";
            $query = $db->query($sql_statement);
            $db->close();
            return $query->affectedRows();
        }
        public function getCliente($nombre){
            $db = new Db('localhost', 'root', '', 'prosking_gestor');
            $sql_statement = "SELECT * FROM `Cliente` WHERE
                            Nombre='$nombre'";
            $account = $db->query($sql_statement)->fetchAll();
            $db->close();
            return $account;
        }
        public function getClienteWhereID($id){
            $db = new Db('localhost', 'root', '', 'prosking_gestor');
            $sql_statement = "SELECT * FROM `Cliente` WHERE
                            ID_cliente='$id'";
            $account = $db->query($sql_statement)->fetchAll();
            $db->close();
            return $account;
        }
        public function updateCliente($array){
            $db = new Db('localhost', 'root', '', 'prosking_gestor');
            $sql_statement = "UPDATE `Cliente` SET `Nombre` = '$array[1]', `Edad` = '$array[2]',`Numero` = '$array[3]' WHERE `Cliente`.`ID_cliente` = '$array[0]'";
            $account = $db->query($sql_statement);
            $db->close();
            return $account->affectedRows();
        }
    }
?>