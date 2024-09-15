<?php
    $paginaActual = 'index.php'; // Cambia esto según el archivo
    require_once 'includes/funciones.php';
   
    $tituloPagina ="Catalogo de Libros";
    include 'includes/header.php';

    
?>

<h2>Contenido de la Página de Inicio</h2>
<nav><ul>
    <label>Ordenas por: </label>
    <li><a href="./?titulo=true&autor=false&asc=false">titulo</a></li>
    <li><a href="./?titulo=false&autor=true&asc=false">autor</a></li>
    <li><a href="./?titulo=true&autor=false&asc=true">titulo asc</a></li>
    <li><a href="./?titulo=false&autor=true&asc=true">autor asc</a></li>
    
</ul></nav>

<div class='listadoLibros'>
    
    <?php 
        
        
        $libros = obtenerLibros();
        
        foreach( $libros as $key => $row ){
            $titulo[$key]  = $row['titulo'];
            $autor[$key] = $row['autor'];
        }


        array_multisort( 
            $_GET['autor'] ? $autor :  $_GET['titulo'] ? $titulo : $autor , 
            $_GET['asc'] ? SORT_ASC : SORT_DESC, $libros);
        mostrarDetalleLibros($libros);
    ?>
</div>

<?php
include 'includes/footer.php';
?>
    