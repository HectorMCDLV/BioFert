<?php 
    require 'include/funciones.php';
    incluirTemplate('header', 2);
?>  

<body>
    

    <main class="contenedor">
        <h1>Nuestros Productos</h1>
        <?php incluirTemplate('producto'); ?>        
    </main>

    <?php 
        incluirTemplate('footer');
    ?>