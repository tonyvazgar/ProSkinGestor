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

  getHeadHTML("ProSkin - Agregar Stock");
?>
<body style='background-color: #f9f3f3;'>
    <?php
        require_once("../include/navbar.php");
        
        getNavbar($fetch_info['name'], $ModeloUsuario->getNombreSucursalUsuario($email)['nombre_sucursal']);
    ?>
    <main role="main" class="container">
        <div class="container">
                <?php
                    $id_sucursal = $ModeloUsuario -> getNumeroSucursalUsuario($email)['id_sucursal'];
                    $id = $_GET['idProducto'];
                    $infoProducto = $ModelProducto->getProductoWereID($id, $id_sucursal);
                ?>
                    <h1>Detalles del producto <br><em><?php echo $infoProducto['descripcion_producto'];?></em></h1>
                    <form action="buscarCliente.php" method="POST" autocomplete="">
                    <hr/>
                    <div class="form-group">
                        <table class="table table-borderless" style="table-layout: fixed;">
                            <tbody>
                                <tr>
                                    <td>
                                        <h4>ID producto:</h4>
                                        <p class="lead"><?php echo $infoProducto['id_producto'];?></p><input type="text" class="form-control" id="id" name="id" value=<?php echo $infoProducto['id_producto'];?>   readonly>
                                    </td>
                                    <td>
                                        <h4>Marca</h4>
                                        <p class="lead"><?php echo $infoProducto['marca_producto'];?></p><input type="text" class="form-control" id="nombre" name="nombre" value=<?php echo "'".$infoProducto['marca_producto']."'";?>   readonly>
                                    </td>
                                    <td>
                                        <h4>Linea</h4>
                                        <p class="lead"><?php echo $infoProducto['linea_producto'];?></p><input type="text" class="form-control" id="nombre" name="nombre" value=<?php echo "'".$infoProducto['linea_producto']."'";?>   readonly>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group">
                        <h4>Descripción</h4>
                        <p class="lead"><em><?php echo $infoProducto['descripcion_producto'];?></em></p><input type="text" class="form-control" id="apellidos" name="apellidos" value=<?php echo "'".$infoProducto['descripcion_producto']."'";?>   readonly>
                    </div>
                    <div class="form-group">
                        <table class="table table-borderless" style="table-layout: fixed;">
                            <tbody>
                                <tr>
                                    <td>
                                        <h4>Presentación</h4>
                                        <p class="lead"><?php echo $infoProducto['presentacion_producto'];?></p><input type="text" class="form-control" id="apellidos" name="apellidos" value=<?php echo "'".$infoProducto['presentacion_producto']."'";?>   readonly>
                                    </td>
                                    <td>
                                        <h4>Precio</h4>
                                        <p class="lead"><?php echo $infoProducto['costo_unitario_producto'];?></p><input type="text" class="form-control" id="email" name="email" value=<?php echo $infoProducto['costo_unitario_producto'];?>   readonly>
                                    </td>
                                    <td>
                                        <h4>Unidades disponibles</h4>
                                        <p class="lead"><?php echo $infoProducto['stock_disponible_producto'];?></p><input type="text" class="form-control" id="email" name="email" value=<?php echo $infoProducto['stock_disponible_producto'];?>   readonly>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group">
                        <a href="../../View/Inventario/" class="btn btn-warning">Regresar</a>
                        <?php
                            $id = $_GET['id'];
                            echo '<a href="../../View/Inventario/agregarStock.php?idProducto='.$id.'" class="btn btn-info">Agregar Stock</a>';
                        ?>
                    </div>
            </form>
        </div>
    </main>
    <?php
      getFooter();
    ?>
    <script src="../../Controller/Clientes/Util/validarCamposAlta.js"></script>
</body>
</html>