<?php 
    function obtenerLibros(){
        $listado_libros = [
            [
                'titulo' => 'Cien años de soledad',
                'autor' => 'Gabriel García Márquez',
                'anio_publicacion' => 1967,
                'genero' => 'Novela',
                'descripcion' => 'La historia épica de la familia Buendía en el mítico pueblo de Macondo.'
            ],
            [
                'titulo' => '1984',
                'autor' => 'George Orwell',
                'anio_publicacion' => 1949,
                'genero' => 'Distopía',
                'descripcion' => 'Una crítica al totalitarismo a través de un futuro distópico donde el Gran Hermano lo controla todo.'
            ],
            [
                'titulo' => 'La Odisea',
                'autor' => 'Homero',
                'anio_publicacion' => -800,
                'genero' => 'Épica',
                'descripcion' => 'La historia de las aventuras de Odiseo en su regreso a Ítaca tras la guerra de Troya.'
            ],
            [
                'titulo' => 'Crimen y castigo',
                'autor' => 'Fiódor Dostoyevski',
                'anio_publicacion' => 1866,
                'genero' => 'Novela psicológica',
                'descripcion' => 'La historia de Raskólnikov, un joven que lucha con la culpa después de cometer un asesinato.'
            ]
        ];
        
    
        return $listado_libros; 
    }

    function obtenerTituloPagina($pagina) {
        $titulos = [
            'index.php' => 'Página de Inicio',
            'sobre_nosotros' => 'Sobre Nosotros',
            'contacto' => 'Contáctanos'
        ];
        return isset($titulos[$pagina]) ? $titulos[$pagina] : 'Página Desconocida';
    }

    function mostrarDetalleLibros($listado) {

        foreach($listado as $libros ){
            echo "<div class='Libro'>";
            echo "<div class='tituloLibro'> ".$libros['titulo'] ."</div>";
            echo "<div class='autor'> ".$libros['autor'] ."</div>";
            echo "<div class='tituloLibro'> ".$libros['anio_publicacion'] ."</div>";
            echo "<div class='tituloLibro'> ".$libros['genero'] ."</div>";
            echo "<div class='tituloLibro'> ".$libros['descripcion'] ."</div>";
            echo "</div>";
            
        }

    }



?>