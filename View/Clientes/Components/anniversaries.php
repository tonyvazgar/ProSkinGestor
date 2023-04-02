<?php

function getTipoAniversario($fecha) {
    $fecha1 = strtotime(date('Y-m-d'));
    $fecha2 = strtotime($fecha);
    $diferencia = $fecha1 - $fecha2;
    $anos = floor($diferencia / 31536000);
    return $anos >=18 ? 'Cumpleaños' : 'Aniversario';
  }
function generateCardBody($id_cliente, $nombre_cliente, $apellidos_cliente, $fecha_cliente, $status){
    $nombre = $nombre_cliente.' '.$apellidos_cliente;

    $todayDate = date('-m-d');
    $bold = $fecha_cliente;

    $tipoAniversario = getTipoAniversario($fecha_cliente);
    $backgroud = '';
    if (strpos($fecha_cliente, $todayDate)) { //If today is the same date from DB
        $bold = '<b>'.$fecha_cliente.'</b>';
        $tipoAniversario = '<b>'.$tipoAniversario.'</b>';
        $backgroud = 'style="background-color: #f7d9d9;"';
    }
    
    $card = '<div class="card-body" '.$backgroud.'>
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <a href="./informacionCliente.php?id='.$id_cliente.'">'.$nombre.'</a>
                        </div>
                        <div class="col">'.$bold.'</div>
                        <div class="col">'.$tipoAniversario.'</div>
                        <div class="col">'.$status.'</div>
                    </div>
                </div>
            </div>';
    return $card;
}

function generateAllCards($anniversaries) {
    $userCards = '';
    foreach ($anniversaries as $value) {
        // printArrayPrety($value);
        $id_cliente = $value['id_cliente'];
        $nombre_cliente = $value['nombre_cliente'];
        $apellidos_cliente = $value['apellidos_cliente'];
        $fecha_cliente = $value['fecha_cliente'];
        $status = $value['status'];

        $oneCard = generateCardBody($id_cliente, $nombre_cliente, $apellidos_cliente, $fecha_cliente, $status);

        $userCards = $userCards.$oneCard;
    }
    return $userCards;
}

function getAniversariesDiv($ModelCliente, $id_sucursal) {

    $anniversaries = $ModelCliente->getAllAnniversariesFromIdSucursal($id_sucursal);
    
    if(!empty($anniversaries)){
        $userCards = generateAllCards($anniversaries);
        echo '<div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                Aniversarios del mes
                            </button>
                        </h5>
                    </div>

                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        '.$userCards.'
                    </div>
                </div>
            </div>';
    }
}
?>
