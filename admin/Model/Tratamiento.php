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
    }
    function printArrayPrety($array){
        print("<pre>".print_r($array,true)."</pre>");
    }
?>