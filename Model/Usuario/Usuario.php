<?php
    class Usuario {
        public function getUsuarioWhereEmail($email){
            $db = new Db();
            $sql_statement = "SELECT * FROM Usuarios WHERE email = '$email'";
            $account = $db->query($sql_statement)->fetchArray();
            $db->close();
            return $account;
        }
        public function getNombreSucursalUsuario($email_usuario){
            $db = new Db();
            //SELECT Sucursal.nombre_sucursal FROM Sucursal, Usuarios WHERE Sucursal.id_sucursal = Usuarios.id_sucursal_usuario AND Usuarios.id=9

            $sql_statement = "SELECT Sucursal.nombre_sucursal 
                              FROM Sucursal, Usuarios 
                              WHERE Sucursal.id_sucursal = Usuarios.id_sucursal_usuario AND Usuarios.email = '$email_usuario'";
            $account = $db->query($sql_statement)->fetchArray();
            $db->close();
            return $account;
        }
        public function getNombreSucursalWhereIDSucursal($id_sucursal){
            $db = new Db();
            //SELECT Sucursal.nombre_sucursal FROM Sucursal, Usuarios WHERE Sucursal.id_sucursal = Usuarios.id_sucursal_usuario AND Usuarios.id=9

            $sql_statement = "SELECT nombre_sucursal 
                              FROM `Sucursal` 
                              WHERE id_sucursal='$id_sucursal'";
            $account = $db->query($sql_statement)->fetchArray();
            $db->close();
            return $account;
        }

        public function getIdCosmetologa($email){
            $db = new Db();
            $sql_statement = "SELECT id FROM Usuarios WHERE email = '$email'";
            $account = $db->query($sql_statement)->fetchArray();
            $db->close();
            return $account;
        }

        public function getNumeroSucursalUsuario($email_usuario){
            $db = new Db();
            //SELECT Sucursal.nombre_sucursal FROM Sucursal, Usuarios WHERE Sucursal.id_sucursal = Usuarios.id_sucursal_usuario AND Usuarios.id=9

            $sql_statement = "SELECT Sucursal.id_sucursal 
                              FROM Sucursal, Usuarios 
                              WHERE Sucursal.id_sucursal = Usuarios.id_sucursal_usuario AND Usuarios.email = '$email_usuario'";
            $account = $db->query($sql_statement)->fetchArray();
            $db->close();
            return $account;
        }
    }
?>