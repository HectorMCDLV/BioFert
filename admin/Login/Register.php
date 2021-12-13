<?php   
require '../../include/config/connect.php';


    $link = conectarDB();
    session_start(); 
    

    $errores = [];
    $email = '';
    $password = '';
    $nombre = '';
    $apellido = '';
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $email = mysqli_real_escape_string( $link, filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL ) ) ;
        $password = mysqli_real_escape_string( $link, $_POST['contraseña'] );
        $nombre = mysqli_real_escape_string( $link, $_POST['nombre']);
        $apellido = mysqli_real_escape_string( $link, $_POST['apellido'] );
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


            header('Location: /biofert/admin/Login/Login.php');
        }
    } 

    require '../../include/funciones.php';
    incluirTemplate('header');
?>

<main class="contenedor">
        <h1>Registro</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" id="formulario" method="POST">
            <div class = "formulario__grupo" id="grupo__nombre">
                <label class = "formulario__label" for="nombre">Nombre(s)</label>
                <div class="formulario__grupo-input">
                    <input class="formulario__input" type="text" id="nombre" name="nombre" placeholder="Nombre(s)" value="<?php echo $nombre; ?>" required> 
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>
                <p class="formulario__input-error">El Nombre ingresado no es valido</p>
            </div>

            <div class = "formulario__grupo" id="grupo__apellido">
                <label class = "formulario__label" for="apellido">Apellido(s)</label>
                <div class="formulario__grupo-input">
                    <input class="formulario__input" type="text" id ="apellido" name="apellido" placeholder="Apellido(s)" value="<?php echo $apellido; ?>" required>
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>
                <p class="formulario__input-error">El Apellido ingresado no es valido</p>
            </div>
                
            <div class = "formulario__grupo" id="grupo__email">
                <label class = "formulario__label" for="email">E-mail</label>
                <div class="formulario__grupo-input">
                    <input class="formulario__input" type="email" id="email" name="email" placeholder="Tu correo" value="<?php echo $email; ?>" required> 
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>
                <p class="formulario__input-error">El email ingresado no es valido</p>
            </div>

            <div class = "formulario__grupo" id="grupo__contraseña">
                <label class = "formulario__label" for="contraseña">Contraseña</label>
                <div class="formulario__grupo-input">
                    <input class="formulario__input" type="password" id="contraseña" name="contraseña" placeholder="Contraseña" <?php echo $password; ?>  required>
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>
                <p class="formulario__input-error">La contraseña ingresada no es valida</p>
            </div>

            <div class="formulario__mensaje" id="formulario__mensaje">
                <p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario correctamente. </p>
            </div>

            <div class="formulario__grupo formulario__grupo-btn-enviar">
                <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
            </div>

                <div class="alinear-derecha flex">
                    <input class="boton w-sm-100" type="submit" value="Registrarse">
                </div>
        </form>
    </main>

<?php 
    incluirTemplate('footer');
?>