<?php 
  require_once "../../Controller/Clientes/ClienteController.php"; 
  require_once "../../Controller/ControllerSesion.php";
  require_once "../../Model/Usuario/Usuario.php";
  require_once "../../Model/Inventario/Producto.php";

  $session = new ControllerSesion();
  $ModeloUsuario = new Usuario();
  $ModelProducto = new Producto();
  
  $email    = $_SESSION['email'];
  $password = $_SESSION['password'];
  
  $fetch_info = $session->verificarSesion($ModeloUsuario, $email, $password);
  $numeroSucursal = $ModeloUsuario->getNumeroSucursalUsuario($email);  
  $productos = $ModelProducto->getAllProductos();
  
  getHeadHTML("ProSkin - Inventario");
?>
<body style='background-color: #f9f3f3;'>
    <!-- <button type="button" class="btn btn-light"><a href="logout.php">Cerrar sesion</a></button> -->
    <?php
        require_once("../include/navbar.php");
        
        getNavbar($fetch_info['name'], $ModeloUsuario->getNombreSucursalUsuario($email)['nombre_sucursal']);
    ?>
    <main role="main" class="container">
      <div class="container">
        <h1>Productos en el invetario</h1>
        <div class="form-group">
          <a href="altaProducto.php" class="btn btn-success">Agregar producto</a>
          <a href="buscarInventario.php" class="btn btn-warning">Buscar en el inventario por nombre</a>
        </div>
        <div class="form-group">
          <label>Selecciona la marca</label>
          <input type="text" class="form-control" id="centro" name="centro" value=<?php echo "'".$numeroSucursal['id_sucursal']."'"; ?> hidden>
          <select name="marca" id="marca" class="form-control">
            <option value="">** SELECCIONA **</option>
            <option value="MIGUETT">MIGUETT</option>
            <option value="AINHOA">AINHOA</option>
            <option value="GERMAINE">GERMAINE</option>
          </select>
        </div>
        <div class="form-group" id="otro" name="otro">
                                                
        </div>

        <div class="form-group" id="productos" name="productos">
                                                
        </div>
        <?php
          // echo "<pre>";
          // print_r($productos);
          // echo "</pre>";
          // foreach($productos as $d){
          //   if($d['stock_disponible_producto'] == 0){
          //     echo "<li class='list-group-item d-flex justify-content-between align-items-center'>
          //             <a href='detallesProducto.php?id=".$d['id_producto']."' role='button'>".$d['nombre_producto']."</a><span class='badge bg-warning rounded-pill'>Sin Stock</span>
          //             </li>";
          //   }else{
          //     echo "<li class='list-group-item d-flex justify-content-between align-items-center'>
          //             <a href='detallesProducto.php?id=".$d['id_producto']."' role='button'>".$d['descripcion_producto']."</a><span class='badge bg-success rounded-pill'>Stock</span>
          //             </li>";
          //   }
          // }
        ?>
        <img src="../img/img2.jpg" class="img-fluid" alt="Responsive image">
      </div>
    </main>
    <?php
      getFooter();
    ?>
    <script src="../../Controller/Inventario/Util/categoriasProductos.js"></script>
</body>
</html>