<?php
    class Session{
        public function verificarSesion() {
            $currentTime       = time();
            $expireTimeSession = $_SESSION['expire'];
            $userRole          = $_SESSION['userRole'];
            
            if ($currentTime > $expireTimeSession || $userRole != 'admin') {
                session_destroy();
                header('Location: ../../View/login/');
            }
        }
    }
?>