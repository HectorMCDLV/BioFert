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

<main class="contenedor">
        <h1>Registro</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" id="login" method="POST">
            <fieldset>
                <label for="email">E-mail</label>
                <input class="formulario__campo" type="email" id="email" name="email" placeholder="Tu correo" value="<?php echo $email; ?>" required> 

                <label for="contraseña">Contraseña</label>
                <input class="formulario__campo" type="password" name="contraseña" placeholder="Contraseña" <?php echo $password; ?>  required>

                <label for="nombre">Nombre(s)</label>
                <input class="formulario__campo" type="text" id="nombre" name="nombres" placeholder="Nombre(s)" value="<?php echo $nombre; ?>" required> 

                <label for="apellido">Apellido(s)</label>
                <input class="formulario__campo" type="text" name="apellidos" placeholder="Apellido(s)" value="<?php echo $apellido; ?>" required>

                <div class="alinear-derecha flex">
                    <input class="boton w-sm-100" type="submit" value="Registrarse">
                </div>
            </fieldset>
        </form>
    </main>

<script src = "//localhost/biofert/js/formulario.js"></script>
<script src = "https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>

<?php 
    incluirTemplate('footer');
?>