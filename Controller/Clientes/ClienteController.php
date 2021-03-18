<?php 
    session_start();
    require_once "../connection.php";
    require_once "../../Model/Clientes/Cliente.php";


    $ModelCliente = new Cliente();
    $email = "";
    $name = "";
    $errors = array();

    if (isset($_POST['altaCliente'])) {
        //Valores del front
        $nombre      = mysqli_real_escape_string($con, $_POST['nombre']);
        $apellidos   = mysqli_real_escape_string($con, $_POST['apellidos']);
        $email       = mysqli_real_escape_string($con, $_POST['email']);
        $numero      = mysqli_real_escape_string($con, $_POST['numero']);
        $fecha       = mysqli_real_escape_string($con, $_POST['fecha']);
        $cp          = mysqli_real_escape_string($con, $_POST['cp']);

        //Contador de usuarios registrados
        $siguienteConsecutivo = strval(sizeof($ModelCliente->getAllUsuarios())+1);
        $id = "";
        $fechaParaId = "";
        if($fecha == ""){
            $fecha = strval(date('Y-m-d'));
        }
        $fechaParaId = $fecha[2].$fecha[3].$fecha[5].$fecha[6].$fecha[8].$fecha[9];
        $arregloApellidos = explode(" ",$apellidos);
        $id = strtoupper($nombre[0]).strtoupper($arregloApellidos[0][0]).strtoupper($arregloApellidos[1][0]).$fechaParaId.$siguienteConsecutivo;

        if(($ModelCliente->insertUsuario([$id, $nombre, $apellidos, $numero, $email]) == 1) && ($ModelCliente->insertClienteOpcional([$id, $fecha, $cp]))){
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
        
        foreach($ModelCliente->getClienteWhereNombreLike($nombre) as $clienteDB){
            echo "<li class='list-group-item d-flex justify-content-between align-items-center'>"
                    .$clienteDB['nombre_cliente']." ".$clienteDB['apellidos_cliente']."<br>
                    Fecha de Nacimiento: ".$clienteDB['fecha_cliente']."<br> 
                    E-Mail: ".$clienteDB['email_cliente']."<br> 
                    Numero: ".$clienteDB['telefono_cliente']."<br>
                    CP: ".$clienteDB['cp_cliente']."<a class='btn btn-warning' href='editarCliente.php?id=".$clienteDB['id_cliente']."' role='button'>Editar</a>
                  </li>";
        }
    }

    if(isset($_POST['editarCliente'])){
        $id     = mysqli_real_escape_string($con, $_POST['id']);
        $nombre      = mysqli_real_escape_string($con, $_POST['nombre']);
        $apellidos   = mysqli_real_escape_string($con, $_POST['apellidos']);
        $email       = mysqli_real_escape_string($con, $_POST['email']);
        $numero      = mysqli_real_escape_string($con, $_POST['numero']);
        $fecha       = mysqli_real_escape_string($con, $_POST['fecha']);
        $cp          = mysqli_real_escape_string($con, $_POST['cp']);

        print_r($id.",".$nombre.",".$apellidos.",".$email.",".$numero.",".$fecha.",".$cp);

        // if($ModelCliente->updateCliente([$id, $nombre, $edad, $numero]) == 1){
        //     header('location: index.php');
        //     exit();
        // } else {
        //     $errors['db-error'] = "Error al darse de alta!";
        // }
    }

?>