<?php

function getNavbar($name){
    echo "
    <nav class='navbar navbar-expand-lg navbar-light' style='background-color: #f7d9d9;'>
    <a class='navbar-brand' href='index.php'>
        <img src='./img/logoProSkin.png' height='30' class='d-inline-block align-top' alt=''>
    </a>
    <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarNav'
        aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
        <span class='navbar-toggler-icon'></span>
    </button>
    <div class='collapse navbar-collapse' id='navbarNav'>
        <ul class='navbar-nav ml-auto'>
            <li class='nav-item'>
                <a class='nav-link' href='clientes.php'>Clientes</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='agenda.php'>Agenda</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='ventas.php'>Venta</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='invetario.php'>Inventario/Productos</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='reportes.php'>Reportes</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='recursos.php'>Recursos</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='administrador.php'>Administar usuarios</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='usuario.php'>$name</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='logout.php'>Cerrar sesion</a>
            </li>
        </ul>
    </div>
</nav>";
}

?>