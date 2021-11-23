<?php
    require 'include/config/connect.php';
    $db = conectarDB();
    session_start();

    $errores = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
        $password = mysqli_real_escape_string($db, $_POST['contraseña']);

        if(!$email){
            $errores[] = " El email es obligatorio o no es válido ";
        }

        if(!password){
            $errores[] = " El password es obligatorio ";
        }
    }

?>