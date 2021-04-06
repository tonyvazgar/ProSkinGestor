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
    print_r(sizeof($ultimoTratamiento));
    
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