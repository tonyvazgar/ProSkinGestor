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
            //INSERT INTO `Cliente`(`id_cliente`, `nombre_cliente`, `apellidos_cliente`, `telefono_cliente`, `email_cliente`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5])
            $sql_statement = "INSERT INTO `Cliente`(`id_cliente`, `nombre_cliente`, `apellidos_cliente`, `telefono_cliente`, `email_cliente`)
                            VALUES ('$array[0]', '$array[1]', '$array[2]', $array[3], '$array[4]')";
            $query = $db->query($sql_statement);
            $db->close();
            return $query->affectedRows();
        }
        public function insertClienteOpcional($array){
            $db = new Db('localhost', 'root', '', 'prosking_gestor');
            //INSERT INTO `ClienteOpcional`(`id_cliente`, `fecha_cliente`, `cp_cliente`) VALUES
            $sql_statement = "INSERT INTO `ClienteOpcional`(`id_cliente`, `fecha_cliente`, `cp_cliente`)
                            VALUES ('$array[0]', '$array[1]', '$array[2]')";
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