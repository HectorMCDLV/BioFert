<?php 
    
    require 'include/funciones.php';
    incluirTemplate('header');
    
?>   
    <div class="slider">
        <div class="glide">
            <div class="glide__track" data-glide-el="track">
                <ul class="glide__slides">
                    <li class="glide__slide"><a href="//localhost/biofert/productos.php"><img class = "slider__img" src="//localhost/biofert/img/slider/slider1.jpg" alt="bn"></a></li>
                    <li class="glide__slide"><a href="//localhost/biofert/productos.php"><img class = "slider__img" src="//localhost/biofert/img/slider/slider2.jpg" alt="bn"></a></li>
                    <li class="glide__slide"> <a href="//localhost/biofert/productos.php"><img class = "slider__img" src="//localhost/biofert/img/slider/slider3.jpg" alt="bn"></a></li>
                </ul>
            </div>
            <div class="glide__bullets" data-glide-el="controls[nav]">
                <button class="glide__bullet" data-glide-dir="=0"></button>
                <button class="glide__bullet" data-glide-dir="=1"></button>
                <button class="glide__bullet" data-glide-dir="=2"></button>
            </div>
        </div>
    </div>  

    <main class="contenedor">
        <h1>Biofert</h1>

    <div class="contenedor con-sidebar">
        <article class="articulos_index" >
            <h1>Efecto de la Salinidad en los Cultivos</h1>
            <img class = "img_contacto" src="img/resultado_sodio.jpg">

            <p>El principal efecto es de tipo osmótico, la alta concentración de sales en el suelo hace que el cultivo tenga que hacer un consumo extra de energía para poder absorber el agua y los nutrientes del suelo, como consecuencias de este estrés
                el cultivo reduce su desarrollo vegetativo ya que se inhibe el crecimiento y la division celular y, por consiguiente, disminuye la produccion.
            </p>

            <p>El efecto de una elevada sodicidad es la rotura de la estructura física del suelo, llegado a sellarse los poros por donde se mueve la solución con todos los nutrientees. Esto conlleva una falta de aireación, un encharcamineto e incluso un
                colapso del suelo.
            </p>
            
        </article>
        <aside>
            <h2>Sodio en el Suelo</h2>
            <p>Este estrés salino reduce la actividad fotosintética y aumenta la necesidad de respiración de la planta con la que consume la energía necesaria para la absorción. Debido a este consumo extra de energía afecta el desarrollo normal, la germinación
                y la brotación es más débil, lo que hace que el potencial productivo disminuya.
            </p>
        </aside>
    </div>
        
    </main>

    <?php 
        incluirTemplate('footer');
    ?>