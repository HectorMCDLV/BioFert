<?php 
    require '../../include/config/connect.php';

    $db = conectarDB();

    $errores = [];

    $nombre = '';
    $descripcion = '';
    $precio = '';
    $almacen = '';

    //Consultas


    //Ejecutar el código después de que el usuario envía el formulario
    if ($_SERVER['REQUEST_METHOD']==='POST'){

        $nombre = mysqli_real_escape_string($db, $_POST['nombre']);
        $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
        $precio = mysqli_real_escape_string($db, $_POST['precio']);
        $almacen = mysqli_real_escape_string($db, $_POST['almacen']);

        
        $imagen = $_FILES['imagen'];

        if(!$nombre){
            $errores[] = "Debes añadir un nombre";
        }
        if(!$precio){
            $errores[] = "Debes añadir un precio";
        }
        if(!$descripcion){
            $errores[] = "Debes añadir una descripción";
        }
        if(!$precio){
            $errores[] = "Debes añadir un precio";
        }


        $tamañoImagen = 1000 * 1000;

        if($imagen['size'] > $tamañoImagen){
            $errores[] = "La imagen es muy pesada";
        }

        if (empty($errores)){
            
            $carpetaImagenes = '../../imagenes/';

            if(!is_dir($carpetaImagenes)){
                mkdir($carpetaImagenes);
            }

            $nombreImagen = md5( uniqid(rand(), true)) . ".jpg";

            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen); 

            $query = " INSERT INTO producto (id, nombre, descripcion, precio, almacen, imagen) VALUES ('$id', '$nombre', '$descripcion', '$precio', '$almacen', '$nombreImagen')";

            $insercion = mysqli_query($db, $query);

            if ($insercion) {
                header('Location: //localhost/biofert/admin/index.php?resultado=1');
            }

        }

    }

    require '../../include/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor">
        <h1>Crear Producto</h1>
        <a href="//localhost/biofert/admin/index.php" class=boton>Volver</a>

        <?php foreach($errores as $error): ?>
            <div class="Alerta Error">
                <?php echo $error ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" id="crear-producto" method="POST" action="//localhost/biofert/admin/properties/crear.php" enctype="multipart/form-data">
            <fieldset>
                <legend>Informacion General</legend>

                <label for="NOMBRE">Nombre</label>
                <input class="formulario__campo" type="text" id="nombre" name="nombre" placeholder="Nombre Producto" value="<?php echo $nombre; ?>">

                <label for="Descripcion">Descripción</label>
                <textarea class="formulario__campo--textarea" id="descripcion" name="descripcion"> <?php echo $descripcion; ?> </textarea>

                <label for="Precio">Precio</label>
                <input class="formulario__campo" type="number" id="precio" name="precio" placeholder="Precio" value="<?php echo $precio; ?>">

                <label for="Almacen">Almacen</label>
                <input class="formulario__campo" type="number" id="almacen" name="almacen" placeholder="Almacen" value="<?php echo $almacen; ?>">
                
                <label for="Imagen">Imagen</label>
                <input class="formulario__campo formulario__campo--imagen" type="file" id="imagen" name="imagen"  accept="image/png, image/jpg, image/jpeg">

            </fieldset>
            
            
            
        </form>

        <button class="boton" type="submit" form="crear-producto">Crear Producto</button>

    </main>

<?php
    incluirTemplate('footer');
?>    