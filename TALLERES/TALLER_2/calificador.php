<?php
    $calificacion = 100;
    $nota = 'A';
    
    if( $calificacion >= 90 && $calificacion <= 100 ) {
        $nota = 'A';
        echo "Tu calificacion es: $calificacion, tu nota es $nota ";

    }elseif( $calificacion >= 80 && $calificacion <= 89 ){
        $nota = 'B';
        echo "Tu calificacion es: $calificacion, tu nota es $nota ";
    }elseif( $calificacion >= 70 && $calificacion <= 79 ){
        $nota = 'C';
        echo "Tu calificacion es: $calificacion, tu nota es $nota ";
    }elseif( $calificacion >= 60 && $calificacion <= 69 ){
        $nota = 'D';
        echo "Tu calificacion es: $calificacion, tu nota es $nota ";
    }elseif( $calificacion >= 0 && $calificacion <= 59 ){
        $nota = 'F';
        echo "Tu calificacion es: $calificacion, tu nota es $nota ";
    }

    echo "<br>";
    echo $calificacion > 60 ? "Aprobado" : "Reprobado";
    echo "<br>";
    /**
     * 
     * A: "Excelente trabajo"
     *  B: "Buen trabajo"
     *   C: "Trabajo aceptable"
     *  D: "Necesitas mejorar"
     * F: "Debes esforzarte más"
     */

     switch ($nota) {
        
        case 'A':
            echo"Excelente trabajo";
            break;
        case 'B':
            echo"Buen trabajo";
            break;
        case 'C':
            echo "Trabajo aceptable";
            break;
        case 'D':
            echo "Necesitas mejorar";
            break;
        case 'F':
            echo "Debes esforzarte más";
            break;
        default:
            echo "nota no válido.<br>";
    }




    
?>