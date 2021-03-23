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
        $tipo_numero = mysqli_real_escape_string($con, $_POST['tipo']);
        $centro      = mysqli_real_escape_string($con, $_POST['centro']);
        $fecha       = mysqli_real_escape_string($con, $_POST['fecha']);
        $cp          = mysqli_real_escape_string($con, $_POST['cp']);

        //Contador de usuarios registrados
        $siguienteConsecutivo = strval(sizeof($ModelCliente->getAllUsuarios())+1);
        $id = "";
        $fechaParaId = "";
        $fecha_creacion = strtotime(date('Y-m-d'));
        $ultima_visita = "";
        $aviso_privacidad = "1";
        
        if($fecha == ""){
            $fecha = strval(date('Y-m-d'));
        }
        $fechaParaId = $fecha[2].$fecha[3].$fecha[5].$fecha[6].$fecha[8].$fecha[9];
        $arregloApellidos = explode(" ",$apellidos);
        $id = strtoupper($nombre[0]).strtoupper($arregloApellidos[0][0]).strtoupper($arregloApellidos[1][0]).$fechaParaId.$siguienteConsecutivo;
        
        //"INSERT INTO `Cliente`(`id_cliente`, `nombre_cliente`, `apellidos_cliente`, `telefono_cliente`, `tipo_numero_cliente`, `email_cliente`, `centro_cliente`, `creacion_cliente`, `ultima_visita_cliente`) VALUES ('$array[0]', '$array[1]', '$array[2]', $array[3], '$array[4]', '$array[5]', '$array[6]', '$array[7]', '$array[8]')";
        
        if(($ModelCliente->insertUsuario([$id, $nombre, $apellidos, $numero, $tipo_numero, $email, $centro, $fecha_creacion, $ultima_visita, $aviso_privacidad]) == 1) && ($ModelCliente->insertClienteOpcional([$id, $fecha, $cp])) && ($ModelCliente->insertClienteStatus([$id, 'activo']))){
            header('location: index.php');
            exit();
        } else {
            $errors['db-error'] = "Error al darse de alta!";
        }
    }

    if(isset($_POST['buscarCliente'])){
        $nombre    = mysqli_real_escape_string($con, $_POST['nombre']);
        $resultado = $ModelCliente->getClienteWhereNombreLike($nombre);
        echo "<div class='container'>
                <ul class='list-group'>";
        if(sizeof($resultado) >= 1){
            foreach($resultado as $clienteDB){
                echo "<li class='list-group-item d-flex justify-content-between align-items-center'>"
                        .$clienteDB['nombre_cliente']." ".$clienteDB['apellidos_cliente']."<br>
                        Fecha de Nacimiento: ".$clienteDB['fecha_cliente']."<br> 
                        E-Mail: ".$clienteDB['email_cliente']."<br> 
                        Numero: ".$clienteDB['telefono_cliente']."<br>
                        CP: ".$clienteDB['cp_cliente']."<a class='btn btn-warning' href='editarCliente.php?id=".$clienteDB['id_cliente']."' role='button'>Editar</a>
                      </li>";
            }
        }else{
            echo "<li class='list-group-item text-center'>
                    <h1 >No hay resultados</h1>
                  </li>";
        }
        echo "</ul>
            </div>";
    }

    if(isset($_POST['editarCliente'])){
        $id     = mysqli_real_escape_string($con, $_POST['id']);
        $nombre      = mysqli_real_escape_string($con, $_POST['nombre']);
        $apellidos   = mysqli_real_escape_string($con, $_POST['apellidos']);
        $email       = mysqli_real_escape_string($con, $_POST['email']);
        $numero      = mysqli_real_escape_string($con, $_POST['numero']);
        $tipo        = mysqli_real_escape_string($con, $_POST['tipo']);
        $centro      = mysqli_real_escape_string($con, $_POST['centro']);
        $fecha       = mysqli_real_escape_string($con, $_POST['fecha']);
        $cp          = mysqli_real_escape_string($con, $_POST['cp']);
        $fecha_registro = mysqli_real_escape_string($con, $_POST['fecha_registro']);
        $fecha_visita   = mysqli_real_escape_string($con, $_POST['fecha_visita']);


        if($ModelCliente->updateCliente([$id, $nombre, $apellidos, $numero, $tipo, $email, $centro, strtotime($fecha_registro),$fecha_visita, $fecha, $cp]) == 1){
            header('location: index.php');
            exit();
        } else {
            $errors['db-error'] = "Error al darse de alta!";
        }
    }

?>