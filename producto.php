<?php 
    require 'include/funciones.php';
    incluirTemplate('header', 2);
?>  

<body>
    

    <main class="contenedor">
        <h1>Biofert Plus </h1>
        
        <div class="producto__diseño">
            <div class="producto" style="display:inline-block;vertical-align:top;">
                    
                    <img class="producto__imagen" src="img/biofert_plus.png" alt="imagen Biofert"  />
                    
            </div>
        
            <div class="producto__informacion" style="display:inline-block;vertical-align:top;padding: 3.5rem;" >
                
                <p class="Visualizacion__descripcion" > 
                Biofert Plus. Es un producto natural a base de excreta de Bovino procesado en un reactor para lograr fermentación en cuatro dases,
                al que se le agrega en cada fase componentes orgánicos que aumentan su efectividad al aplicarlo en el suelo creando un Universo 
                microbiano benéfico al los cultivos. <br>
                Biofer Plis Contiene: Fitohormonas que estimulan y vitalizan la germinación de semillas así como la formación del sistema radicular 
                y tallos, floración, crecimientos, defensas y fruto.    
                </p>

                <input class="formulario__submit" type="submit" value="Agregar al Carrito">
                
            </div>
        </div>
    
    </main>

    <?php 
        incluirTemplate('footer');
    ?>