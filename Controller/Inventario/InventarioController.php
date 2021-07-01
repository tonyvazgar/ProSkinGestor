<?php
    session_start();
    require_once "../../Model/Inventario/Producto.php";
    
    $ModelProducto = new Producto();

    if (isset($_POST['altaInventario'])) {
        $clave                     = mysqli_real_escape_string($con, $_POST['clave']);
        $marca                     = mysqli_real_escape_string($con, $_POST['marca']);
        $linea                     = mysqli_real_escape_string($con, $_POST['linea']);
        $descripcion_producto      = mysqli_real_escape_string($con, strtoupper($_POST['descripcion']));
        $presentacion              = mysqli_real_escape_string($con, $_POST['presentacion']);
        $costo_unitario_producto   = mysqli_real_escape_string($con, $_POST['precio']);
        $stock_disponible_producto = mysqli_real_escape_string($con, $_POST['unidades']);
        $centro                    = mysqli_real_escape_string($con, $_POST['centro']);
        
        if ($ModelProducto->altaProducto($clave, $marca, $linea, $descripcion_producto, $presentacion, $stock_disponible_producto, $costo_unitario_producto, $centro)){
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
        $id_producto     = explode(",",mysqli_real_escape_string($con, implode(",", $_POST['id_producto_seleccionado'])));
        $precio_unitario = explode(",",mysqli_real_escape_string($con, implode(",", $_POST['precioUnitario_producto_seleccionado'])));
        $cantidad        = explode(",",mysqli_real_escape_string($con, implode(",", $_POST['cantidad_producto_seleccionado']))); //la introduce el usuario
        $stock           = explode(",",mysqli_real_escape_string($con, implode(",", $_POST['stock_producto_seleccionado'])));    //Disponibles, le serán restados $cantidad al final
        $total           = explode(",",mysqli_real_escape_string($con, implode(",", $_POST['total_producto_seleccionado'])));    //$cantidad * $precio_unitario
        $metodo_pago     = mysqli_real_escape_string($con, $_POST['metodoPago']);

        $num_centro      = mysqli_real_escape_string($con, $_POST['centro']);
        $id_cosmetologa  = mysqli_real_escape_string($con, $_POST['idCosmetologa']);
        $date               = new DateTime("now", new DateTimeZone('America/Mexico_City') );
        $timeStamp          = strtotime($date->format('Y-m-d H:i:s'));



        $numero_de_productos   = sizeof($id_producto);
        $suma_ventas = $ModelProducto->getSumVentas()[0]['numVentas'];
        $suma_ventas += 1;
        $id_venta = $id_producto[0].$num_centro.$id_cosmetologa.$suma_ventas;

        //************LOGICA PARA REGISTRAR 1 O MUCHOS PRODUCTOS EN UN POST************
        for ($i=0; $i <= $numero_de_productos-1 ; $i++) { 
            $id_producto_temp       = $id_producto[$i];
            $stock_inicial_temp     = $stock[$i];
            $cantidad_producto_temp = $cantidad[$i];
            $nuevo_stock_temp       = $stock_inicial_temp - $cantidad_producto_temp;
            $metodo_pago_temp       = $metodo_pago;
            $precio_total_temp      = $total[$i];
            $precio_unitario_temp   = $precio_unitario[$i];

            //Insertar venta
            $ModelProducto->insertarVentaProducto($id_venta, '', '', $metodo_pago_temp, $precio_total_temp, $timeStamp, $num_centro, '', $id_producto_temp, $precio_unitario_temp, $cantidad_producto_temp, $id_cosmetologa);
            
            //Quitar de ProductosApartados (Borrar de tabla ProductosApartados el registro)
            $ModelProducto -> deleteProductoApartadoFinalizar($id_producto_temp, $cantidad_producto_temp);
        }
        //************ FIN LOGICA PARA REGISTRAR PRODUCTOS ************
        //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        header("Location: ../../View/Ventas/detalleVenta.php?idVenta=$id_venta");
 
    }
?>