<?php
     $id = $_GET['id'];
    
     $request = $_GET['request'];
     
     $id = filter_var($id, FILTER_VALIDATE_INT);
     
     //if(!$id){
     //     header('Location: ../index.php');
     //} 
    //IMPORTAR LA CONEXION A LA BD
    require __DIR__ . '/../config/connect.php';
    $db = conectarDB();
    
    //CONSULTAR 
    $query = " SELECT  id,nombre, imagen, descripcion FROM producto Where id = ${id} ";

    //LEER LOS RESULTADOS
    $resultado = mysqli_query($db, $query);
    $producto = mysqli_fetch_assoc($resultado);

    if( $_SERVER['REQUEST_METHOD'] === 'POST' ){
        $id_producto = $_POST['id_producto'];
        $id_cliente = $_SESSION['id'];
        $consulta_pedido = " SELECT id FROM pedido WHERE id_cliente = $id_cliente";
        $resultado_consulta_pedido = mysqli_query($db, $consulta_pedido);
        
        $pedido = mysqli_fetch_assoc($resultado_consulta_pedido);
        
        $id_pedido = $pedido['id'];
        $cantidad = mysqli_real_escape_string( $db, $_POST['cantidad'] );

        $queryVerificacion = " SELECT id_pedido, id_producto FROM productoxpedido WHERE id_pedido = '${id_pedido}' AND id_producto = '${id_producto}'";
        $resultaVerificacion = mysqli_query($db, $queryVerificacion);
        $verificacion = mysqli_fetch_assoc($resultaVerificacion);
        
        if($verificacion===NULL){
            $query = " INSERT INTO productoxpedido(id_pedido, id_producto, cantidad) VALUES ('${id_pedido}', '${id_producto}', '${cantidad}')";
            $resultado = mysqli_query($db, $query);

            if($resultado){
                header("Location: //localhost/biofert/articulo.php?id=$id&request=1");
            }
        }
        if($verificacion['id_pedido']){
            $query = " UPDATE productoxpedido SET cantidad = cantidad + ${cantidad} WHERE id_pedido = '${id_pedido}' AND id_producto = '${id_producto}'";
            $resultado = mysqli_query($db, $query);

            if($resultado){
                header("Location: //localhost/biofert/carrito.php?id=$id&request=1");
            }
        }
    }
?>

<main class="contenedor">
    <?php if( intval( $request ) === 1 ): ?>
        <p class="alerta exito">producto Agragado al Carrito Exitosamente</p>
    <?php endif; ?>
    <h1><?php echo $producto['nombre']; ?></h1>
    <div class="producto__diseño">
        <img class="producto__imagen" src="//localhost/biofert/imagenes/<?php echo $producto['imagen']; ?>" alt="Producto">
        <div class="producto">
            <p class = "Visualizacion__descripcion">
                <?php echo $producto['descripcion']; ?>
            </p>

            <form id="compra" class="formulario" method="POST">   
                <input type="hidden" name="id_producto" value="<?php echo $producto['id'];?>">
                <input class="formulario__submit" type="number" name="cantidad" placeholder="Cantidad" min="1" value="1">
            </form>
            <input class="boton w-sm-100" type="submit" form="compra" value="Agregar al Carrito">
            </form>
        </div>
    </div>
</main>

<?php 
//CERRAR LA CONEXIÓN
mysqli_close($db);

?>