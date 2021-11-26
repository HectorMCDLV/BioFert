<?php
session_start();
require 'include/config/connect.php';

$db = conectarDB();
$id_cliente = $_SESSION;

if($_SESSION['id']){
    $query = " SELECT pedido.id_cliente as id_cliente, PedidoProducto.id_pedido as id_pedido, producto.imagen as imagen, producto.nombre as nombre, producto.precio as precio, pedidoProducto.almace as almacen FROM pedidoProducto INNER JOIN peido ON  pedido.id = pedidoProducto.id_pedido INNER JOIN producto ON producto.id = pedidoProducto.id_producto WHERE pedido.id_cliente = $id_cliente";

    $resultado = mysqli_query($db, $query);

    $consultaTotal = " SELECT ";

    $resultadoSuma = mysqli_query($db, $consultaTotal);
    $suma = mysqli_fetch_assoc($resultadoSuma);
    $subTotal = $suma['subtotal'];
}

require 'include/funciones.php';
incluirTemplate('header');

?>

<main class="contenedor">
    <?php if($_SESSION['nombre']): ?>
    <h1> ¡Hola <?php echo $_SESSION['nombre']; ?>!</h1>
    <h1>Tu Carrito de Compras</h1>

    <?php endif; ?>

    <?php if(!$_SESSION['nombre']): ?>
        <h1>No has Iniciado sesión</h1>
        <a href = "/biofert/admin/login/login.php"><h1>Logueate Aquí</h1></a>
        <h1>o</h1> <a href="/biofert/admin/login/register.php"><h1>Registrate Aquí</h1></a>
    <?php endif; ?>  
    <div class="carrito">
        <?php while ( $producto = mysqli_fetch_assoc($resultado)): ?>
        <div class="carrito__producto">
            <a href="#">
                <p class="carrito__info--titulo"><?php echo $producto['titulo']; ?></p>
            </a>
            <p class="carrito__info--autor">por <?php echo $producto['autor']; ?></p>
            <p class="carrito__info--precio">$ <?php echo $producto['autor']; ?></p>
            <p class="carrito__info--UD">Cantidad:  <?php echo $producto['autor']; ?></p>
            <p class="carrito__info--UD" href="">Eliminar</p>

        </div>
    </div> 
    <?php endwhile; ?>
    <div>
        <h3 class="carrito__subtotal">Subtotal: $<?php echo $subTotal; ?></h3>
        <button class="buton">Pagar</button>
    </div>
</main>

<?php
    mysqli_close($db);
    incluirTemplate('footer');
?>