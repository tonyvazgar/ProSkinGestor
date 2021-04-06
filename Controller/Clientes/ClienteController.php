<?php 
    session_start();
    require_once "../../View/connection.php";
    require_once "../../Model/Clientes/Cliente.php";
    require_once "../../Model/Tratamiento/Tratamiento.php";


    $ModelCliente = new Cliente();
    $ModelTratamiento = new Tratamiento();
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
        $ultima_visita = $fecha_creacion;
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
                        CP: ".$clienteDB['cp_cliente']."
                        <div>
                            <a class='btn btn-warning' href='editarCliente.php?id=".$clienteDB['id_cliente']."' role='button'>Editar información</a>
                            <br>
                            <a class='btn btn-info' href='iniciarTratamientoCliente.php?id=".$clienteDB['id_cliente']."' role='button'>Registrar tratamiento</a>
                        </div>
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
        $fecha_visita   = strtotime(date('Y-m-d'));


        if($ModelCliente->updateCliente([$id, $nombre, $apellidos, $numero, $tipo, $email, $centro, strtotime($fecha_registro),$fecha_visita, $fecha, $cp]) == 1){
            header('location: index.php');
            exit();
        } else {
            $errors['db-error'] = "Error al darse de alta!";
        }
    }

    if(isset($_POST['comenzarTratamiento'])){

        //Al parecer solo seria para cuando es tratamiento normal
        $id_cliente         = mysqli_real_escape_string($con, $_POST['idCliente']);
        $id_cosmetologa     = mysqli_real_escape_string($con, $_POST['idCosmetologa']);
        $tratamiento        = mysqli_real_escape_string($con, $_POST['tratamiento']);  //1: Depilacion     2:Cavitacion        3:TratamientoNormal
        // $sesiones        = mysqli_real_escape_string($con, $_POST['sesiones'] ?? '0');
        $nombre_tratamiento = mysqli_real_escape_string($con, $_POST['nombreTratamiento']);      //Solo si es $tratamiento es tipo 3
        $precio_tratamiento = mysqli_real_escape_string($con, $_POST['precioTratamiento']);
        $zona               = mysqli_real_escape_string($con, $_POST['zona']);
        $metodo_pago        = mysqli_real_escape_string($con, $_POST['metodoPago']);
        $calificacion       = mysqli_real_escape_string($con, $_POST['calificacion']);
        $id_centro          = mysqli_real_escape_string($con, $_POST['idCentro']);
        $comentarios        = mysqli_real_escape_string($con, $_POST['comentarios']);
        $firma              = mysqli_real_escape_string($con, $_POST['aviso'] ?? '0');
        $timeStamp          = strtotime(date('Y-m-d'));

        // $ModelTratamiento->iniciarTratamientoCliente($id, $tratamiento, $sesiones, $zona, $firma, $timeStamp);

        //Insertar a venta
        $suma_ventas = $ModelTratamiento->getSumVentas()[0]['numVentas'];
        $suma_ventas += 1;
        $id_venta = $id_cliente.$nombre_tratamiento.$suma_ventas;

        $ModelTratamiento ->insertarVenta($id_venta, $id_cliente, $nombre_tratamiento, $metodo_pago, $precio_tratamiento, $timeStamp, $id_centro);

        //Insertar a ClienteTratamiento
        $ModelCliente->insertarClienteTratamiento($id_cliente, $nombre_tratamiento, $id_cosmetologa, $nombre_tratamiento, $zona, $timeStamp);

        //Insertar a ClienteBitacora
        $ModelCliente->insertarClienteBitacora($id_cliente, $nombre_tratamiento, $id_cosmetologa, $id_centro, $calificacion, $timeStamp, $zona, $comentarios);

        //Redirect a Tratamientos


        echo "<br>";

        print_r("Vamos a pasar ".$id_cliente." --> ".$tratamiento." --> ".$nombre_tratamiento." --> ".$precio_tratamiento." --> ".$zona." --> ".$metodo_pago." -->". $calificacion." --> ".$id_centro." --> ".$comentarios." --> ".$firma." --> ".$timeStamp);
    }

?>