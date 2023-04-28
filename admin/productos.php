<?php 
    include_once "./components/header.php";
    include_once './Model/Cosmetologa.php';

    $ModelCosmetologa = new Cosmetologa();
    
    $data = $ModelCosmetologa -> getAllCometologas();
    $sucursalesList = $ModelCosmetologa -> getAllSucursales();
?>
    <!--INICIO del cont principal-->
    <div class="container">
        <h1>Lista de productos</h1>

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>
                </div>
            </div>
        </div>
        <br>
        <div class="container">
            
        </div>

    </div>
    <!--FIN del cont principal-->

<?php require_once "components/footer.php"?>