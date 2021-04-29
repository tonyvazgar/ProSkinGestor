<?php
    class ControllerSesion{
        public function verificarSesion($ModeloUsuario, $email, $password){
            if($email == false && $password == false){
                header('Location: ../../View/login/login.php');
            }else{
                return $ModeloUsuario->getUsuarioWhereEmail($email);
            }
        }
    }

    function getHeadHTML($title){
        echo "<!DOCTYPE html>
              <html lang='es'>
              <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1'>
                <title>$title</title>
                <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js'
                integrity='sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g=='
                crossorigin='anonymous'></script>
                <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
                <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js'
                integrity='sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6'
                crossorigin='anonymous'></script>
                <link rel='stylesheet' href='../../View/include/navbar.css'>
              </head>";
    }
?>