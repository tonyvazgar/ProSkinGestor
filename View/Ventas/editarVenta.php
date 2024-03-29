<?php
  require_once "../../Controller/Clientes/ClienteController.php"; 
  require_once "../../Controller/ControllerSesion.php";
  require_once "../../Model/Usuario/Usuario.php";
  require_once "../../Model/Ventas/Venta.php";
  require_once "../../Model/Tratamiento/Tratamiento.php";
  require_once "../../Controller/Ventas/VentasController.php";

  $session = new ControllerSesion();
  $ModeloUsuario = new Usuario();
  $ModeloVenta = new Venta();
  $ModelTratamiento = new Tratamiento();
  
  $email    = $_SESSION['email'];
  $password = $_SESSION['password'];
  $id_venta = $_GET['idVenta'];
  
  $fetch_info = $session->verificarSesion($ModeloUsuario, $email, $password);
  
  $nombreSucursal = $ModeloUsuario->getNombreSucursalUsuario($email)['nombre_sucursal'];
  $numeroSucursal = $ModeloUsuario->getNumeroSucursalUsuario($email)['id_sucursal'];
  $id_cosmetologa = $ModeloUsuario->getIdCosmetologa($email)['id'];

  $detalles = $ModeloVenta->getTodosLosDetallesVentaProducto($id_venta); //SELECT * FROM Ventas, Cliente WHERE Ventas.id_venta='$id_venta' AND Ventas.id_cliente=Cliente.id_cliente
  if(empty($detalles)){
    $detalles = $ModeloVenta->getTodosLosDetallesVenta($id_venta);       //SELECT * FROM Ventas WHERE Ventas.id_venta='$id_venta'
  }
  getHeadHTML("ProSkin - Edición ".$id_venta);

  $divisionProductosTratamientos = getDesgloseProductosTratamientosVenta($detalles);
  
