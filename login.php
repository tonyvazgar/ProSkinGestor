<?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ProSkin - Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./include/style.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form">
                <form action="login.php" method="POST" autocomplete="">
                    <div class="text-center">
                        <img src="./img/logoProSkin.png" height="60" class="d-inline-block align-center" alt="">
                    </div>
                    <br>
                    <!-- <h2 class="text-center">Iniciar sesión</h2> -->
                    <p class="text-center">Ingresa tu correo y contraseña.</p>
                    <?php
                    if(count($errors) > 0){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <input class="form-control" id="email" type="email" name="email" autocomplete="off" placeholder="Correo electronico" value="<?php echo $email ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" id="password" placeholder="Contraseña" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" id="login" type="submit" name="login" value="Ingresar">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="./include/validateForm.js"></script>
</body>
</html>