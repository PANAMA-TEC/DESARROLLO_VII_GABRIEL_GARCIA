<?php
    require_once "procesar.php";

    $jsonST_FRONT = new JsonStorage('./data.json');
    $myData = $jsonST_FRONT->getAllFields();
    print_r( $myData['data'][array_key_last($myData['data'])]);


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro Avanzado</title>
</head>
<body>
    <h2>Formulario de Registro Avanzado</h2>
    <form action="procesar.php" method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <!-- <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" required><br><br> -->

        <label for="sitio_web">Sitio Web:</label>
        <input type="url" id="sitio_web" name="sitio_web"><br><br>

        <label for="born_date">Fecha de nacimiento:</label>
        <input type="date" id="born_date" name="born_date"><br><br>

        <label for="genero">Género:</label>
        <select id="genero" name="genero">
            <option value="masculino">Masculino</option>
            <option value="femenino">Femenino</option>
            <option value="otro">Otro</option>
        </select><br><br>

        <label>Intereses:</label><br>
        <input type="checkbox" id="deportes" name="intereses[]" value="deportes">
        <label for="deportes">Deportes</label><br>
        <input type="checkbox" id="musica" name="intereses[]" value="musica">
        <label for="musica">Música</label><br>
        <input type="checkbox" id="lectura" name="intereses[]" value="lectura">
        <label for="lectura">Lectura</label><br><br>

        <label for="comentarios">Comentarios:</label><br>
        <textarea id="comentarios" name="comentarios" rows="4" cols="50"></textarea><br><br>

        <label for="foto_perfil">Foto de Perfil:</label>
        <input type="file" id="foto_perfil" name="foto_perfil"><br><br>

        <input type="submit" value="Enviar">
        <input type="reset" value="Limpiar">
    </form>
</body>
</html>