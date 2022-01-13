<?php
    require_once "../../Controller/Clientes/ClienteController.php";
    require_once "../../Model/Clientes/Cliente.php";
    require_once "../../Controller/ControllerSesion.php";
    require_once "../../Model/Usuario/Usuario.php";
    require_once "../../Model/Tratamiento/Tratamiento.php";

    $ModelCliente = new Cliente();
    $ModelTratamiento = new Tratamiento();
    $ModelUsuario = new Usuario();

    $tratamientos = $ModelTratamiento->getAllTratamientos();
    $zonasCuerpo = $ModelTratamiento->getAllZonasCuerpo();




    if (isset($_POST['tipoTratamiento']) && $_POST['tipoTratamiento'] == '3') {  //Si es cualquier otro tratamiento
        $cadena = "<select name='nombreTratamiento[]' id='nombreTratamiento' class='last_tratamiento form-control'>
                    <option value=''>*** Selecciona tratamiento ***</option>";
        foreach ($tratamientos as $tratamiento) {
            if (($tratamiento['id_tratamiento'] == "CAV01") or ($tratamiento['id_tratamiento'] == "DEP01")) {
                continue;
            }
            $cadena .= "<option value='" . $tratamiento['id_tratamiento'] . "'>" . $tratamiento['nombre_tratamiento'] . "</option>";
        }
        $cadena .= '</select>
                    <div class="form-group">
                        <label>Precio:</label>
                        <input type="number" class="last_tratamiento form-control" id="precioTratamiento" name="precioTratamiento[]" step=".01" required="">
                        <label>¿Cuantas sesiones?:</label>
                        <input type="number" class="last_tratamiento form-control" id="cantidadTratamiento" name="cantidadTratamiento[]" step=".01" required="">
                    </div>';
        echo $cadena;
    }
    if(isset($_POST['IDtratamiento'])){
        $precioTratamiento = $ModelTratamiento->getPrecioTratamiento($_POST['IDtratamiento']);
        // echo json_encode($precioTratamiento);
        foreach($precioTratamiento as $d){
            echo $d['precio'];
        }
    }
?>