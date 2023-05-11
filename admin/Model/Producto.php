<?php
    include_once  __DIR__."/Db.php";
    class Producto
    {
        public function getAllProductosAsGlobalAdmin()
        {
            $db = new Db();
            $sql_statement = "SELECT Productos.*, Sucursal.nombre_sucursal FROM Productos, Sucursal WHERE Productos.centro_producto=Sucursal.id_sucursal";
            $account = $db->query($sql_statement)->fetchAll();
            $db->close();
            return $account;
        }

        public function getAllProductosAsLocalAdmin($id_sucursal)
        {
            $db = new Db();
            $sql_statement = "SELECT Productos.*, Sucursal.nombre_sucursal FROM Productos, Sucursal WHERE Productos.centro_producto=Sucursal.id_sucursal AND Productos.centro_producto='$id_sucursal'";
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


        public function getCosmetologaWhereID($id)
        {
            $db = new Db();
            $sql_statement = "SELECT * FROM `usertable` WHERE id='$id'";
            $account = $db->query($sql_statement)->fetchArray();
            $db->close();
            return $account;
        }

        public function updateInfoCosmetologa($id, $nombre, $username, $password, $code, $status, $sucursal)
        {
            $db = new DB();
            $sql_statement = "UPDATE `usertable` 
                                SET 
                                `name` = '$nombre',
                                `email` = '$username',
                                `password` = '$password',
                                `code` = '$code',
                                `status` = '$status',
                                `id_sucursal_usuario` = '$sucursal'
                                WHERE `usertable`.`id` = '$id';";
            $account = $db->query($sql_statement);
            $db->close();
            return $account->affectedRows();
        }

        public function insertNewCosmetologa($id_cliente, $nombre, $username, $password, $code, $status, $sucursal)
        {
            $db = new DB();
            $sql_statement = "INSERT INTO
                            `usertable`(`name`, `email`, `password`, `code`, `status`, `id_sucursal_usuario`)
                            VALUES
                            ('$nombre', '$username', '$password', '$code', '$status', '$sucursal')";
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