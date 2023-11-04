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

        $mensaje                   = urlencode("Agregaste el producto al inventario con el ID ".$clave." existosamente");
        $link                      = urlencode("detallesProducto.php?id=".$clave);

        if ($ModelProducto->altaProducto($clave, $marca, $linea, $descripcion_producto, $presentacion, $stock_disponible_producto, $costo_unitario_producto, $centro)){
            header("Location: exito.php?mensaje=".$mensaje."&link=".$link);
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

        $sucursalesFromDB = $ModelProducto -> getAllSucursales();
        $idSucusales      = [];
        $resultados       = [];
        $colapsados       = [];
        $tamaños          = [];

        foreach ($sucursalesFromDB as $unaSucursal) {
            $nombreSucursalFromArray = $unaSucursal['nombre_sucursal'];
            $idSucursalFromArray     = $unaSucursal['id_sucursal'];
            $resultado               = $ModelProducto->getProductoWereDescripcion($nombre, $idSucursalFromArray);

            $size_resultado = sizeof($resultado);
            $resultados[$nombreSucursalFromArray] = $resultado;
            $tamaños[$nombreSucursalFromArray] = $size_resultado;
            $idSucusales[$nombreSucursalFromArray] = $idSucursalFromArray;
            $colapsados[$nombreSucursalFromArray] = $idSucursalFromArray == $idSucursal ? 'show' : ''; // Agrega un elemento vacío a $colapsados por cada sucursal

        }
        
        echo '<div class="container"><h1>Resultados para "'.$nombre.'"</h1>';
        if(array_sum($tamaños) == 0){
            echo "<li class='list-group-item text-center'>
                    <h1 >No hay resultados para $nombre</h1>
                   </li>";
        }else{
            $botonesResultados = '<p>';
            $divsResultados = '';
            foreach ($resultados as $resultadoKey => $resultadoValue) {
                $classDiv = str_replace(' ', '', $resultadoKey);
                $botonesResultados .= '<button
                                            class="btn btn-outline-primary"
                                            type="button"
                                            data-toggle="collapse"
                                            data-target="#collapse'.$classDiv.'"
                                            aria-expanded="false"
                                            aria-controls="collapse'.$classDiv.'">'
                                            .$resultadoKey.' ('.$tamaños[$resultadoKey].')
                                        </button>';


                $divsResultados .= '
                    <div id="collapse'.$classDiv.'" class="collapse'.$colapsados[$resultadoKey].'" aria-labelledby="heading'.$classDiv.'" data-parent="#accordion">
                        <div class="card-body">
                            <label>'.$resultadoKey.'</label>';
                            foreach($resultadoValue as $producto){
                                $sucursalProductoBuscado = $idSucusales[$resultadoKey];
                                $nombreSucursalProductoBuscado = $resultadoKey;
                                if($idSucursal == $sucursalProductoBuscado){
                                    $divsResultados .= "<li class='list-group-item d-flex justify-content-between align-items-center'>"
                                                        .$producto['nombre_producto']." ".$producto['apellidos_cliente']."<br>
                                                        Descripción: ".$producto['descripcion_producto']."<br> 
                                                        Presentación: ".$producto['presentacion_producto']."<br> 
                                                        Costo unitario: $".$producto['costo_unitario_producto']."<br> 
                                                        Piezas disponibles: ".$producto['stock_disponible_producto']."<br>
                                                        <div><a class='btn btn-warning' href='detallesProducto.php?id=".$producto['id_producto']."' role='button'>Más detalles</a><br>
                                                        <a class='btn btn-success' href='ventaProducto.php?id=".$producto['id_producto']."' role='button'>Venta al mostrador</a></div>
                                                    </li>";
                                }else{
                                    $divsResultados .= "<li class='list-group-item d-flex justify-content-between align-items-center'>"
                                                        .$producto['nombre_producto']." ".$producto['apellidos_cliente']."<br>
                                                        Descripción: ".$producto['descripcion_producto']."<br> 
                                                        Presentación: ".$producto['presentacion_producto']."<br> 
                                                        Costo unitario: $".$producto['costo_unitario_producto']."<br> 
                                                        Piezas disponibles: ".$producto['stock_disponible_producto']."<br>
                                                    </li>";
                                }
                            }
                        $divsResultados .= '</div>
                    </div>
                    ';
            }

            $botonesResultados .= '<p>';
            

            echo '<div id="accordion">
                    '.$botonesResultados.'
            <div class="form-group">
                '.$divsResultados.'
            </div>
        </div>';
        }

        echo '</div>';
    }

    if(isset($_POST['venderProducto'])){
        date_default_timezone_set('America/Mexico_City');
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
        $formato_con_hora = $date->format('Y-m-d H:i:s');
        $timeStamp          = strtotime($formato_con_hora);

        $corte = $ModelProducto->existeCorteCaja(strtotime($date->format('Y-m-d')), $num_centro);
        if($corte){
            $la_fecha = $date;
            $la_fecha->modify('+'.(1).' days');
            $timeStamp = strtotime($la_fecha->format('Y-m-d 10:00:00'));
        }


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
        if($corte){
            $ModelProducto->insertVentasDesplazadas($id_venta, strtotime($formato_con_hora), $timeStamp);
        }
        //************ FIN LOGICA PARA REGISTRAR PRODUCTOS ************
        //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        header("Location: ../../View/Ventas/detalleVenta.php?idVenta=$id_venta");
 
    }

    if (isset($_POST['buttonEliminarProducto'])) {
        $id_producto = mysqli_real_escape_string($con, $_POST['id']);
        $id_centro   = mysqli_real_escape_string($con, $_POST['idSucursal']);
        $mensaje     = urlencode("Eliminaste el producto con el ID ".$id_producto." existosamente!");
        
        if ($ModelProducto->eliminarProducto($id_producto, $id_centro)){
            header("Location: exito.php?mensaje=".$mensaje);
        }else{
            //echo hubo un error;
        }
    }
?>
