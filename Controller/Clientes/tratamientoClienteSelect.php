<?php
    require_once "../../Model/Clientes/Cliente.php";
    $ModelCliente = new Cliente();

    if(isset($_POST['tipo']) && $_POST['tipo'] != ''){
        switch($_POST['tipo']){
            case 1:
                $tratamientosAplicados = $ModelCliente->getDepilacionesFromCliente($_POST['id_cliente']);
                if(empty($tratamientosAplicados)){
                        echo "<h3 class='text-center'>Aún no hay ningun tratamiento registrado</h3>";
                }else{
                    echo "<ul class='list-group'>";
                    foreach($tratamientosAplicados as $d){
                        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>
                                        <a href='../../View/Ventas/detalleVenta.php?idVenta=".$d['id_venta']."' role='button'>".$d['nombre_tratamiento']."</a><span class='badge bg-warning rounded-pill'>".date('Y-m-d', $d['timestamp'])."</span>
                                    </li>";
                        }
                    echo "</ul>";
                }
                break;
            case 2:
                $tratamientosAplicados = $ModelCliente->getCavitacionesFromCliente($_POST['id_cliente']);
                if(empty($tratamientosAplicados)){
                        echo "<h3 class='text-center'>Aún no hay ningun tratamiento registrado</h3>";
                }else{
                    echo "<ul class='list-group'>";
                    foreach($tratamientosAplicados as $d){
                        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>
                                        <a href='../../View/Ventas/detalleVenta.php?idVenta=".$d['id_venta']."' role='button'>".$d['nombre_tratamiento']."</a><span class='badge bg-warning rounded-pill'>".date('Y-m-d', $d['timestamp'])."</span>
                                    </li>";
                        }
                    echo "</ul>";
                }
                break;
            case 3:
                $tratamientosAplicados = $ModelCliente->getTratamientosFromCliente($_POST['id_cliente']);
                if(empty($tratamientosAplicados)){
                        echo "<h3 class='text-center'>Aún no hay ningun tratamiento registrado</h3>";
                }else{
                    echo "<ul class='list-group'>";
                    foreach($tratamientosAplicados as $d){
                        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>
                                        <a href='../../View/Ventas/detalleVenta.php?idVenta=".$d['id_venta']."' role='button'>".$d['nombre_tratamiento']."</a><span class='badge bg-warning rounded-pill'>".date('Y-m-d', $d['timestamp'])."</span>
                                    </li>";
                        }
                    echo "</ul>";
                }
                break;
        }
    }
?>