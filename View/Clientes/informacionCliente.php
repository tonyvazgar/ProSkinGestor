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
  
  getHeadHTML("ProSkin - Editar Cliente");
?>
<body style='background-color: #f9f3f3;'>
    <!-- <button type="button" class="btn btn-light"><a href="logout.php">Cerrar sesion</a></button> -->
    <?php
        require_once("../include/navbar.php");
        
        getNavbar($fetch_info['name'], $ModeloUsuario->getNombreSucursalUsuario($email)['nombre_sucursal']);
    ?>
    <main role="main" class="container">
        <div class="container">
            <h1>Tratamientos que ha tenido el cliente</h1>

            <div class="form-group">
                <select name="tratamiento" id="tratamiento" class="form-control">
                    <option value=''>*** SELECCIONA PARA VER TRATAMIENTOS ***</option>
                    <option value="1">Depilación</option>
                    <option value="2">Cavitación</option>
                    <option value="3">Otros</option>
                </select>
            </div>
            <div class="list-group" id="otro" name="otro"></div>
        </div>

        <div class="container">
            <h1>Informacion de cliente</h1>
            <form action="buscarCliente.php" method="POST" autocomplete="">
                <?php
                    $id = $_GET['id'];
                    $info = $ModelCliente->getClienteWhereID($id);
                    foreach($info as $infoCliente){
                ?>

                <div class="col d-flex justify-content-center">
                    <button type="button" id="editarCliente" name="editarCliente" class="btn btn-warning">Editar información</button>
                    <button type="button" id="cancelarEdicion" name="cancelarEdicion" class="btn btn-danger" hidden>Cancelar edición</button>
                    <a class="btn btn-primary"  href=<?php echo "../../View/Clientes/iniciarTratamientoCliente.php?id=".$infoCliente['id_cliente'];?> role="button">Registrar tratamiento</a>
                </div>

                <div class="form-group">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td>
                                    <label for="exampleInputEmail1">ID</label>
                                    <input type="text" class="form-control" id="id" name="id" value=<?php echo $infoCliente['id_cliente'];?> readonly>
                                </td>    
                                <td>
                                    <label for="exampleInputEmail1">Estado en el sistema</label>
                                    <input type="text" class="form-control" id="status" name="status" value=<?php echo strtoupper($infoCliente['status']); ?> readonly>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                
                <div class="form-group">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td>
                                    <label for="exampleInputEmail1">Fecha de registro</label>
                                    <input type="date" class="form-control" id="fecha_registro" name="fecha_registro" value=<?php echo "'".date( "Y-m-d", $infoCliente['creacion_cliente'])."'";?> readonly>
                                </td>    
                                <td>
                                    <label for="exampleInputEmail1">Ultima Visita</label>
                                    <input type="date" class="form-control" id="fecha_visita" name="fecha_visita" value=<?php echo "'".date('Y-m-d', $infoCliente['ultima_visita_cliente'])."'";?> readonly>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="form-group"></div>
                <div class="form-group">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td>
                                    <label for="exampleInputEmail1">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" value=<?php echo "'".$infoCliente['nombre_cliente']."'";?> readonly required>
                                </td>    
                                <td>
                                    <label for="exampleInputEmail1">Apellidos</label>
                                    <input type="text" class="form-control" id="apellidos" name="apellidos" value=<?php echo "'".$infoCliente['apellidos_cliente']."'";?> readonly required>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">E-mail</label>
                    <input type="text" class="form-control" id="email" name="email" value=<?php echo $infoCliente['email_cliente'];?> readonly required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Número</label>
                    <input  oninput="numberOnly(this.id);"  type = "text"  pattern="\d*" maxlength="10" class="form-control" id="numero" name="numero" value=<?php echo $infoCliente['telefono_cliente'];?> readonly required>
                    <select name="tipo" id="tipo" name="tipo" class="form-control" readonly >
                        <option value="0">Celular</option>
                        <option value="1">Fijo</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Centro</label>
                    <select name="centro" id="centro" class="form-control" readonly>
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
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td>
                                    <label for="exampleInputEmail1">Fecha de nacimiento</label>
                                    <input type="date" class="form-control" id="fecha" name="fecha" value=<?php echo $infoCliente['fecha_cliente'];?> readonly>
                                </td>    
                                <td>
                                    <label for="exampleInputEmail1">CP</label>
                                    <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "text" maxlength = "5" class="form-control" id="cp" name="cp" value=<?php echo "'".$infoCliente['cp_cliente']."'";?>readonly>
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