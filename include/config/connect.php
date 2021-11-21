<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

<<<<<<< HEAD:php/connect.php
function connect() :  mysqli{
=======
function conectarDB() :  mysqli{
>>>>>>> a64429f0a818bd9d1dc3a233637706634951bddc:include/config/connect.php
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'biofert');
 
/* Attempt to connect to MySQL database */
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
// Check connection
    if(!$link){
<<<<<<< HEAD:php/connect.php
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    return $link;}
    connect();
=======
        echo "No se ha podido conectar a la base de datos";
    }

    return $link;
}

>>>>>>> a64429f0a818bd9d1dc3a233637706634951bddc:include/config/connect.php
?>