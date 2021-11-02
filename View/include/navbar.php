<?php

function getNavbar($fecha, $name, $sucursal){
    require_once("../../Model/Usuario/Usuario.php");
    $ModelUsuario = new Usuario();
    $id_centro = $ModelUsuario->getNumeroSucursalxNombre($sucursal);
    
    echo "<nav class='navbar navbar-expand-lg navbar-light fixed-top' style='background-color: #f7d9d9;'>
                <a class='navbar-brand' href='../index.php'>
                    <img src='../../View/img/logoProSkin.png' height='30' class='d-inline-block align-top' alt=''>
                    $sucursal
                </a>
                <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarNav'
                    aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
                    <span class='navbar-toggler-icon'></span>
                </button>
                <div class='collapse navbar-collapse' id='navbarNav'>
                    <ul class='navbar-nav ml-auto'>";
                    getBotonCorteCaja($fecha, $id_centro);
                    echo "<li class='nav-item'>
                            <a class='nav-link' href='../../View/Clientes'>Clientes</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='https://calendar.google.com/' target='_blank'>Agenda</a>
                        </li>";
                        // <li class='nav-item'>
                        //     <a class='nav-link' href='../../View/Ventas/ventas.php'>Venta</a>
                        // </li>
                        echo "<li class='nav-item'>
                            <a class='nav-link' href='../../View/Inventario/'>Inventario/Productos</a>
                        </li>";
                        // echo "<li class='nav-item'>
                        //     <a class='nav-link' href='../../View/Recursos/'>Documentos</a>
                        // </li>";
                        // <li class='nav-item'>
                        //     <a class='nav-link' href='../../View/Reportes/reportes.php'>Reportes</a>
                        // </li>
                        // <li class='nav-item'>
                        //     <a class='nav-link' href='../../View/Recursos/recursos.php'>Recursos</a>
                        // </li>
                        // <li class='nav-item'>
                        //     <a class='nav-link' href='../../View/Administrador/administrador.php'>Administar usuarios</a>
                        // </li>
                        echo "<li class='nav-item'>
                            <a class='nav-link' href='../../View/Usuario/usuario.php'>$name</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='../../View/logout.php'>Cerrar sesion</a>
                        </li>
                    </ul>
                </div>
            </nav>";
}
function getVersion() {
    $hash = exec("git rev-list --tags --max-count=1");
    $ex = exec("git describe --tags $hash");
    if (!$ex){
        $ex = "1.2.1";
    }
    return $ex; 
}
function getGitBranch()
{
    $shellOutput = [];
    exec('git branch | ' . "grep ' * '", $shellOutput);
    foreach ($shellOutput as $line) {
        if (strpos($line, '* ') !== false) {
            return trim(strtolower(str_replace('* ', '', $line)));
        }
    }
    return null;
}
function getFooter(){
    echo "<footer class='footer'>
                <div class='container text-center'>
                    <span class='text-muted font-italic'>La belleza comienza en el momento en que decides ser tú misma.</span>
                    <br>
                    <span class='text-muted font-italic'>".getGitBranch()."==>[".getVersion()."]</span>
                </div>
            </footer>";
}
function getBotonCorteCaja($fecha, $id_centro){
    require_once("../../Model/Usuario/Usuario.php");
    $ModelUsuario = new Usuario();
    $timestamp = strtotime($fecha);
    
    $ds = new DateTime('now', new DateTimeZone('America/Mexico_City') );
    $hora = $ds->format('H');

    if($hora >= 16 && $hora <= 21){
        $corte = $ModelUsuario->existeCorteCaja($timestamp, $id_centro);
        if(!$corte){
            echo "<li class='nav-item'>
                    <a href='../../View/Usuario/corteCaja.php' class='btn btn-success'>Cierre de caja</a>
                  </li>";
        }
    }
}
function esMetodoPagoSolo($metodo, $referencia, $total)
{
    if (strlen($metodo) == 1) {
        return [[[$metodo, $total], $referencia]];
    } else {
        $array_metodos = json_decode($metodo);
        $array_referencia = json_decode($referencia);
        return array_map(null, $array_metodos, $array_referencia);
    }
}

function getFechaFormatoCDMX(){
    $date = new DateTime('now', new DateTimeZone('America/Mexico_City') );
    $fecha = $date->format('Y-m-d');
    return $fecha;
}
?>