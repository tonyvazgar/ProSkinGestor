<?php
    require_once "../../Model/Inventario/Producto.php";
    include "../../Model/Db.php";
    $ModelProducto = new Producto();

    //------------------------------------------------------------------------------------------
    $id_producto       = $_POST['id_producto'];
    $cantidad_producto = $_POST['cantidad_producto'];
    $stock_original_producto = $_POST['stock_original_producto'];
    $nuevo_stock_temp  = $stock_original_producto - $cantidad_producto;
    $id_cosmetologa    = $_POST['id_cosmetologa'];
    $id_centro         = $_POST['id_centro'];

    $date              = new DateTime("now", new DateTimeZone('America/Mexico_City') );
    $timeStampInicial  = strtotime($date->format('H:i'));

    $timeStampFinal    = strtotime("+5 minute", $timeStampInicial);

    $diferencia        = ($timeStampFinal - $timeStampInicial)/60;
    //------------------------------------------------------------------------------------------
    // 1) Pasar esos quitados a la tabla de productosApartados
    $ModelProducto -> insertProductosApartados($id_producto, $id_centro, $cantidad_producto, $id_cosmetologa, $timeStampInicial, $timeStampFinal);
    
    // 2) Quitar stock de Productos
    $ModelProducto -> updateStockProducto($id_producto, $nuevo_stock_temp, $id_centro);

    // 3) verificar el tiempo?
    // 4) si se completa, restar y confirmar
    //------------------------------------------------------------------------------------------
    echo json_encode(['id_producto' => $id_producto,
                      'stock_original_producto' => $stock_original_producto,
                      'cantidad_producto' => $cantidad_producto, 
                      'nuevo_stock_temp' => $nuevo_stock_temp,
                      'id_cosmetologa' => $id_cosmetologa, 
                      'timeStampInicial' => $timeStampInicial, 
                      'timeStampFinal' => $timeStampFinal,
                      'diferencia' => $diferencia,
                      'id_centro' => $id_centro]);

?>