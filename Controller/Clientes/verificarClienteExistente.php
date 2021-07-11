<?php
    session_start();
    require_once "../../Model/Clientes/Cliente.php";

    if(isset($_POST['numero'])){
        $ModelCliente = new Cliente();
        echo json_encode($ModelCliente->buscarUsuario($_POST['numero']));
    }
?>