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

    // echo json_encode($_POST);

    if(($ModelVenta->deleteTratamientoFromVentas($id_tratamiento, $id_venta, $timeStamp) >= 1) && ($ModelVenta->deleteTratamientoFromClienteTratamiento($id_tratamiento, $id_venta, $timeStamp) >= 1) && ($ModelVenta->deleteTratamientoFromClienteBitacora($id_tratamiento, $id_venta, $timeStamp))){
        print_r(true);
    } else {
        print_r(false);
    }

?>