<?php
    class ControllerSesion{
        public function verificarSesion($ModeloUsuario, $email, $password){
            if($email == false && $password == false){
                header('Location: ../../View/login/');
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
                <meta http-equiv = 'Content-Type' content = 'text/html; charset=utf-8' />
                <meta name='viewport' content='width=device-width, initial-scale=1'>
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
                <title>$title</title>
                <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js'
                integrity='sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g=='
                crossorigin='anonymous'></script>
                <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
                <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js'
                integrity='sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6'
                crossorigin='anonymous'></script>
                <script src='https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js' integrity='sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx' crossorigin='anonymous'></script><link rel='stylesheet' href='../../View/include/navbar.css'>
                <link rel='stylesheet' href='https://pro.fontawesome.com/releases/v5.10.0/css/all.css' integrity='sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p' crossorigin='anonymous'/>
              </head>";
    }

    function getMetodoPagoNombre($num_metodo_pago){
        $string = "";
        switch ($num_metodo_pago){
            case 1:
                $string = "Efectivo";
                break;
            case 2:
                $string = "[TDD]Tarjeta de débito";
                break;
            case 3:
                $string = "[TDC]Tarjeta de crédito";
                break;
            case 4:
                $string = "Transferencia";
                break;
            case 5:
                $string = "Cheque de regalo";
                break;
            case 6:
                $string = "Depósito";
                break;
            case 7:
                $string = "Monedero";
                break;
        }
        return $string;
    }
?>