<?php
    include_once  __DIR__."/Db.php";

    class Cliente {
        public function getAllUsuarios($initial_date, $end_date){
            $db = new DB();
            $query_string = "SELECT *
                            FROM Cliente, ClienteOpcional, ClienteStatus, Sucursal 
                            WHERE Cliente.id_cliente=ClienteOpcional.id_cliente 
                            AND ClienteOpcional.id_cliente=ClienteStatus.id_cliente
                            AND Sucursal.id_sucursal=Cliente.centro_cliente
                            AND creacion_cliente BETWEEN $initial_date AND $end_date";
            $account = $db->query($query_string)->fetchAll();
            $db->close();
            return $account;
        }


        public function getAllUsuariosFromIdSucursal($initial_date, $end_date, $id_sucursal){
            $db = new DB();
            $query_string = "SELECT *
                            FROM Cliente, ClienteOpcional, ClienteStatus, Sucursal 
                            WHERE Cliente.id_cliente=ClienteOpcional.id_cliente 
                            AND ClienteOpcional.id_cliente=ClienteStatus.id_cliente
                            AND Sucursal.id_sucursal=Cliente.centro_cliente
                            AND Cliente.centro_cliente='$id_sucursal'
                            AND creacion_cliente BETWEEN $initial_date AND $end_date";
            $account = $db->query($query_string)->fetchAll();
            $db->close();
            return $account;
        }
    }
?>