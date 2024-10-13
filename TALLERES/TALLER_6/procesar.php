<?php
require_once 'validaciones.php';
require_once 'sanitizacion.php';
require_once 'otrasFunciones.php';

class JsonStorage {
        
    private $filePath;

    public function __construct($filePath) {
        $this->filePath = $filePath;
        // Asegurarse de que el archivo JSON exista
        if (!file_exists($this->filePath)) {
            file_put_contents($this->filePath, json_encode([]));
        }
    }

    // Agregar un nuevo campo
    public function addField($key, $value) {
        $data = $this->readData();
        $data[$key] = $value;
        $this->writeData($data);
    }

    // Eliminar un campo
    public function deleteField($key) {
        $data = $this->readData();
        if (isset($data[$key])) {
            unset($data[$key]);
            $this->writeData($data);
        }
    }

    // Actualizar un campo
    public function updateField($key, $value) {
        $data = $this->readData();
        if (isset($data[$key])) {
            $data[$key] = $value;
            $this->writeData($data);
            return true;
        }

        return false;
    }

    // Leer los datos del archivo
    private function readData() {
        $jsonData = file_get_contents($this->filePath);
        return json_decode($jsonData, true);
    }

    // Escribir datos en el archivo
    private function writeData($data) {
        file_put_contents($this->filePath, json_encode($data, JSON_PRETTY_PRINT));
    }

    // Mostrar todos los datos
    public function getAllFields() {
        return $this->readData();
    }
}


$jsonST = new JsonStorage('./data.json');
$myData = $jsonST->getAllFields();


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

    // Persistencia de datos 
    array_push($myData['data'],  $datos);

    if( !$jsonST-> updateField('data', $myData['data'])) {
        $jsonST-> addField('data',  $myData['data']);
        $myData = $jsonST->getAllFields();

        echo "datos agregados";
    }

    
    // Procesar la foto de perfil
    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] !== UPLOAD_ERR_NO_FILE) {
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