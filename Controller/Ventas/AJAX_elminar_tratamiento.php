<?php
    session_start();
    require_once "../../View/connection.php";
    require_once "../../Model/Ventas/Venta.php";
    include "../../Model/Db.php";

    $ModelVenta = new Venta();
    // ------------------------------------------------------------------------------------------
    // {"id_tratamiento":"FAC19","id_venta":"LVG96110722DEP0181","timeStamp":"1629552472"}

    $id_tratamiento = mysqli_real_escape_string($con, $_POST['id_tratamiento']);  
    $id_venta = mysqli_real_escape_string($con, $_POST['id_venta']);
    $timeStamp = mysqli_real_escape_string($con, $_POST['timeStamp']);

    if($id_tratamiento == 'DEP01' || $id_tratamiento == 'CAV01'){
        //$ModelVenta->deleteTratamientoFromVentas($id_tratamiento, $id_venta, $timeStamp
        //deleteTratamientoFromClienteTratamientoEspecial($id_tratamiento, $id_venta, $timeStamp)
        //deleteTratamientoFromClienteBitacora($id_tratamiento, $id_venta, $timeStamp)

        if(($ModelVenta->deleteTratamientoFromVentas($id_tratamiento, $id_venta, $timeStamp) >= 1) && ($ModelVenta->deleteTratamientoFromClienteTratamientoEspecial($id_tratamiento, $id_venta, $timeStamp) >= 1) && ($ModelVenta->deleteTratamientoFromClienteBitacora($id_tratamiento, $id_venta, $timeStamp))){
            print_r(true);
        } else {
            print_r(false);
        }
    // echo json_encode($_POST);
    }else{
        if(($ModelVenta->deleteTratamientoFromVentas($id_tratamiento, $id_venta, $timeStamp) >= 1) && ($ModelVenta->deleteTratamientoFromClienteTratamiento($id_tratamiento, $id_venta, $timeStamp) >= 1) && ($ModelVenta->deleteTratamientoFromClienteBitacora($id_tratamiento, $id_venta, $timeStamp))){
            print_r(true);
        } else {
            print_r(false);
        }
    }

?>