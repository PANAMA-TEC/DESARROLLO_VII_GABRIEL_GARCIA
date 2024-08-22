
<?php
    // Definición de variables
    $nombre = "Gabriel Axel Garcia H";
    $edad = 30;
    $correo = "gagarcia@panama-tec.com";
    $telefono = "+50766705157";

    // Definición de constante
    define("OCUPACION", "Estudiante");

    // Creación de mensaje usando diferentes métodos de concatenación e impresión
    $mensaje1 = "Hola, mi nombre es " . $nombre . " y tengo " . $edad . " años.";
    $mensaje2 = "mi correo es $correo y soy " . OCUPACION . ".";

    echo $mensaje1 . "<br>";
    print($mensaje2 . "<br>");
    printf("En resumen: %s, %d años, %s, %s<br>", $nombre, $edad, $correo, OCUPACION);

    echo "<br>Información de debugging:<br>";
    var_dump($nombre);
    echo "<br>";
    var_dump($edad);
    echo "<br>";
    var_dump($correo);
    echo "<br>";
    var_dump(OCUPACION);
    echo "<br>";
?>