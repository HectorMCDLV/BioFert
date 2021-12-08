<?php   
require '../../include/config/connect.php';


    $link = conectarDB();
    session_start(); 
    
    $errores = [];
    $email = '';
    $password = '';
    $nombre = '';
    $apellido = '';
    var_dump($_POST);
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $email = mysqli_real_escape_string( $link, filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL ) ) ;
        $password = mysqli_real_escape_string( $link, $_POST['contraseña'] );
        $nombre = mysqli_real_escape_string( $link, $_POST['nombres']);
        $apellido = mysqli_real_escape_string( $link, $_POST['apellidos'] );
        if(!$email){
            $errores[] = " El email es obligatorio o no es válido ";
        }

        if(!$password){
            $errores[] = " El password es obligatorio ";
        }
        if(!$nombre){
            $errores[] = "Un nombre es obligatorio ";
        }

        if(!$nombre){
            $errores[] = "Un Apellido es obligatorio ";
        }

      
        if(!$apellido){
            $errores[] = " El apellido es obligatorio ";
        }

        $queryVerificacion = " SELECT id FROM cliente WHERE email = $email ";
        $verificacion = mysqli_query($link, $queryVerificacion);
        
        if($verificacion){
            $errores[] = " El email ya existe ";    
        }


        if(empty($errores)){
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            
            //INSERTAR
            $query = " INSERT INTO cliente (nombres, apellidos, email, contraseña) VALUES ('${nombre}', '${apellido}', '${email}', '${passwordHash}')";
            //bien
                mysqli_query($link, $query)  or die(mysqli_error($link)); 
                
        }
    } 

    require '../../include/funciones.php';
    incluirTemplate('header');
?>

<main>
<div class ="formulario">
        <div class = "row">
            <div class = "col-md-12">
                <h2>Registrar</h2>  
                <p>Favor de llenar los datos para crear una cuenta</p>
                <form class="fomulario" action = " " method = "post">
                    <div class = "form-group">
                            <label>Nombres</label>
                            <input type="text" name = "nombres" class = "form-control"
                             required>

                    <div class = "form-group">
                            <label>Apellidos</label>
                            <input type="text" name = "apellidos" class = "form-control"
                             required>

                    <div class = "form-group">
                            <label>Email</label>
                            <input type="Email" name = "email" class = "form-control"
                             required>
                    <div class = "form-group">
                            <label>Contraseña</label>
                            <input type="password" name = "contraseña" class = "form-control"
                             required>
                    <div class = "form-group">
                            <label>Confirma Contraseña</label>
                            <input type="password" name = "confirma_contraseña" class = "form-control"
                             required>
                    <div class = "form-group">
                            <input type="submit" name = "submit"  value="Submit">
                    </div>
                    <p>Tienes Cuenta <a href="Login.php">Login
                </form>
            </div>
        </div>
</main>

<?php 
    incluirTemplate('footer');
?>