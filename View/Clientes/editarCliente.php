<?php 
  require_once "../../Controller/Clientes/ClienteController.php";

$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email == false && $password == false){
  header('Location: login.php');
}else{
  $sql = "SELECT * FROM usertable WHERE email = '$email'";
  $run_Sql = mysqli_query($con, $sql);
  if($run_Sql){
    $fetch_info = mysqli_fetch_assoc($run_Sql);
  }
}
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
                    <input type="text" class="form-control" id="id" name="id" value=<?php echo $infoCliente['ID_cliente'];?> readonly>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value=<?php echo $infoCliente['Nombre'];?> required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Edad</label>
                    <input type="text" class="form-control" id="edad" name="edad" value=<?php echo $infoCliente['Edad'];?> required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Número</label>
                    <input type="text" class="form-control" id="numero" name="numero" value=<?php echo $infoCliente['Numero'];?> required>
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
</body>
</html>