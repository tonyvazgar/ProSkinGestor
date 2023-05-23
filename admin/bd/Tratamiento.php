<?php
    include_once '../Model/Tratamiento.php';
    $ModelTratamiento = new Tratamiento();

    // Recepción de los datos enviados mediante POST desde el JS
    $tratamiento_id             = (isset($_POST['tratamiento_id'])) ? $_POST['tratamiento_id'] : '';
    $tratamiento_name           = (isset($_POST['tratamiento_name'])) ? $_POST['tratamiento_name'] : '';
    $tratamiento_price          = (isset($_POST['tratamiento_price'])) ? $_POST['tratamiento_price'] : '';
    $tratamiento_duration       = (isset($_POST['tratamiento_duration'])) ? $_POST['tratamiento_duration'] : '';
    $tratamiento_consentimiento = (isset($_POST['tratamiento_consentimiento'])) ? $_POST['tratamiento_consentimiento'] : '';
    $opcion                     = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

    switch($opcion) {
        case 1: //Alta tratamiento
            $data = $ModelTratamiento -> insertNewTratamiento($tratamiento_id, $tratamiento_name, $tratamiento_price, $tratamiento_duration, $tratamiento_consentimiento);
            break;
        case 2: //Update tratamiento
            $infoBeforeUpdate = $ModelTratamiento -> getTratamientoWhere($tratamiento_id);

            $tratamiento_id = $infoBeforeUpdate['id_tratamiento'] != $tratamiento_id ? $tratamiento_id: $infoBeforeUpdate['id_tratamiento'];
            $tratamiento_name = $infoBeforeUpdate['nombre_tratamiento'] != $tratamiento_name ? $tratamiento_name: $infoBeforeUpdate['nombre_tratamiento'];
            $tratamiento_price = $infoBeforeUpdate['precio'] != $tratamiento_price ? $tratamiento_price: $infoBeforeUpdate['precio'];
            $tratamiento_duration = $infoBeforeUpdate['duracion_tratamiento'] != $tratamiento_duration ? $tratamiento_duration: $infoBeforeUpdate['duracion_tratamiento'];
            $tratamiento_consentimiento = $infoBeforeUpdate['consentimiento_tratamiento'] != $tratamiento_consentimiento ? $tratamiento_consentimiento: $infoBeforeUpdate['consentimiento_tratamiento'];

            $ModelTratamiento -> updateInfoTratamiento($tratamiento_id, $tratamiento_name, $tratamiento_price, $tratamiento_duration, $tratamiento_consentimiento);

            // $data = $ModelTratamiento -> getProductoWhere($product_id, $product_sucursal);
            break;
    }

    echo json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
    $conexion = NULL;
?>