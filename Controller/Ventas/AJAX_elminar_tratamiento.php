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

    $date = new DateTime("now", new DateTimeZone('America/Mexico_City') );
    $timeStampEdicion = strtotime($date->format('Y-m-d H:i:s'));

    $antes_de_actualizar_Ventas = $ModelVenta->getInfoJSONVentasTratamiento($id_venta, $timeStamp, $id_tratamiento);

    $antes_de_actualizar_ClienteBitacora = $ModelVenta->getInfoJSONClienteBitacora($id_venta, $timeStamp, $id_tratamiento);

    $antes_de_actualizar_temp = [];


    if($id_tratamiento == 'DEP01' || $id_tratamiento == 'CAV01'){
        $antes_de_actualizar_ClienteTratamientoEspecial = $ModelVenta->getInfoJSONClienteTratamientoEspecial($idTratamiento, $timeStamp);

        array_push($antes_de_actualizar_temp, json_decode($antes_de_actualizar_Ventas), json_decode($antes_de_actualizar_ClienteTratamientoEspecial), json_decode($antes_de_actualizar_ClienteBitacora));

        $antes_de_actualizar = json_encode($antes_de_actualizar_temp);
        //$ModelVenta->deleteTratamientoFromVentas($id_tratamiento, $id_venta, $timeStamp
        //deleteTratamientoFromClienteTratamientoEspecial($id_tratamiento, $id_venta, $timeStamp)
        //deleteTratamientoFromClienteBitacora($id_tratamiento, $id_venta, $timeStamp)

        if(($ModelVenta->deleteTratamientoFromVentas($id_tratamiento, $id_venta, $timeStamp) >= 1) && ($ModelVenta->deleteTratamientoFromClienteTratamientoEspecial($id_tratamiento, $id_venta, $timeStamp) >= 1) && ($ModelVenta->deleteTratamientoFromClienteBitacora($id_tratamiento, $id_venta, $timeStamp))){
            $ModelVenta->insertIntoDetallesEdicionVenta($id_venta, $timeStamp, $timeStampEdicion, 'Tratamiento', $antes_de_actualizar, json_encode([]));
            print_r(true);
        } else {
            print_r(false);
        }
    // echo json_encode($_POST);
    }else{
        array_push($antes_de_actualizar_temp, json_decode($antes_de_actualizar_Ventas), json_decode($antes_de_actualizar_ClienteBitacora));

        $antes_de_actualizar = json_encode($antes_de_actualizar_temp);
        if(($ModelVenta->deleteTratamientoFromVentas($id_tratamiento, $id_venta, $timeStamp) >= 1) && ($ModelVenta->deleteTratamientoFromClienteTratamiento($id_tratamiento, $id_venta, $timeStamp) >= 1) && ($ModelVenta->deleteTratamientoFromClienteBitacora($id_tratamiento, $id_venta, $timeStamp))){
            $ModelVenta->insertIntoDetallesEdicionVenta($id_venta, $timeStamp, $timeStampEdicion, 'Tratamiento', $antes_de_actualizar, json_encode([]));
            print_r(true);
        } else {
            print_r(false);
        }
    }

?>