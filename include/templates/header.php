<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biofert</title>
    <link rel="stylesheet" href="//localhost/biofert/css/normalize.css">
    <link rel="stylesheet" href="//localhost/biofert/css/estilo.css">
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
    </header>