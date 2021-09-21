<?php
    session_start();
    require_once "../../View/connection.php";
    require_once "../../Model/Ventas/Venta.php";
    require_once "../../Model/Inventario/Producto.php";
    include "../../Model/Db.php";

    $ModelVenta = new Venta();
    $ModelProducto = new Producto();
    

    // //------------------------------------------------------------------------------------------
    $id_producto       = mysqli_real_escape_string($con, $_POST['id_producto']);  
    $id_venta          = mysqli_real_escape_string($con, $_POST['id_venta']);
    $timestamp = mysqli_real_escape_string($con, $_POST['timestamp']); //timestamp

    $id_centro = $ModelVenta->getTodosLosDetallesVenta($id_venta)[0]['centro'];

    $stockFromDB       = $ModelProducto->getStockProducto($id_producto, $id_centro);
    $stock             = mysqli_real_escape_string($con, $_POST['stock']);
    $nuevo_stock    = $stock + $stockFromDB;
    
    $antes_de_Actualizar = $ModelVenta->getInfoJSONVentasProducto($id_venta, $timestamp, $id_producto);
    $date = new DateTime("now", new DateTimeZone('America/Mexico_City') );
    $timeStampEdicion = strtotime($date->format('Y-m-d H:i:s'));

    if($ModelVenta->deleteProductoFromVenta($id_venta, $id_producto) >= 1){
        $despues_de_Actualizar = $ModelVenta->getInfoJSONVentasProducto($id_venta, $timestamp, $id_producto);
        $ModelVenta->insertIntoDetallesEdicionVenta($id_venta, $timestamp, $timeStampEdicion, 'Producto', $antes_de_Actualizar, $despues_de_Actualizar);
        $ModelProducto->updateStockProducto($id_producto, $nuevo_stock, $id_centro);
        print_r(true);
    } else {
        print_r(false);
    }

?>