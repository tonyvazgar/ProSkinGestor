<?php
include_once '../Model/Cosmetologa.php';

$ModelCosmetologa = new Cosmetologa();

// Recepción de los datos enviados mediante POST desde el JS
$username = (isset($_POST['username'])) ? $_POST['username'] : '';
$password = (isset($_POST['password'])) ? $_POST['password'] : '';
$opcion   = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id       = (isset($_POST['id'])) ? $_POST['id'] : '';
$name     = (isset($_POST['name'])) ? $_POST['name'] : '';
$status   = (isset($_POST['status'])) ? $_POST['status'] : '';
$sucursal = (isset($_POST['sucursal'])) ? $_POST['sucursal'] : '';

switch($opcion){
    case 1: //alta
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $ModelCosmetologa -> insertNewCosmetologa($id, $name, $username, $hash, $sucursal, $status);
        $data = $ModelCosmetologa -> getLastCosmetologa();
        echo $data;
        break;
    case 2: //modificación
        $infoBeforeUpdate = $ModelCosmetologa -> getCosmetologaWhereID($id);
        $name             = $infoBeforeUpdate['name'] != $name ? $name: $infoBeforeUpdate['name'];
        $username         = $infoBeforeUpdate['username'] != $username ? $username: $infoBeforeUpdate['username'];
        $id               = $infoBeforeUpdate['id'] != $id ? $id: $infoBeforeUpdate['id'];
        $status           = $infoBeforeUpdate['status'] != $status ? $status: $infoBeforeUpdate['status'];
        $sucursal         = $infoBeforeUpdate['sucursal'] != $sucursal ? $sucursal: $infoBeforeUpdate['sucursal'];
        $hash             = $password != '' ? password_hash($password, PASSWORD_BCRYPT): $infoBeforeUpdate['password'];
        
        $ModelCosmetologa ->updateInfoCosmetologa($id, $name, $username, $hash, $sucursal, $status);
        $data = $ModelCosmetologa -> getCosmetologaWhereID($id);
        break;
    case 3://baja
        // $consulta = "DELETE FROM personas WHERE id='$id' ";		
        // $resultado = $conexion->prepare($consulta);
        // $resultado->execute();                           
        // break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
