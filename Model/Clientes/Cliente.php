<?php
    include "../../Model/Db.php";

    class Cliente {
        public function getAllUsuarios(){
            $db = new DB();
            $account = $db->query('SELECT * FROM Cliente')->fetchAll();
            $db->close();
            return $account;
        }
        public function insertUsuario($array){
            $db = new DB();
            //INSERT INTO `Cliente`(`id_cliente`, `nombre_cliente`, `apellidos_cliente`, `telefono_cliente`, `email_cliente`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5])
            $sql_statement = "INSERT INTO `Cliente`(`id_cliente`, `nombre_cliente`, `apellidos_cliente`, `telefono_cliente`, `tipo_numero_cliente`, `email_cliente`, `centro_cliente`, `creacion_cliente`, `ultima_visita_cliente`, `aviso_privacidad_cliente`)
                            VALUES ('$array[0]', '$array[1]', '$array[2]', $array[3], '$array[4]', '$array[5]', '$array[6]', '$array[7]', '$array[8]', '$array[9]')";
            $query = $db->query($sql_statement);
            $db->close();
            return $query->affectedRows();
        }
        public function insertClienteOpcional($array){
            $db = new DB();
            //INSERT INTO `ClienteOpcional`(`id_cliente`, `fecha_cliente`, `cp_cliente`) VALUES
            $sql_statement = "INSERT INTO `ClienteOpcional`(`id_cliente`, `fecha_cliente`, `cp_cliente`)
                            VALUES ('$array[0]', '$array[1]', '$array[2]')";
            $query = $db->query($sql_statement);
            $db->close();
            return $query->affectedRows();
        }
        public function insertClienteStatus($array){
            $db = new DB();
            //INSERT INTO `ClienteStatus` (`id_cliente`, `status`) VALUES ('w', 'activo');
            $sql_statement = "INSERT INTO `ClienteStatus` (`id_cliente`, `status`) 
                            VALUES ('$array[0]', '$array[1]')";
            $query = $db->query($sql_statement);
            $db->close();
            return $query->affectedRows();

        }
        public function getClienteWhereNombreLike($nombre){
            $db = new DB();
            //SELECT * FROM ClienteOpcional, (SELECT * FROM `Cliente` WHERE BINARY nombre_cliente LIKE '%maria%') AS Nombre WHERE ClienteOpcional.id_cliente=Nombre.id_cliente
            $sql_statement = "SELECT * 
                              FROM ClienteOpcional, (SELECT * FROM `Cliente` WHERE BINARY nombre_cliente LIKE '%$nombre%') AS Nombre 
                              WHERE ClienteOpcional.id_cliente = Nombre.id_cliente";
            $account = $db->query($sql_statement)->fetchAll();
            $db->close();
            return $account;
        }
        public function getClienteWhereID($id){
            $db = new DB();
            $sql_statement = "SELECT * FROM Cliente, ClienteOpcional, ClienteStatus 
                              WHERE Cliente.id_cliente='$id' 
                              AND Cliente.id_cliente = ClienteOpcional.id_cliente
                              AND ClienteStatus.id_cliente = ClienteOpcional.id_cliente";
            $account = $db->query($sql_statement)->fetchAll();
            $db->close();
            return $account;
        }
        public function updateCliente($array){
            $db = new DB();
            
            $sql_statement = "UPDATE Cliente, ClienteOpcional 
                              SET Cliente.nombre_cliente = '$array[1]',
                              Cliente.apellidos_cliente = '$array[2]',
                              Cliente.telefono_cliente = '$array[3]',
                              Cliente.tipo_numero_cliente = '$array[4]',
                              Cliente.email_cliente = '$array[5]',
                              Cliente.centro_cliente = '$array[6]',
                              Cliente.creacion_cliente = '$array[7]',
                              Cliente.ultima_visita_cliente = '$array[8]',
                              ClienteOpcional.fecha_cliente = '$array[9]',
                              ClienteOpcional.cp_cliente = '$array[10]'
                              WHERE Cliente.id_cliente=ClienteOpcional.id_cliente 
                              AND Cliente.id_cliente='$array[0]'";

            $account = $db->query($sql_statement);
            $db->close();
            return $account->affectedRows();
        }
    }
?>