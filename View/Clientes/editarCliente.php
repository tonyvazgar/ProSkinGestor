<?php 
  require_once "../../Controller/Clientes/ClienteController.php"; 
  require_once "../../Model/Clientes/Cliente.php";
  require_once "../../Controller/ControllerSesion.php";
  require_once "../../Model/Usuario/Usuario.php";

  $ModelCliente = new Cliente();
  $session = new ControllerSesion();
  $ModeloUsuario = new Usuario();
  
  $email    = $_SESSION['email'];
  $password = $_SESSION['password'];
  
  $fetch_info = $session->verificarSesion($ModeloUsuario, $email, $password);
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ProSkin - Editar Cliente</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"
    integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g=="
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../include/navbar.css">
    <script src="../include/loadNavbar.js"></script>
</head>
<body style='background-color: #f9f3f3;'>
    <!-- <button type="button" class="btn btn-light"><a href="logout.php">Cerrar sesion</a></button> -->
    <?php
        require_once("../include/navbar.php");
        getNavbar($fetch_info['name']);
    ?>
    <main role="main" class="container">
        <div class="container">
            <h1>Editar informacion de cliente</h1>
            <form action="buscarCliente.php" method="POST" autocomplete="">
                <?php
                    $id = $_GET['id'];
                    $info = $ModelCliente->getClienteWhereID($id);
                    foreach($info as $infoCliente){
                ?>
                <div class="form-group">
                    <label for="exampleInputEmail1">ID</label>
                    <input type="text" class="form-control" id="id" name="id" value=<?php echo $infoCliente['id_cliente'];?> readonly>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value=<?php echo "'".$infoCliente['nombre_cliente']."'";?> required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Apellidos</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos" value=<?php echo "'".$infoCliente['apellidos_cliente']."'";?> required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">E-mail</label>
                    <input type="text" class="form-control" id="email" name="email" value=<?php echo $infoCliente['email_cliente'];?> required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Número</label>
                    <input type="text" class="form-control" id="numero" name="numero" value=<?php echo $infoCliente['telefono_cliente'];?> required>
                    <select name="tipo" id="tipo" name="tipo" class="form-control">
                        <option value="0">Celular</option>
                        <option value="1">Fijo</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Centro</label>
                    <select name="centro" id="centro" class="form-control">
                        <?php
                            if($infoCliente['centro_cliente'] == '1'){
                                echo "<option value='1'>*Sonata*</option>";
                                echo "<option value='2'>Plaza Real</option>
                                      <option value='3'>La Paz</option>";
                            }else if($infoCliente['centro_cliente'] == '2'){
                                echo "<option value='2'>*Plaza Real*</option>";
                                echo "<option value='1'>Sonata</option>
                                      <option value='3'>La Paz</option>";
                            }else{
                                echo "<option value='3'>*La paz*</option>";
                                echo "<option value='1'>Sonata</option>
                                      <option value='2'>Plaza Real</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Fecha de nacimiento</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" value=<?php echo $infoCliente['fecha_cliente'];?> >
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">CP</label>
                    <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "text" maxlength = "5" class="form-control" id="cp" name="cp" value=<?php echo "'".$infoCliente['cp_cliente']."'";?>>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Fecha de registro</label>
                    <input type="date" class="form-control" id="fecha_registro" name="fecha_registro" value=<?php echo "'".date( "Y-m-d", $infoCliente['creacion_cliente'])."'";?> readonly>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Ultima Visita</label>
                    <input type="date" class="form-control" id="fecha_visita" name="fecha_visita" value=<?php echo "'".date('Y-m-d', $infoCliente['ultima_visita_cliente'])."'";?> readonly>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Estado en el sistema</label>
                    <input type="text" class="form-control" id="status" name="status" value=<?php echo $infoCliente['status'];?> readonly>
                </div>
                <button type="submit" id="editarCliente" name="editarCliente" class="btn btn-success">Editar</button>
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