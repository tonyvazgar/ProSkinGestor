<?php 
    include_once __DIR__."/../components/header.php";
    include_once __DIR__.'/../Model/Venta.php';

    require_once __DIR__."/../Model/Session.php";
    $Session = new Session();

    $ModelVenta = new Venta();

    $idSucursal = $Session -> getSucursalFromSession();
?>

    <!--INICIO del cont principal-->
    <div class="container-fluid">

        <div class="container-fluid">
            <h1>Reporte de ventas <i class="fas fa-fw fa-comments-dollar"></i></h1>
        </div>
        <br>
        <form class="container-fluid" id="formTratamientosAplicados" autocomplete="off" method="POST">
            <div class="modal-body">
                <div class="form-group">
                    <label for="startDate">Fecha Inicial</label>
                    <input id="startDate" class="form-control" type="date" />
                    <span id="startDateSelected"></span>
                </div>
                <div class="form-group">
                    <label for="endDate">Fecha Final</label>
                    <input id="endDate" class="form-control" type="date" />
                    <span id="endDateSelected"></span>
                </div>
            </div>
            <div class="form-group">
                <button id="btnBuscar" type="submit" class="btn btn-success form-control" data-toggle="modal">Buscar</button>
            </div>
        </form>

        <div class="container-fluid" id="fifteen-days-cortecaja-widgets">
            <h1>Últimos 15 días <i class="fas fa-fw fa-comments-dollar"></i></h1>
        </div>

        <div  id="div-grafica-ventasdiarias">Gráfica ventas diarias</div>
        <div class="form-group row justify-content-center" id="data">
            
        </div>
        <script src="/admin/vendor/charts/jquery-2.1.4.js"></script>
        <script src="/admin/vendor/charts/fusioncharts.js"></script>
        <script src="/admin/vendor/charts/fusioncharts.charts.js"></script>
        <script src="/admin/vendor/charts/themes/fusioncharts.theme.zune.js"></script>
        <script src="/admin/vendor/charts/themes/fusioncharts.theme.ocean.js"></script>
        <script src="/admin/vendor/charts/themes/fusioncharts.theme.fint.js"></script>
        <script src="/admin/vendor/charts/themes/fusioncharts.theme.carbon.js"></script>
<?php 
    require_once __DIR__."/../components/footer.php";
    echo '<!-- código propio JS -->
    <script type="text/javascript" src="/admin/js/Reportes/venta.js"></script>';
?>