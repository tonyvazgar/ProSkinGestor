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



  $continente=$_POST['continente'];
  $id_cliente = $_POST['id_cliente'];


  if($continente=='1'){ //Si es depilacion
    //Buscar ultimo tratamiento de depilacion y mostrar info
    $ultimoTratamiento = $ModelTratamiento->getUltimoTratamientoEspecialIdCliente($id_cliente, 'Depilacion');
    if(sizeof($ultimoTratamiento) >= 1){  //Si exiten tratamientos previos, mostrar info del ultimo
      $detallesUltimoTratamiento = $ModelTratamiento->getDetallesUltimaDepilacion($ultimoTratamiento[0]['id_cliente'], $ultimoTratamiento[0]['timestamp']);
      
      //----------------------

      $cadena = "";
      foreach($detallesUltimoTratamiento as $tratamiensto){
        $zonas_de_tratamiento_from_db = explode(",",$tratamiensto['zona']);
        $nombre_zonas = "";
        $nombre_sucursal = $ModelUsuario->getNombreSucursalWhereIDSucursal($tratamiensto['centro'])['nombre_sucursal'];
        foreach($zonas_de_tratamiento_from_db as $id_zona){
          $nombre_zonas .= $ModelTratamiento->getNombreZonaCuerpoWhereID($id_zona)['nombre_zona'].", ";
        }
        //<label>Tratamiento a empezar</label><input type="text" class="form-control" id="nombre" name="nombre" value="Luis Antonio Vazquez Garcia" readonly="">
        $cadena .= "<div class='form-group'><label>Zona cuerpo: </label><input type='text' class='form-control' value='".$nombre_zonas."' readonly></div>";
        $cadena .= "<div class='form-group'><label>Detalle de la zona: </label><input type='text' class='form-control' value='".$tratamiensto['detalle_zona']."' readonly></div>";
        $cadena .= "<div class='form-group'><label>Fecha de aplicacion: </label><input type='text' class='form-control' value='".date("Y-m-d H:i:s",$tratamiensto['timestamp'])."' readonly></div>";
        $cadena .= "<div class='form-group'><label>Sesión número: </label><input type='text' class='form-control' value='".$tratamiensto['num_sesion']."' readonly></div>";
        $cadena .= "<div class='form-group'><label>Centro de belleza: </label><input type='text' class='form-control' value='".$nombre_sucursal."' readonly></div>";
        $cadena .= "<label>Comentarios</label><input type='text' class='form-control' value='".$tratamiensto['comentarios']."' readonly>";
      }
      $cadena .= "<label>Detalle de zona</label><input type='text' name='detalleZona' id='detalleZona' class='form-control'>";
      $cadena .= "<div class='form-group form-inline'>
                    <label>Método de pago: </label>
                    <select name='metodoPago' id='metodoPago' class='form-control'>
                        <option value='1'>Efectivo</option>
                        <option value='2'>Tarjeta</option>
                        <option value='3'>Otro</option>
                    </select>
                    <label>Precio: </label>
                    <input type='number' class='form-control' id='precioTratamiento' name='precioTratamiento' step='.01' required>
                  </div>";
    }else{  //Si NO exiten tratamientos previos, alertar que no hay.
      $cadena = "<label>No hay tratamientos regitrados de depilación anteriormente</label><br>";
      $cadena .= "<label>Detalle de zona</label><input type='text' name='detalleZona' id='detalleZona' class='form-control'>";
      $cadena .= "<div class='form-group form-inline'>
                    <label>Método de pago: </label>
                    <select name='metodoPago' id='metodoPago' class='form-control'>
                        <option value='1'>Efectivo</option>
                        <option value='2'>Tarjeta</option>
                        <option value='3'>Otro</option>
                    </select>
                    <label>Precio: </label>
                    <input type='number' class='form-control' id='precioTratamiento' name='precioTratamiento' step='.01' required>
                  </div>";
    }
    echo $cadena;

    echo "<div class='form-group'>
    <label for='exampleInputEmail1'>Zona del cuerpo</label>
    <table class='table table-borderless'>
        <tbody>
            <td>";
              for ($i = 0; $i <= sizeof($zonasCuerpo)/2; $i++) {
                        echo "<div class='form-check'>
                                <input class='form-check-input' type='checkbox' value='".$zonasCuerpo[$i]['id_zona']."' name='zonas_cuerpo[]' id='flexCheckDefault".$zonasCuerpo[$i]['id_zona']."'>
                                <label class='form-check-label' for='flexCheckDefault".$zonasCuerpo[$i]['id_zona']."'>
                                    ".$zonasCuerpo[$i]['nombre_zona']."
                                </label>
                              </div>";
                    }
            echo "</td>
            <td>";
              for ($i = floor(sizeof($zonasCuerpo)/2)+1; $i <= sizeof($zonasCuerpo)-1; $i++) {
                        echo "<div class='form-check'>
                                <input class='form-check-input' type='checkbox' value='".$zonasCuerpo[$i]['id_zona']."' name='zonas_cuerpo[]' id='flexCheckDefault".$zonasCuerpo[$i]['id_zona']."'>
                                <label class='form-check-label' for='flexCheckDefault".$zonasCuerpo[$i]['id_zona']."'>
                                    ".$zonasCuerpo[$i]['nombre_zona']."
                                </label>
                              </div>";
                    }
            echo "</td>
        </tbody>
     </div>";

  }else if($continente=='2'){ //Si es cavitacion
    //Buscar ultimo tratamiento de cavitacion y mostrar info
    $ultimoTratamiento = $ModelTratamiento->getUltimoTratamientoEspecialIdCliente($id_cliente, 'Cavitacion');
    if(sizeof($ultimoTratamiento) >= 1){  //Si exiten tratamientos previos, mostrar info del ultimo
      $detallesUltimoTratamiento = $ModelTratamiento->getDetallesUltimaCavitacion($ultimoTratamiento[0]['id_cliente'], $ultimoTratamiento[0]['timestamp']);
      
      //----------------------

      $cadena = "";
      foreach($detallesUltimoTratamiento as $tratamiensto){
        $zonas_de_tratamiento_from_db = explode(",",$tratamiensto['zona']);
        $nombre_zonas = "";
        $nombre_sucursal = $ModelUsuario->getNombreSucursalWhereIDSucursal($tratamiensto['centro'])['nombre_sucursal'];
        foreach($zonas_de_tratamiento_from_db as $id_zona){
          $nombre_zonas .= $ModelTratamiento->getNombreZonaCuerpoWhereID($id_zona)['nombre_zona'].", ";
        }
        //<label>Tratamiento a empezar</label><input type="text" class="form-control" id="nombre" name="nombre" value="Luis Antonio Vazquez Garcia" readonly="">
        $cadena .= "<div class='form-group'><label>Zona cuerpo</label><input type='text' class='form-control' value='".$nombre_zonas."' readonly></div>";
        $cadena .= "<div class='form-group'><label>Tratamiento</label><input type='text' class='form-control' value='".$tratamiensto['detalle_zona']."' readonly></div>";
        $cadena .= "<div class='form-group'><label>Fecha de aplicacion</label><input type='text' class='form-control' value='".date("Y-m-d H:i:s",$tratamiensto['timestamp'])."' readonly></div>";
        $cadena .= "<div class='form-group'><label>Sesión número</label><input type='text' class='form-control' value='".$tratamiensto['num_sesion']."' readonly></div>";
        $cadena .= "<div class='form-group'><label>Centro de belleza</label><input type='text' class='form-control' value='".$nombre_sucursal."' readonly></div>";
        $cadena .= "<label>Comentarios</label><input type='text' class='form-control' value='".$tratamiensto['comentarios']."' readonly>";
      }
      $cadena .= "<label>Detalle de zona</label><input type='text' name='detalleZona' id='detalleZona' class='form-control'>";
      $cadena .= "<div class='form-group form-inline'>
                    <label>Método de pago: </label>
                    <select name='metodoPago' id='metodoPago' class='form-control'>
                        <option value='1'>Efectivo</option>
                        <option value='2'>Tarjeta</option>
                        <option value='3'>Otro</option>
                    </select>
                    <label>Precio: </label>
                    <input type='number' class='form-control' id='precioTratamiento' name='precioTratamiento' step='.01' required>
                  </div>";

    }else{  //Si NO exiten tratamientos previos, alertar que no hay.
      $cadena = "<label>No hay tratamientos regitrados de depilación anteriormente</label><br>";
      $cadena .= "<label>Detalle de zona</label><input type='text' name='detalleZona' id='detalleZona' class='form-control'>";
      $cadena .= "<div class='form-group form-inline'>
                    <label>Método de pago: </label>
                    <select name='metodoPago' id='metodoPago' class='form-control'>
                        <option value='1'>Efectivo</option>
                        <option value='2'>Tarjeta</option>
                        <option value='3'>Otro</option>
                    </select>
                    <label>Precio: </label>
                    <input type='number' class='form-control' id='precioTratamiento' name='precioTratamiento' step='.01' required>
                  </div>";
    }
    echo $cadena;
    echo "<div class='form-group'>
    <label for='exampleInputEmail1'>Zona del cuerpo</label>
    <table class='table table-borderless'>
        <tbody>
            <td>";
              for ($i = 1; $i <= sizeof($zonasCuerpo)/2; $i++) {
                        echo "<div class='form-check'>
                                <input class='form-check-input' type='checkbox' value='".$zonasCuerpo[$i]['id_zona']."' name='zonas_cuerpo[]' id='flexCheckDefault".$zonasCuerpo[$i]['id_zona']."'>
                                <label class='form-check-label' for='flexCheckDefault".$zonasCuerpo[$i]['id_zona']."'>
                                    ".$zonasCuerpo[$i]['nombre_zona']."
                                </label>
                              </div>";
                    }
            echo "</td>
            <td>";
              for ($i = floor(sizeof($zonasCuerpo)/2)+1; $i <= sizeof($zonasCuerpo)-1; $i++) {
                        echo "<div class='form-check'>
                                <input class='form-check-input' type='checkbox' value='".$zonasCuerpo[$i]['id_zona']."' name='zonas_cuerpo[]' id='flexCheckDefault".$zonasCuerpo[$i]['id_zona']."'>
                                <label class='form-check-label' for='flexCheckDefault".$zonasCuerpo[$i]['id_zona']."'>
                                    ".$zonasCuerpo[$i]['nombre_zona']."
                                </label>
                              </div>";
                    }
            echo "</td>
        </tbody>
     </div>";
  }else if($continente =='3'){  //Si es cualquier otro tratamiento
    $cadena = "<thead>
                    <tr>
                        <td scope='col'>Nombre tratamiento</td>
                        <td scope='col'>Precio</td>
                        <td scope='col'>Forma Pago</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>";
                        
    $cadena .= "<select name='nombreTratamiento' id='nombreTratamiento' class='form-control'>";
    foreach($tratamientos as $tratamiento){
      $cadena .= "<option value='".$tratamiento['id_tratamiento']."'>".$tratamiento['nombre_tratamiento']."</option>";
    }
    $cadena.="</select>
                </td>
                <td>
                    <input type='number' class='form-control' id='precioTratamiento' name='precioTratamiento' step='.01' required>
                </td>
                <td>
                    <select name='metodoPago' id='metodoPago' class='form-control'>
                        <option value='1'>Efectivo</option>
                        <option value='2'>Tarjeta</option>
                        <option value='3'>Otro</option>
                    </select>
                </td>
                </tr>
                </tbody>";
    echo $cadena;
  }  
?>