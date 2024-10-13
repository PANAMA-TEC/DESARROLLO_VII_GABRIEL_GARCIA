<?php
    function calcularEdad($fechaNacimiento) {
        // Convertir la fecha de nacimiento a un objeto DateTime
        $fechaNac = new DateTime($fechaNacimiento);
        $hoy = new DateTime(); // Fecha actual

        // Calcular la diferencia
        $edad = $hoy->diff($fechaNac);

        return $edad->y; // Retorna solo los años
    }
?>