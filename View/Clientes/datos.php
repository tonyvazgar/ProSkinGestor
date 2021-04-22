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


  if($continente=='1' || $continente == '2'){ //Si es depilacion
    //Buscar ultimo tratamiento de depilacion y mostrar info
    if($continente=='1'){
      $ultimoTratamiento = $ModelTratamiento->getUltimoTratamientoEspecialIdCliente($id_cliente, 'DEP01');
    }else{
      $ultimoTratamiento = $ModelTratamiento->getUltimoTratamientoEspecialIdCliente($id_cliente, 'CAV01');
    }
    if(sizeof($ultimoTratamiento) >= 1){  //Si exiten tratamientos previos, mostrar info del ultimo
      if($continente == '1'){
        $detallesUltimoTratamiento = $ModelTratamiento->getDetallesUltimaDepilacion($ultimoTratamiento[0]['id_cliente'], $ultimoTratamiento[0]['timestamp']);
      }else{
        $detallesUltimoTratamiento = $ModelTratamiento->getDetallesUltimaCavitacion($ultimoTratamiento[0]['id_cliente'], $ultimoTratamiento[0]['timestamp']);  
      }
      
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
        $cadena .= "<div class='form-group'><label>Número de zonas</label><input type='text' class='form-control' value='".$tratamiensto['detalle_zona']."' readonly></div>";
        $cadena .= "<div class='form-group'><label>Fecha de aplicacion: </label><input type='text' class='form-control' value='".date("Y-m-d H:i:s",$tratamiensto['timestamp'])."' readonly></div>";
        $cadena .= "<div class='form-group'><label>Sesión número: </label><input type='text' class='form-control' value='".$tratamiensto['num_sesion']."' readonly></div>";
        $cadena .= "<div class='form-group'><label>Centro de belleza: </label><input type='text' class='form-control' value='".$nombre_sucursal."' readonly></div>";
        $cadena .= "<label>Comentarios</label><input type='text' class='form-control' value='".$tratamiensto['comentarios']."' readonly>";
      }
    }else{  //Si NO exiten tratamientos previos, alertar que no hay.
      if($continente=='1'){
        $cadena = "<h2>No hay tratamientos regitrados de depilación anteriormente</h2><br>";
      }else{
        $cadena = "<h2>No hay tratamientos regitrados de cavitación anteriormente</h2><br>";
      }
    }
    $cadena .= "<div hidden><label>Nombre de tratamiento</label><select name='nombreTratamiento[]' id='nombreTratamiento' class='form-control' readonly>";
    if($continente=='1'){
      $cadena .= "<option value='DEP01'>Depilación</option>";
    }else{
      $cadena .= "<option value='CAV01'>Cavitación</option>";
    }
    $cadena .= "</select></div>";
      $cadena .= "<label>Número de zonas</label><select name='detalleZona[]' id='detalleZona' class='form-control'>";
      for ($i=1; $i <= 18 ; $i++) { 
        $cadena .= "<option value='$i'>$i</option>";
      }
      $cadena .= "</select><div class='form-group form-inline'>
                    <label>Método de pago: </label>
                    <select name='metodoPago[]' id='metodoPago' class='form-control'>
                        <option value='1'>Efectivo</option>
                        <option value='2'>[TDD]Tarjeta de débito</option>
                        <option value='3'>[TDC]Tarjeta de crédito</option>
                        <option value='4'>Transferencia</option>
                        <option value='5'>Cheque de regalo</option>
                    </select>
                    <label>Precio: </label>
                    <input type='number' class='form-control' id='precioTratamiento' name='precioTratamiento[]' step='.01' required>
                  </div>";
    echo $cadena;

    echo "<div class='form-group'>
    <label for='exampleInputEmail1'>Zona del cuerpo</label>
    <table class='table table-borderless zonasCheckbox' id='zonasCheckbox'>
        <tbody>
            <td>";
            $inicio = 0;
            if($continente=='2'){
              $inicio = 1;
            }
              for ($i = $inicio; $i <= sizeof($zonasCuerpo)/2; $i++) {
                        echo "<div class='form-check'>
                                <input class='form-check-input check' type='checkbox' value='".$zonasCuerpo[$i]['id_zona']."' name='zonas_cuerpo[0][]' id='flexCheckDefault".$zonasCuerpo[$i]['id_zona']."'>
                                <label class='form-check-label' for='flexCheckDefault".$zonasCuerpo[$i]['id_zona']."'>
                                    ".$zonasCuerpo[$i]['nombre_zona']."
                                </label>
                              </div>";
                    }
            echo "</td>
            <td>";
              for ($i = floor(sizeof($zonasCuerpo)/2)+1; $i <= sizeof($zonasCuerpo)-1; $i++) {
                        echo "<div class='form-check'>
                                <input class='form-check-input check' type='checkbox' value='".$zonasCuerpo[$i]['id_zona']."' name='zonas_cuerpo[0][]' id='flexCheckDefault".$zonasCuerpo[$i]['id_zona']."'>
                                <label class='form-check-label' for='flexCheckDefault".$zonasCuerpo[$i]['id_zona']."'>
                                    ".$zonasCuerpo[$i]['nombre_zona']."
                                </label>
                              </div>";
                    }
            echo "</td>
        </tbody>
     </div>";

  }
  
  else if($continente =='3'){  //Si es cualquier otro tratamiento
    $cadena = "<div hidden>
                <label>Número de zonas</label>
                <select name='detalleZona[]' id='detalleZona' class='form-control'>
                <option value=''></option>";
    $cadena .= "</select>
              </div>
              <table class='table table-borderless'>
                <thead>
                    <tr>
                        <td scope='col'>Nombre tratamiento</td>
                        <td scope='col'>Precio</td>
                        <td scope='col'>Forma Pago</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>";
                        
    $cadena .= "<select name='nombreTratamiento[]' id='nombreTratamiento' class='form-control'>
                <option value=''>*** Selecciona tratamiento ***</option>";
    foreach($tratamientos as $tratamiento){
      $cadena .= "<option value='".$tratamiento['id_tratamiento']."'>".$tratamiento['nombre_tratamiento']."</option>";
    }
    $cadena.="</select>
                </td>
                <td>
                    <input type='number' class='form-control' id='precioTratamiento' name='precioTratamiento[]' step='.01' required>
                </td>
                <td>
                    <select name='metodoPago[]' id='metodoPago' class='form-control'>
                        <option value='1'>Efectivo</option>
                        <option value='2'>[TDD]Tarjeta de débito</option>
                        <option value='3'>[TDC]Tarjeta de crédito</option>
                        <option value='4'>Transferencia</option>
                        <option value='5'>Cheque de regalo</option>
                    </select>
                </td>
                </tr>
                </tbody>
                </table>";
    echo $cadena;

    echo "<div class='form-group' hidden>
    <label for='exampleInputEmail1'>Zona del cuerpo</label>
    <table class='table table-borderless zonasCheckbox' id='zonasCheckbox'>
        <tbody>
            <td>";
    echo "<div class='form-check'>
            <input class='form-check-input check' type='checkbox' value='".$zonasCuerpo[$i]['id_zona']."' name='zonas_cuerpo[0][]' id='flexCheckDefault".$zonasCuerpo[$i]['id_zona']."'checked>
              <label class='form-check-label' for='flexCheckDefault".$zonasCuerpo[$i]['id_zona']."'>
              ".$zonasCuerpo[$i]['nombre_zona']."
              </label>
            </div>";
    echo "</td>
        </tbody>
     </div>";
    // echo "<div class='form-group'> <table class='table table-borderless'> <thead> <tr> <td>Calificación</td> <td scope='col'>Centro</td> </tr> </thead> <tbody> <tr> <td> <select name='calificacion' id='calificacion' class='form-control'> <option value='1'>☆</option> <option value='2'>☆☆</option> <option value='3'>☆☆☆</option> <option value='4'>☆☆☆☆</option> <option value='5'>☆☆☆☆☆</option> </select> </td> <td> <select name='idCentro' id='idCentro' class='form-control' readonly> <option value='".$numeroSucursal['id_sucursal']."'>".$nombreSucursal['nombre_sucursal']."</option> </select> </td> </tr> </tbody> </table> </div> <div class='form-group'> <label>Comentarios</label> <textarea name='comentarios' id='comentarios' cols='30' rows='5' class='form-control' maxlength='250' placeholder='Escribe algo relevante de este tratamiento' required></textarea> </div> <div class='form-group'> <label>Firma requerida del cliente</label> <select name='aviso' id='aviso' class='form-control'> <option>*** SELECCIONA ***</option> <option value='0'>No firmado</option> <option value='1'>Ya se firmó</option> </select> </div>";
  }  
?>