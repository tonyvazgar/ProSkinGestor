<?php
    session_start();
    require_once "../../Model/Inventario/Producto.php";
    
    $ModelProducto = new Producto();

    if (isset($_POST['altaInventario'])) {
        $marca                     = mysqli_real_escape_string($con, $_POST['marca']);
        $linea                     = mysqli_real_escape_string($con, $_POST['linea']);
        $descripcion_producto      = mysqli_real_escape_string($con, strtoupper($_POST['descripcion']));
        $presentacion              = mysqli_real_escape_string($con, $_POST['presentacion']);
        $costo_unitario_producto   = mysqli_real_escape_string($con, $_POST['precio']);
        $stock_disponible_producto = mysqli_real_escape_string($con, $_POST['unidades']);
        $centro                    = mysqli_real_escape_string($con, $_POST['centro']);
        
        $id_producto               = $ModelProducto->generateIdProducto($marca);
        
        
        if ($ModelProducto->altaProducto($id_producto, $marca, $linea, $descripcion_producto, $presentacion, $stock_disponible_producto, $costo_unitario_producto, $centro)){
            header("Location: exito.php");
        }else{
            //echo hubo un error;
        }
        print_r(var_dump($_POST));
    }
    if (isset($_POST['buscarProducto'])){
        // $nombre    = mysqli_real_escape_string($con, ucwords($_POST['nombre']));
        $nombre    = mysqli_real_escape_string($con, strtoupper($_POST['nombre']));
        $resultado = $ModelProducto->getProductoWereDescripcion($nombre);
        if(sizeof($resultado) >= 1){
            $front = "<div class='container'><ul class='list-group'>";
            foreach($resultado as $producto){
                $front .= "<li class='list-group-item d-flex justify-content-between align-items-center'>"
                            .$producto['nombre_producto']." ".$producto['apellidos_cliente']."<br>
                            Descripción: ".$producto['descripcion_producto']."<br> 
                            Costo unitario: $".$producto['costo_unitario_producto']."<br> 
                            Piezas disponibles: ".$producto['stock_disponible_producto']."<br>
                            <div><a class='btn btn-warning' href='detallesProducto.php?id=".$producto['id_producto']."' role='button'>Más detalles</a><br>
                            <a class='btn btn-success' href='ventaProducto.php?id=".$producto['id_producto']."' role='button'>Vender</a></div>
                          </li>";
            }
            echo $front;
        }else{
            echo "<li class='list-group-item text-center'>
                    <h1 >No hay resultados para $nombre</h1>
                   </li>";
        }
    }

    if(isset($_POST['venderProducto'])){
        $id_producto     = mysqli_real_escape_string($con, $_POST['id']);
        $precio_unitario = mysqli_real_escape_string($con, $_POST['precioUnitario']);
        $cantidad        = mysqli_real_escape_string($con, $_POST['cantidad']); //la introduce el usuario
        $stock           = mysqli_real_escape_string($con, $_POST['stock']);    //Disponibles, le serán restados $cantidad al final
        $total           = mysqli_real_escape_string($con, $_POST['total']);    //$cantidad * $precio_unitario
        $metodo_pago     = mysqli_real_escape_string($con, $_POST['metodoPago']);

        $num_centro      = mysqli_real_escape_string($con, $_POST['centro']);
        $id_cosmetologa  = mysqli_real_escape_string($con, $_POST['idCosmetologa']);
        $date               = new DateTime("now", new DateTimeZone('America/Mexico_City') );
        $timeStamp          = strtotime($date->format('Y-m-d H:i:s'));


        $nuevo_stock = $stock - $cantidad;


        $suma_ventas = $ModelProducto->getSumVentas()[0]['numVentas'];
        $suma_ventas += 1;
        $id_venta = $id_producto.$num_centro.$id_cosmetologa.$suma_ventas;

       
        
        //Actualizar stock de producto
        $ModelProducto->updateStockProducto($id_producto, $nuevo_stock);


        //Insertar venta
        $ModelProducto->insertarVentaProducto($id_venta, '', '', $metodo_pago, $total, $timeStamp, $num_centro, '', $id_producto, $precio_unitario, $cantidad, $id_cosmetologa);

        header("Location: ../../View/Ventas/detalleVenta.php?idVenta=$id_venta");
    }
?>