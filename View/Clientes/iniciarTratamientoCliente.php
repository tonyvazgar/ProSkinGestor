<?php 
  require_once "../../Controller/Clientes/ClienteController.php"; 
  require_once "../../Model/Clientes/Cliente.php";
  require_once "../../Controller/ControllerSesion.php";
  require_once "../../Model/Usuario/Usuario.php";
  require_once "../../Model/Tratamiento/Tratamiento.php";

  $ModelCliente = new Cliente();
  $session = new ControllerSesion();
  $ModeloUsuario = new Usuario();
  $ModelTratamiento = new Tratamiento();

  $tratamientos = $ModelTratamiento->getAllTratamientos();
  $zonasCuerpo = $ModelTratamiento->getAllZonasCuerpo();
  
  $email    = $_SESSION['email'];
  $password = $_SESSION['password'];
  
  $fetch_info = $session->verificarSesion($ModeloUsuario, $email, $password);
  $nombreSucursal = $ModeloUsuario->getNombreSucursalUsuario($email);
  $numeroSucursal = $ModeloUsuario->getNumeroSucursalUsuario($email);
  $id_cosmetologa = $ModeloUsuario->getIdCosmetologa($email);
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ProSkin - Registo de tratamiento</title>
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
        
        getNavbar($fetch_info['name'], $ModeloUsuario->getNombreSucursalUsuario($email)['nombre_sucursal']);
    ?>
    <main role="main" class="container">
        <div class="container">
            <h1>Registrar tratamiento</h1>
            <form action="iniciarTratamientoCliente.php" method="POST" autocomplete="">
                <?php
                    $id = $_GET['id'];
                    $info = $ModelCliente->getClienteWhereID($id);
                    foreach($info as $infoCliente){
                ?>
                <div class="form-group">
                    <label for="exampleInputEmail1">ID</label>
                    <input type="text" class="form-control" id="idCliente" name="idCliente" value=<?php echo $infoCliente['id_cliente'];?> readonly>
                    <input type="text" class="form-control" id="idCosmetologa" name="idCosmetologa" value=<?php echo "'".$id_cosmetologa['id']."'";?> hidden>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value=<?php echo "'".$infoCliente['nombre_cliente']." ".$infoCliente['apellidos_cliente']."'";?> readonly>
                </div>
                <div class="form-group">
                    <label>Tratamiento a empezar</label>
                    <select name="tratamiento" id="tratamiento" class="form-control">
                        <option>*** SELECCIONA ***</option>
                        <option value="1">Depilación</option>
                        <option value="2">Cavitación</option>
                        <option value="3">Tratamiento normal</option>
                    </select>
                </div>
                <div class="form-group" id="otro" name="otro">
                    <label>????</label>
                    
                </div>
                <!-- <div class="form-group">
                    <label for="exampleInputEmail1">Sesiones</label>
                    <input type="text" class="form-control" id="sesiones" name="sesiones" required>
                </div> -->

                <div class="form-group">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <td>Calificación</td>
                                <td scope="col">Centro</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select name="calificacion" id="calificacion" class="form-control">
                                        <option value="1">☆</option>
                                        <option value="2">☆☆</option>
                                        <option value="3">☆☆☆</option>
                                        <option value="4">☆☆☆☆</option>
                                        <option value="5">☆☆☆☆☆</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="idCentro" id="idCentro" class="form-control" readonly>
                                        <option value=<?php echo "'".$numeroSucursal['id_sucursal']."'";?>> <?php echo $nombreSucursal['nombre_sucursal'];?></option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>


                <div class="form-group">
                    <label>Comentarios</label>
                    <textarea name="comentarios" id="comentarios" cols="30" rows="5" class="form-control" maxlength='250' placeholder="Escribe algo relevante de este tratamiento" required></textarea>
                </div>

                <div class="form-group">
                    <label>Firma requerida del cliente</label>
                    <select name="aviso" id="aviso" class="form-control">
                        <option>*** SELECCIONA ***</option>
                        <option value="0">No firmado</option>
                        <option value="1">Ya se firmó</option>
                    </select>
                </div>
                <div class="form-group" id='botonComenzar' name='botonComenzar'>
                    <!-- <button type="submit" id="comenzarTratamiento" name="comenzarTratamiento" class="btn btn-success">Comenzar tratamiento</button> -->
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
    <script src="../../Controller/Tratamiento/Util/validarCamposIniciarCliente.js"></script>
</body>
</html>