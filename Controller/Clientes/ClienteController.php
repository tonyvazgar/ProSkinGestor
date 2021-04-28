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
        $nombre      = mysqli_real_escape_string($con, ucwords($_POST['nombre']));
        $apellidos   = mysqli_real_escape_string($con, ucwords($_POST['apellidos']));
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
        $date = new DateTime("now", new DateTimeZone('America/Mexico_City') );
        $fecha_creacion  = strtotime($date->format('Y-m-d'));
        $ultima_visita = $fecha_creacion;
        $aviso_privacidad = "1";
        
        if($fecha == ""){
            $fecha = $fecha_creacion;
        }
        $fechaParaId = $fecha[2].$fecha[3].$fecha[5].$fecha[6].$fecha[8].$fecha[9];
        $arregloApellidos = explode(" ",$apellidos);
        $id = strtoupper($nombre[0]).strtoupper($arregloApellidos[0][0]).strtoupper($arregloApellidos[1][0]).$fechaParaId.$siguienteConsecutivo;
        
        //"INSERT INTO `Cliente`(`id_cliente`, `nombre_cliente`, `apellidos_cliente`, `telefono_cliente`, `tipo_numero_cliente`, `email_cliente`, `centro_cliente`, `creacion_cliente`, `ultima_visita_cliente`) VALUES ('$array[0]', '$array[1]', '$array[2]', $array[3], '$array[4]', '$array[5]', '$array[6]', '$array[7]', '$array[8]')";
        
        if(($ModelCliente->insertUsuario([$id, $nombre, $apellidos, $numero, $tipo_numero, $email, $centro, $fecha_creacion, $ultima_visita, $aviso_privacidad]) == 1) && ($ModelCliente->insertClienteOpcional([$id, $fecha, $cp])) && ($ModelCliente->insertClienteStatus([$id, 'activo']))){
            header('location: exito.php');
            exit();
        } else {
            $errors['db-error'] = "Error al darse de alta!";
        }
    }

    if(isset($_POST['buscarCliente'])){
        $nombre    = mysqli_real_escape_string($con, ucwords($_POST['nombre']));
        $resultado = $ModelCliente->getClienteWhereNombreLike($nombre);
        echo "<div class='container'>
                <ul class='list-group'>";
        if(sizeof($resultado) >= 1){
            foreach($resultado as $clienteDB){
                echo "<li class='list-group-item d-flex justify-content-between align-items-center'>"
                        .$clienteDB['nombre_cliente']." ".$clienteDB['apellidos_cliente']."<br>
                        Fecha de Nacimiento: ".$clienteDB['fecha_cliente']."<br> 
                        E-Mail: ".$clienteDB['email_cliente']."<br> 
                        Numero: ".$clienteDB['telefono_cliente']."
                        <div>
                            <a class='btn btn-warning' href='informacionCliente.php?id=".$clienteDB['id_cliente']."' role='button'>Ver información</a>
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

    if(isset($_POST['editarClienteButton'])){
        $id     = mysqli_real_escape_string($con, $_POST['id']);
        $nombre      = mysqli_real_escape_string($con, ucwords($_POST['nombre']));
        $apellidos   = mysqli_real_escape_string($con, ucwords($_POST['apellidos']));
        $email       = mysqli_real_escape_string($con, $_POST['email']);
        $numero      = mysqli_real_escape_string($con, $_POST['numero']);
        $tipo        = mysqli_real_escape_string($con, $_POST['tipo']);
        $centro      = mysqli_real_escape_string($con, $_POST['centro']);
        $fecha       = mysqli_real_escape_string($con, $_POST['fecha']);
        $cp          = mysqli_real_escape_string($con, $_POST['cp']);
        $fecha_registro = mysqli_real_escape_string($con, $_POST['fecha_registro']);
        $date = new DateTime("now", new DateTimeZone('America/Mexico_City') );
        $fecha_visita  = strtotime($date->format('Y-m-d'));


        if($ModelCliente->updateCliente([$id, $nombre, $apellidos, $numero, $tipo, $email, $centro, strtotime($fecha_registro),$fecha_visita, $fecha, $cp]) == 1){
            header('location: exito.php');
            // exit();
        } else {
            $errors['db-error'] = "Error al darse de alta!";
        }
    }

    if(isset($_POST['comenzarTratamiento'])){

        //Al parecer solo seria para cuando es tratamiento normal
        $id_cliente         = mysqli_real_escape_string($con, $_POST['idCliente']);                                                      //Es un valor: [idCliente] => RL96061115
        $id_cosmetologa     = mysqli_real_escape_string($con, $_POST['idCosmetologa']);                                                  //Es un valor: [idCosmetologa] => 8
        $tratamiento        = explode(",",mysqli_real_escape_string($con, implode(",", $_POST['tratamiento'])));                         //Es un Array: [tratamiento] => Array([0] => 2 [1] => 3 [2] => 1 )
        $nombre_tratamiento = explode(",",mysqli_real_escape_string($con, implode(",", $_POST['nombreTratamiento'])));                   //Es un Array: [nombreTratamiento] => Array([0] => CAV01 [1] => MAS34 [2] => DEP01 )
        $precio_tratamiento = explode(",",mysqli_real_escape_string($con, implode(",", $_POST['precioTratamiento'])));                   //Es un Array: [precioTratamiento] => Array([0] => 300 [1] => 550 [2] => 500)
        $zona               = $_POST['zonas_cuerpo'];                        //Es un Array de Arrays (si es vacio es un tratamiento normal): [zonas_cuerpo] => Array([0] => Array ([0] => 20 [1] => 22 [2] => 15 [3] => 1 ) [1] => Array ([0] => ) [2] => Array ([0] => 23))
        $detalle_zona       = explode(",",mysqli_real_escape_string($con, implode(",", $_POST['detalleZona'])));
        $metodo_pago        = explode(",",mysqli_real_escape_string($con, implode(",", $_POST['metodoPago'])));                          //Es un Array: [metodoPago] => Array([0] => 2 [1] => 3 [2] => 1)
        $calificacion       = explode(",",mysqli_real_escape_string($con, implode(",", $_POST['calificacion'])));                        //Es un Array: [calificacion] => Array([0] => 1 [1] => 3 [2] => 4)
        $id_centro          = mysqli_real_escape_string($con, $_POST['idCentro']);                                                       //Es un valor: [idCentro] => 1
        $comentarios        = explode(",",mysqli_real_escape_string($con, implode(",", str_replace(",", ".", $_POST['comentarios']))));  //Es un Array: [comentarios] => Array([0] => Cavitación con 9 numero de zonas, metido de tarjeta de ¢300 y 4 zonas, 1 estrella [1] => Masaje relajante con ¢550, otro método de pago y 3 estrellas [2] => Depilación con 10 números de zonas, la zona del cuerpo que es 23 y con 4 de calificación y $500 )
        $firma              = mysqli_real_escape_string($con, $_POST['aviso'] ?? '0');                                                   //Es un valor: [aviso] => 1
        $date               = new DateTime("now", new DateTimeZone('America/Mexico_City') );
        $timeStamp          = strtotime($date->format('Y-m-d H:i:s'));
        //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        //************LOGICA PARA REGISTRAR 1 O MUCHOS TRATAMIENTOS EN UN POST************
        $numero_de_tratamientos   = sizeof($tratamiento);
        $tratamientos_a_registrar = [];     //Aqui se meteran toda la info de los tratamientos
        
        for ($i=1; $i <= $numero_de_tratamientos ; $i++) { //Iterar por cada tratamiento que se va a registrar, 1..n
            $temp = [];
            if($tratamiento[$i-1] != 3){   //Es tratamiento de depilacion o cavitacion
                $string_zonas = "";
                $zona_del_tratamiento = $zona[$i-1];
                foreach ($zona_del_tratamiento as $k) {
                    $string_zonas .= $k.",";
                }
                //tempVentaTratamiento           = $id_venta, $id_cliente, 'CAV01', $metodo_pago, $precio_tratamiento, $timeStamp, $id_centro, $precio_tratamiento, '', '', '', $id_cosmetologa
                $tempVentaTratamiento            = ['', $id_cliente, $nombre_tratamiento[$i-1], $metodo_pago[$i-1], $precio_tratamiento[$i-1], $timeStamp, $id_centro, $precio_tratamiento[$i-1], '', '', '', $id_cosmetologa];
                //tempClienteTratamientoEspecial = $id_cliente, $nombre_tratamiento, $id_cosmetologa, $nombre_tratamiento, $zona, $numZonas, $timeStamp, $numsesion;
                $tempClienteTratamientoEspecial  = [$id_cliente, $nombre_tratamiento[$i-1], $id_cosmetologa, $nombre_tratamiento[$i-1], $string_zonas, $detalle_zona[$i-1], $timeStamp, ''];
                //tempClienteBitacora            = $id_cliente, $nombre_tratamiento, $id_cosmetologa, $id_centro, $calificacion, $timeStamp, $zona, $comentarios, $id_venta
                $tempClienteBitacora             = [$id_cliente, $nombre_tratamiento[$i-1], $id_cosmetologa, $id_centro, $calificacion[$i-1], $timeStamp, $string_zonas, $comentarios[$i-1], ''];

                array_push($temp, [$tratamiento[$i-1]], $tempVentaTratamiento, $tempClienteTratamientoEspecial, $tempClienteBitacora);
            }else{  //es un tratamiento normal
                //tempVentaTratamiento   = $id_venta, $id_cliente, $nombre_tratamiento, $metodo_pago, $precio_tratamiento, $timeStamp, $id_centro, $precio_tratamiento, '', '', '', $id_cosmetologa
                $tempVentaTratamiento    = ['', $id_cliente, $nombre_tratamiento[$i-1], $metodo_pago[$i-1], $precio_tratamiento[$i-1], $timeStamp, $id_centro, $precio_tratamiento[$i-1], '', '', '', $id_cosmetologa];
                //tempClienteTratamiento = $id_cliente, $nombre_tratamiento, $id_cosmetologa, $nombre_tratamiento, $zona, $timeStamp
                $tempClienteTratamiento  = [$id_cliente, $nombre_tratamiento[$i-1], $id_cosmetologa, $nombre_tratamiento[$i-1], '', $timeStamp];
                //tempClienteBitacora    = $id_cliente, $nombre_tratamiento, $id_cosmetologa, $id_centro, $calificacion, $timeStamp, $zona, $comentarios, $id_venta
                $tempClienteBitacora     = [$id_cliente, $nombre_tratamiento[$i-1], $id_cosmetologa, $id_centro, $calificacion[$i-1], $timeStamp, '', $comentarios[$i-1], ''];

                array_push($temp, [$tratamiento[$i-1]], $tempVentaTratamiento, $tempClienteTratamiento, $tempClienteBitacora);
            }
            array_push($tratamientos_a_registrar, $temp);
        }
        
        $suma_ventas = $ModelTratamiento->getSumVentas()[0]['numVentas'];
        $suma_ventas += 1;
        $ID_VENTA_UUID = '';
        
        foreach($tratamientos_a_registrar as $tar){
            //$id_venta = $id_cliente.$nombre_tratamiento.$suma_ventas;
            if($ID_VENTA_UUID == ''){
                $ID_VENTA_UUID                     = $tar[1][1].$tar[1][2].$suma_ventas;     //id de venta general para todo el registro
            }
            $insertarAVentaTratamiento    = $tar[1];
            $insertarAVentaTratamiento[0] = $ID_VENTA_UUID;

            $insertarAClienteTratamiento  = $tar[2];

            $insertarClienteBitacora      = $tar[3];
            $insertarClienteBitacora[8]   = $ID_VENTA_UUID;
            if($tar[0][0] == 3){    //aplicar metodos de insertar tratamiento normal
                $ModelTratamiento->insertarVentaTratamiento($insertarAVentaTratamiento[0], $insertarAVentaTratamiento[1], $insertarAVentaTratamiento[2], $insertarAVentaTratamiento[3], $insertarAVentaTratamiento[4], $insertarAVentaTratamiento[5], $insertarAVentaTratamiento[6], $insertarAVentaTratamiento[7], '', '', '', $insertarAVentaTratamiento[11]);

                //Insertar a ClienteTratamiento
                $ModelCliente->insertarClienteTratamiento($insertarAClienteTratamiento[0], $insertarAClienteTratamiento[1], $insertarAClienteTratamiento[2], $insertarAClienteTratamiento[3], $insertarAClienteTratamiento[4], $insertarAClienteTratamiento[5]);

                //Insertar a ClienteBitacora
                $ModelCliente->insertarClienteBitacora($insertarClienteBitacora[0], $insertarClienteBitacora[1], $insertarClienteBitacora[2], $insertarClienteBitacora[3], $insertarClienteBitacora[4], $insertarClienteBitacora[5], $insertarClienteBitacora[6], $insertarClienteBitacora[7], $insertarClienteBitacora[8]);

            }else{                  //aplicar metodos de insertar tratamiento especial
                //**contaviizar numero sesion */
                if($insertarAVentaTratamiento[2] == 'CAV01'){ //depilacion

                    $insertarAClienteTratamiento[7] = $ModelCliente->getNumeroSesionesDepilacion($id_cliente)[0]['sesiones'] + 1;

                    //Insertar a venta
                    $ModelTratamiento->insertarVentaTratamiento($insertarAVentaTratamiento[0], $insertarAVentaTratamiento[1], $insertarAVentaTratamiento[2], $insertarAVentaTratamiento[3], $insertarAVentaTratamiento[4], $insertarAVentaTratamiento[5], $insertarAVentaTratamiento[6], $insertarAVentaTratamiento[7], '', '', '', $insertarAVentaTratamiento[11]);

                    $ModelCliente->insertarClienteTratamientoEspecial($insertarAClienteTratamiento[0], $insertarAClienteTratamiento[1], $insertarAClienteTratamiento[2], $insertarAClienteTratamiento[3], $insertarAClienteTratamiento[4], $insertarAClienteTratamiento[5], $insertarAClienteTratamiento[6], $insertarAClienteTratamiento[7]);

                    // //Insertar a ClienteBitacora
                    $ModelCliente->insertarClienteBitacora($insertarClienteBitacora[0], $insertarClienteBitacora[1], $insertarClienteBitacora[2], $insertarClienteBitacora[3], $insertarClienteBitacora[4], $insertarClienteBitacora[5], $insertarClienteBitacora[6], $insertarClienteBitacora[7], $insertarClienteBitacora[8]);
                }else{  //caviytacion
                    $insertarAClienteTratamiento[7] = $ModelCliente->getNumeroSesionesCavitacion($id_cliente)[0]['sesiones'] + 1;


                    //Insertar a venta
                    $ModelTratamiento->insertarVentaTratamiento($insertarAVentaTratamiento[0], $insertarAVentaTratamiento[1], $insertarAVentaTratamiento[2], $insertarAVentaTratamiento[3], $insertarAVentaTratamiento[4], $insertarAVentaTratamiento[5], $insertarAVentaTratamiento[6], $insertarAVentaTratamiento[7], '', '', '', $insertarAVentaTratamiento[11]);

                    $ModelCliente->insertarClienteTratamientoEspecial($insertarAClienteTratamiento[0], $insertarAClienteTratamiento[1], $insertarAClienteTratamiento[2], $insertarAClienteTratamiento[3], $insertarAClienteTratamiento[4], $insertarAClienteTratamiento[5], $insertarAClienteTratamiento[6], $insertarAClienteTratamiento[7]);

                    // //Insertar a ClienteBitacora
                    $ModelCliente->insertarClienteBitacora($insertarClienteBitacora[0], $insertarClienteBitacora[1], $insertarClienteBitacora[2], $insertarClienteBitacora[3], $insertarClienteBitacora[4], $insertarClienteBitacora[5], $insertarClienteBitacora[6], $insertarClienteBitacora[7], $insertarClienteBitacora[8]);
                }
            }
        }
        $ModelCliente->updateUltimaVisita($id_cliente, $timeStamp);

        header("Location: ../../View/Ventas/detalleVenta.php?idVenta=$ID_VENTA_UUID");
        //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        // // $ModelTratamiento->iniciarTratamientoCliente($id, $tratamiento, $sesiones, $zona, $firma, $timeStamp);

        // //Insertar a venta
        // $suma_ventas = $ModelTratamiento->getSumVentas()[0]['numVentas'];
        // $suma_ventas += 1;
        // $id_venta = $id_cliente.$nombre_tratamiento.$suma_ventas;

        // //$ModelTratamiento ->insertarVenta($id_venta, $id_cliente, $nombre_tratamiento, $metodo_pago, $precio_tratamiento, $timeStamp, $id_centro);
        // $ModelTratamiento->insertarVentaTratamiento($id_venta, $id_cliente, $nombre_tratamiento, $metodo_pago, $precio_tratamiento, $timeStamp, $id_centro, $precio_tratamiento, '', '', '', $id_cosmetologa);

        // //Insertar a ClienteTratamiento
        // $ModelCliente->insertarClienteTratamiento($id_cliente, $nombre_tratamiento, $id_cosmetologa, $nombre_tratamiento, $zona, $timeStamp);

        // //Insertar a ClienteBitacora
        // $ModelCliente->insertarClienteBitacora($id_cliente, $nombre_tratamiento, $id_cosmetologa, $id_centro, $calificacion, $timeStamp, $zona, $comentarios, $id_venta);

        // //Redirect a Tratamientos

        // $ModelCliente->updateUltimaVisita($id_cliente, $timeStamp);

        // //href='detalleVenta.php?idVenta="

        // header("Location: ../../View/Ventas/detalleVenta.php?idVenta=$id_venta");
        print_r($_POST);
        echo "<br>";
        echo "<br>";
        print_r("Vamos a pasar [".$id_cliente
                ."] id_cosmetologa: --> [".$id_cosmetologa
                ."] Tratamiento: --> [".$tratamiento
                ."] --> Nombre tratamiento [".$nombre_tratamiento
                ."] --> precio_tratamiento [".$precio_tratamiento
                ."] --> zona [".$zona
                ."] --> metodo_pago [".$metodo_pago
                ."] --> calificacion [". $calificacion
                ."] --> id_centro [".$id_centro
                ."] --> comentarios [".$comentarios
                ."] --> firma [".$firma
                ."] --> timeStamp [".$timeStamp);
    }

    if(isset($_POST['comenzarTratamientoDepilacion'])){

        //Al parecer solo seria para cuando es tratamiento normal
        $id_cliente         = mysqli_real_escape_string($con, $_POST['idCliente']);
        $id_cosmetologa     = mysqli_real_escape_string($con, $_POST['idCosmetologa']);
        $tratamiento        = mysqli_real_escape_string($con, $_POST['tratamiento']);  //1: Depilacion     2:Cavitacion        3:TratamientoNormal
        $detalle_zona       = mysqli_real_escape_string($con, $_POST['detalleZona'] ?? '0');
        $metodo_pago        = mysqli_real_escape_string($con, $_POST['metodoPago']);
        $nombre_tratamiento = mysqli_real_escape_string($con, 'DEP01');      //Solo si es $tratamiento es tipo 3
        $precio_tratamiento = mysqli_real_escape_string($con, $_POST['precioTratamiento']);
        $zona               = mysqli_real_escape_string($con, implode(",", $_POST['zonas_cuerpo']));
        $calificacion       = mysqli_real_escape_string($con, $_POST['calificacion']);
        $id_centro          = mysqli_real_escape_string($con, $_POST['idCentro']);
        $comentarios        = mysqli_real_escape_string($con, $_POST['comentarios']);
        $firma              = mysqli_real_escape_string($con, $_POST['aviso'] ?? '0');
        $date               = new DateTime("now", new DateTimeZone('America/Mexico_City') );
        $timeStamp          = strtotime($date->format('Y-m-d H:i:s'));

        $suma_ventas = $ModelTratamiento->getSumVentas()[0]['numVentas'];
        $suma_ventas += 1;
        $id_venta = $id_cliente.$nombre_tratamiento.$suma_ventas;

        // $ModelTratamiento->iniciarTratamientoCliente($id, $tratamiento, $sesiones, $zona, $firma, $timeStamp);

        // //Insertar a ClienteTratamiento
        $num_sesion = $ModelCliente->getNumeroSesionesDepilacion($id_cliente)[0]['sesiones'] + 1;
        $ModelCliente->insertarClienteTratamientoEspecial($id_cliente, 'DEP01', $id_cosmetologa, 'Depilacion', $zona, $detalle_zona, $timeStamp, $num_sesion);


        // //Insertar a ClienteBitacora
        $ModelCliente->insertarClienteBitacora($id_cliente, 'DEP01', $id_cosmetologa, $id_centro, $calificacion, $timeStamp, $zona, $comentarios, $id_venta);



        //Insertar a venta

        //$ModelTratamiento ->insertarVenta($id_venta, $id_cliente, $nombre_tratamiento, $metodo_pago, $precio_tratamiento, $timeStamp, $id_centro);
        $ModelTratamiento->insertarVentaTratamiento($id_venta, $id_cliente, 'DEP01', $metodo_pago, $precio_tratamiento, $timeStamp, $id_centro, $precio_tratamiento, '', '', '', $id_cosmetologa);


        $ModelCliente->updateUltimaVisita($id_cliente, $timeStamp);


        // //Redirect a Tratamientos

        header("Location: ../../View/Ventas/detalleVenta.php?idVenta=$id_venta");

        // print_r("Vamos a pasar ".$id_cliente." --> ".$id_cosmetologa." --> ".$detalle_zona." --> ".$metodo_pago." --> ".$nombre_tratamiento." --> ".$precio_tratamiento." -->". $zona." --> ".$calificacion." --> ".$id_centro." --> ".$comentarios." --> ".$firma." --> ".$timeStamp);
    }

    if(isset($_POST['comenzarTratamientoCavitacion'])){

        //Al parecer solo seria para cuando es tratamiento normal
        $id_cliente         = mysqli_real_escape_string($con, $_POST['idCliente']);
        $id_cosmetologa     = mysqli_real_escape_string($con, $_POST['idCosmetologa']);
        $tratamiento        = mysqli_real_escape_string($con, $_POST['tratamiento']);  //1: Depilacion     2:Cavitacion        3:TratamientoNormal
        $detalle_zona       = mysqli_real_escape_string($con, $_POST['detalleZona'] ?? '0');
        $metodo_pago        = mysqli_real_escape_string($con, $_POST['metodoPago']);
        $nombre_tratamiento = mysqli_real_escape_string($con, 'CAV01');      //Solo si es $tratamiento es tipo 3
        $precio_tratamiento = mysqli_real_escape_string($con, $_POST['precioTratamiento']);
        $zona               = mysqli_real_escape_string($con, implode(",", $_POST['zonas_cuerpo']));
        $calificacion       = mysqli_real_escape_string($con, $_POST['calificacion']);
        $id_centro          = mysqli_real_escape_string($con, $_POST['idCentro']);
        $comentarios        = mysqli_real_escape_string($con, $_POST['comentarios']);
        $firma              = mysqli_real_escape_string($con, $_POST['aviso'] ?? '0');

        $date               = new DateTime("now", new DateTimeZone('America/Mexico_City') );
        $timeStamp          = strtotime($date->format('Y-m-d H:i:s'));

        $suma_ventas = $ModelTratamiento->getSumVentas()[0]['numVentas'];
        $suma_ventas += 1;
        $id_venta = $id_cliente.$nombre_tratamiento.$suma_ventas;

        // // //Insertar a ClienteTratamiento
        $num_sesion = $ModelCliente->getNumeroSesionesCavitacion($id_cliente)[0]['sesiones'] + 1;
        $ModelCliente->insertarClienteTratamientoEspecial($id_cliente, 'CAV01', $id_cosmetologa, 'Cavitacion', $zona, $detalle_zona, $timeStamp, $num_sesion);


        // // //Insertar a ClienteBitacora
        $ModelCliente->insertarClienteBitacora($id_cliente, 'CAV01', $id_cosmetologa, $id_centro, $calificacion, $timeStamp, $zona, $comentarios, $id_venta);



        //Insertar a venta

        //$ModelTratamiento ->insertarVenta($id_venta, $id_cliente, $nombre_tratamiento, $metodo_pago, $precio_tratamiento, $timeStamp, $id_centro);
        $ModelTratamiento->insertarVentaTratamiento($id_venta, $id_cliente, 'CAV01', $metodo_pago, $precio_tratamiento, $timeStamp, $id_centro, $precio_tratamiento, '', '', '', $id_cosmetologa);


        $ModelCliente->updateUltimaVisita($id_cliente, $timeStamp);


        // // //Redirect a Tratamientos

        header("Location: ../../View/Ventas/detalleVenta.php?idVenta=$id_venta");

        // print_r("Dando la siguiente info en Cavitacion ".$id_cliente." --> ".$id_cosmetologa." --> ".$detalle_zona." --> ".$metodo_pago." --> ".$nombre_tratamiento." --> ".$precio_tratamiento." -->". $zona." --> ".$calificacion." --> ".$id_centro." --> ".$comentarios." --> ".$firma." --> ".$timeStamp);
    }

?>