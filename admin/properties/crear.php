<?php 
    require '../../include/config/connect.php';

    $db = conectarDB();

    $errores = [];

    $id = '';
    $nombre = '';
    $descripcion = '';
    $precio = '';
    $almacen = '';

    //Consultas


    //Ejecutar el código después de que el usuario envía el formulario
    if ($_SERVER['REQUEST_METHOD']==='POST'){

        $id = mysqli_real_escape_string($db, $_POST['nombre']);
        $nombre = mysqli_real_escape_string($db, $_POST['precio']);
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
        if(!$nombre){
            $errores[] = "Debes añadir un título";
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

            $query = " INSERT INTO biofert (id, nombre, descripcion, precio, almacen) VALUES ('$id', '$nombre', '$descripcion', '$precio', '$almacen')";

            $insercion = mysqli_query($db, $query);

            if ($insercion) {
                header('Location: /admin?resultado=1');
            }

        }

    }

    require '../../include/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor">
        <h1>Crear Producto</h1>
        <a href="/admin" class=boton>Volver</a>

        <?php foreach($errores as $error): ?>
            <div class="Alerta Error">
                <?php echo $error ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" id="crear-producto" method="POST" action="/admin/properties/crear.php" enctype="multipart/form-data">
            <fieldset>
                <legend>Informacion General</legend>

                <label for="ID">ID</label>
                <input class="formulario__campo" type="number" min="1" id="id" placeholder="ID Producto" value="<?php echo $nombre; ?>">

                <label for="NOMBRE">Nombre</label>
                <input class="formulario__campo" type="text" id="nombre" name="nombre" placeholder="Nombre Producto" value="<?php echo $nombre; ?>">

                <label for="Descripcion">Descripción</label>
                <input class="formulario__campo" type="text" id="descripcion">

                <label for="Precio">Precio</label>
                <input class="formulario__campo" type="number">

                <label for="Almacen">Almacen</label>
                <input class="formulario__campo">
                
            </fieldset>
        </form>


    </main>

<?php
    incluirTemplate('footer');
?>    