<?php
    class Usuario {
        public function getUsuarioWhereEmail($email){
            $db = new Db('localhost', 'root', '', 'prosking_gestor');
            $sql_statement = "SELECT * FROM usertable WHERE email = '$email'";
            $account = $db->query($sql_statement)->fetchArray();
            $db->close();
            return $account;
        }
    }
?>