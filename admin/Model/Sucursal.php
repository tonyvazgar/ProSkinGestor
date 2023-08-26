<?php
    include_once  __DIR__."/Db.php";
    class Sucursal
    {
        public function getAllSucursales()
        {
            $db = new Db();
            $sql_statement = "SELECT * FROM `Sucursal`";
            $account = $db->query($sql_statement)->fetchAll();
            $db->close();
            return $account;
        }

        public function updateInfoSucursal($sucursal_id, $sucursal_nombre)
        {
            $db = new DB();
            $sql_statement = "UPDATE `Sucursal`
                                SET `nombre_sucursal` = '$sucursal_nombre'
                                WHERE `Sucursal`.`id_sucursal` = '$sucursal_id';";
            $account = $db->query($sql_statement);
            $db->close();
            return $account->affectedRows();
        }
        public function getSucursalWhere($sucursal_id)
        {
            $db = new Db();
            $selectStatement = "SELECT * 
                                FROM `Sucursal`
                                WHERE Sucursal.id_sucursal='$sucursal_id'";
                                print_r($selectStatement);
            $account = $db->query($selectStatement)->fetchArray();
            $db->close();
            return $account;
        }

        public function insertNewSucursal($sucursal_name)
        {
            $db = new DB();
            $sql_statement = "INSERT INTO `Sucursal` (`id_sucursal`, `nombre_sucursal`)
                                VALUES (NULL,'$sucursal_name')";
            $query = $db->query($sql_statement);
            $db->close();
            return $query->affectedRows();
        }

        public function getCierresDeCajaFromCentro($id_sucursal, $primer_dia, $ultimo_dia){
            $db = new Db();
            $sql_statement_todo = "SELECT * 
                                    FROM CorteDeCaja, Sucursal
                                    WHERE id_centro='$id_sucursal' 
                                    AND timestamp BETWEEN $primer_dia AND $ultimo_dia
                                    AND CorteDeCaja.id_centro=Sucursal.id_sucursal
                                    ORDER BY timestamp DESC";
            $info = $db->query($sql_statement_todo)->fetchAll();
            $db->close();
            return $info;
        }

        public function getCierresDeCaja($primer_dia, $ultimo_dia){
            $db = new Db();
            $sql_statement_todo = "SELECT *
                                    FROM CorteDeCaja, Sucursal
                                    WHERE timestamp BETWEEN $primer_dia AND $ultimo_dia
                                    AND CorteDeCaja.id_centro=Sucursal.id_sucursal
                                    ORDER BY timestamp DESC";
            $info = $db->query($sql_statement_todo)->fetchAll();
            $db->close();
            return $info;
        }

    }
    // function printArrayPrety($array){
    //     print("<pre>".print_r($array,true)."</pre>");
    // }

?>