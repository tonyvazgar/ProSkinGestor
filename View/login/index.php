<?php require_once "../../Controller/controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='apple-touch-icon' sizes='57x57' href='../../View/img/favicon/apple-icon-57x57.png'>
    <link rel='apple-touch-icon' sizes='60x60' href='../../View/img/favicon/apple-icon-60x60.png'>
    <link rel='apple-touch-icon' sizes='72x72' href='../../View/img/favicon/apple-icon-72x72.png'>
    <link rel='apple-touch-icon' sizes='76x76' href='../../View/img/favicon/apple-icon-76x76.png'>
    <link rel='apple-touch-icon' sizes='114x114' href='../../View/img/favicon/apple-icon-114x114.png'>
    <link rel='apple-touch-icon' sizes='120x120' href='../../View/img/favicon/apple-icon-120x120.png'>
    <link rel='apple-touch-icon' sizes='144x144' href='../../View/img/favicon/apple-icon-144x144.png'>
    <link rel='apple-touch-icon' sizes='152x152' href='../../View/img/favicon/apple-icon-152x152.png'>
    <link rel='apple-touch-icon' sizes='180x180' href='../../View/img/favicon/apple-icon-180x180.png'>
    <link rel='icon' type='image/png' sizes='192x192'  href='../../View/img/favicon/android-icon-192x192.png'>
    <link rel='icon' type='image/png' sizes='32x32' href='../../View/img/favicon/favicon-32x32.png'>
    <link rel='icon' type='image/png' sizes='96x96' href='../../View/img/favicon/favicon-96x96.png'>
    <link rel='icon' type='image/png' sizes='16x16' href='../../View/img/favicon/favicon-16x16.png'>
    <link rel='manifest' href='../../View/img/favicon/manifest.json'>
    <meta name='msapplication-TileColor' content='#ffffff'>
    <meta name='msapplication-TileImage' content='/ms-icon-144x144.png'>
    <meta name='theme-color' content='#ffffff'>
    <title>ProSkin - Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../include/style.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form">
                <form action="index.php" method="POST" autocomplete="">
                    <div class="text-center">
                        <img src="../img/logoProSkin.png" height="60" class="d-inline-block align-center" alt="">
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
    <script src="../include/validateForm.js"></script>
</body>
</html>