<?php
require_once 'validaciones.php';
require_once 'sanitizacion.php';
require_once 'otrasFunciones.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errores = [];
    $datos = [];

    // Procesar y validar cada campo
    $campos = ['nombre', 'email', 'edad', 'sitio_web', 'born_date', 'genero', 'intereses', 'comentarios'];
    
    foreach ($campos as $campo) {
        
        if (isset($_POST[$campo])) {
            $valor = $_POST[$campo];
            $valorSanitizado = call_user_func("sanitizar" . ucfirst($campo), $valor);

            if ($campo == 'born_date'){
                echo "campo encontrado";
                $datos[$campo] = $valorSanitizado;
                $datos['edad'] = $valorSanitizado = call_user_func("sanitizar" . ucfirst('edad'), calcularEdad($datos[$campo]) );
            }else{

                $datos[$campo] = $valorSanitizado;
            }

            if (!call_user_func("validar" . ucfirst($campo), $valorSanitizado)) {
                $errores[] = "El campo $campo no es válido.";
            }
        }
    }

    // Procesar la foto de perfil
    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] !== UPLOAD_ERR_NO_FILE) {
        
        if(file_exists('./uploads/'.$_FILES['foto_perfil']['name'])){

            $_FILES['foto_perfil']['name'] =  cambiarNombreArchivo($_FILES['foto_perfil'], "FP_" . date('Ymd_His'));
                    
        }


        if (!validarFotoPerfil($_FILES['foto_perfil'])) {
            $errores[] = "La foto de perfil no es válida. comprueba el nombre del archivo, puede estar duplicado";
        } else {
            $rutaDestino = './uploads/' . basename($_FILES['foto_perfil']['name']);
            if (move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $rutaDestino)) {
                $datos['foto_perfil'] = $rutaDestino;
            } else {
                $errores[] = "Hubo un error al subir la foto de perfil.";
            }
        }
    }

    // Mostrar resultados o errores
    if (empty($errores)) {
        echo "<h2>Datos Recibidos:</h2>";
        foreach ($datos as $campo => $valor) {
            if ($campo === 'intereses') {
                echo "$campo: " . implode(", ", $valor) . "<br>";
            } elseif ($campo === 'foto_perfil') {
                echo "$campo: <img src='$valor' width='100'><br>";
            } else {
                echo "$campo: $valor<br>";
            }
        }
    } else {
        echo "<h2>Errores:</h2>";
        foreach ($errores as $error) {
            echo "$error<br>";
        }
    }
} else {
    echo "Acceso no permitido.";
}
?>