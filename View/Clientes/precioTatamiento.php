<?php 
  require_once "../../Controller/Clientes/ClienteController.php"; 
  require_once "../../Model/Clientes/Cliente.php";
  require_once "../../Controller/ControllerSesion.php";
  require_once "../../Model/Usuario/Usuario.php";
  require_once "../../Model/Tratamiento/Tratamiento.php";

  $ModelCliente = new Cliente();
  $ModelTratamiento = new Tratamiento();

  $tratamientos = $ModelTratamiento->getAllTratamientos();


  $idTratamiento=$_POST['idTratamiento'];

  $precioTratamiento = $ModelTratamiento->getPrecioTratamiento($idTratamiento);
  foreach($precioTratamiento as $d){
    echo $d['precio'];
  }
  
?>