<?php 
  require_once "../../Controller/Clientes/ClienteController.php"; 
  require_once "../../Controller/ControllerSesion.php";
  require_once "../../Model/Usuario/Usuario.php";
  require_once "../../Model/Tratamiento/Tratamiento.php";
  require_once "../../Model/Inventario/Producto.php";

  $session          = new ControllerSesion();
  $ModeloUsuario    = new Usuario();
  $ModelTratamiento = new Tratamiento();
  $ModelProducto    = new Producto();
  
  $email    = $_SESSION['email'];
  $password = $_SESSION['password'];
  
  $fetch_info = $session->verificarSesion($ModeloUsuario, $email, $password);

  $mis_tratamientos = $ModelTratamiento->getAllTratamientosAplicadosDeCosmetologa($email);
  $mis_ventas = $ModelTratamiento->getAllVentasDeCosmetologa($email);

  getHeadHTML("ProSkin - ".$fetch_info['name']);
?>
<body style='background-color: #f9f3f3;'>
    <!-- <button type="button" class="btn btn-light"><a href="logout.php">Cerrar sesion</a></button> -->
    <?php
        require_once("../include/navbar.php");
        
        getNavbar($fetch_info['name'], $ModeloUsuario->getNombreSucursalUsuario($email)['nombre_sucursal']);
    ?>
    <main role="main" class="container">
        <div class="container">
            <!-- <h2>Esta es tu información</h2>
            <dl class="row">
                <dt class="col-sm-3">Description lists</dt>
                <dd class="col-sm-9">A description list is perfect for defining terms.</dd>

                <dt class="col-sm-3">Euismod</dt>
                <dd class="col-sm-9">
                    <p>Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</p>
                    <p>Donec id elit non mi porta gravida at eget metus.</p>
                </dd>

                <dt class="col-sm-3">Malesuada porta</dt>
                <dd class="col-sm-9">Etiam porta sem malesuada magna mollis euismod.</dd>

                <dt class="col-sm-3 text-truncate">Truncated term is truncated</dt>
                <dd class="col-sm-9">Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</dd>

                <dt class="col-sm-3">Nesting</dt>
                <dd class="col-sm-9">
                    <dl class="row">
                    <dt class="col-sm-4">Nested definition list</dt>
                    <dd class="col-sm-8">Aenean posuere, tortor sed cursus feugiat, nunc augue blandit nunc.</dd>
                    </dl>
                </dd>
            </dl> -->
            <h1>Hola <?php echo $fetch_info['name']; ?></h1>
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <h3>Los tratamientos que has aplicado:</h3>
                        <ul class="list-group">
                            <?php
                                if(empty($mis_tratamientos)){
                                    echo "<h3 class='text-center'>Aún no has registrado ningún tratamiento</h3>";
                                }else{
                                foreach($mis_tratamientos as $tratamiento){
                                    echo "<li class='list-group-item d-flex justify-content-between align-items-center'>
                                                <a href='../../View/Ventas/detalleVenta.php?idVenta=".$tratamiento['id_venta']."'>".$tratamiento['nombre_tratamiento']."</a>
                                                <span class='badge bg-info rounded-pill'>".date("Y-m-d", $tratamiento['timestamp'])."</span>
                                        </li>";
                                }
                                }
                            ?>
                        </ul>
                    </div>
                    <div class="col-sm">
                        <h3>Los productos que has vendido:</h3>
                        <ul class="list-group">
                            <?php
                                if(empty($mis_ventas)){
                                    echo "<h3 class='text-center'>Aún no has vendido ningún producto</h3>";
                                }else{
                                foreach($mis_ventas as $venta){
                                    echo "<li class='list-group-item'>
                                            <a href='../../View/Ventas/detalleVenta.php?idVenta=".$venta['id_venta']."'>".$venta['descripcion_producto']."</a><br>
                                            <span class='badge bg-info rounded-pill'>".date("Y-m-d", $venta['timestamp'])."</span>
                                            <span class='badge bg-info rounded-pill'>".$venta['cantidad_producto']." piezas</span>
                                            <span class='badge bg-info rounded-pill'>$".$venta['monto']."</span>
                                          </li>";
                                    }
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- <img src="../img/bg.webp" class="img-fluid" alt="Responsive image"> -->
        </div>
    </main>
    <?php
      getFooter();
    ?>
    </main>
</body>
</html>