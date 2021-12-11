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
            
            $queryId = " SELECT id FROM cliente WHERE email = '${email}'";
            $resultadoId = mysqli_query($link, $queryId);

            $cliente = mysqli_fetch_assoc($resultadoId);
            $clienteid = $cliente['id'];
            $querypedido = " INSERT INTO pedido (id_cliente) VALUES ($clienteid)";
            mysqli_query($link, $querypedido)  or die(mysqli_error($link)); 


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
                <form class="formulario" action = " " method = "post">
                    <div class = "form-group">
                            <label>Nombres</label>
                            <input type="text" name = "nombres" class = "form-control"
                             required>
                            <i class="formulario__validacion-estado fas fa-times-circle"></i>
                            <p class="formulario__input-error">El Nombre no es valido</p>

                    <div class = "form-group">
                            <label>Apellidos</label>
                            <input type="text" name = "apellidos" class = "form-control"
                             required>
                             <i class="formulario__validacion-estado fas fa-times-circle"></i>
                             <p class="formulario__input-error">El Apellido no es valido</p>

                    <div class = "form-group">
                            <label>Email</label>
                            <input type="Email" name = "email" class = "form-control"
                             required>
                             <i class="formulario__validacion-estado fas fa-times-circle"></i>
                             <p class="formulario__input-error">El Email no es valido</p>

                    <div class = "form-group">
                            <label>Contraseña</label>
                            <input type="password" name = "contraseña" class = "form-control"
                             required>
                             <i class="formulario__validacion-estado fas fa-times-circle"></i>
                             <p class="formulario__input-error">La Contraseña no es valida</p>

                    <div class = "form-group">
                            <label>Confirma Contraseña</label>
                            <input type="password" name = "confirma_contraseña" class = "form-control"
                             required>
                             <i class="formulario__validacion-estado fas fa-times-circle"></i>
                             <p class="formulario__input-error">Las dos Contraseñas deben se iguales</p>

                    <div class = "form-group">
                            <button type="submit" name = "submit"  value="Submit">Enviar</button>
                    </div>

                    <div class="formulario__mensaje" id="formulario__mensaje">
                        <p><i class = "fas fa-exclamation-triangle"></i> <b>Error:</b> Llenar todos los campos </p>
                    </div>

                    <p>Tienes Cuenta <a href="Login.php">Login
                </form>

                <script src = "//localhost/biofert/js/formulario.js"></script>
                <script src = "https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
            </div>
        </div>
</main>

<?php 
    incluirTemplate('footer');
?>