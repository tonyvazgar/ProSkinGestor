<?php

function getNavbar($name){
    echo "<nav class='navbar navbar-expand-lg navbar-light fixed-top' style='background-color: #f7d9d9;'>
                <a class='navbar-brand' href='../index.php'>
                    <img src='/ProSkinGestor/View/img/logoProSkin.png' height='30' class='d-inline-block align-top' alt=''>
                </a>
                <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarNav'
                    aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
                    <span class='navbar-toggler-icon'></span>
                </button>
                <div class='collapse navbar-collapse' id='navbarNav'>
                    <ul class='navbar-nav ml-auto'>
                        <li class='nav-item'>
                            <a class='nav-link' href='/ProSkinGestor/View/Clientes/'>Clientes</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='/ProSkinGestor/View/Agenda/agenda.php'>Agenda</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='/ProSkinGestor/View/Ventas/ventas.php'>Venta</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='/ProSkinGestor/View/Inventario/invetario.php'>Inventario/Productos</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='/ProSkinGestor/View/Reportes/reportes.php'>Reportes</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='/ProSkinGestor/View/Recursos/recursos.php'>Recursos</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='/ProSkinGestor/View/Administrador/administrador.php'>Administar usuarios</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='/ProSkinGestor/View/Usuario/usuario.php'>$name</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='/ProSkinGestor/View/logout.php'>Cerrar sesion</a>
                        </li>
                    </ul>
                </div>
            </nav>";
}

function getFooter(){
    echo "<footer class='footer'>
                <div class='container text-center'>
                    <span class='text-muted font-italic'>La belleza comienza en el momento en que decides ser tú misma.</span>
                </div>
            </footer>";
}
?>