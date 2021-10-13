<?php
    session_start();
    require_once "../../Model/Inventario/Producto.php";
    
    $ModelProducto = new Producto();

    if (isset($_POST['altaInventario'])) {
        $clave                     = mysqli_real_escape_string($con, $_POST['clave']);
        $marca                     = mysqli_real_escape_string($con, $_POST['marca']);
        $linea                     = mysqli_real_escape_string($con, str_replace("%2B", "+", $_POST['linea']));
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

    if (isset($_POST['agregarStockSubmit'])){
        $id_producto = mysqli_real_escape_string($con, $_POST['id']);
        $cantidad    = mysqli_real_escape_string($con, $_POST['stockDisponible']);
        $id_centro   = mysqli_real_escape_string($con, $_POST['idSucursal']);
        $descripcion = mysqli_real_escape_string($con, $_POST['descripcion']);
        $presentacion= mysqli_real_escape_string($con, $_POST['presentacion']);
        $precio      = mysqli_real_escape_string($con, $_POST['precio']);

        $ModelProducto -> updateInformacionProducto($id_producto, $cantidad, $id_centro, $descripcion, $presentacion, $precio);
        header("Location: ../../View/Inventario/detallesProducto.php?id={$id_producto}");
        // print_r($_POST);
    }

    if (isset($_POST['buscarProducto'])){
        // $nombre    = mysqli_real_escape_string($con, ucwords($_POST['nombre']));
        $nombre    = mysqli_real_escape_string($con, strtoupper($_POST['nombre']));
        $idSucursal= mysqli_real_escape_string($con, strtoupper($_POST['idSucursal']));

        $resultado1 = $ModelProducto->getProductoWereDescripcion($nombre, '1');
        $size_resultado1 = sizeof($resultado1);
        $resultado2 = $ModelProducto->getProductoWereDescripcion($nombre, '2');
        $size_resultado2 = sizeof($resultado2);
        $resultado3 = $ModelProducto->getProductoWereDescripcion($nombre, '3');
        $size_resultado3 = sizeof($resultado3);
        
        $colapsados = ['', '', ''];
        $colapsados[intval($idSucursal)-1] = 'show';

        echo '<div class="container"><h1>Resultados para "'.$nombre.'"</h1>';
        if(empty($resultado1) && empty($resultado2) && empty($resultado3)){
            echo "<li class='list-group-item text-center'>
                    <h1 >No hay resultados para $nombre</h1>
                   </li>";
        }else{
            echo '<div id="accordion">
            <p>
                <button class="btn btn-outline-primary" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">SONATA ('.$size_resultado1.')</button>
                <button class="btn btn-outline-secondary" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">PLAZA REAL ('.$size_resultado2.')</button>
                <button class="btn btn-outline-info" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">LA PAZ ('.$size_resultado3.')</button>
            </p>
            <div class="form-group">
                <div id="collapseOne" class="collapse'.$colapsados[0].'" aria-labelledby="headingOne" data-parent="#accordion" style="">
                    <div class="card-body">
                    <label>SONATA</label>';
                    foreach($resultado1 as $producto){
                        $sucursalProductoBuscado = $producto['centro_producto'];
                        $nombreSucursalProductoBuscado = $ModelProducto -> getNombreSucursalProducto($sucursalProductoBuscado)['nombre_sucursal'];
                        if($idSucursal == $sucursalProductoBuscado){
                            echo "<li class='list-group-item d-flex justify-content-between align-items-center'>"
                                                .$producto['nombre_producto']." ".$producto['apellidos_cliente']."<br>
                                                Descripción: ".$producto['descripcion_producto']."<br> 
                                                Presentación: ".$producto['presentacion_producto']."<br> 
                                                Costo unitario: $".$producto['costo_unitario_producto']."<br> 
                                                Piezas disponibles: ".$producto['stock_disponible_producto']."<br>
                                                <div><a class='btn btn-warning' href='detallesProducto.php?id=".$producto['id_producto']."' role='button'>Más detalles</a><br>
                                                <a class='btn btn-success' href='ventaProducto.php?id=".$producto['id_producto']."' role='button'>Venta al mostrador</a></div>
                                              </li>";
                        }else{
                            echo "<li class='list-group-item d-flex justify-content-between align-items-center'>"
                                                .$producto['nombre_producto']." ".$producto['apellidos_cliente']."<br>
                                                Descripción: ".$producto['descripcion_producto']."<br> 
                                                Presentación: ".$producto['presentacion_producto']."<br> 
                                                Costo unitario: $".$producto['costo_unitario_producto']."<br> 
                                                Piezas disponibles: ".$producto['stock_disponible_producto']."<br>
                                              </li>";
                        }
                    }
                    echo '</div>
                </div>
                
                <div id="collapseTwo" class="collapse'.$colapsados[1].'" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                    <label>PLAZA REAL</label>';
                    foreach($resultado2 as $producto){
                        $sucursalProductoBuscado = $producto['centro_producto'];
                        $nombreSucursalProductoBuscado = $ModelProducto -> getNombreSucursalProducto($sucursalProductoBuscado)['nombre_sucursal'];
                        if($idSucursal == $sucursalProductoBuscado){
                            echo "<li class='list-group-item d-flex justify-content-between align-items-center'>"
                                                .$producto['nombre_producto']." ".$producto['apellidos_cliente']."<br>
                                                Descripción: ".$producto['descripcion_producto']."<br> 
                                                Presentación: ".$producto['presentacion_producto']."<br> 
                                                Costo unitario: $".$producto['costo_unitario_producto']."<br> 
                                                Piezas disponibles: ".$producto['stock_disponible_producto']."<br>
                                                <div><a class='btn btn-warning' href='detallesProducto.php?id=".$producto['id_producto']."' role='button'>Más detalles</a><br>
                                                <a class='btn btn-success' href='ventaProducto.php?id=".$producto['id_producto']."' role='button'>Venta al mostrador</a></div>
                                              </li>";
                        }else{
                            echo "<li class='list-group-item d-flex justify-content-between align-items-center'>"
                                                .$producto['nombre_producto']." ".$producto['apellidos_cliente']."<br>
                                                Descripción: ".$producto['descripcion_producto']."<br> 
                                                Presentación: ".$producto['presentacion_producto']."<br> 
                                                Costo unitario: $".$producto['costo_unitario_producto']."<br> 
                                                Piezas disponibles: ".$producto['stock_disponible_producto']."<br>
                                              </li>";
                        }
                    }
                    echo '</div>
                </div>
                
                <div id="collapseThree" class="collapse'.$colapsados[2].'" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                    <label>LA PAZ</label>';
                    foreach($resultado3 as $producto){
                        $sucursalProductoBuscado = $producto['centro_producto'];
                        $nombreSucursalProductoBuscado = $ModelProducto -> getNombreSucursalProducto($sucursalProductoBuscado)['nombre_sucursal'];
                        if($idSucursal == $sucursalProductoBuscado){
                            echo "<li class='list-group-item d-flex justify-content-between align-items-center'>"
                                                .$producto['nombre_producto']." ".$producto['apellidos_cliente']."<br>
                                                Descripción: ".$producto['descripcion_producto']."<br> 
                                                Presentación: ".$producto['presentacion_producto']."<br> 
                                                Costo unitario: $".$producto['costo_unitario_producto']."<br> 
                                                Piezas disponibles: ".$producto['stock_disponible_producto']."<br>
                                                <div><a class='btn btn-warning' href='detallesProducto.php?id=".$producto['id_producto']."' role='button'>Más detalles</a><br>
                                                <a class='btn btn-success' href='ventaProducto.php?id=".$producto['id_producto']."' role='button'>Venta al mostrador</a></div>
                                              </li>";
                        }else{
                            echo "<li class='list-group-item d-flex justify-content-between align-items-center'>"
                                                .$producto['nombre_producto']." ".$producto['apellidos_cliente']."<br>
                                                Descripción: ".$producto['descripcion_producto']."<br> 
                                                Presentación: ".$producto['presentacion_producto']."<br> 
                                                Costo unitario: $".$producto['costo_unitario_producto']."<br> 
                                                Piezas disponibles: ".$producto['stock_disponible_producto']."<br>
                                              </li>";
                        }
                    }
                    echo '</div>
                </div>
            </div>
        </div>';
        }

        echo '</div>';
    }

    if(isset($_POST['venderProducto'])){
        $id_producto     = explode(",",mysqli_real_escape_string($con, implode(",", $_POST['id_producto_seleccionado'])));
        $precio_unitario = explode(",",mysqli_real_escape_string($con, implode(",", $_POST['precioUnitario_producto_seleccionado'])));
        $cantidad        = explode(",",mysqli_real_escape_string($con, implode(",", $_POST['cantidad_producto_seleccionado']))); //la introduce el usuario
        $stock           = explode(",",mysqli_real_escape_string($con, implode(",", $_POST['stock_producto_seleccionado'])));    //Disponibles, le serán restados $cantidad al final
        $total           = explode(",",mysqli_real_escape_string($con, implode(",", $_POST['total_producto_seleccionado'])));    //$cantidad * $precio_unitario
        $metodo_pago     = explode(",",mysqli_real_escape_string($con, implode(",", $_POST['metodoPago'])));
        $referencia_pago = explode(",",mysqli_real_escape_string($con, implode(",", $_POST['referencia'])));
        $total_metodo_pago     = explode(",",mysqli_real_escape_string($con, implode(",", $_POST['totalMetodoPago'])));

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
            $metodo_pago_temp       = json_encode(array_map(null, $metodo_pago, $total_metodo_pago));
            $referencia_pago_temp   = json_encode($referencia_pago);
            $precio_total_temp      = $total[$i];
            $precio_unitario_temp   = $precio_unitario[$i];

            //Insertar venta
            $ModelProducto->insertarVentaProducto($id_venta, '', '', $metodo_pago_temp, $referencia_pago_temp, $precio_total_temp, $timeStamp, $num_centro, '', $id_producto_temp, $precio_unitario_temp, $cantidad_producto_temp, $id_cosmetologa);
            
            //Quitar de ProductosApartados (Borrar de tabla ProductosApartados el registro)
            $ModelProducto -> deleteProductoApartadoFinalizar($id_producto_temp, $cantidad_producto_temp);
        }
        //************ FIN LOGICA PARA REGISTRAR PRODUCTOS ************
        //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        header("Location: ../../View/Ventas/detalleVenta.php?idVenta=$id_venta");
 
    }

    if (isset($_POST['buttonEliminarProducto'])) {
        $id_producto = mysqli_real_escape_string($con, $_POST['id']);
        $id_centro   = mysqli_real_escape_string($con, $_POST['idSucursal']);
        
        if ($ModelProducto->eliminarProducto($id_producto, $id_centro)){
            header("Location: exito.php");
        }else{
            //echo hubo un error;
        }
    }
?>
