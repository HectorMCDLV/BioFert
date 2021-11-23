<?php 
session_start();


if(isset($_SESSION["userid"]) &&  $_SESSIOPM["userid"] === true ){
    header("location: welcome.php");
    exit;
}


?>