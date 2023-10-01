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
  $id_sucursal = $ModeloUsuario->getNumeroSucursalUsuario($email)['id_sucursal'];
  getHeadHTML("ProSkin - ".$fetch_info['name']);
?>
<body style='background-color: #f9f3f3;'>
    <!-- <button type="button" class="btn btn-light"><a href="logout.php">Cerrar sesion</a></button> -->
    <?php
        require_once("../include/navbar.php");
        getLoader("Cargando...");
        $fecha_para_corte_caja = getFechaFormatoCDMX();
        date_default_timezone_set('America/Mexico_City');

        $nbDay = date('N', strtotime($fecha_para_corte_caja));
        $monday = new DateTime($fecha_para_corte_caja, new DateTimeZone('America/Mexico_City') );
        $sunday = new DateTime($fecha_para_corte_caja, new DateTimeZone('America/Mexico_City') );
        $monday->modify('-'.($nbDay-1).' days');
        $sunday->modify('+'.(7-$nbDay).' days');
        $primer_dia = strtotime($monday->format('Y-m-d'));
        $ultimo_dia = strtotime($sunday->format('Y-m-d'));

        $cortes_de_caja = $ModeloUsuario -> getCierresDeCajaFromCentro($id_sucursal, $primer_dia, $ultimo_dia);

        
      
        getNavbar($fecha_para_corte_caja, $fetch_info['name'], $ModeloUsuario->getNombreSucursalUsuario($email)['nombre_sucursal']);
        // echo '<pre>';
        // print_r($cortes_de_caja);
        // echo '<pre>';
    ?>
    <main role="main" class="container">
        <div class="container">
            <h1>Hola <?php echo $fetch_info['name']; ?></h1>
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <h3>Cierres de caja de la semana (<?php echo $monday->format('M-d').' al '.$sunday->format('M-d');?>):</h3>
                        <ul class="list-group">
                            <?php
                                if(empty($cortes_de_caja)){
                                    echo "<h3 class='text-center'>Aún no hay ningún cierre de caja disponible</h3>";
                                }else{
                                foreach($cortes_de_caja as $corte){
                                    echo "<li class='list-group-item'>
                                            <a href='../../Documents/ReportesCierreCaja/".$corte['nombre_archivo']."'>".$corte['id_corte_caja']."</a>
                                          </li>";
                                    }
                                }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <h3>Los tratamientos que has aplicado:</h3>
                        <ul class="list-group">
                            <?php
                                if(empty($mis_tratamientos)){
                                    echo "<h3 class='text-center'>Aún no has registrado ningún tratamiento</h3>";
                                }else{
                                foreach($mis_tratamientos as $tratamiento){
                                    echo "<li class='list-group-item'>
                                                <a href='../../View/Ventas/detalleVenta.php?idVenta=".$tratamiento['id_venta']."'>".$tratamiento['nombre_tratamiento']."</a><br>
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
                                          </li>";
                                    }
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
      getFooter();
    ?>
    </main>
    <script src="../../Controller/Usuario/Util/validarCamposCorteCaja.js"></script>
</body>
</html>