<?php
    require '../include/config/connect.php';
    $db = conectarDB();

    $query = "SELECT producto.id as id, producto.nombre as nombre, producto.descripcion as descripcion, producto.precio as precio, producto.almacen as almacen, producto.imagen as imagen FROM producto ORDER BY nombre";

    $consulta = mysqli_query($db, $query);

    $resultado = $_GET['resultado'] ?? null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id){
            $eliminarArchivo = " SELECT imagen From producto WHERE id = ${id} ";

            $resultadoArch = mysqli_query($db, $eliminarArchivo);
            $producto = mysqli_fetch_assoc($resultadoArch);

            unlink('//localhost/biofert/imagenes/' . $producto['imagen']);

            $eliminarRegistro = " DELETE FROM producto WHERE id = ${id} ";
            $resultadoElim = mysqli_query($db, $eliminarRegistro);


            if($resultadoElim)
            {
                header('Location: //localhost/biofert/admin?resultado=3');
            }
        }
    }

    require '../include/funciones.php';
    incluirTemplate('header');

?>



<main class="contenedor">
    <h1>Administrador de Productos</h1>
    <?php if( intval($resultado) === 1): ?>
    <p class = "alerta exito">Producto Creado Correctamente</p>
    <?php elseif( intval( $resultado ) === 2 ): ?>
    <p class="alerta exito">Producto Actualizado Correctamente</p>
    <?php elseif( intval( $resultado ) === 3 ): ?>
    <p class="alerta exito">Producto Eliminado Correctamente</p>

    <?php endif; ?>

    <a class = "boton" href="//localhost/biofert/admin/properties/crear.php">Nuevo Producto</a>

    <table class="tabla">
    <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Almacen</th>
                <th>Imagen</th>
            </tr>
        </thead>
        
        <tbody>
        <?php while ($producto = mysqli_fetch_assoc($consulta)): ?>
            <tr>
                <td> <?php echo $producto['id']; ?> </td>
                <td> <?php echo $producto['nombre']; ?> </td>
                <td> <?php echo $producto['descripcion']; ?> </td>
                <td> <?php echo $producto['precio']; ?> </td>
                <td> <?php echo $producto['almacen']; ?> </td>
                <td><img src="/biofert/imagenes/<?php echo $producto['imagen'];?>" class="imagen-tabla"></td>
                <td>
                    <form method="POST" class="w-sm-100">
                        <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
                        <input type="submit" class="boton boton-rojo" value="Eliminar">
                    </form>
                    <a class="boton boton-amarillo" href="//localhost/biofert/admin/properties/actualizar.php?id=<?php echo $producto['id']; ?>">Actualizar</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
        

    </table>

</main>

<?php

    //CERRAR LA CONEXIÓN
    mysqli_close($db);

    incluirTemplate('footer');
?>