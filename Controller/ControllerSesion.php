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

?>