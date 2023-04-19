<?php
    require_once "../../View/connection.php";
    require_once "../../Model/Clientes/Cliente.php";

    $ModelCliente = new Cliente();
    // print_r($_POST);
    $nombre = mysqli_real_escape_string($con, ucwords($_POST['nombre']));
    $resultado = $ModelCliente->getClienteWhereNombreLike($nombre);
    echo "<div class='container'>
                <ul class='list-group'>";
    if (sizeof($resultado) >= 1) {
        foreach ($resultado as $clienteDB) {
            echo "<li class='list-group-item d-flex justify-content-between align-items-center'>"
                . $clienteDB['nombre_cliente'] . " " . $clienteDB['apellidos_cliente'] . "<br>
                        Fecha de Nacimiento: " . $clienteDB['fecha_cliente'] . "<br> 
                        E-Mail: " . $clienteDB['email_cliente'] . "<br> 
                        Numero: " . $clienteDB['telefono_cliente'] . "
                        <div>
                            <a class='btn btn-warning' href='informacionCliente.php?id=" . $clienteDB['id_cliente'] . "' role='button'>Ver información</a>
                        </div>
                    </li>";
        }
    } else {
        echo "<li class='list-group-item text-center'>
                    <h1 >No hay resultados para '" . $nombre . "'</h1>
                </li>";
    }
    echo "</ul>
            </div>";
?>