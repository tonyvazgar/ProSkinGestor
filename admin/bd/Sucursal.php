<?php
    include_once '../Model/Sucursal.php';
    $ModelSucursal = new Sucursal();

    // Recepción de los datos enviados mediante POST desde el JS
    $sucursal_name           = (isset($_POST['sucursal_name'])) ? $_POST['sucursal_name'] : '';
    $sucursal_id             = (isset($_POST['sucursal_id'])) ? $_POST['sucursal_id'] : '';
    $opcion                     = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

    switch($opcion) {
        case 1: //Alta tratamiento
            $data = $ModelSucursal -> insertNewSucursal($sucursal_name);
            break;
        case 2: //Update tratamiento
            $infoBeforeUpdate = $ModelSucursal -> getSucursalWhere($sucursal_id);
            
            $sucursal_name = $infoBeforeUpdate['nombre_sucursal'] != $sucursal_name ? $sucursal_name: $infoBeforeUpdate['nombre_sucursal'];

            $ModelSucursal -> updateInfoSucursal($sucursal_id, $sucursal_name);
            
            break;
    }

    echo json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
    $conexion = NULL;
?>