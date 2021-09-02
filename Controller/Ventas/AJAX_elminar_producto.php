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

    $id_centro = $ModelVenta->getTodosLosDetallesVenta($id_venta)[0]['centro'];

    $stockFromDB       = $ModelProducto->getStockProducto($id_producto, $id_centro);
    $stock             = mysqli_real_escape_string($con, $_POST['stock']);
    $nuevo_stock    = $stock + $stockFromDB;
    
    

    if($ModelVenta->deleteProductoFromVenta($id_venta, $id_producto) >= 1){
        $ModelProducto->updateStockProducto($id_producto, $nuevo_stock, $id_centro);
        print_r(true);
    } else {
        print_r(false);
    }

?>