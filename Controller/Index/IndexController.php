<?php 
session_start();
require "connection.php";

//----------------------
// include "../Model/Db.php";

// $dbhost = 'localhost';
// $dbuser = 'root';
// $dbpass = '';
// $dbname = 'userform';

// $db = new Db($dbhost, $dbuser, $dbpass, $dbname);
// $account = $db->query('SELECT * FROM Usuarios')->fetchArray();
// print_r($account);
//----------------------
$email = "";
$name = "";
$errors = array();

//if user signup button
if (isset($_POST['signup'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    if ($password !== $cpassword) {
        $errors['password'] = "Las contraseñas no coinciden!";
    }
    $email_check = "SELECT * FROM Usuarios WHERE email = '$email'";
    $res = mysqli_query($con, $email_check);
    if (mysqli_num_rows($res) > 0) {
        $errors['email'] = "Ese correo ya está registrado, inicia sesión <a href='login.php'>aqui</a>!";
    }
    if (count($errors) === 0) {
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $code = rand(999999, 111111);
        $status = "notverified";
        $insert_data = "INSERT INTO Usuarios (name, email, password, code, status)
                        values('$name', '$email', '$encpass', '$code', '$status')";
        $data_check = mysqli_query($con, $insert_data);
        if ($data_check) {
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            header('location: index.php');
            exit();
        } else {
            $errors['db-error'] = "Error al darse de alta!";
        }
    }

}
//if user click login button
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $check_email = "SELECT * FROM Usuarios WHERE email = '$email'";
    $res = mysqli_query($con, $check_email);
    if (mysqli_num_rows($res) > 0) {
        $fetch = mysqli_fetch_assoc($res);
        $fetch_pass = $fetch['password'];
        if (password_verify($password, $fetch_pass)) {
            $_SESSION['email'] = $email;
            $status = $fetch['status'];
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            header('location: index.php');
        } else {
            $errors['email'] = "Contraseña incorrecta!";
        }
    }
}
?>