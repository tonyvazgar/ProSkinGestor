<?php
    session_start();
    require_once "../../View/connection.php";
    require_once "../../Model/Clientes/Cliente.php";

    $ModelCliente = new Cliente();

    $idCliente = mysqli_real_escape_string($con, $_POST['id_cliente']);

    $result = $ModelCliente -> deleteClienteID($idCliente);
    
    if($result >= 2){
        print_r(true);
    } else {
        print_r(false);
    }
?>