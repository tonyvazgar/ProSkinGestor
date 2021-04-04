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

  $ultimoTratamiento = $ModelTratamiento->getAllTratamientosEspecialesWhereCliente($id_cliente);

  if($continente=='1'){ //Si es depilacion
    $cadena = "<select name='select2lista' id='select2lista' class='form-control' ></select>";
    print_r($ultimoTratamiento);
    echo $cadena;

  }else if($continente=='2'){ //Si es cavitacion
    $cadena = "<select name='select2lista' id='select2lista' class='form-control'></select>";
    echo $cadena;

  }else if($continente =='3'){  //Si es cualquier otro tratamiento
    $cadena = "<select name='select2lista' id='select2lista' class='form-control'>";
    foreach($tratamientos as $tratamiento){
      $cadena .= "<option value='".$tratamiento['id_tratamiento']."'>".$tratamiento['nombre_tratamiento']."</option>";
    }
    
    $cadena.= "</select>";
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