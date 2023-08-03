<?php 
    include_once __DIR__."/../components/header.php";
    include_once __DIR__.'/../Model/Venta.php';

    require_once __DIR__."/../Model/Session.php";
    $Session = new Session();

    $ModelVenta = new Venta();

?>

    <!--INICIO del cont principal-->
    <div class="container-fluid">
        <h1>Estadísticas últimos 15 días</h1>
        <div class="container-fluid">
            <div id="widgetsVentasTotales">
                
            </div>
            
            <div>
                <div class="container-fluid">
                    <div class="row" id="widgetsClientes">
                        <h1>Clientes</h1>
                        
                    </div>
                </div>
            </div>
        </div>


<?php 
    require_once __DIR__."/../components/footer.php";
    echo '<!-- código propio JS -->
    <script type="text/javascript" src="/admin/js/Reportes/resumen.js"></script>';
?>