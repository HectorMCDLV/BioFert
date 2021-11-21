<?php 
    require 'include/funciones.php';
    incluirTemplate('header', 2);
?>  

<body>
    

    <main class="contenedor">
        <h1>Nuestros Productos</h1>
        <div class="grid">
            <div class="producto">
                <a href="producto.php">
                    <img class="producto__imagen" src="img/biofert_plus.png" alt="imagen Biofert">
                    <div class="producto__informacion">
                        <p class="producto__nombre">Biofert Plus</p>
                        <p class="producto__precio">$25</p>
                    </div>
                </a>
            </div>
            <div class="producto">
                <a href="producto.php">
                    <img class="producto__imagen" src="img/biofert_plus_gel.png" alt="imagen biofert_plus_gel">
                    <div class="producto__informacion">
                        <p class="producto__nombre">Biofert Plus Gel</p>
                        <p class="producto__precio">$25</p>
                    </div>
                </a>
            </div>
            <div class="producto">
                <a href="producto.php">
                    <img class="producto__imagen" src="img/biofert_1.jfif" alt="imagen Secuestrante Sodio">
                    <div class="producto__informacion">
                        <p class="producto__nombre">Secuestrante de Sodio Biofert OB</p>
                        <p class="producto__precio">$25</p>
                    </div>
                </a>
            </div>
            <div class="producto">
                <a href="producto.php">
                    <img class="producto__imagen" src="img/biofert_2.jfif" alt="Biofert Inicio">
                    <div class="producto__informacion">
                        <p class="producto__nombre">Biofert Inicio</p>
                        <p class="producto__precio">$25</p>
                    </div>
                </a>
            </div>
            <div class="producto">
                <a href="producto.php">
                    <img class="producto__imagen" src="img/biofert_3.jfif" alt="Biofert Llenado">
                    <div class="producto__informacion">
                        <p class="producto__nombre">Biofert Llenado</p>
                        <p class="producto__precio">$25</p>
                    </div>
                </a>
            </div>
        </div>
        
    </main>

    <?php 
        incluirTemplate('footer');
    ?>