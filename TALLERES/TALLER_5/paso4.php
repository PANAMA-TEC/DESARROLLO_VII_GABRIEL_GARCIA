<?php
// Paso 4: Ordenamiento y Filtrado Avanzado de Arreglos

// 1. Definir el arreglo de libros
$biblioteca = [
    [
        "titulo" => "Cien años de soledad",
        "autor" => "Gabriel García Márquez",
        "año" => 1967,
        "genero" => "Realismo mágico",
        "prestado" => true
    ],
    [
        "titulo" => "1984",
        "autor" => "George Orwell",
        "año" => 1949,
        "genero" => "Ciencia ficción",
        "prestado" => false
    ],
    [
        "titulo" => "El principito",
        "autor" => "Antoine de Saint-Exupéry",
        "año" => 1943,
        "genero" => "Literatura infantil",
        "prestado" => true
    ],
    [
        "titulo" => "Don Quijote de la Mancha",
        "autor" => "Miguel de Cervantes",
        "año" => 1605,
        "genero" => "Novela",
        "prestado" => false
    ],
    [
        "titulo" => "Orgullo y prejuicio",
        "autor" => "Jane Austen",
        "año" => 1813,
        "genero" => "Novela romántica",
        "prestado" => true
    ],
    
];

// 2. Función para imprimir la biblioteca
function imprimirBiblioteca($libros) {
    foreach ($libros as $libro) {
        echo "{$libro['titulo']} - {$libro['autor']} ({$libro['año']}) - {$libro['genero']} - " . 
             ($libro['prestado'] ? "Prestado" : "Disponible") . "\n";
    }
    echo "\n";
}

echo "Biblioteca original:\n";
imprimirBiblioteca($biblioteca);

// 3. Ordenar libros por año de publicación (del más antiguo al más reciente)
usort($biblioteca, function($a, $b) {
    return $a['año'] - $b['año'];
});

echo "Libros ordenados por año de publicación:\n";
imprimirBiblioteca($biblioteca);

// 4. Ordenar libros alfabéticamente por título
usort($biblioteca, function($a, $b) {
    return strcmp($a['titulo'], $b['titulo']);
});

echo "Libros ordenados alfabéticamente por título:\n";
imprimirBiblioteca($biblioteca);

// 5. Filtrar libros disponibles (no prestados)
$librosDisponibles = array_filter($biblioteca, function($libro) {
    return !$libro['prestado'];
});

echo "Libros disponibles:\n";
imprimirBiblioteca($librosDisponibles);

// 6. Filtrar libros por género
function filtrarPorGenero($libros, $genero) {
    return array_filter($libros, function($libro) use ($genero) {
        return strcasecmp($libro['genero'], $genero) === 0;
    });
}

$librosCienciaFiccion = filtrarPorGenero($biblioteca, "Ciencia ficción");
echo "Libros de Ciencia ficción:\n";
imprimirBiblioteca($librosCienciaFiccion);

// 7. Obtener lista de autores únicos
$autores = array_unique(array_column($biblioteca, 'autor'));
sort($autores);

echo "Lista de autores:\n";
foreach ($autores as $autor) {
    echo "- $autor\n";
}
echo "\n";

// 8. Calcular el año promedio de publicación
$añoPromedio = array_sum(array_column($biblioteca, 'año')) / count($biblioteca);
echo "Año promedio de publicación: " . round($añoPromedio, 2) . "\n\n";

// 9. Encontrar el libro más antiguo y el más reciente
$libroMasAntiguo = array_reduce($biblioteca, function($carry, $libro) {
    return (!$carry || $libro['año'] < $carry['año']) ? $libro : $carry;
});

$libroMasReciente = array_reduce($biblioteca, function($carry, $libro) {
    return (!$carry || $libro['año'] > $carry['año']) ? $libro : $carry;
});

echo "Libro más antiguo: {$libroMasAntiguo['titulo']} ({$libroMasAntiguo['año']})\n";
echo "Libro más reciente: {$libroMasReciente['titulo']} ({$libroMasReciente['año']})\n\n";

// 10. TAREA: Implementa una función de búsqueda que permita buscar libros por título o autor
// La función debe ser capaz de manejar búsquedas parciales y no debe ser sensible a mayúsculas/minúsculas
function buscarLibros($biblioteca, $termino) {
    $termino = strtolower($termino); // Convertir término de búsqueda a minúsculas
    $resultados = [];
    
    foreach ($biblioteca as $libro) {
        // Convertir título y autor a minúsculas para la comparación
        $titulo = strtolower($libro['titulo']);
        $autor = strtolower($libro['autor']);
        
        // Verificar si el término de búsqueda está en el título o autor
        // esta es la manera mas simplificada de hacer lo solicitado.

        if (strpos($titulo, $termino) !== false || strpos($autor, $termino) !== false) {
            array_push($resultados, $libro);
        }
    }
    
    return $resultados;
}

// Ejemplo de uso de la función de búsqueda
$termino_busqueda = "cien";
$resultadosBusqueda = buscarLibros($biblioteca, $termino_busqueda);
echo "<br><br>Resultados de búsqueda para ". $termino_busqueda .":\n";
imprimirBiblioteca($resultadosBusqueda);

// 11. TAREA: Crea una función que genere un reporte de la biblioteca
// El reporte debe incluir: número total de libros, número de libros prestados,
// número de libros por género, y el autor con más libros en la biblioteca
function generarReporteBiblioteca($biblioteca) {
    // Número total de libros
    $totalLibros = count($biblioteca);

    // Número de libros prestados
    $librosPrestados = [];

    foreach ($biblioteca as $libro) {
        if ($libro['prestado']) {
            array_push($librosPrestados, $libro);
        }
    }

    $totalPrestados = count($librosPrestados);

    // Número de libros por género
    $generos = array_column($biblioteca, 'genero');
    // echo "<br><br> generos en la biblioteca: ";
    // print_r($generos);
    $conteoGeneros = array_count_values($generos);

    // Autor con más libros en la biblioteca
    $autores = array_column($biblioteca, 'autor');



    $conteoAutores = array_count_values($autores);
    arsort($conteoAutores); // Ordenar en orden descendente



    $autorMasLibros = key($conteoAutores);

    // Crear el reporte
    $reporte = [
        'total_libros' => $totalLibros, //ok
        'total_prestados' => $totalPrestados, //ok
        'libros_por_genero' => $conteoGeneros, //ok
        'autor_con_mas_libros' => $autorMasLibros
    ];

    return $reporte;
}



//Ejemplo de uso de la función de reporte (descomenta para probar)
echo "<br><br>Reporte de la Biblioteca:\n";
print_r(generarReporteBiblioteca($biblioteca));

?>