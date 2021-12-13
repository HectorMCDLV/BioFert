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
                $newhash = $usuario['contraseña']; 

                

                $auth = password_verify($password, $newhash);

                if ($auth) {
                    echo"verified";            
                    echo "Logged in!";

                    session_start();
                    $_SESSION['correo'] = $usuario['email'];
                    $_SESSION['rol'] = $usuario['cliente'];
                    $_SESSION['id'] = $usuario['id'];
                    $_SESSION['login'] = true;
                    $_SESSION['nombre'] = $usuario['nombres']; 
                    
                    header('Location: /biofert/productos.php'); 
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
    require '../../include/funciones.php';
    incluirTemplate('header');  
?>

<main class="contenedor">

    <h1>Inicie Sesion</h1>
    <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error ?>
            </div>
    <?php endforeach; ?>

    <div class="centrar">
    <form class = "formularioLogin" method="POST" id = "formulario" action=''>
        <div class = "formulario__grupo" id = "grupo__email">
            <label class = "formulario__label" for="email">Correo: </label>
            <div class="formulario__grupo-input">
                <input class="formulario__input" type="email" id="email" name="email">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error">El email ingresado no es valido</p>
        </div>

        <div class = "formulario__grupo" id = "grupo__contraseña">
            <label class = "formulario__label" for="contraseña">Contraseña: </label>
            <div class="formulario__grupo-input">
                <input class="formulario__input" type="password" id="contraseña" name="contraseña">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error">La contraseña ingresada no es valida</p>
        </div>
                
        <a class="link" href="/biofert/admin/Login/Register.php">Registrate Aqui.</a>
        <button type="sumbit" >Ingresar</button>
    </form>
    </div>
</main>

<?php 
    incluirTemplate('footer');
?>
