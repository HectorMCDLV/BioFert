<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

function conectarDB() :  mysqli{
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'biofert');
 
/* Attempt to connect to MySQL database */
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
// Check connection
    if(!$link){
        echo "No se ha podido conectar a la base de datos";
    }

    return $link;
}

?>