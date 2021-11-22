<?php
    require __DIR__ . '/../config/connect.php';
    $db = conectarDB();

    $query = " SELECT Nombre, Descripcion, Precio, Almacen, Imagen FROM producto ";

    $resultado = mysqli_query($db, $query);
    
?>

<div class="grid">
    <?php while ( $producto = mysqli_fetch_assoc($resultado) ): ?>
    <div class="producto">
        <a href="//localhost/biofert/producto.php?id=<?php echo $producto['ID']; ?>">
            <img class="producto__portada" src="//localhost/biofert/imagenes/<?php echo $producto['Imagen']; ?>" alt="imagen producto">
            <div class="producto__informacion">
                <p class="producto__titulo"> <?php echo $producto['Nombre']; ?> </p>
                <p class="producto__precio"> <?php echo '$' . $producto['Descripcion']; ?> </p>
                <p class="producto__info"><?php echo $producto['Precio']; ?> </p>
                <p class="producto__info"><?php echo $producto['Almacen']; ?> </p>
            </div>
        </a>
    </div>
    <?php endwhile; ?>
</div>