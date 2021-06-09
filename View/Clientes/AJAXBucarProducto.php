<?php
    require_once "../../Model/Inventario/Producto.php";
    require_once "../../Model/Clientes/Cliente.php";

    $ModelCliente = new Cliente();
    $ModelProducto = new Producto();

    if(isset($_POST['id_producto'])){
        $id_producto = $_POST['id_producto'];
        $info = $ModelProducto->getProductoWereID($id_producto);
        echo json_encode($info[0]);
    }
?>