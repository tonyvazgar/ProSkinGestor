<?php
    class Tratamiento {
        function getAllTratamientos(){
            $db = new DB();
            $tratamientos = $db->query('SELECT * FROM Tratamiento ORDER BY Tratamiento.nombre_tratamiento ASC')->fetchAll();
            $db->close();
            return $tratamientos;
        }

        function getPrecioTratamiento($id_tratamiento){
            $db = new DB();
            //SELECT * FROM `TratamientoPrecio` WHERE id_tratamiento = 'ACN10'
            $tratamientos = $db->query("SELECT * FROM `TratamientoPrecio` WHERE id_tratamiento = '$id_tratamiento'")->fetchAll();
            $db->close();
            return $tratamientos;

        }

        function getNombreZonaCuerpoWhereID($id_zona){
            $db = new DB();
            //SELECT * FROM `ZonasCuerpo` WHERE id_zona='17'
            $tratamientos = $db->query("SELECT * 
                                        FROM `ZonasCuerpo` 
                                        WHERE id_zona='$id_zona'")->fetchArray();
            $db->close();
            return $tratamientos;
        }

        function getAllTratamientosEspecialesWhereCliente($id){
            $db = new DB();
            $tratamientos = $db->query("SELECT * FROM `ClienteTratamientoEspecial` WHERE id_cliente='$id'")->fetchAll();
            $db->close();
            return $tratamientos;
        }


        function getAllZonasCuerpo(){
            $db = new DB();
            $tratamientos = $db->query('SELECT * FROM `ZonasCuerpo` ORDER BY nombre_zona ASC')->fetchAll();
            $db->close();
            return $tratamientos;
        }

        function iniciarTratamientoCliente($id_cliente, $id_tratamiento, $sesiones, $zona, $firma, $timestamp){
            //INSERT INTO `ClienteTratamiento`(`id_cliente`, `id_tratamiento`, `fecha_aplicacion`, `consentimiento`, `sesiones`, `zona_cuerpo`) VALUES
            $db = new DB();
            $sql_statement = "INSERT INTO `ClienteTratamiento`(`id_cliente`, `id_tratamiento`, `fecha_aplicacion`, `consentimiento`, `sesiones`, `zona_cuerpo`) VALUES
                              ('$id_cliente', '$id_tratamiento', '$timestamp', $firma, '$sesiones', '$zona')";
            $query = $db->query($sql_statement);
            $db->close();
            return $query->affectedRows();
        }


        function getUltimoTratamientoEspecialIdCliente($id_cliente, $nombre_tratamiento){
            //SELECT * FROM `ClienteTratamientoEspecial` WHERE id_cliente='LVG9405285' AND nombre_tratamiento='Depilacion' ORDER by timestamp DESC LIMIT 1

            $db = new DB();
            $tratamientos = $db->query("SELECT * FROM `ClienteTratamientoEspecial` WHERE id_cliente='$id_cliente' AND nombre_tratamiento='$nombre_tratamiento' ORDER by timestamp DESC LIMIT 1")->fetchAll();
            $db->close();
            return $tratamientos;

        }

        function getDetallesUltimaDepilacion($id_cliente, $timestamp){
            // SELECT * FROM ClienteTratamientoEspecial, ClienteBitacora WHERE ClienteTratamientoEspecial.id_cliente='LVG9405285' AND ClienteTratamientoEspecial.id_cliente = ClienteBitacora.id_cliente AND ClienteTratamientoEspecial.timestamp = ClienteBitacora.timestamp

            $db = new DB();
            $tratamientos = $db->query("SELECT * 
                                        FROM ClienteTratamientoEspecial, ClienteBitacora 
                                        WHERE ClienteTratamientoEspecial.id_cliente='$id_cliente' 
                                        AND ClienteTratamientoEspecial.id_tratamiento='DEP01'
                                        AND ClienteTratamientoEspecial.id_tratamiento=ClienteBitacora.id_tratamiento
                                        AND ClienteTratamientoEspecial.id_cliente = ClienteBitacora.id_cliente 
                                        AND ClienteTratamientoEspecial.timestamp='$timestamp'
                                        AND ClienteTratamientoEspecial.timestamp = ClienteBitacora.timestamp")->fetchAll();
            $db->close();
            return $tratamientos;
        }

        function getDetallesUltimaCavitacion($id_cliente, $timestamp){
            // SELECT * FROM ClienteTratamientoEspecial, ClienteBitacora WHERE ClienteTratamientoEspecial.id_cliente='LVG9405285' AND ClienteTratamientoEspecial.id_cliente = ClienteBitacora.id_cliente AND ClienteTratamientoEspecial.timestamp = ClienteBitacora.timestamp

            $db = new DB();
            $tratamientos = $db->query("SELECT * 
                                        FROM ClienteTratamientoEspecial, ClienteBitacora, ZonasCuerpo 
                                        WHERE ClienteTratamientoEspecial.id_cliente='$id_cliente' 
                                        AND ClienteTratamientoEspecial.id_tratamiento='CAV01'
                                        AND ClienteTratamientoEspecial.id_tratamiento=ClienteBitacora.id_tratamiento
                                        AND ClienteTratamientoEspecial.id_cliente = ClienteBitacora.id_cliente 
                                        AND ClienteTratamientoEspecial.timestamp='$timestamp'
                                        AND ClienteTratamientoEspecial.timestamp = ClienteBitacora.timestamp
                                        AND ZonasCuerpo.id_zona=ClienteTratamientoEspecial.zona")->fetchAll();
            $db->close();
            return $tratamientos;
        }
        
        //Insertar a venta
        function insertarVentaTratamiento($id_venta, $id_cliente, $id_tratamiento, $metodo_pago, $referencia_pago, $monto, $timestamp, $centro, $costo_tratamiento, $id_productos, $costo_producto, $cantidad_producto, $id_cosmetologa){
            //INSERT INTO `Ventas`(`id_venta`, `id_cliente`, `id_tratamiento`, `metodo_pago`, `monto`, `timestamp`, `centro`, `costo_tratamiento`, `id_productos`, `costo_producto`, `cantidad_producto`, `id_cosmetologa`) VALUES
            $db = new DB();
            $sql_statement = "INSERT INTO `Ventas`(`id_venta`, `id_cliente`, `id_tratamiento`, `metodo_pago`, `referencia_pago`, `monto`, `timestamp`, `centro`, `costo_tratamiento`, `id_productos`, `costo_producto`, `cantidad_producto`, `id_cosmetologa`) 
                              VALUES
                              ('$id_venta', '$id_cliente', '$id_tratamiento', $metodo_pago, '$referencia_pago', '$monto', '$timestamp', '$centro', '$costo_tratamiento', '$id_productos', '$costo_producto', '$cantidad_producto', '$id_cosmetologa')";
            $query = $db->query($sql_statement);
            $db->close();
            return $query->affectedRows();
        }
        function getSumVentas(){
            //SELECT COUNT(*) FROM Ventas
            $db = new DB();
            $tratamientos = $db->query('SELECT COUNT(*) AS numVentas FROM Ventas')->fetchAll();
            $db->close();
            return $tratamientos;
        }

        function getAllTratamientosAplicadosDeCosmetologa($email){
            $db = new DB();
            $tratamientos = $db->query("SELECT ClienteBitacora.*, Tratamiento.*, Ventas.id_venta
                                        FROM `ClienteBitacora`, usertable, Tratamiento, Ventas
                                        WHERE ClienteBitacora.id_cosmetologa=usertable.id 
                                        AND ClienteBitacora.timestamp=Ventas.timestamp
                                        AND Tratamiento.id_tratamiento=ClienteBitacora.id_tratamiento 
                                        AND usertable.email='$email'
                                        ORDER by ClienteBitacora.timestamp DESC")->fetchAll();
            $db->close();
            return $tratamientos;
        }
        function getAllVentasDeCosmetologa($email){
            $db = new DB();
            $tratamientos = $db->query("SELECT Ventas.*, Productos.*
                                        FROM usertable, Ventas, Productos
                                        WHERE usertable.id=Ventas.id_cosmetologa
                                        AND Ventas.id_productos=Productos.id_producto
                                        AND Ventas.id_productos!=''
                                        AND usertable.email='$email'
                                        ORDER by Ventas.timestamp DESC")->fetchAll();
            $db->close();
            return $tratamientos;
        }
    }
?>