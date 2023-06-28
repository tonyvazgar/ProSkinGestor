<?php 
    include_once __DIR__."/../components/header.php";
    include_once __DIR__.'/../Model/Cosmetologa.php';

    require_once __DIR__."/../Model/Session.php";
    $Session = new Session();

    $ModelCosmetologa = new Cosmetologa();

    $idSucursal = $Session -> getSucursalFromSession();
    $data = [];
    if($Session->isAdminGlobal()) {
        $data = $ModelCosmetologa -> getAllCometologasAsGlobalAdmin();
    } else {
        $data = $ModelCosmetologa -> getAllCometologasAsLocalAdmin($idSucursal);
    }
    $sucursalesList = $ModelCosmetologa -> getAllSucursales();
    
?>

    <!--INICIO del cont principal-->
    <div class="container">

        <div class="container">
            <h1>Reporte de corte de caja</h1>
        </div>
        <br>
        <form id="formFechasCorteCaja" autocomplete="off" method="POST">
            <div class="modal-body">
                <div class="form-group">
                    <label for="startDate">Fecha Inicial</label>
                    <input id="startDate" class="form-control" type="date" required />
                    <span id="startDateSelected"></span>
                </div>
                <div class="form-group">
                    <label for="endDate">Fecha Final</label>
                    <input id="endDate" class="form-control" type="date" required />
                    <span id="endDateSelected"></span>
                </div>
            </div>
            <div class="form-group">
                <button id="btnBuscar" type="submit" class="btn btn-success form-control" data-toggle="modal">Buscar</button>
            </div>
        </form>
        <div class="form-group row justify-content-center" id="data">
            
        </div>
        <div id="chart-container">FusionCharts will render here</div>
        <script src="/admin/vendor/charts/jquery-2.1.4.js"></script>
        <script src="/admin/vendor/charts/fusioncharts.js"></script>
        <script src="/admin/vendor/charts/fusioncharts.charts.js"></script>
        <script src="/admin/vendor/charts/themes/fusioncharts.theme.zune.js"></script>
<?php 
    require_once __DIR__."/../components/footer.php";
    echo '<!-- código propio JS -->
    <script type="text/javascript" src="/admin/js/Reportes/cortecaja.js"></script>';
?>