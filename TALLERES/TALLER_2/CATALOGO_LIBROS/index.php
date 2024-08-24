<?php
    $paginaActual = 'index.php'; // Cambia esto según el archivo
    require_once 'includes/funciones.php';
   
    $tituloPagina ="Catalogo de Libros";
    include 'includes/header.php';

    
?>

<h2>Contenido de la Página de Inicio</h2>
<div class='listadoLibros'>
    <?php 
        $libros = obtenerLibros();
        mostrarDetalleLibros($libros);
    ?>
</div>

<?php
include 'includes/footer.php';
?>
    