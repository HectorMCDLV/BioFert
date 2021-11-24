<?php

require '../../include/config/connect.php';

    $link = conectarDB();
    session_start(); 
    
    $errores = [];
    $email = '';
    $password = '';
  
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $email = mysqli_real_escape_string( $link, filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL ) ) ;
        $password = mysqli_real_escape_string( $link, $_POST['contraseña'] );
       
        if(!$email){
            $errores[] = " El email es obligatorio  ";
        }

        if(!$password){
            $errores[] = " El password es obligatorio ";
        }
     

       

        if(empty($errores)){


            $queryVerificacion = "SELECT * FROM cliente WHERE email = '${email}' ";
            $verificacion = mysqli_query($link, $queryVerificacion);
            
            if(!$verificacion === false && $verificacion->num_rows > 0 ){

                $usuario = mysqli_fetch_assoc($verificacion);



                $newhash=$usuario['contraseña'];//taken from db


                var_dump( $newhash);
               

                var_dump(password_verify($password, $newhash));

                $auth = password_verify($password, $newhash);


                if ($auth) {
                    echo"verified";            
                    echo "Logged in!";

                    session_start();
                    $_SESSION['correo'] = $usuario['email'];
                    $_SESSION['rol'] = $usuario['cliente'];
                    $_SESSION['id'] = $usuario['id'];
                    $_SESSION['login'] = true;
                    $_SESSION['nombre'] = $usuario['nombre']; 
                    
                    header('Location: /../../nosotros.php'); 
                }
                else{
                    $errores[] = "contraseña incorrecta";
                }

            }
                
            else{
                $errores[]="usuario no existe";
            }
        
         
        }
    } 

    



?>






<!DOCTYPE html>
<html>
<head>
        <title>Login</title>
</head>
<body>
    <h1>Inicie Sesion</h1>
        <div>
            <form method="POST" action=''>
            
                
                <table>
                    <tr>
                        <td>Correo:</td>
                        <td><input type="email" name="email"
                        placeholder= "Ingrese su correo"></td>
                    </tr>
                    <tr>
                        <td>Contraseña:</td>
                        <td><input type="password" name="contraseña"></td>
                    </tr>
                    <tr>
                        <td>
                        <button type="sumbit" >Ingresar</button>
                        <td>
                    </tr>
                </table>
            </form>
        </div>
    <h1>
</body>