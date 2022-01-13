<?php 
  require_once "../../Controller/Clientes/ClienteController.php"; 
  require_once "../../Model/Clientes/Cliente.php";
  require_once "../../Controller/ControllerSesion.php";
  require_once "../../Model/Usuario/Usuario.php";
  require_once "../../Model/Tratamiento/Tratamiento.php";

  $ModelCliente     = new Cliente();
  $ModelTratamiento = new Tratamiento();
  $ModelUsuario     = new Usuario();
  $tratamientos     = $ModelTratamiento->getAllTratamientos();
  $zonasCuerpo      = $ModelTratamiento->getAllZonasCuerpo();
  $idTratamientoMonedero= $_POST['idTratamientoMonedero'];
  $id_cliente       = $_POST['id_cliente'];


  if($idTratamientoMonedero=='1' || $idTratamientoMonedero == '2'){ //Si es depilacion
    //Buscar ultimo tratamiento de depilacion y mostrar info
    $zonas_tratamiento_producto = $_POST['zonasCuerpoSeleccionadas'];
    $ishiden = "";
    
    $zonas_cuerpo_array = [ '**TODO EL CUERPO**' => 23, 'Abdomen' => 17, 'Antebrazos' => 3, 'Axilas' => 2, 'Brazos' => 4, 'Entrecejo' => 12, 'Espalda' => 18, 'Frente' => 13, 'Glúteos' => 10, 'Hombro' => 19, 'Ingles' => 7, 'LSMP' => 24, 'Labio Superior' => 14, 'Lumbares' => 21, 'Manos' => 5, 'Mentón' => 16, 'Muslo' => 8, 'Nuca' => 20, 'Orejas' => 22, 'Patillas' => 15, 'Pecho' => 1, 'Pierna' => 9, 'Pubis' => 6, 'Zona Alba' => 11 ];

    $zonas_cuerpo_array_cavitacion =['Abdomen' => 17, 'Brazos' => 4, 'Espalda' => 18, 'Glúteos' => 10, 'Pierna' => 9];

    if($idTratamientoMonedero=='1'){
      $ultimoTratamiento = $ModelTratamiento->getUltimoTratamientoEspecialIdCliente($id_cliente, 'DEP01');
    }else{
      $ultimoTratamiento = $ModelTratamiento->getUltimoTratamientoEspecialIdCliente($id_cliente, 'CAV01');
      $ishiden = "hidden";
    }
    if(sizeof($ultimoTratamiento) >= 1){  //Si exiten tratamientos previos, mostrar info del ultimo
      if($idTratamientoMonedero == '1'){
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
        
        $cadena .= "<label class='lead text-muted' hidden>Último tratamiento registrado fue:</label><table class='table' style='table-layout: fixed;' hidden> <tbody> <tr> <td {$ishiden}> <label class='lead text-muted'>Número de zonas: </label> <p class='lead text-muted'>".$tratamiensto['detalle_zona']."</p> </td> <td> <label class='lead text-muted'>Zonas del cuerpo:</label> <p class='lead text-muted'>".$nombre_zonas."</p> </td> </tr> <tr> <td> <label class='lead text-muted'>Fecha de aplicacion: </label> <p class='lead text-muted'>".date("Y-m-d",$tratamiensto['timestamp'])."</p> </td> <td> <label class='lead text-muted'>Sesión número y sucursal: </label> <p class='lead text-muted'>#".$tratamiensto['num_sesion']." en ".$nombre_sucursal."</p> </td> </tr> </tbody> </table>";
        $cadena .= "<table class='table' style='table-layout: fixed;' hidden> <tbody> <tr> <td> <label class='lead text-muted'>Comentarios: </label> <p class='lead text-muted'>".$tratamiensto['comentarios']."</p> </td> </tr> </tbody> </table>";
      }
    }else{  //Si NO exiten tratamientos previos, alertar que no hay.
      if($idTratamientoMonedero=='1'){
        $cadena = "<h2 hidden>No hay tratamientos regitrados de depilación anteriormente</h2><br>";
      }else{
        $cadena = "<h2 hidden>No hay tratamientos regitrados de cavitación anteriormente</h2><br>";
      }
    }
    $cadena .= "<div hidden><label>Nombre de tratamiento</label><select name='nombreTratamiento[]' id='nombreTratamiento' class='last_tratamiento form-control' readonly>";
    if($idTratamientoMonedero=='1'){
      $cadena .= "<option value='DEP01'>Depilación</option>";
    }else{
      $cadena .= "<option value='CAV01'>Cavitación</option>";
    }
    $cadena .= "</select></div>";
      $cadena .= "<div class='form-group form-inline' hidden {$ishiden}><label>Número de zonas</label><select name='detalleZona[]' id='detalleZona' class='last_tratamiento form-control'>";
      for ($i=0; $i <= 18 ; $i++) { 
        $cadena .= "<option value='$i'>$i</option>";
      }
      $cadena .= "</select></div><div class='form-group form-inline'>";
      
      $cadena .= "<label hidden>Precio: </label>
                    <input type='number' class='last_tratamiento form-control' id='precioTratamiento' name='precioTratamiento[]' step='.01' hidden required>
                  </div>";
    echo $cadena;
    if($idTratamientoMonedero == 2){
      echo '<div class="form-group"> <label for="exampleInputEmail1">Zonas del cuerpo</label> <table class="table table-borderless zonasCheckbox" id="zonasCheckbox"> <tbody> <tr> <td>';
      foreach($zonas_cuerpo_array_cavitacion as $nombre => $num){
        $checked = '';
        if( in_array($num, explode(',', $zonas_tratamiento_producto))){ $checked = ' checked'; }
        echo '<div class="form-check">
                <input class="form-check-input check" type="checkbox" value="'.$num.'" name="zonas_cuerpo[0][]" id="flexCheckDefault'.$num.'"'.$checked.'>
                <label class="form-check-label" for="flexCheckDefault'.$num.'">'.$nombre.'</label>
              </div>';
      } 
      echo '</td> </tr> </tbody> </table> </div>';
    }else{
      echo "<div class='form-group'> <label for='exampleInputEmail1'>Zona del cuerpo:</label> <table class='table table-borderless zonasCheckbox' id='zonasCheckbox'> <tbody> <td>";
      foreach($zonas_cuerpo_array as $nombre => $num){
        $checked = '';
        if( in_array($num, explode(',', $zonas_tratamiento_producto))){ 
          $checked = ' checked';
          echo '<div class="form-check">
                  <input class="form-check-input check" type="checkbox" value="'.$num.'" name="zonas_cuerpo[]" id="flexCheckDefault'.$num.'"'.$checked.'>
                  <label class="form-check-label" for="flexCheckDefault'.$num.'">'.$nombre.'</label>
                </div>';
        }
      }
      echo "</td> </tbody> </div>";
    }
  }
  
  else if($idTratamientoMonedero =='3'){  //Si es cualquier otro tratamiento
    $cadena = "<div hidden> <label>Número de zonas</label> <select name='detalleZona[]' id='detalleZona' class='last_tratamiento form-control'> <option value=''></option>";
    $cadena .= "</select> </div> <table class='table table-borderless'> <thead> <tr> <td scope='col'>Nombre tratamiento</td> <td scope='col' hidden>Precio</td> </tr> </thead> <tbody> <tr> <td>";
                        
    $cadena .= "<select name='nombreTratamiento[]' id='nombreTratamiento' class='last_tratamiento form-control'> <option value=''>*** Selecciona tratamiento ***</option>";
    foreach($tratamientos as $tratamiento){
      if(($tratamiento['id_tratamiento'] == "CAV01") or ($tratamiento['id_tratamiento'] == "DEP01")){
        continue;
      }
      $cadena .= "<option value='".$tratamiento['id_tratamiento']."'>".$tratamiento['nombre_tratamiento']."</option>";
    }
    $cadena.="</select> </td> <td> <input type='number' class='last_tratamiento form-control' id='precioTratamiento' name='precioTratamiento[]' step='.01' hidden required> </td>";
    $cadena.= "</tr> </tbody> </table>";
    echo $cadena;

    echo "<div class='form-group' hidden> <label for='exampleInputEmail1'>Zona del cuerpo</label> <table class='table table-borderless zonasCheckbox' id='zonasCheckbox'> <tbody> <td>";
    echo "<div class='form-check'> <input class='form-check-input check' type='checkbox' value='".$zonasCuerpo[$i]['id_zona']."' name='zonas_cuerpo[0][]' id='flexCheckDefault".$zonasCuerpo[$i]['id_zona']."'checked> <label class='form-check-label' for='flexCheckDefault".$zonasCuerpo[$i]['id_zona']."'> ".$zonasCuerpo[$i]['nombre_zona']." </label> </div> </td> </tbody> </div>";
  }  
?>