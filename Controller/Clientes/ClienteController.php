<?php 
    session_start();
    require_once "../connection.php";
    require_once "../../Model/Clientes/Cliente.php";


    $ModelCliente = new Cliente();
    $email = "";
    $name = "";
    $errors = array();

    if (isset($_POST['altaCliente'])) {
        $nombre = mysqli_real_escape_string($con, $_POST['nombre']);
        $edad   = mysqli_real_escape_string($con, $_POST['edad']);
        $numero = mysqli_real_escape_string($con, $_POST['numero']);

        if($ModelCliente->insertUsuario([$nombre, $edad, $numero]) == 1){
            header('location: index.php');
            exit();
        } else {
            $errors['db-error'] = "Error al darse de alta!";
        }

        // $insert_query = "INSERT INTO `Cliente`(`Nombre`, `Edad`, `Numero`) 
        //                 VALUES ('$nombre', $edad, '$numero')";
        // $data_check   = mysqli_query($con, $insert_query);
        // if ($data_check) {
        //     header('location: clientes.php');
        //     exit();
        // } else {
        //     $errors['db-error'] = "Error al darse de alta!";
        // }
        // echo $insert_query;
    }

    if(isset($_POST['buscarCliente'])){
        $nombre = mysqli_real_escape_string($con, $_POST['nombre']);
        
        foreach($ModelCliente->getCliente($nombre) as $clienteDB){
            echo "<li class='list-group-item d-flex justify-content-between align-items-center'>"
                    .$clienteDB['Nombre']."<br> Edad: ".$clienteDB['Edad']."<br> Numero: ".$clienteDB['Numero']."<a class='btn btn-warning' href='editarCliente.php?id=".$clienteDB['ID_cliente']."' role='button'>Editar</a>
                  </li>";
        }
    }

    if(isset($_POST['editarCliente'])){
        $id     = mysqli_real_escape_string($con, $_POST['id']);
        $nombre = mysqli_real_escape_string($con, $_POST['nombre']);
        $edad   = mysqli_real_escape_string($con, $_POST['edad']);
        $numero = mysqli_real_escape_string($con, $_POST['numero']);

        if($ModelCliente->updateCliente([$id, $nombre, $edad, $numero]) == 1){
            header('location: index.php');
            exit();
        } else {
            $errors['db-error'] = "Error al darse de alta!";
        }
    }

?>