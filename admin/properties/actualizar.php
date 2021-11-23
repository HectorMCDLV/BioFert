<?php

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: //Localhost/biofert/admin');
    }

    require '../../include/config/connect.php';
    $db = conectarDB();

    $consultaDatos = " SELECT * FROM producto WHERE id = ${id} ";
    
    $resultadoDatos = mysqli_query($db, $consultaDatos);
    $producto = mysqli_fetch_assoc($resultadoDatos);

    $errores = [];

    $id = $producto['ID'];
    $nombre = $producto['Nombre'];
    $descripcion = $producto['Descripcion'];
    $precio = $producto['Precio'];
    $almacen = $producto['Almacen'];
    $imagenProducto = $producto['Imagen'];

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $nombre = mysqli_real_escape_string($db, $_POST['nombre']);
        $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
        $precio = mysqli_real_escape_string($db, $_POST['precio']);
        $almacen = mysqli_real_escape_string($db, $_POST['almacen']);

        $imagen = $_FILES['imagen'];

        if(!$nombre){
            $errores[]= "Debes añadir un nombre";
        }
        if(!$descripcion){
            $errores[]= "Debes añadir una descripción";
        }
        if(!$precio){
            $errores[]= "Debes añadir un precio";
        }
        if(!$almacen){
            $errores[]= "Debes añadir el almacen";
        }

        $tamañoImagen = 1000 * 1000;

        if($imagen['size'] > $tamañoImagen){
            $errores[] = "La imagen es muy pesada";
        }

        if(empty($errores)){
            
            $carpetaImagenes = '../../imagenes/';

            if(!is_dir($carpetaImagenes)){
                mkdir($carpetaImagenes);
            }

            $nombreImagen = '';

            if( $imagen['name'] ){
                unlink($carpetaImagenes . $producto['Imagen']);
                
                $nombreImagen = md5( uniqid( rand(), true )) . ".jpg";

                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
            }
            else{
                $nombreImagen = $producto['Imagen'];
            }

            $query = " UPDATE producto SET nombre = '${nombre}', descripcion = '${descripcion}', precio = '${precio}', almacen = '${almacen}', imagen = '${nombreImagen}'  WHERE id = ${id} "; 
            $insercion = mysqli_query($db, $query);

            if($insercion){
                header('Location: //localhost/biofert/admin?resultado=2');
            }

        }
    }

    require '../../include/funciones.php';
    incluirTemplate('header');

?>

<main class="contenedor">
    <h1>Actualizar Producto</h1>

    <a href="//localhost/biofert/admin/" class="boton">Volver</a>

    <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error ?>
            </div>
    <?php endforeach; ?>

    <form class="formulario" id="crear-producto" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>Informacion General</legend>

                <label for="nombre">Nombre</label>
                <input class="formulario__campo" type="text" id="nombre" name="nombre" placeholder="Nombre Producto" value="<?php echo $nombre; ?>">

                <label for="descripcion">Descripción</label>
                <textarea class="formulario__campo--textarea" id="descripcion" name="descripcion"> <?php echo $descripcion; ?> </textarea>

                <label for="precio">Precio</label>
                <input class="formulario__campo" type="number" id="precio" name="precio" placeholder="Precio" value="<?php echo $precio; ?>">

                <label for="almacen">Almacen</label>
                <input class="formulario__campo" type="number" id="almacen" name="almacen" placeholder="Almacen" value="<?php echo $almacen; ?>">
                
                <label for="imagen">Imagen</label>  
                <input class="formulario__campo formulario__campo--imagen" type="file" id="imagen" name="imagen"  accept="image/png, image/jpg, image/jpeg">
            
                <img src="//localhost/biofert/imagenes/<?php echo $imagenProducto ?>" class="imagen-small">
            </fieldset>            
    </form>
    <button class="boton" type="submit" form="crear-producto">Actualizar Producto</button>
</main>

<?php 
    incluirTemplate('footer');
?>
