<?php
    include "../../Model/Db.php";

    class Cliente {
        public function getAllUsuarios(){
            $db = new DB();
            $account = $db->query('SELECT * FROM Cliente')->fetchAll();
            $db->close();
            return $account;
        }
        function getDepilacionesFromCliente($id_cliente){
            $db = new DB();
            $tratamientos = $db->query("SELECT ClienteBitacora.*, Tratamiento.nombre_tratamiento 
                                        FROM ClienteBitacora, Tratamiento
                                        WHERE ClienteBitacora.id_cliente='$id_cliente'
                                        AND ClienteBitacora.id_tratamiento='DEP01'
                                        AND ClienteBitacora.id_tratamiento = Tratamiento.id_tratamiento
                                        ORDER BY `timestamp` DESC")->fetchAll();
            $db->close();
            return $tratamientos;
        }
        function getCavitacionesFromCliente($id_cliente){
            $db = new DB();
            $tratamientos = $db->query("SELECT ClienteBitacora.*, Tratamiento.nombre_tratamiento 
                                        FROM ClienteBitacora, Tratamiento
                                        WHERE ClienteBitacora.id_cliente='$id_cliente'
                                        AND ClienteBitacora.id_tratamiento='CAV01'
                                        AND ClienteBitacora.id_tratamiento = Tratamiento.id_tratamiento
                                        ORDER BY `timestamp` DESC")->fetchAll();
            $db->close();
            return $tratamientos;
        }


        function getProductosFromCliente($id_cliente){
            $db = new DB();
            $tratamientos = $db->query("SELECT * 
                                        FROM `Ventas` 
                                        WHERE id_cliente='$id_cliente' AND id_productos!=''
                                        ORDER BY `timestamp` DESC")->fetchAll();
            $db->close();
            return $tratamientos;
        }

        function getTratamientosFromCliente($id_cliente){
            $db = new DB();
            $tratamientos = $db->query("SELECT ClienteBitacora.*, Tratamiento.nombre_tratamiento 
                                        FROM ClienteBitacora, Tratamiento
                                        WHERE id_cliente='$id_cliente'
                                        AND (ClienteBitacora.id_tratamiento!='CAV01' AND ClienteBitacora.id_tratamiento!='DEP01')
                                        AND ClienteBitacora.id_tratamiento = Tratamiento.id_tratamiento
                                        ORDER BY `timestamp` DESC")->fetchAll();
            $db->close();
            return $tratamientos;
        }
        public function getAllUsuariosFromIdSucursal($id_sucursal){
            $db = new DB();
            $account = $db->query("SELECT * 
                                   FROM Cliente 
                                   WHERE Cliente.centro_cliente='$id_sucursal'
                                   ORDER BY Cliente.ultima_visita_cliente DESC
                                   LIMIT 5")->fetchAll();
            $db->close();
            return $account;
        }

        public function getAllAnniversariesFromIdSucursal($id_sucursal){
            $db = new DB();
            $date = date('-m-');
            $account = $db->query("SELECT Cliente.id_cliente, Cliente.nombre_cliente, Cliente.apellidos_cliente, ClienteOpcional.fecha_cliente, ClienteStatus.status
                                    FROM Cliente, ClienteOpcional, ClienteStatus
                                    WHERE Cliente.id_cliente=ClienteOpcional.id_cliente 
                                    AND Cliente.id_cliente=ClienteStatus.id_cliente 
                                    AND Cliente.centro_cliente='$id_sucursal'
                                    AND ClienteOpcional.fecha_cliente LIKE '%$date%'
                                    ORDER by Cliente.nombre_cliente ASC")->fetchAll();
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
            $sql_statement = "INSERT INTO `ClienteOpcional`(`id_cliente`, `fecha_cliente`, `cp_cliente`, `id_monedero`)
                            VALUES ('$array[0]', '$array[1]', '$array[2]', '$array[3]')";
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
            $nombre = trim($nombre);
            $sql_statement = "SELECT * 
                                FROM ClienteOpcional, 
                                (SELECT * 
                                FROM `Cliente` 
                                WHERE BINARY nombre_cliente LIKE '%$nombre%' 
                                OR BINARY apellidos_cliente LIKE '%$nombre%' 
                                OR ( BINARY CONCAT( Cliente.nombre_cliente, ' ', Cliente.apellidos_cliente ) LIKE '%$nombre%') ) 
                                AS Nombre 
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

        public function deleteClienteID($idCliente){
            $db = new DB();
            $clienteTable = $db->query("DELETE FROM `Cliente` 
                                        WHERE `Cliente`.`id_cliente` = '$idCliente'")
                                        ->affectedRows();
            $clienteOpcionalTable = $db->query("DELETE FROM `ClienteOpcional`
                                        WHERE `ClienteOpcional`.`id_cliente` = '$idCliente'")
                                        ->affectedRows();
            $db->close();
            return $clienteTable + $clienteOpcionalTable;
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
            $account = $db->query("SELECT COUNT(*) as sesiones FROM `ClienteTratamientoEspecial` WHERE nombre_tratamiento='DEP01' AND id_cliente='$id_cliente'")->fetchAll();
            $db->close();
            return $account;
        }
        
        function getNumeroSesionesCavitacion($id_cliente){
            //SELECT * FROM `ClienteTratamientoEspecial` WHERE nombre_tratamiento='Depilacion' AND id_cliente='AVG21032610'
            $db = new DB();
            $account = $db->query("SELECT COUNT(*) as sesiones FROM `ClienteTratamientoEspecial` WHERE nombre_tratamiento='CAV01' AND id_cliente='$id_cliente'")->fetchAll();
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

        function buscarUsuario($numero){
            $db = new DB();
            $sql_statement = "SELECT *
                              FROM Cliente, ClienteOpcional, Sucursal
                              WHERE Cliente.id_cliente = ClienteOpcional.id_cliente
                              AND Cliente.centro_cliente = Sucursal.id_sucursal
                              AND Cliente.telefono_cliente='$numero'";
            $account = $db->query($sql_statement)->fetchAll();
            $db->close();
            return $account;
        }

        function getNombreTratamiento($id_tratamiento){
            $db = new DB();
            //SELECT * FROM `TratamientoPrecio` WHERE id_tratamiento = 'ACN10'
            $tratamiento = $db->query("SELECT nombre_tratamiento FROM `Tratamiento` WHERE id_tratamiento = '$id_tratamiento'")->fetchArray();
            $db->close();
            return $tratamiento['nombre_tratamiento'];

        }

        // ------------ MONEDERO ------------

        function insertarMonedero($id_monedero, $id_cliente, $id_cosmetologa_venta, $id_cosmetologa_uso, $dinero_inicial, $tratamientos_inicial, $precios_unitarios, $num_zonas, $zonas_tratamiento, $cantidad, $dinero_final, $tratamientos_final, $timestamp_creacion, $timestamp_uso, $comentarios){
            // INSERT INTO `Monedero` (`id_monedero`, `id_cliente`, `id_cosmetologa_venta`, `id_cosmetologa_uso`, `dinero_inicial`, `tratamientos_inicial`, `precios_unitarios`, `num_zonas`, `zonas_tratamiento`, `cantidad`, `dinero_final`, `tratamientos_final`, `timestamp_creacion`, `timestamp_uso`)
            // VALUES ('xx', 'xx', 'xx', '', 'xxx', 'xx', '', '', 'xxx', '');
            $db = new DB();
            $sql_statement = "INSERT INTO `Monedero` (`id_monedero`, `id_cliente`, `id_cosmetologa_venta`, `id_cosmetologa_uso`, `dinero_inicial`, `tratamientos_inicial`, `precios_unitarios`, `num_zonas`, `zonas_tratamiento`, `cantidad`, `dinero_final`, `tratamientos_final`, `timestamp_creacion`, `timestamp_uso`, `comentarios`)
                              VALUES ('$id_monedero', '$id_cliente', '$id_cosmetologa_venta', '$id_cosmetologa_uso', '$dinero_inicial', '$tratamientos_inicial', '$precios_unitarios', '$num_zonas', '$zonas_tratamiento',  '$cantidad', '$dinero_final', '$tratamientos_final', '$timestamp_creacion', '$timestamp_uso', '$comentarios')";
            $query = $db->query($sql_statement);
            $db->close();
            return $query;
        }

        function getAllMonederosFromCliente($id_cliente){
            $db = new DB();
            $sql_statement = "SELECT * 
                              FROM Monedero 
                              WHERE id_cliente = '$id_cliente'
                              ORDER BY id_monedero DESC";
            $account = $db->query($sql_statement)->fetchAll();
            $db->close();
            return $account;
        }

        function deleteMonederoTratamiento($id_monedero, $timestamp_creacion){
            // DELETE FROM `Monedero` WHERE `Monedero`.`id_monedero` = \'aas\' AND `Monedero`.`timestamp_creacion` = \'1644793332\'
            $db = new DB();
            $tratamientos = $db->query("DELETE FROM `Monedero` 
                                        WHERE `Monedero`.`id_monedero` = '$id_monedero' 
                                        AND `Monedero`.`timestamp_creacion` = '$timestamp_creacion'")->affectedRows();
            $db->close();
            return $tratamientos;
        }

        function deleteMonederoDinero($id_monedero, $id_cliente){
            $db = new DB();
            $tratamientos = $db->query("DELETE FROM `MonederoDinero` 
                                        WHERE `MonederoDinero`.`id_monedero` = '$id_monedero' 
                                        AND `MonederoDinero`.`id_cliente` = '$id_cliente'")->affectedRows();
            $db->close();
            return $tratamientos;
        }

        function getAllMonederosDineroFromCliente($id_cliente){
            $db = new DB();
            $sql_statement = "SELECT * 
                              FROM MonederoDinero 
                              WHERE id_cliente = '$id_cliente'
                              ORDER BY id_monedero DESC";
            $account = $db->query($sql_statement)->fetchAll();
            $db->close();
            return $account;
        }
        
        public function getMonederoWhereID($id_monedero){
            $db = new DB();
            $sql_statement = "SELECT * 
                              FROM `Monedero`
                              WHERE id_monedero='$id_monedero'";
            $account = $db->query($sql_statement)->fetchAll();
            $db->close();
            return $account;
        }

        public function getMonederoDineroWhereID($id_monedero){
            $db = new DB();
            $sql_statement = "SELECT * 
                              FROM `MonederoDinero`
                              WHERE id_monedero='$id_monedero'";
            $account = $db->query($sql_statement)->fetchArray();
            $db->close();
            return $account;
        }

        public function getMonederoWhereIDandCliente($id_monedero, $idCliente){
            $db = new DB();
            $sql_statement = "SELECT * 
                              FROM `Monedero`
                              WHERE id_monedero='$id_monedero' AND id_cliente='$idCliente'";
            $account = $db->query($sql_statement)->fetchArray();
            $db->close();
            return $account;
        }

        public function getMonederoDineroWhereIDandCliente($id_monedero, $idCliente){
            $db = new DB();
            $sql_statement = "SELECT * 
                              FROM `MonederoDinero`
                              WHERE id_monedero='$id_monedero' AND id_cliente='$idCliente'";
            $account = $db->query($sql_statement)->fetchArray();
            $db->close();
            return $account;
        }

        public function updateClienteMonedero($id_cliente, $id_monedero){
            $db = new DB();
            
            $sql_statement = "UPDATE `ClienteOpcional` 
                              SET `id_monedero` = '$id_monedero' 
                              WHERE `ClienteOpcional`.`id_cliente` = '$id_cliente';";
    
            $account = $db->query($sql_statement);
            $db->close();
            return $account->affectedRows();
        }

        function insertarVentaMonedero($id_venta, $id_cliente, $metodo_pago, $referencia_pago , $monto, $timestamp, $centro, $id_cosmetologa){
            $db = new DB();
            $sql_statement = "INSERT INTO `Ventas`(`id_venta`, `id_cliente`, `id_tratamiento`, `metodo_pago`, `referencia_pago`, `monto`, `timestamp`, `centro`, `costo_tratamiento`, `id_productos`, `costo_producto`, `cantidad_producto`, `id_cosmetologa`) 
                              VALUES ('$id_venta', '$id_cliente', '', '$metodo_pago', '$referencia_pago', '$monto', '$timestamp', '$centro', '', '', '', '', '$id_cosmetologa')";
            $query = $db->query($sql_statement);
            $db->close();
            return $query->affectedRows();
        }

        function updateCantidadMonedero($id_monedero, $timestamp_creacion, $nueva_cantidad){
            //UPDATE `Monedero` SET `cantidad` = '[\"10\",\"2\",\"7\",\"0\"]' WHERE `Monedero`.`id_monedero` = 'assa' AND `Monedero`.`timestamp_creacion` = '1629425310';
            $db = new DB();
            
            $sql_statement = "UPDATE `Monedero` 
                              SET `cantidad` = '$nueva_cantidad' 
                              WHERE `Monedero`.`id_monedero` = '$id_monedero' AND `Monedero`.`timestamp_creacion` = '$timestamp_creacion';";
    
            $account = $db->query($sql_statement);
            $db->close();
            return $account->affectedRows();
        }
        function updateMonedero_tratamientos_final($id_monedero, $timestamp_creacion, $nueva_cantidad){
            //UPDATE `Monedero` SET `tratamientos_final` = '[]' WHERE `Monedero`.`id_monedero` = 'dg67' AND `Monedero`.`timestamp_creacion` = '1638511974';
            $db = new DB();
            
            $sql_statement = "UPDATE `Monedero` 
                              SET `tratamientos_final` = '$nueva_cantidad' 
                              WHERE `Monedero`.`id_monedero` = '$id_monedero' AND `Monedero`.`timestamp_creacion` = '$timestamp_creacion';";
    
            $account = $db->query($sql_statement);
            $db->close();
            return $account->affectedRows();
        }
        function updateMonedero_timestamp_uso($id_monedero, $timestamp_creacion, $timestamp_uso){
            //UPDATE `Monedero` SET `tratamientos_final` = '[]' WHERE `Monedero`.`id_monedero` = 'dg67' AND `Monedero`.`timestamp_creacion` = '1638511974';
            $db = new DB();
            
            $sql_statement = "UPDATE `Monedero` 
                              SET `timestamp_uso` = '$timestamp_uso' 
                              WHERE `Monedero`.`id_monedero` = '$id_monedero' AND `Monedero`.`timestamp_creacion` = '$timestamp_creacion';";
    
            $account = $db->query($sql_statement);
            $db->close();
            return $account->affectedRows();
        }
        function updateMonedero_dinero_final($id_monedero, $timestamp_creacion, $montos){
            //UPDATE `Monedero` SET `dinero_final` = '[\'211\']' WHERE `Monedero`.`id_monedero` = 'xxaasd' AND `Monedero`.`timestamp_creacion` = '1629425332';
            $db = new DB();
            
            $sql_statement = "UPDATE `Monedero` 
                              SET `dinero_final` = '$montos' 
                              WHERE `Monedero`.`id_monedero` = '$id_monedero' AND `Monedero`.`timestamp_creacion` = '$timestamp_creacion';";
    
            $account = $db->query($sql_statement);
            $db->close();
            return $account->affectedRows();
        }
        function updateMonedero_id_cosmetologa_uso($id_monedero, $timestamp_creacion, $id_cosmetologa_uso){
            //UPDATE `Monedero` SET `dinero_final` = '[\'211\']' WHERE `Monedero`.`id_monedero` = 'xxaasd' AND `Monedero`.`timestamp_creacion` = '1629425332';
            $db = new DB();
            
            $sql_statement = "UPDATE `Monedero` 
                              SET `id_cosmetologa_uso` = '$id_cosmetologa_uso' 
                              WHERE `Monedero`.`id_monedero` = '$id_monedero' AND `Monedero`.`timestamp_creacion` = '$timestamp_creacion';";
    
            $account = $db->query($sql_statement);
            $db->close();
            return $account->affectedRows();
        }

        function updateNuevosTratamientosRecargaMonedero($id_monedero, $dinero_inicial, $timestamp_creacion, $tratamientos_iniciales_actualizado, $precios_unitarios_actualizado, $num_zonas_actualizado, $zonas_tratamiento_actualizado, $cantidad_actualizado, $dinero_final, $tratamientos_final, $comentariosMonedero){
            $db = new DB();
            
            $sql_statement = "UPDATE `Monedero` 
                              SET `dinero_inicial` = '$dinero_inicial',
                              `tratamientos_inicial` = '$tratamientos_iniciales_actualizado',
                              `precios_unitarios` = '$precios_unitarios_actualizado',
                              `num_zonas` = '$num_zonas_actualizado',
                              `zonas_tratamiento` = '$zonas_tratamiento_actualizado',
                              `cantidad` = '$cantidad_actualizado',
                              `dinero_final` = '$dinero_final',
                              `tratamientos_final` = '$tratamientos_final',
                              `comentarios` = '$comentariosMonedero'
                              WHERE `Monedero`.`id_monedero` = '$id_monedero' AND `Monedero`.`timestamp_creacion` = '$timestamp_creacion';";
    
            $account = $db->query($sql_statement);
            $db->close();
            return $account->affectedRows();
        }

        function updateMonederoDineroTable($id_monedero, $id_cliente, $id_cosmetologa, $timestamp, $dinero, $comentarios){
            $db = new DB();
            $sql_statement = "UPDATE `MonederoDinero` 
                              SET `id_cosmetologa` = '$id_cosmetologa',
                              `timestamp` = '$timestamp',
                              `dinero` = '$dinero',
                              `comentarios` = '$comentarios'
                              WHERE `MonederoDinero`.`id_monedero` = '$id_monedero' AND `MonederoDinero`.`id_cliente` = '$id_cliente';";
    
            $account = $db->query($sql_statement);
            $db->close();
            return $account->affectedRows();
        }
        function updateMonederoDineroTableSinComentarios($id_monedero, $id_cliente, $id_cosmetologa, $timestamp, $dinero){
            $db = new DB();
            $sql_statement = "UPDATE `MonederoDinero` 
                              SET `id_cosmetologa` = '$id_cosmetologa',
                              `timestamp` = '$timestamp',
                              `dinero` = '$dinero'
                              WHERE `MonederoDinero`.`id_monedero` = '$id_monedero' AND `MonederoDinero`.`id_cliente` = '$id_cliente';";
    
            $account = $db->query($sql_statement);
            $db->close();
            return $account->affectedRows();
        }

        function insertarMonederoDinero($id_monedero, $id_cliente, $id_cosmetologa, $timestamp, $dinero, $comentarios){
            $db = new DB();

            //INSERT INTO `MonederoDinero`(`id_monedero`, `id_cliente`, `id_cosmetologa`, `timestamp`, `dinero`) VALUES

            $sql_statement = "INSERT INTO `MonederoDinero`(`id_monedero`, `id_cliente`, `id_cosmetologa`, `timestamp`, `dinero`, `comentarios`) VALUES ('$id_monedero', '$id_cliente', '$id_cosmetologa', '$timestamp', '$dinero', '$comentarios')";
            $query = $db->query($sql_statement);
            $db->close();
            return $query;
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

    function restarElementosMonedero($id_cosmetologa, $id_monedero, $id_cliente, $elementos){
        $ModelCliente              = new Cliente();

        $infoDeMonedero            = $ModelCliente -> getMonederoWhereIDandCliente($id_monedero, $id_cliente);
        $tratamientos_del_monedero = json_decode($infoDeMonedero['tratamientos_inicial']);
        $cantidad_tratamientos_del_monedero = json_decode($infoDeMonedero['cantidad']);
        $tratamientos_final        = json_decode($infoDeMonedero['tratamientos_final']);
        $timeStamp_uso             = json_decode($infoDeMonedero['timestamp_uso']);
        $date                      = new DateTime('now', new DateTimeZone('America/Mexico_City') );
        $timeStamp_modificacion    = strval(strtotime($date->format('Y-m-d H:i:s')));
        $precios_unitarios_tratamientos = json_decode($infoDeMonedero['precios_unitarios']);
        $dinero_final              = json_decode($infoDeMonedero['dinero_final']);
        $id_cosmetologa_uso        = json_decode($infoDeMonedero['id_cosmetologa_uso']);

        if(empty($tratamientos_final))
        {
            $tratamientos_final = [$cantidad_tratamientos_del_monedero];
        }
        if(empty($timeStamp_uso))
        {
            $timeStamp_uso      = [$infoDeMonedero['timestamp_creacion']];
        }
        if(empty($dinero_final))
        {
            $dinero_final       = [$infoDeMonedero['dinero_inicial']];
        }
        if(empty($id_cosmetologa_uso))
        {
            $id_cosmetologa_uso = [$id_cosmetologa];
        }

        $ultimo_precio          = end($dinero_final);

        foreach($elementos as $elemento){
            $posicion_a_modificar = array_search($elemento, $tratamientos_del_monedero);
            $cantidad_original    = intval($cantidad_tratamientos_del_monedero[$posicion_a_modificar]);
            $cantidad_modificada  = $cantidad_original - 1;
            $cantidad_tratamientos_del_monedero[$posicion_a_modificar] = strval($cantidad_modificada);

            $valor_tratamiento    = $precios_unitarios_tratamientos[$posicion_a_modificar];
            $ultimo_precio        = $ultimo_precio - $valor_tratamiento;
        }
        array_push($tratamientos_final, $cantidad_tratamientos_del_monedero);
        array_push($timeStamp_uso, $timeStamp_modificacion);
        array_push($dinero_final, strval($ultimo_precio));
        array_push($id_cosmetologa_uso, $id_cosmetologa);
        // echo '<pre>';
        // print_r($id_cosmetologa_uso);
        // echo '</pre>';
        
        $ModelCliente -> updateCantidadMonedero($id_monedero, $infoDeMonedero['timestamp_creacion'], json_encode($cantidad_tratamientos_del_monedero));
        $ModelCliente -> updateMonedero_tratamientos_final($id_monedero, $infoDeMonedero['timestamp_creacion'], json_encode($tratamientos_final));
        $ModelCliente -> updateMonedero_timestamp_uso($id_monedero, $infoDeMonedero['timestamp_creacion'], json_encode($timeStamp_uso));
        $ModelCliente -> updateMonedero_dinero_final($id_monedero, $infoDeMonedero['timestamp_creacion'], json_encode($dinero_final));

        $ModelCliente -> updateMonedero_id_cosmetologa_uso($id_monedero, $infoDeMonedero['timestamp_creacion'], json_encode($id_cosmetologa_uso));

        //insertar en historial
        //update el timestamp/cosmetologa/dinero de uso
    }



    function restarDineroMonedero($id_cosmetologa, $id_monedero, $id_cliente, $monto){
        $ModelCliente           = new Cliente();
        $infoDeMonedero         = $ModelCliente -> getMonederoDineroWhereIDandCliente($id_monedero, $id_cliente);
        
        $timeStamp_uso          = json_decode($infoDeMonedero['timestamp']);
        $dinero_final           = json_decode($infoDeMonedero['dinero']);
        $id_cosmetologa_uso     = json_decode($infoDeMonedero['id_cosmetologa']);
        $ultimo_precio          = end($dinero_final);
        $date                   = new DateTime('now', new DateTimeZone('America/Mexico_City') );
        $timeStamp_modificacion = strval(strtotime($date->format('Y-m-d H:i:s')));
        $ultimo_precio          = $ultimo_precio - $monto;
        
        array_push($id_cosmetologa_uso, $id_cosmetologa);
        array_push($timeStamp_uso, $timeStamp_modificacion);
        array_push($dinero_final, strval($ultimo_precio));
        
        $ModelCliente -> updateMonederoDineroTableSinComentarios($id_monedero, $id_cliente, json_encode($id_cosmetologa_uso), json_encode($timeStamp_uso), json_encode($dinero_final));

    }
?>