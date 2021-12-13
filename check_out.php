<?php 
    session_start();
    require 'include/config/connect.php';
    
    $db = conectarDB();
    $id_cliente = $_SESSION['id'];

    //CONSULTAS PARA MOSTRAR EN PANTALLA
    if($_SESSION['id']){
        /*CONSULTA DE SELECCION DE PRODUCTOS*/
        $query = " SELECT pedido.id_cliente as id_cliente, productoxpedido.id_pedido as id_pedido, productoxpedido.id_producto as id_producto, producto.imagen as imagen, producto.nombre as nombre, producto.precio as precio, productoxpedido.cantidad as cantidad FROM productoxpedido INNER JOIN pedido ON  pedido.id = productoxpedido.id_pedido INNER JOIN producto ON producto.id = productoxpedido.id_producto  WHERE pedido.id_cliente = $id_cliente ";

        $resultado = mysqli_query($db, $query);
        $compra = mysqli_fetch_assoc($resultado);

        /*CONSULTA DEL TOTAL DE LOS PRODUCTOS*/
        $consultaTotal = " SELECT SUM(producto.precio * productoxpedido.cantidad) as subtotal, COUNT(productoxpedido.id_servicio) as cuentaProuctos FROM productoxpedido INNER JOIN pedido ON  pedido.id = productoxpedido.id_pedido INNER JOIN producto ON producto.id = productoxpedido.id_producto WHERE id_cliente = $id_cliente ";
        
        $resultadoSuma = mysqli_query($db, $consultaTotal);
        $suma = mysqli_fetch_assoc($resultadoSuma);
        $total = $suma['subtotal'] + ($suma['subtotal'] * 0.16);
        $total = round($total, 2); 
        $cuentaProductos = $suma['cuentaProuctos']-1;
    }

   /* var_dump($_POST);
    
    if( $_SERVER['REQUEST_METHOD'] === 'POST' ){
        $id_carrito = $_POST['id_carrrito'];
        $id_carrito = filter_var($id_carrito, FILTER_VALIDATE_INT);
        if($id_carrito){
            $eliminarCarrito = " DELETE FROM carritoProducto WHERE id_carrito = ${id_carrito} ";
            $resultadoElim = mysqli_query($db, $eliminarCarrito);
            if($resultadoElim){
                header('Location: /index.php');
            }
        }
    }*/

    require 'include/funciones.php';
    incluirTemplate('header');
?>

<main class="contenedor">
    <h1>Paga tu producto aquí</h1>
    <div class="carrito">
        <div class="carrito__producto">
            
            <a href="#">
                <img class="carrito__imagen" src="//localhost/biofert/imagenes/<?php echo $compra['imagen']; ?>" >
            </a>

            <?php
            echo $compra['imagen'];
            ?>
            
            <div class="carrito__info--compra">
                <a href="#">
                    <p class="carrito__info--nombre"><?php echo $compra['nombre']; ?></p>
                    <?php if($cuentaProductos > 1): ?>
                    <p class="carrito__info--nombre">y otros <?php echo $cuentaProductos; ?> articulos</p>
                    <?php endif; ?>
                    <?php if($cuentaProductos === 1): ?>
                    <p class="carrito__info--nombre">y otro artículo</p>
                    <?php endif; ?>
                </a>
            </div>

        </div>
        <div class="carrito__total">
            <h3 class="carrito__subtotal">Total: $<?php echo $total; ?> MXN</h3>
            <div id="smart-button-container">
                <div style="text-align: center;">
                    <div id="paypal-button-container"></div>
                </div>
            </div>
            <script src="https://www.paypal.com/sdk/js?client-id=sb&enable-funding=venmo&currency=MXN" data-sdk-integration-source="button-factory"></script>
            <script>
                function initPayPalButton() {
                paypal.Buttons({
                    style: {
                    shape: 'pill',
                    color: 'blue',
                    layout: 'horizontal',
                    label: 'pay',
                    
                    },

                    createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{"amount":{"currency_code":"MXN","value":<?php echo floatval($total); ?>}}]
                    });
                    },

                    onApprove: function(data, actions) {
                    return actions.order.capture().then(function(orderData) {
                        
                        // Full available details
                        console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

                        // Show a success message within this page, e.g.
                        const element = document.getElementById('paypal-button-container');
                        //element.innerHTML = '';
                        //element.innerHTML = 'actura.php';
                        // Or go to another URL:  actions.redirect('thank_you.html');



                        //INSERTAR FACTURA PHP
                        //actions.redirect('https://jojocomics.herokuapp.com/recibo.php');         
                        header('Location: /biofert/recibo.php');

                    });
                    },

                    onError: function(err) {
                    console.log(err);
                    }
                }).render('#paypal-button-container');
                }
                initPayPalButton();
            </script>
        </div>
    </div>
</main>

<?php
    incluirTemplate('footer');
?>