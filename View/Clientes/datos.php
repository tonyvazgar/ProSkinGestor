<?php 
  require_once "../../Controller/Clientes/ClienteController.php"; 
  require_once "../../Model/Clientes/Cliente.php";
  require_once "../../Controller/ControllerSesion.php";
  require_once "../../Model/Usuario/Usuario.php";
  require_once "../../Model/Tratamiento/Tratamiento.php";

  $ModelCliente = new Cliente();
  $ModelTratamiento = new Tratamiento();

  $tratamientos = $ModelTratamiento->getAllTratamientos();


  $continente=$_POST['continente'];
  $id_cliente = $_POST['id_cliente'];


  if($continente=='1'){ //Si es depilacion
    //Buscar ultimo tratamiento de depilacion y mostrar info
    $ultimoTratamiento = $ModelTratamiento->getUltimaDepilacionWhereIdCliente($id_cliente);
    // $cadena = "<select name='select2lista' id='select2lista' class='form-control' ></select>";
    if(sizeof($ultimoTratamiento) >= 1){
      // print_r("Hay tratamientos previos");echo "<br>";
      $detallesUltimoTratamiento = $ModelTratamiento->getDetallesUltimaDepilacion($ultimoTratamiento[0]['id_cliente'], $ultimoTratamiento[0]['timestamp']);
      print_r($detallesUltimoTratamiento);
      // print(strtotime(date("Y-m-d H:i:s")));
      // echo "<br>";
      
      //----------------------

      $cadena = "";
      foreach($detallesUltimoTratamiento as $tratamiensto){
        //<label>Tratamiento a empezar</label><input type="text" class="form-control" id="nombre" name="nombre" value="Luis Antonio Vazquez Garcia" readonly="">
        $cadena .= "<div class='form-group form-inline'><label>Zona cuerpo</label><input type='text' class='form-control' value='".$tratamiensto['nombre_zona']."' readonly></div>";
        $cadena .= "<div class='form-group form-inline'><label>Tratamiento</label><input type='text' class='form-control' value='".$tratamiensto['detalle_zona']."' readonly></div>";
        $cadena .= "<div class='form-group form-inline'><label>Fecha de aplicacion</label><input type='text' class='form-control' value='".date("Y-m-d H:i:s",$tratamiensto['timestamp'])."' readonly></div>";
        $cadena .= "<div class='form-group form-inline'><label>Sesión número</label><input type='text' class='form-control' value='".$tratamiensto['num_sesion']."' readonly></div>";
        $cadena .= "<div class='form-group form-inline'><label>Centro de belleza</label><input type='text' class='form-control' value='".$tratamiensto['centro']."' readonly></div>";
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
                    <input type='text' class='form-control' id='precioTratamiento' name='precioTratamiento'>
                  </div>";
    }else{
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
                    <input type='text' class='form-control' id='precioTratamiento' name='precioTratamiento'>
                  </div>";
    }
    echo $cadena;
    
    // echo $cadena;

  }else if($continente=='2'){ //Si es cavitacion
    //Buscar ultimo tratamiento de cavitacion y mostrar info
    $ultimoTratamiento = $ModelTratamiento->getUltimaCavitacionWhereIdCliente($id_cliente);
    $cadena = "<select name='select2lista' id='select2lista' class='form-control'></select>";
    // echo $cadena;

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
                    <input type='text' class='form-control' id='precioTratamiento' name='precioTratamiento'>
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


	// $sql="SELECT id,
	// 		 id_continente,
	// 		 pais 
	// 	from t_mundo 
	// 	where id_continente='$continente'";

	// $result=mysqli_query($conexion,$sql);

	// $cadena="<label>SELECT 2 (paises)</label> 
	// 		<select id='lista2' name='lista2'>";

	// while ($ver=mysqli_fetch_row($result)) {
	// 	$cadena=$cadena.'<option value='.$ver[0].'>'.utf8_encode($ver[2]).'</option>';
	// }

	// echo  $cadena."</select>";
	
  
?>