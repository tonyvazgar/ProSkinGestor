<?php
    session_start();
    require_once "../../View/connection.php";
    require_once "../../Model/Ventas/Venta.php";


    $ModelVenta = new Venta();

    if(isset($_POST['editarMetodoPagoSubmit'])){
        $idCliente = mysqli_real_escape_string($con, $_POST['idCliente']);
        $timeStamp = mysqli_real_escape_string($con, $_POST['timeStamp']);
        $metodoPago = mysqli_real_escape_string($con, $_POST['metodoPago']);
        $referenciaInput = mysqli_real_escape_string($con, $_POST['referenciaInput']);
        echo '<pre>';
        print_r($_POST);
        echo '</pre>';

        $antes_de_Actualizar = $ModelVenta->getInfoJSONVentas($idCliente, $timeStamp);

        $date = new DateTime("now", new DateTimeZone('America/Mexico_City') );
        $timeStampEdicion = strtotime($date->format('Y-m-d H:i:s'));

        if($ModelVenta->updateMetodoPago($idCliente, $timeStamp, $metodoPago, $referenciaInput) >= 1){
            $despues_de_Actualizar = $ModelVenta->getInfoJSONVentas($idCliente, $timeStamp);
            $ModelVenta->insertIntoDetallesEdicionVenta($idCliente, $timeStamp, $timeStampEdicion, 'Pago', $antes_de_Actualizar, $despues_de_Actualizar);
            header('Location: editarVenta.php?idVenta='.$idCliente);
            // exit();
        } else {
            $errors['db-error'] = "Error al darse de alta!";
        }
    }

    if(isset($_POST['editarTotalSubmit'])){
        $idCliente = mysqli_real_escape_string($con, $_POST['idCliente']);
        $timeStamp = mysqli_real_escape_string($con, $_POST['timeStamp']);
        $totalInput = mysqli_real_escape_string($con, $_POST['totalInput']);


        echo '<pre>';
        print_r($_POST);
        echo '</pre>';
    }

    if(isset($_POST['editarProductoSubmit'])){
        $idVenta = mysqli_real_escape_string($con, $_POST['idCliente']);
        $timeStamp = mysqli_real_escape_string($con, $_POST['timeStamp']);
        $idProducto = mysqli_real_escape_string($con, $_POST['idProducto']);
        $precioUnitarioProducto = mysqli_real_escape_string($con, $_POST['precioUnitarioProducto']);
        $cantidadProducto = mysqli_real_escape_string($con, $_POST['cantidadProducto']);
        $precioTotalProducto = mysqli_real_escape_string($con, $_POST['precioTotalProducto']);
        

        echo '<pre>';
        print_r($_POST);
        echo '</pre>';

        $antes_de_Actualizar = $ModelVenta->getInfoJSONVentasProducto($idVenta, $timeStamp, $idProducto);

        $date = new DateTime("now", new DateTimeZone('America/Mexico_City') );
        $timeStampEdicion = strtotime($date->format('Y-m-d H:i:s'));

        if($ModelVenta->updateProductoVenta($idVenta, $timeStamp, $idProducto, $precioUnitarioProducto, $cantidadProducto, $precioTotalProducto) >= 0){
            $despues_de_Actualizar = $ModelVenta->getInfoJSONVentasProducto($idVenta, $timeStamp, $idProducto);
            $ModelVenta->insertIntoDetallesEdicionVenta($idVenta, $timeStamp, $timeStampEdicion, 'Producto', $antes_de_Actualizar, $despues_de_Actualizar);
            header('Location: detalleVenta.php?idVenta='.$idVenta);
            exit();
        } else {
            $errors['db-error'] = "Error al darse de alta!";
        }
    }

    if(isset($_POST['editarTratamientoSubmit'])){
        $idVenta = mysqli_real_escape_string($con, $_POST['idVenta']);
        $timeStamp = mysqli_real_escape_string($con, $_POST['timeStamp']);
        $idTratamiento = mysqli_real_escape_string($con, $_POST['idTratamiento']);
        $precioTratamiento = mysqli_real_escape_string($con, $_POST['precioTratamiento']);
        $comentarioTratamiento = mysqli_real_escape_string($con, $_POST['comentarioTratamiento']);

        $date = new DateTime("now", new DateTimeZone('America/Mexico_City') );
        $timeStampEdicion = strtotime($date->format('Y-m-d H:i:s'));

        $antes_de_actualizar_Ventas = $ModelVenta->getInfoJSONVentasTratamiento($idVenta, $timeStamp, $idTratamiento);

        $antes_de_actualizar_ClienteBitacora = $ModelVenta->getInfoJSONClienteBitacora($idVenta, $timeStamp, $idTratamiento);

        $antes_de_actualizar_temp = [];

        if($idTratamiento == 'DEP01'){

            $antes_de_actualizar_ClienteTratamientoEspecial = $ModelVenta->getInfoJSONClienteTratamientoEspecial($idTratamiento, $timeStamp);

            array_push($antes_de_actualizar_temp, json_decode($antes_de_actualizar_Ventas), json_decode($antes_de_actualizar_ClienteTratamientoEspecial), json_decode($antes_de_actualizar_ClienteBitacora));

            $antes_de_actualizar = json_encode($antes_de_actualizar_temp);

            $numZonasTratamiento = mysqli_real_escape_string($con, $_POST['numZonasTratamiento']);
            $zonas_cuerpo= mysqli_real_escape_string($con, implode(",", $_POST['zonas_cuerpo']));
            // updateCavitacionDepilacionVenta($idVenta, $idTratamiento, $timeStamp, $precioTratamiento)
            // updateClienteTratamientoEspecial($idTratamiento, $timeStamp, $zonas_cuerpo, $numZonasTratamiento)
            // updateTratamientoEspecialBitacora($idVenta, $idTratamiento, $timeStamp, $comentarioTratamiento, $zonas_cuerpo)
            
            if(($ModelVenta->updateCavitacionDepilacionVenta($idVenta, $idTratamiento, $timeStamp, $precioTratamiento) >= 0) && ($ModelVenta->updateClienteTratamientoEspecial($idTratamiento, $timeStamp, $zonas_cuerpo, $numZonasTratamiento) >= 0) && ($ModelVenta->updateTratamientoEspecialBitacora($idVenta, $idTratamiento, $timeStamp, $comentarioTratamiento, $zonas_cuerpo) >= 0)){

                $despues_de_actualizar_Ventas = $ModelVenta->getInfoJSONVentasTratamiento($idVenta, $timeStamp, $idTratamiento);

                $despues_de_actualizar_ClienteTratamientoEspecial = $ModelVenta->getInfoJSONClienteTratamientoEspecial($idTratamiento, $timeStamp);

                $despues_de_actualizar_ClienteBitacora = $ModelVenta->getInfoJSONClienteBitacora($idVenta, $timeStamp, $idTratamiento);


                $despues_de_actualizar_temp = [];
                array_push($despues_de_actualizar_temp, json_decode($despues_de_actualizar_Ventas), json_decode($despues_de_actualizar_ClienteTratamientoEspecial), json_decode($despues_de_actualizar_ClienteBitacora));

                $despues_de_actualizar = json_encode($despues_de_actualizar_temp);

                $ModelVenta->insertIntoDetallesEdicionVenta($idVenta, $timeStamp, $timeStampEdicion, 'Tratamiento', $antes_de_actualizar, $despues_de_actualizar);

                header('Location: detalleVenta.php?idVenta='.$idVenta);
                exit();
            } else {
                $errors['db-error'] = "Error al darse de alta!";
            }
        }else if($idTratamiento == 'CAV01'){

            $antes_de_actualizar_ClienteTratamientoEspecial = $ModelVenta->getInfoJSONClienteTratamientoEspecial($idTratamiento, $timeStamp);
            
            array_push($antes_de_actualizar_temp, json_decode($antes_de_actualizar_Ventas), json_decode($antes_de_actualizar_ClienteTratamientoEspecial), json_decode($antes_de_actualizar_ClienteBitacora));

            $antes_de_actualizar = json_encode($antes_de_actualizar_temp);

            $zonas_cuerpo= mysqli_real_escape_string($con, implode(",", $_POST['zonas_cuerpo']));

            if(($ModelVenta->updateCavitacionDepilacionVenta($idVenta, $idTratamiento, $timeStamp, $precioTratamiento) >= 0) && ($ModelVenta->updateClienteTratamientoEspecial($idTratamiento, $timeStamp, $zonas_cuerpo, 0) >= 0) && ($ModelVenta->updateTratamientoEspecialBitacora($idVenta, $idTratamiento, $timeStamp, $comentarioTratamiento, $zonas_cuerpo) >= 0)){

                $despues_de_actualizar_Ventas = $ModelVenta->getInfoJSONVentasTratamiento($idVenta, $timeStamp, $idTratamiento);

                $despues_de_actualizar_ClienteTratamientoEspecial = $ModelVenta->getInfoJSONClienteTratamientoEspecial($idTratamiento, $timeStamp);

                $despues_de_actualizar_ClienteBitacora = $ModelVenta->getInfoJSONClienteBitacora($idVenta, $timeStamp, $idTratamiento);


                $despues_de_actualizar_temp = [];
                array_push($despues_de_actualizar_temp, json_decode($despues_de_actualizar_Ventas), json_decode($despues_de_actualizar_ClienteTratamientoEspecial), json_decode($despues_de_actualizar_ClienteBitacora));

                $despues_de_actualizar = json_encode($despues_de_actualizar_temp);

                $ModelVenta->insertIntoDetallesEdicionVenta($idVenta, $timeStamp, $timeStampEdicion, 'Tratamiento', $antes_de_actualizar, $despues_de_actualizar);

                header('Location: detalleVenta.php?idVenta='.$idVenta);
                exit();
            } else {
                $errors['db-error'] = "Error al darse de alta!";
            }
        }else{

            array_push($antes_de_actualizar_temp, json_decode($antes_de_actualizar_Ventas), json_decode($antes_de_actualizar_ClienteBitacora));

            $antes_de_actualizar = json_encode($antes_de_actualizar_temp);

            if(($ModelVenta->updateTratamientoNormalVenta($idVenta, $idTratamiento, $timeStamp, $precioTratamiento) >= 0) && ($ModelVenta->updateTatamientoNormalBitacora($idVenta, $idTratamiento, $timeStamp, $comentarioTratamiento) >= 0)){


                $despues_de_actualizar_Ventas = $ModelVenta->getInfoJSONVentasTratamiento($idVenta, $timeStamp, $idTratamiento);

                $despues_de_actualizar_ClienteBitacora = $ModelVenta->getInfoJSONClienteBitacora($idVenta, $timeStamp, $idTratamiento);


                $despues_de_actualizar_temp = [];
                array_push($despues_de_actualizar_temp, json_decode($despues_de_actualizar_Ventas), json_decode($despues_de_actualizar_ClienteBitacora));

                $despues_de_actualizar = json_encode($despues_de_actualizar_temp);

                $ModelVenta->insertIntoDetallesEdicionVenta($idVenta, $timeStamp, $timeStampEdicion, 'Tratamiento', $antes_de_actualizar, $despues_de_actualizar);


                header('Location: detalleVenta.php?idVenta='.$idVenta);
                exit();
            } else {
                $errors['db-error'] = "Error al darse de alta!";
            }
        }
    }

    if (isset($_POST['edicionVenta'])){
        echo'<pre>';
        print_r($_POST);
        echo'</pre>';
    }
?>