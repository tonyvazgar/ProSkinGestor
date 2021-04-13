<?php
    session_start();
    require_once "../../Model/Inventario/Producto.php";
    
    $ModelProducto = new Producto();

    if (isset($_POST['altaInventario'])) {
        $nombre_producto           = mysqli_real_escape_string($con, $_POST['nombre']);
        $descripcion_producto      = mysqli_real_escape_string($con, $_POST['descripcion']);
        $costo_unitario_producto   = mysqli_real_escape_string($con, $_POST['precio']);
        $stock_disponible_producto = mysqli_real_escape_string($con, $_POST['unidades']);
        $centro                    = mysqli_real_escape_string($con, $_POST['centro']);
        $id_producto               = $ModelProducto->generateIdProducto($nombre_producto);
        
        if ($ModelProducto->altaProducto($id_producto, $nombre_producto, $descripcion_producto, $costo_unitario_producto, $stock_disponible_producto, $centro)){
            header("Location: ../../View/Inventario/");
        }else{
            //echo hubo un error;
        }

    }
?>