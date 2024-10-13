<?php
    function calcularEdad($fechaNacimiento) {
        // Convertir la fecha de nacimiento a un objeto DateTime
        $fechaNac = new DateTime($fechaNacimiento);
        $hoy = new DateTime(); // Fecha actual

        // Calcular la diferencia
        $edad = $hoy->diff($fechaNac);

        return $edad->y; // Retorna solo los años
    }

    function cambiarNombreArchivo($archivo, $nuevoNombre) {
        // Obtener la extensión del archivo original
        $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
    
        // Generar el nuevo nombre con la misma extensión
        $nuevoNombreCompleto = $nuevoNombre . '.' . $extension;
    
        // Retornar el nuevo nombre completo
        return $nuevoNombreCompleto;
    }
?>