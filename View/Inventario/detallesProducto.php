<?php 
  require_once "../../Controller/Clientes/ClienteController.php"; 
  require_once "../../Controller/Inventario/InventarioController.php"; 
  require_once "../../Model/Clientes/Cliente.php";
  require_once "../../Controller/ControllerSesion.php";
  require_once "../../Model/Usuario/Usuario.php";
  require_once "../../Model/Inventario/Producto.php";

  $ModelCliente = new Cliente();
  $session = new ControllerSesion();
  $ModeloUsuario = new Usuario();
  
  $email    = $_SESSION['email'];
  $password = $_SESSION['password'];
  
  $fetch_info = $session->verificarSesion($ModeloUsuario, $email, $password);
  
  $ModelProducto = new Producto();

  getHeadHTML("ProSkin - Detalles producto");
?>
<body style='background-color: #f9f3f3;'>
    <?php
        require_once("../include/navbar.php");
        
        getNavbar($fetch_info['name'], $ModeloUsuario->getNombreSucursalUsuario($email)['nombre_sucursal']);
    ?>
    <main role="main" class="container">
        <div class="container">
                <?php
                    $id = $_GET['id'];
                    $info = $ModelProducto->getProductoWereID($id);
                    foreach($info as $infoProducto){
                ?>
                    <h1>Detalles del producto <?php echo $infoProducto['descripcion_producto'];?></h1>
                    <form action="buscarCliente.php" method="POST" autocomplete="">
                    <div class="form-group">
                        <label for="exampleInputEmail1">ID</label>
                        <input type="text" class="form-control" id="id" name="id" value=<?php echo $infoProducto['id_producto'];?> readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Marca</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value=<?php echo "'".$infoProducto['marca_producto']."'";?> readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Linea</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value=<?php echo "'".$infoProducto['linea_producto']."'";?> readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Descripción</label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos" value=<?php echo "'".$infoProducto['descripcion_producto']."'";?> readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Presentación</label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos" value=<?php echo "'".$infoProducto['presentacion_producto']."'";?> readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Precio</label>
                        <input type="text" class="form-control" id="email" name="email" value=<?php echo $infoProducto['costo_unitario_producto'];?> readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Unidades disponibles</label>
                        <input type="text" class="form-control" id="email" name="email" value=<?php echo $infoProducto['stock_disponible_producto'];?> readonly>
                    </div>
                    <div class="form-group">
                        <a href="../../View/Inventario/" class="btn btn-warning">Regresar</a>
                    </div>
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