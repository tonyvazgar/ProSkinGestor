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
        public function getSucursalFromSession() {
            return $_SESSION['userSucursal'];;
        }

        public function isAdminGlobal() {
            return $_SESSION['userPermission'] === 'global';
        }
    }
?>