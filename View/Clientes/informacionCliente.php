<?php 
  require_once "../../Controller/Clientes/ClienteController.php"; 
  require_once "../../Model/Clientes/Cliente.php";
  require_once "../../Controller/ControllerSesion.php";
  require_once "../../Model/Usuario/Usuario.php";
  require_once "../../Model/Inventario/Producto.php";

  $ModelCliente = new Cliente();
  $session = new ControllerSesion();
  $ModeloUsuario = new Usuario();
  $ModelProducto = new Producto();
  
  $email    = $_SESSION['email'];
  $password = $_SESSION['password'];
  
  $fetch_info = $session->verificarSesion($ModeloUsuario, $email, $password);
  
  getHeadHTML("ProSkin - Editar Cliente");
  $id = $_GET['id'];
  $info = $ModelCliente->getClienteWhereID($id);
  $listaSucursales = $ModeloUsuario -> getListSucursales();
?>
<body style='background-color: #f9f3f3;'>
    <!-- <button type="button" class="btn btn-light"><a href="logout.php">Cerrar sesion</a></button> -->
    <?php
        require_once("../include/navbar.php");
        getLoader("Cargando información del cliente...");
        $fecha_para_corte_caja = getFechaFormatoCDMX();
        getNavbar($fecha_para_corte_caja, $fetch_info['name'], $ModeloUsuario->getNombreSucursalUsuario($email)['nombre_sucursal']);
    ?>
    <main role="main" class="container">
        <div class="container">
            <h1>Tratamientos que ha tenido el cliente</h1>
            <div id="accordion">
                <p>
                    <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">DEPILACIONES</button>
                    <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">CAVITACIONES</button>
                    <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">OTROS TRATAMIENTOS</button>
                    <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">PRODUCTOS</button>
                    <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">MONEDEROS</button>
                </p>
                <div class="form-group">
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <?php
                                $tratamientosAplicados = $ModelCliente->getDepilacionesFromCliente($_GET['id']);
                                if(empty($tratamientosAplicados)){
                                        echo "<h3 class='text-center'>Aún no hay ninguna depilación registrada :(</h3>";
                                }else{
                                    echo "<ul class='list-group'>";
                                    foreach($tratamientosAplicados as $d){
                                        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>
                                                        <a href='../../View/Ventas/detalleVenta.php?idVenta=".$d['id_venta']."' role='button'>".$d['nombre_tratamiento']."</a><span class='badge bg-warning rounded-pill'>".date('Y-m-d', $d['timestamp'])."</span>
                                                    </li>";
                                        }
                                    echo "</ul>";
                                }
                            ?>
                        </div>
                    </div>
                    
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">
                            <?php
                                $tratamientosAplicados = $ModelCliente->getCavitacionesFromCliente($_GET['id']);
                                if(empty($tratamientosAplicados)){
                                        echo "<h3 class='text-center'>Aún no hay ninguna cavitación registrada :(</h3>";
                                }else{
                                    echo "<ul class='list-group'>";
                                    foreach($tratamientosAplicados as $d){
                                        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>
                                                        <a href='../../View/Ventas/detalleVenta.php?idVenta=".$d['id_venta']."' role='button'>".$d['nombre_tratamiento']."</a><span class='badge bg-warning rounded-pill'>".date('Y-m-d', $d['timestamp'])."</span>
                                                    </li>";
                                        }
                                    echo "</ul>";
                                }
                            ?>
                        </div>
                    </div>
                    
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body">
                            <?php
                                $tratamientosAplicados = $ModelCliente->getTratamientosFromCliente($_GET['id']);
                                if(empty($tratamientosAplicados)){
                                        echo "<h3 class='text-center'>Aún no hay ningun tratamiento registrado :(</h3>";
                                }else{
                                    echo "<ul class='list-group'>";
                                    foreach($tratamientosAplicados as $d){
                                        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>
                                                        <a href='../../View/Ventas/detalleVenta.php?idVenta=".$d['id_venta']."' role='button'>".$d['nombre_tratamiento']."</a><span class='badge bg-warning rounded-pill'>".date('Y-m-d', $d['timestamp'])."</span>
                                                    </li>";
                                        }
                                    echo "</ul>";
                                }
                            ?>
                        </div>
                    </div>
                    
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                        <div class="card-body">
                            <?php
                                $productosAplicados = $ModelCliente->getProductosFromCliente($_GET['id']);
                                if(empty($productosAplicados)){
                                        echo "<h3 class='text-center'>Aún no hay ningun producto adquirido :(</h3>";
                                }else{
                                    echo "<ul class='list-group'>";
                                    foreach($productosAplicados as $d){
                                        $infoProducto = $ModelProducto->getProductoWereID($d['id_productos'], $d['centro']);
                                        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>
                                                        <a href='../../View/Ventas/detalleVenta.php?idVenta=".$d['id_venta']."' role='button'>".$infoProducto['descripcion_producto']." ".$infoProducto['presentacion_producto']."</a><span class='badge bg-warning rounded-pill'>".date('Y-m-d', $d['timestamp'])."</span>
                                                    </li>";
                                        }
                                    echo "</ul>";
                                }
                            ?>
                        </div>
                    </div>

                    <div id="collapseFive" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                        <div class="card-body">
                            <?php
                            
                                $monederos = $ModelCliente->getAllMonederosFromCliente($_GET['id']);
                                $isHiddenBotonMonedero = '';
                                $tipo_monedero = " (tratamientos)";
                                $dineroDisponible = 0;
                                if(empty(json_decode($monederos[0]['dinero_final']))){ $dineroDisponible = number_format($monederos[0]['dinero_inicial']); }else{ $dineroDisponible = number_format(end(json_decode($monederos[0]['dinero_final']))); }
                                if(empty($monederos)){
                                    $monederos = $ModelCliente->getAllMonederosDineroFromCliente($_GET['id']);
                                    // $dineroDisponible     = number_format(end(json_decode($monederos[0]['dinero'])));
                                    $tipo_monedero = " (dinero) ";
                                }
                                if(empty($monederos)){
                                        echo "<h3 class='text-center'>Aún no hay ningun monedero registrado :(</h3>";
                                }else{
                                    $isHiddenBotonMonedero = 'hidden';
                                    echo "<ul class='list-group'>";
                                    foreach($monederos as $d){
                                        echo "<li class='list-group-item d-flex justify-content-between align-items-right'>
                                                <a href='../../View/Clientes/infoMonedero.php?id_monedero=".$d['id_monedero']."&id_cliente=".$d['id_cliente']."' role='button'>Monedero ".$tipo_monedero." #"
                                                    .$d['id_monedero'].
                                                "</a>";
                                                
                                                echo "<span class='badge bg-warning rounded-pill'>Monto disponible: $"
                                                    .$dineroDisponible.
                                                "</span>
                                              </li>";
                                        }
                                    echo "</ul>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="form-group">
                <select name="tratamiento" id="tratamiento" class="form-control">
                    <option value=''>*** SELECCIONA PARA VER TRATAMIENTOS ***</option>
                    <option value="1">Depilación</option>
                    <option value="2">Cavitación</option>
                    <option value="3">Otros</option>
                </select>
            </div> -->
            <div class="list-group" id="otro" name="otro"></div>
        </div>

        <div class="container">
            <h1>Informacion de cliente</h1>
            <form action="informacionCliente.php" method="POST" autocomplete="">
                <?php
                    foreach($info as $infoCliente){
                        $nombreSucursalCliente = $ModeloUsuario -> getNombreSucursalWhereIDSucursal($infoCliente['centro_cliente'])['nombre_sucursal'];
                ?>

                <div class="col d-flex justify-content-center">
                    <button type="button" id="editarCliente" name="editarCliente" class="btn btn-warning">Editar información</button>

                    <button type="button" id="cancelarEdicion" name="cancelarEdicion" class="btn btn-warning" hidden>Cancelar edición</button>

                    <button type="button" id="buttonEliminarCliente" name="buttonEliminarCliente" class="btn btn-danger" style="display: none;">Eliminar Cliente</button>

                    <a class="btn btn-primary"  href=<?php echo "../../View/Clientes/iniciarTratamientoCliente.php?id=".$infoCliente['id_cliente'];?> role="button" name="buttonRegistrarTratamiento" id="buttonRegistrarTratamiento">Registrar tratamiento</a>
                    
                    <a class="btn btn-info" name="buttonRegistrarMonedero" id="buttonRegistrarMonedero" href=<?php echo "../../View/Clientes/registroMonedero.php?idCliente=".$info[0]['id_cliente'];?> <?php echo $isHiddenBotonMonedero;?> role="button">Registrar un monedero</a>
                </div>

                <div class="form-group">
                    <table class="table table-borderless" style="table-layout: fixed;">
                        <tbody>
                            <tr>
                                <td>
                                    <h3>ID</h3>
                                    <!-- <input type="text" class="form-control" id="id" name="id" value=<?php echo $infoCliente['id_cliente'];?> readonly> -->
                                    <p class="lead" id="id" name="id"><?php echo $infoCliente['id_cliente'];?></p>
                                </td>    
                                <td>
                                    <h3>Estado en el sistema</h3>
                                    <!-- <input type="text" class="form-control" id="status" name="status" value=<?php echo strtoupper($infoCliente['status']); ?> readonly> -->
                                    <p class="lead" id="status" name="status"><?php echo strtoupper($infoCliente['status']);?></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                
                <div class="form-group">
                    <table class="table table-borderless" style="table-layout: fixed;">
                        <tbody>
                            <tr>
                                <td>
                                    <h3>Fecha de registro</h3>
                                    <!-- <input type="date" class="form-control" id="fecha_registro" name="fecha_registro" value=<?php echo "'".date( "Y-m-d", $infoCliente['creacion_cliente'])."'";?> readonly> -->
                                    <p class="lead" id="fecha_registro" name="fecha_registro"><?php echo date( "Y-m-d", $infoCliente['creacion_cliente']);?></p>
                                </td>    
                                <td>
                                    <h3>Ultima Visita</h3>
                                    <!-- <input type="date" class="form-control" id="fecha_visita" name="fecha_visita" value=<?php echo "'".date('Y-m-d', $infoCliente['ultima_visita_cliente'])."'";?> readonly> -->
                                    <p class="lead" id="fecha_visita" name="fecha_visita"><?php echo date('Y-m-d', $infoCliente['ultima_visita_cliente']);?></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="form-group"></div>
                <div class="form-group">
                    <table class="table table-borderless" style="table-layout: fixed;">
                        <tbody>
                            <tr>
                                <td>
                                    <h3>Nombre</h3>
                                    <!-- <input type="text" class="form-control" id="nombre" name="nombre" value=<?php echo "'".$infoCliente['nombre_cliente']."'";?> readonly required> -->
                                    <p class="lead" id="nombre" name="nombre"><?php echo $infoCliente['nombre_cliente'];?></p>
                                </td>    
                                <td>
                                    <h3>Apellidos</h3>
                                    <!-- <input type="text" class="form-control" id="apellidos" name="apellidos" value=<?php echo "'".$infoCliente['apellidos_cliente']."'";?> readonly required> -->
                                    <p class="lead" id="apellidos" name="apellidos"><?php echo $infoCliente['apellidos_cliente'];?></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <h3>E-mail</h3>
                    <!-- <input type="text" class="form-control" id="email" name="email" value=<?php echo $infoCliente['email_cliente'];?> readonly required> -->
                    <p class="lead" id="email" name="email"><?php echo $infoCliente['email_cliente'];?></p>
                </div>
                <div class="form-group">
                    <h3>Número</h3>
                    <!-- <input  oninput="numberOnly(this.id);"  type = "text"  pattern="\d*" maxlength="10" class="form-control" id="numero" name="numero" value=<?php echo $infoCliente['telefono_cliente'];?> readonly required> -->
                    <p class="lead" id="numero" name="numero"><?php echo $infoCliente['telefono_cliente'];?></p>
                    <select name="tipo" id="tipo" name="tipo" class="form-control" style="display: none;" readonly >
                        <option value="0">Celular</option>
                        <option value="1">Fijo</option>
                    </select>
                </div>
                <div class="form-group">
                    <h3>Centro</h3>
                    <p class="lead" id="centrolLbl" name="centroLbl">
                        <?php echo $nombreSucursalCliente; ?>
                    </p>
                    <select name="centro" id="centro" class="form-control"  style="display: none;" readonly>
                        <?php
                            foreach ($listaSucursales as $id => $nombre) {
                                $selected = ($infoCliente['centro_cliente'] == $id) ? "selected" : "";
                                echo "<option value='$id' $selected>$nombre</option>";
                            }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <table class="table table-borderless" style="table-layout: fixed;">
                        <tbody>
                            <tr>
                                <td>
                                    <h3>Fecha de nacimiento</h3>
                                    <!-- <input type="date" class="form-control" id="fecha" name="fecha" value=<?php echo $infoCliente['fecha_cliente'];?> readonly> -->
                                    <p class="lead" id="fecha" name="fecha"><?php echo is_numeric($infoCliente['fecha_cliente']) ? date("Y-m-d", $infoCliente['fecha_cliente']) : $infoCliente['fecha_cliente'];?></p>
                                </td>    
                                <td>
                                    <h3>CP</h3>
                                    <!-- <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "text" maxlength = "5" class="form-control" id="cp" name="cp" value=<?php echo "'".$infoCliente['cp_cliente']."'";?>readonly> -->
                                    <p class="lead" id="cp" name="cp"><?php echo $infoCliente['cp_cliente'];?></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>


                <button type="submit" id="editarClienteButton" name="editarClienteButton" class="btn btn-success" hidden>Confirmar edición</button>
                   <?php
                    }
                    ?>
            </form>
        </div>
    </main>
    <?php
      getFooter();
    ?>
    <script src="../../Controller/Clientes/Util/validarCamposAlta.js"></script>
</body>
</html>