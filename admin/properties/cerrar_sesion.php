<?php   
    session_start(); 
    session_destroy(); 
    header("location://localhost/biofert/index.php"); 
    exit();
?>