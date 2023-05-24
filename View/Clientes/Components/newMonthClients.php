<?php

    function generateCardBodyNewClients($id_cliente, $nombre_cliente, $apellidos_cliente, $creacion_cliente){
        $nombre = $nombre_cliente.' '.$apellidos_cliente;

        
        $card = '<div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <a href="./informacionCliente.php?id='.$id_cliente.'">'.$nombre.'</a>
                            </div>
                            <div class="col">'.date('Y-m-d', $creacion_cliente).'</div>
                            <div class="col">'.date('Y-m-d', $creacion_cliente).'</div>
                            <div class="col">'.date('Y-m-d', $$creacion_cliente).'</div>
                        </div>
                    </div>
                </div>';
        return $card;
    }

    function generateCardsNewClients($arrayNewClients) {
        $userCards = '';
        foreach ($arrayNewClients as $value) {
            $id_cliente = $value['id_cliente'];
            $nombre_cliente = $value['nombre_cliente'];
            $apellidos_cliente = $value['apellidos_cliente'];
            $creacion_cliente = $value['creacion_cliente'];

            $oneCard = generateCardBodyNewClients($id_cliente, $nombre_cliente, $apellidos_cliente, $creacion_cliente);

            $userCards = $userCards.$oneCard;
        }
        return $userCards;
    }

    function getNewMontlyUsers($ModelCliente, $id_sucursal) {

        $arrayNewClients = $ModelCliente->getNewClientsOfMonth($id_sucursal);
        
        if(!empty($arrayNewClients)){
            $userCards = generateCardsNewClients($arrayNewClients);
            echo '<div id="accordion">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseNewClients" aria-expanded="false" aria-controls="collapseNewClients">
                                    Nuevos usuarios del mes
                                </button>
                            </h5>
                        </div>

                        <div id="collapseNewClients" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            '.$userCards.'
                        </div>
                    </div>
                </div>';
        }

    }
?>