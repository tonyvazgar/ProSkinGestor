<?php
    $monederoTratamientos = $ModeloUsuario -> verificarMonedero($id);
    $monederoDinero       = $ModeloUsuario -> verificarMonederoDinero($id);
    if(!empty($monederoTratamientos)){
        $idMonedero       = $monederoTratamientos['id_monedero'];
        $infoMonedero     = $ModelCliente->getMonederoWhereID($idMonedero)[0];
        $dineroDisponible = 0;
        if(json_decode($infoMonedero['tratamientos_final']) == ''){
            $historial          = [];
        }else{
            $dinero_final       = json_decode($infoMonedero['dinero_final']);
            $tratamientos_final = json_decode($infoMonedero['tratamientos_final']);
            $id_cosmetologa_uso = json_decode($infoMonedero['id_cosmetologa_uso']);
            $timestamp_uso      = json_decode($infoMonedero['timestamp_uso']);
            $historial          = array_map(null, $dinero_final, $tratamientos_final, $id_cosmetologa_uso, $timestamp_uso);
        }
        if(empty(json_decode($monederoTratamientos['dinero_final']))){
            $dineroDisponible = number_format($monederoTratamientos['dinero_inicial']);
        }else{
            $dineroDisponible = number_format(end(json_decode($monederoTratamientos['dinero_final'])));
        }
        $tratamientosOriginales = json_decode($infoMonedero['tratamientos_inicial']);
        
        $prueba = [];
        foreach($tratamientosOriginales as $to){
            $prueba[$to] = [];
        }
        foreach($historial as $idmov => $movimiento) {
            $inicial = '';
            if($idmov != 0) {
                $tratamientos_aplicados_temp = array_diff_assoc($movimiento[1], $historial[$idmov-1][1]);
                $tratamientos_aplicados = '';
                foreach($tratamientos_aplicados_temp as $key => $val) {
                    array_push($prueba[$tratamientosOriginales[$key]], $movimiento[3]);
                }
            }
        }
        echo '<input type="text" class="form-control idMonederoActual" id="idMonederoActual" name="idMonederoActual" value="'.$monederoTratamientos['id_monedero'].'" hidden>';
        echo '<input type="text" class="form-control agregadoDeMonedero" id="itemsAgregadosDeMonedero" name="itemsAgregadosDeMonedero" hidden>';
        echo '<div class="form-group">
                <h3>
                    Monedero existente(tratamientos)
                    <a href="infoMonedero.php?id_monedero='.$monederoTratamientos['id_monedero'].'" role="button" class="btn btn-link btn-sm" target="_blank">
                        <i class="fas fa-info-circle"></i>
                    </a>
                    <button type="button" class="btn btn-light" id="mostrarComentariosMonedero" name="mostrarComentariosMonedero">
                        <i id="abrirComentarios" style="display: block;" class="fas fa-angle-down"></i>
                        <i id="cerrarComentarios" style="display: none;" class="fas fa-angle-up" ></i>
                    </button>
                </h3>
                <label class="lead text-muted">Puedes registrar lo siguiente (en caso de usar el monedero):</label><br>
                <label class="lead text-muted">Monto en monedero: $'.$dineroDisponible.'</label>
                <div class="row">';
                if(!empty(json_decode($monederoTratamientos['tratamientos_inicial']))){
                    $data_temporal = array_map(null, json_decode($monederoTratamientos['tratamientos_inicial']), json_decode($monederoTratamientos['cantidad']), json_decode($monederoTratamientos['precios_unitarios']), json_decode($monederoTratamientos['num_zonas']), json_decode($monederoTratamientos['zonas_tratamiento']));

                    foreach($data_temporal as $tratamiento){
                        $id_shuffle = str_shuffle($tratamiento[0]);
                        echo '<div class="col-sm">
                                <div class="card">
                                    <div class="card-body">
                                        <div>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="collapse" data-target="#collapse'.$id_shuffle.'" aria-expanded="true" aria-controls="collapse'.$id_shuffle.'">
                                            '.$ModelTratamiento->getNombreTratamiento($tratamiento[0]).' <span class="badge badge-light">'.$tratamiento[1].'</span>
                                            </button>';

                                            if($tratamiento[0] == 'DEP01' || $tratamiento[0] == 'CAV01'){
                                                echo '<button type="button" class="btn btn-sm" data-toggle="collapse" data-target="#info'.$id_shuffle.'" aria-expanded="true" aria-controls="info'.$id_shuffle.'">
                                                          <i class="fas fa-info-circle"></i>
                                                      </button>';
                                                echo '<div class="collapse" id="info'.$id_shuffle.'">
                                                    <div class="card card-body">
                                                    Detalles del tratamiento:';
                                                    if($tratamiento[0] == 'DEP01'){
                                                        echo '<p class="font-weight-light">Número de zonas: '.$tratamiento[3].'</p>';
                                                        
                                                    }
                                                    $zonasFront = '';
                                                    foreach(explode(',', $tratamiento[4]) as $zonaParaString){
                                                        $zonasFront .= $ModeloUsuario -> getNombreZonaCuerpoWhereID($zonaParaString).', ';
                                                    }
                                                    echo '<p class="font-weight-light">Zonas: '.$zonasFront.'</p>';
                                                echo'</div></div>';
    
                                            
                                            }
                                        echo '</div>
                                            <div class="collapse" id="collapse'.$id_shuffle.'">
                                                <div class="card card-body">Historial: ';
                                                if(empty($prueba[$tratamiento[0]])){
                                                    echo '<p class="font-weight-light">NO HAY HISTORIAL DE ESTE TRATAMIENTO</p>';
                                                }else{
                                                    foreach($prueba[$tratamiento[0]] as $elemento){
                                                        echo '<p class="font-weight-light">'.date('Y-m-d H:i:s',$elemento).'</p>';
                                                    }
                                                }
                                            echo'</div>
                                        </div>

                                        ';
                                        if($tratamiento[1] >= 1){
                                            if(empty($_COOKIE['modalMensajeTratamientoMonedero'])){
                                                $modal = 'data-toggle="modal" data-target="#modal'.$id_shuffle.'"';
                                            }else{
                                                $modal = '';
                                            }
                                            
                                            echo '<div class="d-flex justify-content-start">
                                                    <button id="agregar-'.$tratamiento[0].'" class="btn btn-primary agregarListaDesdeMonedero float-right" '.$modal.' type="button">Aplicar tratamiento</button>';
                                                    echo '<input type="text" class="form-control agregar-'.$tratamiento[0].'" id="precios_unitario_producto" name="precios_unitario_producto" value="'.$tratamiento[2].'" hidden>';
                                                    echo '<input type="text" class="form-control agregar-'.$tratamiento[0].'" id="num_zonas_producto" name="num_zonas_producto" value="'.$tratamiento[3].'" hidden>';
                                                    echo '<input type="text" class="form-control agregar-'.$tratamiento[0].'" id="zonas_tratamiento_producto" name="zonas_tratamiento_producto" value="'.$tratamiento[4].'" hidden>
                                                </div>';

                                                echo '<div class="modal fade" id="modal'.$id_shuffle.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLongTitle">Recuerda</h5>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Agregaste a la lista para registrar <b>'.$ModelTratamiento->getNombreTratamiento($tratamiento[0]).'</b> desde el monedero.<br>
                                                                        Los datos de este tratamiento son precargados automáticamente.
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="" id="ocultarModal">
                                                                            <label class="form-check-label" for="ocultarModal">
                                                                                No volver a mostrar
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>';
                                        }
                        echo '</div></div></div>';
                        print_r("<br>");
                    }
                }
        echo '</div>
        </div>
        <div class="row" id="comentariosMonedero" style="display: none;">
            <div class="col-sm">
                <h3>Comentarios del monedero</h3>
                <p class="lead" id="status" name="status">
                    '.$monederoTratamientos['comentarios'].'
                </p>
            </div>
        </div>';
    }

    if(!empty($monederoDinero)) {
        
        $idMonedero       = $monederoDinero['id_monedero'];
        $dinero_final     = json_decode($monederoDinero['dinero']);
        
        echo '<input type="text" class="form-control idMonederoActual" id="idMonederoActual" name="idMonederoActual" value="'.$idMonedero.'" hidden>';
        echo '<input type="text" class="form-control dineroDeMonedero" id="dineroDeMonedero" name="dineroDeMonedero" value="'.end($dinero_final).'" hidden>';
        echo '<div id="seUsaMonedero"></div>';
        echo '<div class="form-group">
                <h3>
                    Monedero existente (solo dinero)
                    <a href="infoMonedero.php?id_monedero='.$idMonedero.'" role="button" class="btn btn-link btn-sm" target="_blank">
                        <i class="fas fa-info-circle"></i>
                    </a>
                </h3>
                <label class="lead text-muted">Monto en monedero: $'.number_format(end($dinero_final), 2).'</label>
                <div class="row">';
        echo '</div>
        </div>';
    }
  
?>