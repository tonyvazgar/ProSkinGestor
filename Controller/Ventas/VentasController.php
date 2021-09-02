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

        if($ModelVenta->updateMetodoPago($idCliente, $timeStamp, $metodoPago, $referenciaInput) >= 1){
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

        if($ModelVenta->updateProductoVenta($idVenta, $timeStamp, $idProducto, $precioUnitarioProducto, $cantidadProducto, $precioTotalProducto) >= 1){
            header('Location: editarVenta.php?idVenta='.$idVenta);
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


        if($idTratamiento == 'DEP01'){
            echo '<pre>';
            print_r($_POST);
            echo '</pre>';
        }else if($idTratamiento == 'CAV01'){
            echo '<pre>';
            print_r($_POST);
            echo '</pre>';
        }else{
            if(($ModelVenta->updateTratamientoNormalVenta($idVenta, $idTratamiento, $timeStamp, $precioTratamiento) >= 0) && ($ModelVenta->updateTatamientoNormalBitacora($idVenta, $idTratamiento, $timeStamp, $comentarioTratamiento) >= 0)){
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