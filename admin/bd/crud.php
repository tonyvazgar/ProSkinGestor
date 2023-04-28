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
$code     = (isset($_POST['code'])) ? $_POST['code'] : '';

switch($opcion){
    case 1: //alta
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $ModelCosmetologa -> insertNewCosmetologa($id, $name, $username, $hash, $code, $status, $sucursal);
        $data = $ModelCosmetologa -> getLastCosmetologa();
        break;
    case 2: //modificación
        $infoBeforeUpdate = $ModelCosmetologa -> getCosmetologaWhereID($id);
        $id               = $infoBeforeUpdate['id'] != $id ? $id: $infoBeforeUpdate['id'];
        $name             = $infoBeforeUpdate['name'] != $name ? $name: $infoBeforeUpdate['name'];
        $username         = $infoBeforeUpdate['email'] != $username ? $username: $infoBeforeUpdate['email'];
        $hash             = $password != '' ? password_hash($password, PASSWORD_BCRYPT): $infoBeforeUpdate['password'];
        $code             = $infoBeforeUpdate['code'] != $code ? $code: $infoBeforeUpdate['code'];
        $status           = $infoBeforeUpdate['status'] != $status ? $status: $infoBeforeUpdate['status'];
        $sucursal         = $infoBeforeUpdate['id_sucursal_usuario'] != $sucursal ? $sucursal: $infoBeforeUpdate['id_sucursal_usuario'];
        
        $ModelCosmetologa ->updateInfoCosmetologa($id, $name, $username, $hash, $code, $status, $sucursal);
        $data = $ModelCosmetologa -> getCosmetologaWhereID($id);
        break;
    case 3://baja
        // $consulta = "DELETE FROM personas WHERE id='$id' ";		
        // $resultado = $conexion->prepare($consulta);
        // $resultado->execute();                           
        // break;        
}

echo json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
