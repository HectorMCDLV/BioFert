<?php
session_start();
require 'include/config/connect.php';

$db = conectarDB();


if($_SESSION){
    $id_cliente = $_SESSION['id'];
    $query = "SELECT producto.id as id_producto, pedido.id_cliente as id_cliente, producto.nombre as nombre, producto.imagen as imagen, producto.precio as precio, productoxpedido.id_pedido as id_pedido, productoxpedido.cantidad as cantidad
              FROM productoxpedido INNER JOIN pedido ON pedido.id = productoxpedido.id_pedido INNER JOIN producto ON producto.id = productoxpedido.id_producto
              WHERE pedido.id_cliente = '$id_cliente' ";
    
    $resultado = mysqli_query($db, $query);
    
    $consultaTotal = " SELECT SUM(producto.precio * productoxpedido.cantidad) as subtotal FROM productoxpedido INNER JOIN pedido ON  pedido.id = productoxpedido.id_pedido INNER JOIN producto ON producto.id = productoxpedido.id_producto WHERE id_cliente = $id_cliente ";
        

    $resultadoSuma = mysqli_query($db, $consultaTotal);
    $suma = mysqli_fetch_assoc($resultadoSuma);
    $subTotal = $suma['subtotal'];
}

if( $_SERVER['REQUEST_METHOD'] === 'POST' ){
        
    $id_producto = $_POST['id_producto'];
    
    $id_producto = filter_var($id_producto, FILTER_VALIDATE_INT);
    
    $id_pedido = $_POST['id_pedido'];
    
    $id_pedido = filter_var($id_pedido, FILTER_VALIDATE_INT);
   

    if($id_producto){
        $eliminarProducto = " DELETE FROM productoxpedido WHERE id_producto = ${id_producto} AND id_pedido = ${id_pedido} ";
        
        $resultadoElim = mysqli_query($db, $eliminarProducto);
        
    }

    if($resultadoElim){
        header('Location: /biofert/carrito.php');
    }
}

require 'include/funciones.php';
incluirTemplate('header');

?>

<main class="contenedor">
    <?php if($_SESSION): ?>
    <h1> ¡Hola <?php echo $_SESSION['nombre']; ?>!</h1>
    <h1>Tu Carrito de Compras</h1>

    <?php endif; ?>

    <?php if(!$_SESSION): ?>
        <h1>No has Iniciado sesión</h1>
        <a href = "/biofert/admin/login/login.php"><h1>Logueate Aquí</h1></a>
        <h1>o</h1> <a href="/biofert/admin/login/register.php"><h1>Registrate Aquí</h1></a>
    <?php endif; ?>  
    <div class="carrito">
        <?php while ( $producto = mysqli_fetch_assoc($resultado)): ?>
        <div class="carrito__producto">
            <a href="#">
                <p class="carrito__info--titulo"><?php echo $producto['nombre']; ?></p>
            </a>    
            <p class="carrito__info--precio">$ <?php echo $producto['precio']; ?></p>
            <p class="carrito__info--UD">Cantidad:  <?php echo $producto['cantidad']; ?></p>
            <form method="POST">
                            <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">
                            <input type="hidden" name="id_pedido" value="<?php echo $producto['id_pedido']; ?>">
                            <input type="submit" value="Eliminar" class="reset carrito__info--UD"></input>
            </form>


        </div>
    </div> 
    <?php endwhile; ?>
    <div>
        <a href="/biofert/check_out.php">   
            <h3 class="carrito__subtotal">Subtotal: $<?php echo $subTotal; ?></h3>
            <button class="buton" >Pagar</button>
        </a>  
    </div>
</main>


<?php
    mysqli_close($db);
    incluirTemplate('footer');
?>