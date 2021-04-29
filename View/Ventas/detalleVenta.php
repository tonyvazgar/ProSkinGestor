<?php 
  require_once "../../Controller/Clientes/ClienteController.php"; 
  require_once "../../Controller/ControllerSesion.php";
  require_once "../../Model/Usuario/Usuario.php";
  require_once "../../Model/Ventas/Venta.php";

  $session = new ControllerSesion();
  $ModeloUsuario = new Usuario();
  $ModeloVenta = new Venta();
  
  $email    = $_SESSION['email'];
  $password = $_SESSION['password'];
  $id_venta = $_GET['idVenta'];
  
  $fetch_info = $session->verificarSesion($ModeloUsuario, $email, $password);
  
  $nombreSucursal = $ModeloUsuario->getNombreSucursalUsuario($email)['nombre_sucursal'];
  $numeroSucursal = $ModeloUsuario->getNumeroSucursalUsuario($email)['id_sucursal'];
  $id_cosmetologa = $ModeloUsuario->getIdCosmetologa($email)['id'];

  $detalles = $ModeloVenta->getTodosLosDetallesVentaTratamiento($id_venta)[0];
  if(is_null($detalles)){
    $detalles = $ModeloVenta->getTodosLosDetallesVentaProducto($id_venta)[0];
  }

  getHeadHTML("ProSkin - Detalle Venta");
?>
<body style='background-color: #f9f3f3;'>
    <!-- <button type="button" class="btn btn-light"><a href="logout.php">Cerrar sesion</a></button> -->
    <?php
        require_once("../include/navbar.php");
        
        getNavbar($fetch_info['name'], $ModeloUsuario->getNombreSucursalUsuario($email)['nombre_sucursal']);
    ?>
    <main role="main" class="container">
      <div class="container">
        <h1>Detalle de la venta</h1>
          <div class="form-group">
            <table class='table table-borderless'>
              <tbody>
                <tr>
                  <td><label for="exampleInputEmail1">ID Venta</label></td>
                  <td><label for="exampleInputEmail1">ID Cliente</label></td>
                </tr>
                <tr>
                  <td><input type="text" class="form-control" id="id" name="id" value=<?php echo "'".$detalles['id_venta']."'";?> readonly></td>
                  <td><input type="text" class="form-control" id="id" name="id" value=<?php echo "'".$detalles['id_cliente']."'";?> readonly></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Método de pago</label>
            <input type="text" class="form-control" id="id" name="id" value=<?php echo "'".$detalles['metodo_pago']."'";?> readonly>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Monto</label>
            <input type="text" class="form-control" id="id" name="id" value=<?php echo "'".$detalles['monto']."'";?> readonly>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Monto</label>
            <input type="text" class="form-control" id="id" name="id" value=<?php echo "'".date('Y-m-d',$detalles['timestamp'])."'";?> readonly>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Centro de belleza</label>
            <input type="text" class="form-control" id="id" name="id" value=<?php echo "'".$detalles['centro']."'";?> readonly>
          </div>
          <div class="form-group">
            <table class='table table-borderless'>
              <tbody>
                <tr>
                  <td><label for="exampleInputEmail1">Producto</label></td>
                  <td><label for="exampleInputEmail1">Cantidad</label></td>
                </tr>
                <tr>
                  <td><input type="text" class="form-control" id="id" name="id" value=<?php echo "'".$detalles['id_productos']."'";?> readonly></td>
                  <td><input type="text" class="form-control" id="id" name="id" value=<?php echo "'".$detalles['cantidad_producto']."'";?> readonly></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Costo unitario</label>
            <input type="text" class="form-control" id="id" name="id" value=<?php echo "'".$detalles['costo_producto']."'";?> readonly>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Cosmetologa</label>
            <input type="text" class="form-control" id="id" name="id" value=<?php echo "'".$detalles['id_cosmetologa']."'";?> readonly>
          </div>
        <?php
            // print_r($detalles);
        ?>
        
        <!-- <img src="../img/img2.jpg" class="img-fluid" alt="Responsive image"> -->
      </div>
    </main>
    <?php
      getFooter();
    ?>
</body>
</html>