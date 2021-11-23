<?php

    include '../../admin/Login/Session.php';
    include '../../include/config/connect.php';

    $db = conectarDB();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $nombres = trim($_POST['nombres']);
    $apellidos = trim($_POST['apellidos']);
    $email = trim($_POST['email']);
    $telefono = trim($_POST['telefono']);
    $password = trim($_POST['contraseña']);
    $confirm_password = trim($_POST["confirma_contraseña"]);
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    
    
    if($query = $db->prepare("SELECT * FROM cliente WHERE email = ?")) {
            $error = '';
            // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
    $query->bind_param('s', $email);
    $query->execute();
    // Store the result so we can check if the account exists in the database.
    $query->store_result();
            if ($query->num_rows > 0) {
                 $error .= '<p class="error">The email address is already registered!</p>';
            } else {
                // Validate password
                if (strlen($password ) < 6) {
                    $error .= '<p class="error">Password must have atleast 6 characters.</p>';
                }
                // Validate confirm password
                if (empty($confirm_password)) {
                    $error .= '<p class="error">Please enter confirm password.</p>';
                }   else {
                    if (empty($error) && ($password != $confirm_password)) {
                        $error .= '<p class="error">Password did not match.</p>';
                }
            }
            if (empty($error) ) {
                $insertQuery = " INSERT INTO cliente (nombres, apellidos,telefono,email,contraseña) VALUES ('${nombres}', '${apellidos}','${telefono}'. '${email}', '${passwordHash}')";
                $resultado = mysqli_query($db, $insertQuery);
    
            }
        }
    }
    
    $insertQuery->close();
    
    $query->close();
   
    

   
    
    // Close DB connection
    mysqli_close($db);
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
                    <p>Tienes Cuenta <a href="login.php">Login
                </form>
            </div>
        </div>
    </div>
</body>
</html>