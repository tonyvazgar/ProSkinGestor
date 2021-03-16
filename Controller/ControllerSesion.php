<?php
    class ControllerSesion{
        public function verificarSesion($con, $email, $password){
            if($email == false && $password == false){
                header('Location: ../../View/login/login.php');
            }else{
                $sql = "SELECT * FROM usertable WHERE email = '$email'";
                $run_Sql = mysqli_query($con, $sql);
                if($run_Sql){
                    $fetch_info = mysqli_fetch_assoc($run_Sql);
                    return $fetch_info;
                }
            }
        }
    }

?>