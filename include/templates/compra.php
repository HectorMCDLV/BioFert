<?php
    $id = $_GET['ID'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if ($id)
    {
        header('Location: /');
    }

    require __DIR__ . '/../config/connect.php';
    $db = conectarDB();

    $query = " SELECT Nombre, Descripcion, Precio, Almacen, Imagen FROM producto ";

    $resultado = mysqli_query($db, $query);
    $producto = mysqli_fetch_assoc($resultado);
?>

<main class="contenedor">
    <h1><?php echo $producto['Nombre']; ?></h1>
    <div class="tienda">
        <img class="tienda__imagen" src="//localhost/biofert/imagenes/<?php echo $producto['Imagen']; ?>" alt="Producto">
        <div class="tienda__info">
            <p>
                <?php echo $producto['Descripcion']; ?>
            </p>

            <form id="compra" class="formulario" >   
                <input class="formulario__campo" type="number" placeholder="Cantidad" min="1" value="1">
            </form>
            <input class="boton w-sm-100" type="submit" form="compra" value="Agregar al Carrito">
        </div>
    </div>
</main>

<?php 
mysqli_close($db);
?>