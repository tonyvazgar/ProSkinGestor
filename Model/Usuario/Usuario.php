<?php
    class Usuario {
        public function getUsuarioWhereEmail($email){
            $db = new Db();
            $sql_statement = "SELECT * FROM usertable WHERE email = '$email'";
            $account = $db->query($sql_statement)->fetchArray();
            $db->close();
            return $account;
        }
        public function getNombreSucursalUsuario($email_usuario){
            $db = new Db();
            //SELECT Sucursal.nombre_sucursal FROM Sucursal, usertable WHERE Sucursal.id_sucursal = usertable.id_sucursal_usuario AND usertable.id=9

            $sql_statement = "SELECT Sucursal.nombre_sucursal 
                              FROM Sucursal, usertable 
                              WHERE Sucursal.id_sucursal = usertable.id_sucursal_usuario AND usertable.email = '$email_usuario'";
            $account = $db->query($sql_statement)->fetchArray();
            $db->close();
            return $account;
        }

        public function getIdCosmetologa($email){
            $db = new Db();
            $sql_statement = "SELECT id FROM usertable WHERE email = '$email'";
            $account = $db->query($sql_statement)->fetchArray();
            $db->close();
            return $account;
        }

        public function getNumeroSucursalUsuario($email_usuario){
            $db = new Db();
            //SELECT Sucursal.nombre_sucursal FROM Sucursal, usertable WHERE Sucursal.id_sucursal = usertable.id_sucursal_usuario AND usertable.id=9

            $sql_statement = "SELECT Sucursal.id_sucursal 
                              FROM Sucursal, usertable 
                              WHERE Sucursal.id_sucursal = usertable.id_sucursal_usuario AND usertable.email = '$email_usuario'";
            $account = $db->query($sql_statement)->fetchArray();
            $db->close();
            return $account;
        }
    }
?>