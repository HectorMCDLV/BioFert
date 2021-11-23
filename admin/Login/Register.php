<?php   
require '../../include/config/connect.php';


    $link = conectarDB();
    session_start(); 
    
    $errores = [];
    $email = '';
    $password = '';
    $nombre = '';
    $apellido = '';
    $telefono = '';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $email = mysqli_real_escape_string( $link, filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL ) ) ;
        $password = mysqli_real_escape_string( $link, $_POST['contraseña'] );
        $nombre = mysqli_real_escape_string( $link, $_POST['nombres']);
        $apellido = mysqli_real_escape_string( $link, $_POST['apellidos'] );
        $telefono = mysqli_real_escape_string($link, $_POST['telefono'] );
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

        if(!$telefono){
            $errores[] = "El telefono es obligatorio ";
        }

        if(!$apellido){
            $errores[] = " El apellido es obligatorio ";
        }

        $queryVerificacion = " SELECT id_cliente FROM cliente WHERE email = $email ";
        $verificacion = mysqli_query($link, $queryVerificacion);
        var_dump($queryVerificacion);
        if($verificacion){
            $errores[] = " El email ya existe ";    
        }


        if(empty($errores)){
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            
            //INSERTAR
            $query = " INSERT INTO cliente (nombres, apellidos,telefono, email, contraseña) VALUES ('${nombre}', '${apellido}', '${telefono}', '${email}', '${passwordHash}')";
            $resultado = mysqli_query($link, $query);

            $queryID = " SELECT id_cliente FROM cliente WHERE email = '${email}' ";
            $resultadoId = mysqli_query($link, $queryID);

            $cliente = mysqli_fetch_assoc($resultadoId);
            $clienteid = $cliente['id_cliente'];

            $queryPedido = " INSERT INTO pedido (id_cliente) VALUES ($clienteid) ";
            $insercionPedido = mysqli_query($link, $queryPedido);

        }
    } 

    if($_SESSION){
        header('Location: /');      
    }

    
?>

<!DOCTYPE html>
<html>
    <head>
        Registrarse
    </head>
<body>
    <div class ="container">
        <div class = "row">
            <div class = "col-md-12">
                <h2>Registrar</h2>  
                <p>Favor de llenar los datos para crear una cuenta</p>
                <form action = " " method = "post">
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
                            <label>Telefono</label>
                            <input type="tel" name = "telefono" class = "form-control"
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
    </div>
</body>
</html>