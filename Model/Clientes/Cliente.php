<?php
    include "../../Model/Db.php";

    class Cliente {
        public function getAllUsuarios(){
            $db = new DB();
            $account = $db->query('SELECT * FROM Cliente')->fetchAll();
            $db->close();
            return $account;
        }
        public function getUltimaVisitaCliente(){
            $db = new DB();
            $account = $db->query('SELECT Cliente.id_cliente, Cliente.ultima_visita_cliente FROM Cliente')->fetchAll();
            $db->close();
            return $account;
        }

        public function getStatusCliente($id_cliente){
            $db = new DB();
            $sql_statement = "SELECT status FROM ClienteStatus WHERE id_cliente = '$id_cliente'";
            $account = $db->query($sql_statement)->fetchAll();
            $db->close();
            return $account;
        }

        public function setStatusCliente($id_cliente, $status){
            //UPDATE `ClienteStatus` SET `status` = 'inactivo' WHERE `ClienteStatus`.`id_cliente` = 'LVG9405285';
            $db = new DB();
            
            $sql_statement = "UPDATE ClienteStatus 
                              SET ClienteStatus.status = '$status'
                              WHERE ClienteStatus.id_cliente='$id_cliente'";

            $account = $db->query($sql_statement);
            $db->close();
            return $account->affectedRows();
        }
        public function insertUsuario($array){
            $db = new DB();
            //INSERT INTO `Cliente`(`id_cliente`, `nombre_cliente`, `apellidos_cliente`, `telefono_cliente`, `email_cliente`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5])
            $sql_statement = "INSERT INTO `Cliente`(`id_cliente`, `nombre_cliente`, `apellidos_cliente`, `telefono_cliente`, `tipo_numero_cliente`, `email_cliente`, `centro_cliente`, `creacion_cliente`, `ultima_visita_cliente`, `aviso_privacidad_cliente`)
                            VALUES ('$array[0]', '$array[1]', '$array[2]', $array[3], '$array[4]', '$array[5]', '$array[6]', '$array[7]', '$array[8]', '$array[9]')";
            $query = $db->query($sql_statement);
            $db->close();
            return $query->affectedRows();
        }
        public function insertClienteOpcional($array){
            $db = new DB();
            //INSERT INTO `ClienteOpcional`(`id_cliente`, `fecha_cliente`, `cp_cliente`) VALUES
            $sql_statement = "INSERT INTO `ClienteOpcional`(`id_cliente`, `fecha_cliente`, `cp_cliente`)
                            VALUES ('$array[0]', '$array[1]', '$array[2]')";
            $query = $db->query($sql_statement);
            $db->close();
            return $query->affectedRows();
        }
        public function insertClienteStatus($array){
            $db = new DB();
            //INSERT INTO `ClienteStatus` (`id_cliente`, `status`) VALUES ('w', 'activo');
            $sql_statement = "INSERT INTO `ClienteStatus` (`id_cliente`, `status`) 
                            VALUES ('$array[0]', '$array[1]')";
            $query = $db->query($sql_statement);
            $db->close();
            return $query->affectedRows();

        }
        public function getClienteWhereNombreLike($nombre){
            $db = new DB();
            //SELECT * FROM ClienteOpcional, (SELECT * FROM `Cliente` WHERE BINARY nombre_cliente LIKE '%maria%') AS Nombre WHERE ClienteOpcional.id_cliente=Nombre.id_cliente
            $sql_statement = "SELECT * 
                              FROM ClienteOpcional, (SELECT * FROM `Cliente` WHERE BINARY nombre_cliente LIKE '%$nombre%') AS Nombre 
                              WHERE ClienteOpcional.id_cliente = Nombre.id_cliente";
            $account = $db->query($sql_statement)->fetchAll();
            $db->close();
            return $account;
        }
        public function getClienteWhereID($id){
            $db = new DB();
            $sql_statement = "SELECT * FROM Cliente, ClienteOpcional, ClienteStatus 
                              WHERE Cliente.id_cliente='$id' 
                              AND Cliente.id_cliente = ClienteOpcional.id_cliente
                              AND ClienteStatus.id_cliente = ClienteOpcional.id_cliente";
            $account = $db->query($sql_statement)->fetchAll();
            $db->close();
            return $account;
        }
        public function updateCliente($array){
            $db = new DB();
            
            $sql_statement = "UPDATE Cliente, ClienteOpcional 
                              SET Cliente.nombre_cliente = '$array[1]',
                              Cliente.apellidos_cliente = '$array[2]',
                              Cliente.telefono_cliente = '$array[3]',
                              Cliente.tipo_numero_cliente = '$array[4]',
                              Cliente.email_cliente = '$array[5]',
                              Cliente.centro_cliente = '$array[6]',
                              Cliente.creacion_cliente = '$array[7]',
                              Cliente.ultima_visita_cliente = '$array[8]',
                              ClienteOpcional.fecha_cliente = '$array[9]',
                              ClienteOpcional.cp_cliente = '$array[10]'
                              WHERE Cliente.id_cliente=ClienteOpcional.id_cliente 
                              AND Cliente.id_cliente='$array[0]'";

            $account = $db->query($sql_statement);
            $db->close();
            return $account->affectedRows();
        }

        function updateUltimaVisita($id_cliente, $timestamp){
            //UPDATE `Cliente` SET `ultima_visita_cliente` = '1617746401' WHERE `Cliente`.`id_cliente` = 'PRG00010111';
            $db = new DB();
            $sql_statement = "UPDATE `Cliente` 
                              SET `ultima_visita_cliente` = '$timestamp' 
                              WHERE `Cliente`.`id_cliente` = '$id_cliente'";

            $account = $db->query($sql_statement);
            $db->close();
            return $account->affectedRows();
        }

        function insertarClienteTratamiento($id_cliente, $id_tratamiento, $id_cosmetologa, $nombre_tratamiento, $zona_cuerpo, $timestamp){
            //Insertar a ClienteTratamiento
            $db = new DB();
            $sql_statement = "INSERT INTO `ClienteTratamiento`(`id_cliente`, `id_tratamiento`, `id_cosmetologa`, `nombre_tratamiento`, `zona_cuerpo`, `fecha_aplicacion`) VALUES 
                              ('$id_cliente', '$id_tratamiento', '$id_cosmetologa', '$nombre_tratamiento', '$zona_cuerpo', '$timestamp')";
            $query = $db->query($sql_statement);
            $db->close();
            return $query->affectedRows();
        }


        function insertarClienteTratamientoEspecial($id_cliente, $id_tratamiento, $id_cosmetologa, $nombre_tratamiento, $zona, $detalle_zona, $timestamp, $num_sesion){
            //INSERT INTO `ClienteTratamientoEspecial`(`id_cliente`, `id_tratamiento`, `id_cosmetologa`, `nombre_tratamiento`, `zona`, `detalle_zona`, `timestamp`, `num_sesion`) VALUES
            $db = new DB();
            $sql_statement = "INSERT INTO `ClienteTratamientoEspecial`(`id_cliente`, `id_tratamiento`, `id_cosmetologa`, `nombre_tratamiento`, `zona`, `detalle_zona`, `timestamp`, `num_sesion`) VALUES 
                              ('$id_cliente', '$id_tratamiento', '$id_cosmetologa', '$nombre_tratamiento', '$zona', '$detalle_zona', '$timestamp', '$num_sesion')";
            $query = $db->query($sql_statement);
            $db->close();
            return $query->affectedRows();
        }

        function getNumeroSesionesDepilacion($id_cliente){
            //SELECT * FROM `ClienteTratamientoEspecial` WHERE nombre_tratamiento='Depilacion' AND id_cliente='AVG21032610'
            $db = new DB();
            $account = $db->query("SELECT COUNT(*) as sesiones FROM `ClienteTratamientoEspecial` WHERE nombre_tratamiento='Depilacion' AND id_cliente='$id_cliente'")->fetchAll();
            $db->close();
            return $account;
        }
        
        function getNumeroSesionesCavitacion($id_cliente){
            //SELECT * FROM `ClienteTratamientoEspecial` WHERE nombre_tratamiento='Depilacion' AND id_cliente='AVG21032610'
            $db = new DB();
            $account = $db->query("SELECT COUNT(*) as sesiones FROM `ClienteTratamientoEspecial` WHERE nombre_tratamiento='Cavitacion' AND id_cliente='$id_cliente'")->fetchAll();
            $db->close();
            return $account;
        }
    
        function insertarClienteBitacora($id_cliente, $id_tratamiento, $id_cosmetologa, $centro, $calificacion, $timestamp, $zona_cuerpo, $comentarios, $id_venta){
            $db = new DB();
            $sql_statement = "INSERT INTO `ClienteBitacora`(`id_cliente`, `id_tratamiento`, `id_cosmetologa`, `centro`, `calificacion`, `timestamp`, `zona_cuerpo`, `comentarios`, `id_venta`) VALUES 
                              ('$id_cliente', '$id_tratamiento', '$id_cosmetologa', '$centro', '$calificacion', '$timestamp', '$zona_cuerpo', '$comentarios', '$id_venta')";
            $query = $db->query($sql_statement);
            $db->close();
            return $query->affectedRows();
        }
    }

    function verificarStatusClientes($limite){
        $clienteModelo = new Cliente();
        $statusClientes = $clienteModelo->getUltimaVisitaCliente();   //Obtener todos los status de clientes en la BDD
        $hoy = strtotime(date("Y-m-d"));                              //Obtenemos la fecha de hoy


        foreach($statusClientes as $cliente){
          $ultima_visita = $cliente['ultima_visita_cliente'];         //la ultima visita del cliente
          $diferencia = $hoy - $ultima_visita;
          $dias = floor($diferencia / (24 * 60 * 60 )); // convert to days
          if($dias >= $limite){
            $clienteModelo->setStatusCliente($cliente['id_cliente'], "inactivo");   //Lo ponemos inactivo porque tiene mas dias de diferencia 
          }else{
            $clienteModelo->setStatusCliente($cliente['id_cliente'], "activo");   //Lo ponemos inactivo porque tiene mas dias de diferencia 
          }
        }
    }

?>