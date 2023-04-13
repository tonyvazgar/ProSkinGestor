<?php
    include_once  __DIR__."/Db.php";
    class Cosmetologa
    {
        public function getAllCometologas()
        {
            $db = new Db();
            $sql_statement = "SELECT * FROM `usertable`";
            $account = $db->query($sql_statement)->fetchAll();
            $db->close();
            return $account;
        }
        public function getAllSucursales()
        {
            $db = new Db();
            $sql_statement = "SELECT * FROM `Sucursal`";
            $account = $db->query($sql_statement)->fetchAll();
            $db->close();
            return $account;
        }

        public function getLastCosmetologa()
        {
            $db = new Db();
            $sql_statement = "SELECT * FROM usertable ORDER BY id DESC LIMIT 1";
            $account = $db->query($sql_statement)->fetchAll();
            $db->close();
            return $account;
        }

        public function getCosmetologaWhereID($id)
        {
            $db = new Db();
            $sql_statement = "SELECT * FROM `usertable` WHERE id='$id'";
            $account = $db->query($sql_statement)->fetchArray();
            $db->close();
            return $account;
        }

        public function updateInfoCosmetologa($id, $nombre, $username, $password, $sucusal, $rol)
        {
            $db = new DB();
            $sql_statement = "UPDATE `usertable` 
                                SET 
                                `name` = '$nombre',
                                `email` = '$username',
                                `password` = '$password',
                                `code` = '$rol',
                                `status` = '$rol',
                                `id_sucursal_usuario` = '$sucusal'
                                WHERE `usertable`.`id` = '$id';";

            $account = $db->query($sql_statement);
            $db->close();
            return $account->affectedRows();
        }

        public function insertNewCosmetologa($id_cliente, $nombre, $username, $password, $sucusal, $rol)
        {
            $db = new DB();
            $sql_statement = "INSERT INTO
                            `usertable`(`name`, `email`, `password`, `code`, `status`, `id_sucursal_usuario`)
                            VALUES
                            ('$nombre', '$username', '$password', '$rol', '$rol', '$sucusal')";
            $query = $db->query($sql_statement);
            $db->close();
            return $query->affectedRows();
        }

        public function deleteCosmetologa($username)
        {

        }
    }
    function printArrayPrety($array){
        print("<pre>".print_r($array,true)."</pre>");
    }

?>