<?php 
    include_once __DIR__."/../components/header.php";
    include_once __DIR__.'/../Model/Cosmetologa.php';

    require_once __DIR__."/../Model/Session.php";
    $Session = new Session();

    $ModelCosmetologa = new Cosmetologa();

    $idSucursal = $Session -> getSucursalFromSession();
    
?>

    <!--INICIO del cont principal-->
    <div class="container-fluid">
        <div class="container-fluid">
            <h1>Reporte de registro de clientes <i class="fas fa-fw fa-users"></i></h1>
        </div>
        <br>
        <form id="formFechasRegistroClienteReport" autocomplete="off" method="POST">
            <div class="modal-body">
                <div class="form-group">
                    <label for="startDate">Fecha Inicial</label>
                    <input id="startDate" class="form-control" type="date" required/>
                    <span id="startDateSelected"></span>
                </div>
                <div class="form-group">
                    <label for="endDate">Fecha Final</label>
                    <input id="endDate" class="form-control" type="date" required/>
                    <span id="endDateSelected"></span>
                </div>
            </div>
            <div class="form-group">
                <button id="btnBuscar" type="submit" class="btn btn-success form-control" data-toggle="modal">Buscar</button>
            </div>
        </form>
        <div class="form-group row justify-content-center" id="data">
            
        </div>


<?php 
    require_once __DIR__."/../components/footer.php";
    echo '<!-- código propio JS -->
    <script type="text/javascript" src="/admin/js/Reportes/registroclientes.js"></script>';
?>