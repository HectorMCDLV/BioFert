<?php
if(!isset($_SESSION))
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biofert</title>
    <link rel="stylesheet" type="text/css" href="//localhost/biofert/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="//localhost/biofert/css/estilo.css">
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
   
    <header class="header">
        
        <a hred="index.html"> <img class = "header__logo" src="//localhost/biofert/img/logo.jfif" alt="Logotipo"> </a>
        
        <nav class="navegacion">
            
            <a class="navegacion__enlace <?php echo $activo===1 ? 'navegacion__enlace--activo' : ''; ?>" href="//localhost/biofert/index.php">Inicio</a>
            <a class="navegacion__enlace <?php echo $activo===2 ? 'navegacion__enlace--activo' : ''; ?>" href="//localhost/biofert/productos.php">Productos</a>
            <a class="navegacion__enlace <?php echo $activo===3 ? 'navegacion__enlace--activo' : ''; ?>" href="//localhost/biofert/nosotros.php">Nosotros</a>
            <a class="navegacion__enlace <?php echo $activo===4 ? 'navegacion__enlace--activo' : ''; ?>" href="//localhost/biofert/contacto.php">Contacto</a>
            
        </nav>   
        
        <div>
            <?php if($_SESSION): ?>
            <a  href="//localhost/biofert/carrito.php?id=<?php echo $_SESSION['id']; ?>">
            <?php endif; ?>
            <?php if(!$_SESSION): ?>
            <a  href="//localhost/biofert/carrito.php">
            <?php endif; ?>
            <a href="/biofert/admin/login/login.php">
                <svg width="45px" height="45px" viewBox="0 0 24 24" stroke-width="1.5" stroke="#EEEEEE" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                    <path d="M20 12h-13l3 -3m0 6l-3 -3" />
                </svg>
            </a>
            <a href="/biofert/carrito.php">
                <svg width="45" height="45" viewBox="0 0 24 24" stroke-width="1.5" stroke="#EEEEEE" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <circle cx="6" cy="19" r="2" />
                    <circle cx="17" cy="19" r="2" />
                    <path d="M17 17h-11v-14h-2" />
                    <path d="M6 5l14 1l-1 7h-13" />
                </svg>
            </a>
            <?php if($_SESSION['nombre']): ?>
            <h1>Hola <?php echo $_SESSION['nombre']; ?></h1>
            <a class="link" href="/admin/properties/cerrar_sesion.php">Cerrar Sesion</a>
            <?php endif;?>
        </div>
    </header>