<?php
    include_once '../Model/Producto.php';
    $ModelProducto = new Producto();

    // Recepción de los datos enviados mediante POST desde el JS
    $product_id           = (isset($_POST['product_id'])) ? $_POST['product_id'] : '';
    $product_brand        = (isset($_POST['product_brand'])) ? $_POST['product_brand'] : '';
    $opcion               = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
    $product_line         = (isset($_POST['product_line'])) ? $_POST['product_line'] : '';
    $product_description  = (isset($_POST['product_description'])) ? $_POST['product_description'] : '';
    $product_presentation = (isset($_POST['product_presentation'])) ? $_POST['product_presentation'] : '';
    $product_stock        = (isset($_POST['product_stock'])) ? $_POST['product_stock'] : '';
    $product_cost         = (isset($_POST['product_cost'])) ? $_POST['product_cost'] : '';
    $product_sucursal     = (isset($_POST['product_sucursal'])) ? $_POST['product_sucursal'] : '';

    switch($opcion) {
        case 1: //Alta producto
            $data = $ModelProducto -> insertNewProducto($product_id, $product_brand, $product_line, $product_description, $product_presentation, $product_stock, $product_cost, $product_sucursal);
            break;
        case 2: //Update Producto
            $infoBeforeUpdate = $ModelProducto -> getProductoWhere($product_id, $product_sucursal);
            $product_id = $infoBeforeUpdate['id_producto'] != $product_id ? $product_id: $infoBeforeUpdate['id_producto'];
            $product_brand = $infoBeforeUpdate['marca_producto'] != $product_brand ? $product_brand: $infoBeforeUpdate['marca_producto'];
            $product_line = $infoBeforeUpdate['linea_producto'] != $product_line ? $product_line: $infoBeforeUpdate['linea_producto'];
            $product_description = $infoBeforeUpdate['descripcion_producto'] != $product_description ? $product_description: $infoBeforeUpdate['descripcion_producto'];
            $product_presentation = $infoBeforeUpdate['presentacion_producto'] != $product_presentation ? $product_presentation: $infoBeforeUpdate['presentacion_producto'];
            $product_stock = $infoBeforeUpdate['stock_disponible_producto'] != $product_stock ? $product_stock: $infoBeforeUpdate['stock_disponible_producto'];
            $product_cost = $infoBeforeUpdate['costo_unitario_producto'] != $product_cost ? $product_cost: $infoBeforeUpdate['costo_unitario_producto'];
            $product_sucursal = $infoBeforeUpdate['centro_producto'] != $product_sucursal ? $product_sucursal: $infoBeforeUpdate['centro_producto'];

            $ModelProducto -> updateInfoProducto($product_id, $product_brand, $product_line, $product_description, $product_presentation, $product_stock, $product_cost, $product_sucursal);

            $data = $ModelProducto -> getProductoWhere($product_id, $product_sucursal);
            break;
    }

    echo json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
    $conexion = NULL;
?>