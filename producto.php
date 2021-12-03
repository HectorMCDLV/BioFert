<?php
    $id = $_GET['id'];
    $request = $_GET['request'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id)
    {
        header('Location: /');
    }

    require __DIR__ . '/include/config/connect.php';
    $db = conectarDB();

    $query = " SELECT producto.id as id, producto.nombre as nombre, producto.imagen as imagen  FROM producto ";

    $resultado = mysqli_query($db, $query);
    $producto = mysqli_fetch_assoc($resultado);
?>  

<main class="contenedor">
    <?php if( intval( $request ) === 1 ): ?>
        <p class="alerta exito">Producto Agregado al Carrito Exitosamente</p>
    <?php endif; ?>
    <h1><?php echo $producto['nombre']; ?></h1>
    <div class="tienda">
        <img class="tienda__imagen" src="../../portadas/<?php echo $comic['imagen']; ?>" alt="Producto">
        <div class="tienda__info">
            <p>
                <?php echo $comic['sinopsis']; ?>
            </p>

            <form id="compra" class="formulario" method="POST">   
                <input type="hidden" name="id_producto" value="<?php echo $comic['id'];?>">
                <input class="formulario__campo" type="number" name="cantidad" placeholder="Cantidad" min="1" value="1">
            </form>
            <input class="boton w-sm-100" type="submit" form="compra" value="Agregar al Carrito">
        </div>
    </div>
</main>