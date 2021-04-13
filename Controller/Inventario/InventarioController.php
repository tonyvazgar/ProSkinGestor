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
    if (isset($_POST['buscarProducto'])){
        $nombre    = mysqli_real_escape_string($con, $_POST['nombre']);
        $resultado = $ModelProducto->getProductoWereNombre($nombre);
        if(sizeof($resultado) >= 1){
            $front = "<div class='container'><ul class='list-group'>";
            foreach($resultado as $producto){
                $front .= "<li class='list-group-item d-flex justify-content-between align-items-center'>"
                            .$producto['nombre_producto']." ".$producto['apellidos_cliente']."<br>
                            Descripción: ".$producto['descripcion_producto']."<br> 
                            Costo unitario: $".$producto['costo_unitario_producto']."<br> 
                            Piezas disponibles: ".$producto['stock_disponible_producto']."<br>
                            <div><a class='btn btn-warning' href='detallesProducto.php?id=".$producto['id_producto']."' role='button'>Más detalles</a></div>
                          </li>";
            }
            echo $front;
        }else{
            echo "<li class='list-group-item text-center'>
                    <h1 >No hay resultados para $nombre</h1>
                   </li>";
        }
    }
?>