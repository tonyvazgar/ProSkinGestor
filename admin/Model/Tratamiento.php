<?php
    include_once  __DIR__."/Db.php";

    class Tratamiento
    {
        public function getAllTratamientos()
        {
            $db = new Db();
            $sql_statement = "SELECT Tratamiento.*, TratamientoPrecio.precio FROM Tratamiento, TratamientoPrecio WHERE Tratamiento.id_tratamiento=TratamientoPrecio.id_tratamiento ORDER BY Tratamiento.nombre_tratamiento ASC";
            $account = $db->query($sql_statement)->fetchAll();
            $db->close();
            return $account;
        }

        public function insertNewTratamiento($tratamiento_id, $tratamiento_name, $tratamiento_price, $tratamiento_duration, $tratamiento_consentimiento)
        {
            $db = new DB();
            $sqlStatementTratamiento = "INSERT INTO `Tratamiento`(`id_tratamiento`, `nombre_tratamiento`, `duracion_tratamiento`, `consentimiento_tratamiento`) 
                                VALUES ('$tratamiento_id','$tratamiento_name','$tratamiento_duration','$tratamiento_consentimiento')";
            $query = $db->query($sqlStatementTratamiento);


            $sqlStatementTratamientoPrecio = "INSERT INTO `TratamientoPrecio`(`id_tratamiento`, `precio`)
                                                VALUES ('$tratamiento_id','$tratamiento_price')";
            $query = $db->query($sqlStatementTratamientoPrecio);
            $db->close();
            return $query->affectedRows();
        }

        public function getTratamientoWhere($tratamiento_id)
        {
            $db = new Db();
            $selectStatement = "SELECT *
                                FROM Tratamiento, TratamientoPrecio
                                WHERE Tratamiento.id_tratamiento='$tratamiento_id' 
                                AND Tratamiento.id_tratamiento=TratamientoPrecio.id_tratamiento 
                                ORDER BY Tratamiento.nombre_tratamiento ASC";
            $account = $db->query($selectStatement)->fetchArray();
            $db->close();
            return $account;
        }

        public function updateInfoTratamiento($tratamiento_id, $tratamiento_name, $tratamiento_price, $tratamiento_duration, $tratamiento_consentimiento)
        {
            $db = new DB();
            $sql_statement = "UPDATE `Tratamiento`
                                SET `id_tratamiento` = '$tratamiento_id', `nombre_tratamiento` = '$tratamiento_name', `duracion_tratamiento` = '$tratamiento_duration', `consentimiento_tratamiento` = '$tratamiento_consentimiento'
                                WHERE `Tratamiento`.`id_tratamiento` = '$tratamiento_id';";
            $account = $db->query($sql_statement);

            $sql_statement = "UPDATE `TratamientoPrecio`
                                SET `id_tratamiento` = '$tratamiento_id', `precio` = '$tratamiento_price'
                                WHERE `TratamientoPrecio`.`id_tratamiento` = '$tratamiento_id';";
            $account = $db->query($sql_statement);

            $db->close();
            return $account->affectedRows();
        }
    }
    function printArrayPrety($array){
        print("<pre>".print_r($array,true)."</pre>");
    }
?>