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
          <h4>Selecciona la marca</h4>
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
      </div>
    </main>
    <?php
      getFooter();
    ?>
    <script src="../../Controller/Inventario/Util/categoriasProductos.js"></script>
</body>
</html>