?>
<body style='background-color: #f9f3f3;'>
    <?php
        require_once("../include/navbar.php");
        $fecha_para_corte_caja = getFechaFormatoCDMX();
        getNavbar($fecha_para_corte_caja, $fetch_info['name'], $ModeloUsuario->getNombreSucursalUsuario($email)['nombre_sucursal']);
    ?>
    <div class="container">
        <h1>Edición de venta</h1>
          <div class="form-group">
            <table class='table table-borderless' style='table-layout: fixed;'>
              <tbody>
                <tr>
                  <td>
                    <h3>ID Venta</h3>
                    <p class="lead"><?php echo $divisionProductosTratamientos['id_venta'];?> </p>
                  </td>
                  <td>
                    <h3>Cliente</h3>
                    <p class="lead"><?php echo $divisionProductosTratamientos['nombre'];?> </p>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="form-group">
            <!-- ---- -->
            <table class='table table-borderless' style='table-layout: fixed;'>
              <tbody>
                <tr>
                  <td>
                    <h3>Fecha</h3>
                    <p class="lead"><?php echo date('Y-m-d H:i:s',$detalles[0]['timestamp']);?> </p>
                  </td>
                  <td>
                    <h3>Centro de belleza</h3>
                    <p class="lead"><?php echo $nombreSucursal." [".$ModeloUsuario->getNombreCosmetologaWhereID($divisionProductosTratamientos['cosmetologa'])."]";?> </p>
                    <!-- <input class="form-control" name="sucursalInput" id="sucursalInput" type="text" value=<?php echo "'".$numeroSucursal."'";?>> -->
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="form-group">
            <table class='table table-borderless' style='table-layout: fixed;'>
              <tbody>
                <tr>
                  <td>
                    <h3>Método de pago <button id='metodoPagoButton'><i class="fas fa-edit"></i></button></h3>
                    <div class='metodoPagoText'>
                      <p class="lead">
                        <?php 
                          $metodo_pago = $divisionProductosTratamientos['metodo_pago'];
                          $referencia = $divisionProductosTratamientos['referencia_pago'];
                          $total = $divisionProductosTratamientos['total'];
    
                          $estandarizado = esMetodoPagoSolo($metodo_pago, $referencia, $total);
    
                          foreach($estandarizado as $elemento){
                            echo "*".getMetodoPagoNombre($elemento[0][0])." |".$elemento[1]."| - $".$elemento[0][1];
                            echo "<br>";
                          }?> 
                        </p>
                      </p>
                    </div>
                    <form action="editarVenta.php" method="post" style='display: none;' id='metodoPagoForm' autocomplete="off">
                      <input type="text" class="form-control" id="idCliente" name="idCliente" value=<?php echo $divisionProductosTratamientos['id_venta'];?> hidden readonly>
                      <input type="text" class="form-control" id="timeStamp" name="timeStamp" value=<?php echo $detalles[0]['timestamp'];?> hidden readonly>
                      <?php 
                          $metodo_pago = $divisionProductosTratamientos['metodo_pago'];
                          $referencia = $divisionProductosTratamientos['referencia_pago'];
                          $total = $divisionProductosTratamientos['total'];
    
                          $estandarizado = esMetodoPagoSolo($metodo_pago, $referencia, $total);
    
                          foreach($estandarizado as $elemento){
                            echo "<select name='metodoPago[]' id='metodoPago[]' class='form-control'>
                                    <option value='6'>Depósito</option>
                                    <option value='1'>Efectivo</option>
                                    <option value='2'>[TDD]Tarjeta de débito</option>
                                    <option value='3'>[TDC]Tarjeta de crédito</option>
                                    <option value='4'>Transferencia</option>
                                    <option value='5'>Cheque de regalo</option>
                                </select>";

                            echo '<input class="form-control" name="referenciaInput[]" id="referenciaInput[]" placeholder="Referencia #'.$elemento[1].'" type="text" value="'.$elemento[1].'" autocomplete="off">';

                            echo '<input class="form-control" name="totalMetodoPago[]" id="totalMetodoPago[]" placeholder="$'.$elemento[0][1].'" type="number" value="'.$elemento[0][1].'" autocomplete="off">';

                            echo "<br>";
                          }
                      ?> 
                      
                      
                      <button type="submit" class='form-control btn-success' id="editarMetodoPagoSubmit" name="editarMetodoPagoSubmit" id='editarMetodoPagoSubmit'  onclick='return confirm("¿Estás seguro de editar el método de pago/transferencia?")'>Confirmar</button>
                      <button type='button' id='cancelarMetodoPagoButton' class='form-control btn-warning'>Cancelar</button>
                    </form>
                  </td>
                  <td>
                    <h3>Total de venta</h3>
                    <!-- <h3>Total de venta<button id='totalButton'><i class="fas fa-plus-circle"></i></button></h3> -->
                    <div class='totalText'>
                      <p class="lead">
                        <?php 
                          $metodo_pago = $divisionProductosTratamientos['metodo_pago'];
                          echo '$'.number_format($divisionProductosTratamientos['total_noFormat'], 2);?> 
                          
                        </p>
                      </p>
                    </div>
                    <form action="editarVenta.php" method="post" style='display: none;' id='totalForm'>
                      <input type="text" class="form-control" id="idCliente" name="idCliente" value=<?php echo $divisionProductosTratamientos['id_venta'];?> hidden readonly>
                      <input type="text" class="form-control" id="timeStamp" name="timeStamp" value=<?php echo $detalles[0]['timestamp'];?> hidden readonly>
                      <input class="form-control" name="totalInput" id="totalInput" type="number" step=".01" value=<?php echo "'".$divisionProductosTratamientos['total_noFormat']."'";?>>
                      <button type="submit" class='form-control btn-success' id="editarTotalSubmit" name="editarTotalSubmit" id='editarTotalSubmit'>Confirmar</button>
                      <button type='button' id='cancelarTotalButton' class='form-control btn-warning'>Cancelar</button>
                    </form>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          
          <div class="form-group">
            <table class='table table-borderless' style='table-layout: fixed;'>
              <tbody>
                <tr>
                  <!-- <td><h3>Productos <button id='agregarProductoButton'><i class="fas fa-plus-circle"></i></button></h3></td> -->
                  <td><h3>Productos</h3></td>
                  <!-- <td><h3>Tratamientos <button id='agregarTratamientoButton'><i class="fas fa-plus-circle"></i></button></h3></td> -->
                  <td><h3>Tratamientos</h3></td>
                </tr>
                <tr>
                  <!-- PRODUCTOS -->
                  <td>
                    <p class="lead">
                      <?php
                        $numero_de_producto = 1;
                        if($divisionProductosTratamientos['num_productos'] != 0){
                          foreach($divisionProductosTratamientos['productos'] as $prod){
                            // 'id_productos','metodo_pago','monto','costo_producto','cantidad_producto'
                            // print_r($prod);
                            echo '<div class="card">
                                    <div style="position: absolute;right: 0;">
                                      <button id="eliminarProductoButton" class="Producto'.$numero_de_producto.'"><i class="far fa-trash-alt"></i></button>
                                      <button id="editarProductoButton" class="Producto'.$numero_de_producto.'"><i class="fas fa-edit"></i></button>
                                    </div>
                                    <div class="card-body infoProductoText Producto'.$numero_de_producto.'">
                                      <h5 class="card-title">'.$ModeloVenta->getDetallesProducto($prod[0])['descripcion_producto'].'</h5>
                                      <h5 class="card-title">$'.$prod[2].'</h5>
                                      <h6 class="card-subtitle mb-2 text-muted">Cantidad: '.$prod[4].' producto(s) | $'.$prod[3].'</h6>
                                    </div>

                                    <div class="card-body Producto'.$numero_de_producto.'" style="display: none;" id="infoProductoForm">
                                      <form action="editarVenta.php" method="post" autocomplete="off">
                                        <input type="text" class="form-control Producto'.$numero_de_producto.'" id="idCliente" name="idCliente" value="'.$divisionProductosTratamientos['id_venta'].'" hidden readonly>
                                        <input type="text" class="form-control Producto'.$numero_de_producto.'" id="timeStamp" name="timeStamp" value="'.$detalles[0]['timestamp'].'" hidden readonly>
                                        <input type="text" class="form-control Producto'.$numero_de_producto.'" id="idProducto" name="idProducto" value="'.$prod[0].'" hidden readonly>

                                        <h5 class="card-title ">'.$ModeloVenta->getDetallesProducto($prod[0])['descripcion_producto'].'</h5>
                                        <label>Precio Unitario:</label>
                                        <input class="form-control Producto'.$numero_de_producto.'" name="precioUnitarioProducto" id="precioUnitarioProducto" type="number" step=".01" value="'.$prod[3].'" autocomplete="off">
                                        <label>Cantidad:</label>
                                        <input class="form-control Producto'.$numero_de_producto.'" name="cantidadProducto" id="cantidadProducto" type="number" step=".01" value="'.$prod[4].'" autocomplete="off">
                                        <label>Total:</label>
                                        <input class="form-control Producto'.$numero_de_producto.'" name="precioTotalProducto" id="precioTotalProducto" type="number" step=".01" value="'.$prod[2].'" autocomplete="off">


                                        <button type="submit" class="form-control btn-success Producto'.$numero_de_producto.'" id="editarProductoSubmit" name="editarProductoSubmit" id="editarProductoSubmit" onclick="return confirm(\'¿Estás seguro de editar este producto?\')">Confirmar</button>
                                        <button type="button" id="cancelarProductoButton" name="Producto'.$numero_de_producto.'" class="form-control btn-warning Producto'.$numero_de_producto.'">Cancelar</button>
                                      </form>
                                    </div>

                                  </div><br>';
                            $numero_de_producto += 1;
                          }
                        }else{
                          echo "NO HAY PRODUCTOS";
                        }
                      ?>
                    </p>
                  </td>

                  <!-- TRATAMIENTOS -->
                  <td>
                    <p class="lead">
                      <?php 
                        $zonas_cuerpo_array = [ '**TODO EL CUERPO**' => 23, 'Abdomen' => 17, 'Antebrazos' => 3, 'Axilas' => 2, 'Brazos' => 4, 'Entrecejo' => 12, 'Espalda' => 18, 'Frente' => 13, 'Glúteos' => 10, 'Hombro' => 19, 'Ingles' => 7, 'LSMP' => 24, 'Labio Superior' => 14, 'Lumbares' => 21, 'Manos' => 5, 'Mentón' => 16, 'Muslo' => 8, 'Nuca' => 20, 'Orejas' => 22, 'Patillas' => 15, 'Pecho' => 1, 'Pierna' => 9, 'Pubis' => 6, 'Zona Alba' => 11 ];

                        $zonas_cuerpo_array_cavitacion =['Abdomen' => 17, 'Brazos' => 4, 'Espalda' => 18, 'Glúteos' => 10, 'Pierna' => 9];

                        $numero_de_tratamiento = 1;
                        if($divisionProductosTratamientos['num_tratamientos'] != 0){
                          foreach($divisionProductosTratamientos['tratamientos'] as $trat){
                            $informacion_gral_tratamiento = $ModeloVenta->getDetallesTratamiento($trat[0], $id_venta);
                            // print_r($informacion_gral_tratamiento);
                            $str_zonas = [];
                            if(!empty($informacion_gral_tratamiento['zona_cuerpo'])){
                              $array_zonas = explode(",", $informacion_gral_tratamiento['zona_cuerpo']);
                              array_pop($array_zonas);
                              foreach($array_zonas as $num_zona){
                                $nombre_zona = $ModelTratamiento -> getNombreZonaCuerpoWhereID($num_zona)['nombre_zona'];
                                array_push($str_zonas, $nombre_zona);
                              }
                            }else{
                              $array_zonas = [];
                            }
                            // print_r($str_zonas);

                            if($informacion_gral_tratamiento['id_tratamiento'] == 'DEP01'){
                              // print_r($informacion_gral_tratamiento);
                              $numeroDeZonas = $ModelTratamiento->getNumDeZonasDepilacionFromClienteWhere($informacion_gral_tratamiento['id_cliente'], $informacion_gral_tratamiento['timestamp']);

                              echo '<div class="card">
                                      <div style="position: absolute;right: 0;">
                                        <button id="eliminarTratamientoButton" class="Tratamiento'.$numero_de_tratamiento.'"><i class="far fa-trash-alt"></i></button>
                                        <button id="editarTratamientoButton" class="Tratamiento'.$numero_de_tratamiento.'"><i class="fas fa-edit"></i></button>
                                      </div>
                                      <div class="card-body infoTratamientoText Tratamiento'.$numero_de_tratamiento.'">
                                        <h5 class="card-title">'.$informacion_gral_tratamiento['nombre_tratamiento']." - $".number_format($trat[2]).'</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">'.implode(", ", $str_zonas).'</h6>
                                        <p class="card-text">'.$informacion_gral_tratamiento['comentarios'].'</p>
                                      </div>
  
                                      <div class="card-body Tratamiento'.$numero_de_tratamiento.'" style="display: none;" id="infoTratamientoForm">
                                        <form action="editarVenta.php" method="post" autocomplete="off">
                                          <input type="text" class="form-control Tratamiento'.$numero_de_tratamiento.'" id="idVenta" name="idVenta" value="'.$divisionProductosTratamientos['id_venta'].'" hidden readonly>
                                          <input type="text" class="form-control Tratamiento'.$numero_de_tratamiento.'" id="timeStamp" name="timeStamp" value="'.$informacion_gral_tratamiento['timestamp'].'" hidden readonly>
                                          <input type="text" class="form-control Tratamiento'.$numero_de_tratamiento.'" id="idTratamiento" name="idTratamiento" value="'.$trat[0].'" hidden readonly>
  
                                          <h5 class="card-title ">'.$ModelTratamiento->getNombreTratamientoWhereID($trat[0]).'</h5>
                                          <h6 class="card-subtitle mb-2 text-muted">'.implode(", ", $str_zonas).'</h6>
                                          <label>Número de zonas:</label>
                                          <input class="form-control Tratamiento'.$numero_de_tratamiento.'" name="numZonasTratamiento" id="numZonasTratamiento" type="number" step=".01" value="'.$numeroDeZonas.'" autocomplete="off">
                                          <label>Precio:</label>
                                          <input class="form-control Tratamiento'.$numero_de_tratamiento.'" name="precioTratamiento" id="precioTratamiento" type="number" step=".01" value="'.$trat[3].'" autocomplete="off">
                                          <label>Comentarios:</label>
                                          <textarea class="form-control Tratamiento'.$numero_de_tratamiento.'" name="comentarioTratamiento" id="comentarioTratamiento" cols="30" rows="2" class="form-control" maxlength="250" placeholder="Escribe algo relevante de este tratamiento" autocomplete="off">'.$informacion_gral_tratamiento['comentarios'].'</textarea>
                                          
                                          <label>Zonas del cuerpo:</label><div>';

                                          foreach($zonas_cuerpo_array as $nombre => $num){
                                            $checked = '';
                                            if( in_array($num, $array_zonas)){ $checked = ' checked'; }
                                            echo '<div class="form-check">
                                                    <input class="form-check-input check" type="checkbox" value="'.$num.'" name="zonas_cuerpo[]" id="flexCheckDefault'.$num.'"'.$checked.'>
                                                    <label class="form-check-label" for="flexCheckDefault'.$num.'">'.$nombre.'</label>
                                                  </div>';
                                          }
                                          echo '</div>
                                          <button type="submit" class="form-control btn-success Tratamiento'.$numero_de_tratamiento.'" id="editarTratamientoSubmit" name="editarTratamientoSubmit" id="editarTratamientoSubmit" onclick="return confirm(\'¿Estás seguro de editar este tratamiento?\')">Confirmar</button>
                                          <button type="button" id="cancelarTratamientoButton" name="Tratamiento'.$numero_de_tratamiento.'" class="form-control btn-warning Tratamiento'.$numero_de_tratamiento.'">Cancelar</button>
                                        </form>
                                      </div>
                                    </div><br>';
                            }else if($informacion_gral_tratamiento['id_tratamiento'] == 'CAV01'){
                              echo '<div class="card">
                                      <div style="position: absolute;right: 0;">
                                        <button id="eliminarTratamientoButton" class="Tratamiento'.$numero_de_tratamiento.'"><i class="far fa-trash-alt"></i></button>
                                        <button id="editarTratamientoButton" class="Tratamiento'.$numero_de_tratamiento.'"><i class="fas fa-edit"></i></button>
                                      </div>
                                      <div class="card-body infoTratamientoText Tratamiento'.$numero_de_tratamiento.'">
                                        <h5 class="card-title">'.$informacion_gral_tratamiento['nombre_tratamiento']." - $".number_format($trat[2]).'</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">'.implode(", ", $str_zonas).'</h6>
                                        <p class="card-text">'.$informacion_gral_tratamiento['comentarios'].'</p>
                                      </div>
  
                                      <div class="card-body Tratamiento'.$numero_de_tratamiento.'" style="display: none;" id="infoTratamientoForm">
                                        <form action="editarVenta.php" method="post" autocomplete="off">
                                          <input type="text" class="form-control Tratamiento'.$numero_de_tratamiento.'" id="idVenta" name="idVenta" value="'.$divisionProductosTratamientos['id_venta'].'" hidden readonly>
                                          <input type="text" class="form-control Tratamiento'.$numero_de_tratamiento.'" id="timeStamp" name="timeStamp" value="'.$informacion_gral_tratamiento['timestamp'].'" hidden readonly>
                                          <input type="text" class="form-control Tratamiento'.$numero_de_tratamiento.'" id="idTratamiento" name="idTratamiento" value="'.$trat[0].'" hidden readonly>
  
                                          <h5 class="card-title ">'.$ModelTratamiento->getNombreTratamientoWhereID($trat[0]).'</h5>
                                          <h6 class="card-subtitle mb-2 text-muted">'.implode(", ", $str_zonas).'</h6>
                                          
                                          <label>Precio:</label>
                                          <input class="form-control Tratamiento'.$numero_de_tratamiento.'" name="precioTratamiento" id="precioTratamiento" type="number" step=".01" value="'.$trat[3].'" autocomplete="off">
                                          <label>Comentarios:</label>
                                          <textarea class="form-control Tratamiento'.$numero_de_tratamiento.'" name="comentarioTratamiento" id="comentarioTratamiento" cols="30" rows="2" class="form-control" maxlength="250" placeholder="Escribe algo relevante de este tratamiento" autocomplete="off">'.$informacion_gral_tratamiento['comentarios'].'</textarea>
                                          
                                          <label>Zonas del cuerpo:</label><div>';

                                          foreach($zonas_cuerpo_array_cavitacion as $nombre => $num){
                                            $checked = '';
                                            if( in_array($num, $array_zonas)){ $checked = ' checked'; }
                                            echo '<div class="form-check">
                                                    <input class="form-check-input check" type="checkbox" value="'.$num.'" name="zonas_cuerpo[]" id="flexCheckDefault'.$num.'"'.$checked.'>
                                                    <label class="form-check-label" for="flexCheckDefault'.$num.'">'.$nombre.'</label>
                                                  </div>';
                                          }
                                          echo '</div>
                                          <button type="submit" class="form-control btn-success Tratamiento'.$numero_de_tratamiento.'" id="editarTratamientoSubmit" name="editarTratamientoSubmit" id="editarTratamientoSubmit" onclick="return confirm(\'¿Estás seguro de editar este tratamiento?\')">Confirmar</button>
                                          <button type="button" id="cancelarTratamientoButton" name="Tratamiento'.$numero_de_tratamiento.'" class="form-control btn-warning Tratamiento'.$numero_de_tratamiento.'">Cancelar</button>
                                        </form>
                                      </div>
                                    </div><br>';
                            }else{
                              echo '<div class="card">
                                      <div style="position: absolute;right: 0;">
                                        <button id="eliminarTratamientoButton" class="Tratamiento'.$numero_de_tratamiento.'"><i class="far fa-trash-alt"></i></button>
                                        <button id="editarTratamientoButton" class="Tratamiento'.$numero_de_tratamiento.'"><i class="fas fa-edit"></i></button>
                                      </div>
                                      <div class="card-body infoTratamientoText Tratamiento'.$numero_de_tratamiento.'">
                                        <h5 class="card-title">'.$informacion_gral_tratamiento['nombre_tratamiento']." - $".number_format($trat[2]).'</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">'.implode(", ", $str_zonas).'</h6>
                                        <p class="card-text">'.$informacion_gral_tratamiento['comentarios'].'</p>
                                      </div>
  
                                      <div class="card-body Tratamiento'.$numero_de_tratamiento.'" style="display: none;" id="infoTratamientoForm">
                                        <form action="" method="post" autocomplete="off">
                                          <input type="text" class="form-control Tratamiento'.$numero_de_tratamiento.'" id="idVenta" name="idVenta" value="'.$divisionProductosTratamientos['id_venta'].'" hidden readonly>
                                          <input type="text" class="form-control Tratamiento'.$numero_de_tratamiento.'" id="timeStamp" name="timeStamp" value="'.$informacion_gral_tratamiento['timestamp'].'" hidden readonly>
                                          <input type="text" class="form-control Tratamiento'.$numero_de_tratamiento.'" id="idTratamiento" name="idTratamiento" value="'.$trat[0].'" hidden readonly>
  
                                          <h5 class="card-title ">'.$ModelTratamiento->getNombreTratamientoWhereID($trat[0]).'</h5>
                                          
                                          <label>Precio:</label>
                                          <input class="form-control Tratamiento'.$numero_de_tratamiento.'" name="precioTratamiento" id="precioTratamiento" type="number" step=".01" value="'.$trat[3].'" autocomplete="off">
                                          <label>Comentarios:</label>
                                          <textarea class="form-control Tratamiento'.$numero_de_tratamiento.'" name="comentarioTratamiento" id="comentarioTratamiento" cols="30" rows="2" class="form-control" maxlength="250" placeholder="Escribe algo relevante de este tratamiento" autocomplete="off">'.$informacion_gral_tratamiento['comentarios'].'</textarea>

  
                                          <button type="submit" class="form-control btn-success Tratamiento'.$numero_de_tratamiento.'" id="editarTratamientoSubmit" name="editarTratamientoSubmit" id="editarTratamientoSubmit" onclick="return confirm(\'¿Estás seguro de editar este tratamiento?\')">Confirmar</button>
                                          <button type="button" id="cancelarTratamientoButton" name="Tratamiento'.$numero_de_tratamiento.'" class="form-control btn-warning Tratamiento'.$numero_de_tratamiento.'">Cancelar</button>
                                        </form>
                                      </div>
                                    </div><br>';
                            }
                            $numero_de_tratamiento += 1;
                          }
                        }else{
                          echo "NO HAY TRATAMIENTOS";
                        }
                      ?>
                    </p>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

        <div class="form-group text-center">
          <a class="btn btn-danger" href=<?php
              echo "'./detalleVenta.php?idVenta=".$id_venta."'";
            ?>role="button">Cancelar edición</a>
        </div>
      </div>
    <?php
      getFooter();
    ?>
    <script src="../../Controller/Ventas/Util/validarCamposEditarVenta.js"></script>
</body>
</html>