<?php

    $login_server = [
        "usuario_1" => ["gabrielP","Profesor","123456"],
        "usuario_2" => ["gabrielE","Estudiante","123456"]
    ];

    $login_rols = ["Profesor", "Estudiante"];
    $existeUsuario = false;
    $rolUsuaraio = "";

    function validaUsuario ( $nombre) {
        return !empty($nombre) && strlen($nombre) <= 50;
    }

    function validarPassword ( $password ){
        return strlen($password) > 5 ;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST['usuario']) && isset($_POST['contrasena'])) {
            
            foreach ($login_server as $usuarios) {
                
                if( $_POST['usuario'] == $usuarios[0] && $_POST['contrasena'] == $usuarios[2] ){
                    $existeUsuario = true;
                    $rolUsuaraio = $usuarios[1];
                }
                


            } 


           
        }
    
    }

    if($existeUsuario) {
        session_start();
        $_SESSION['usuario'] = $_POST['usuario'];
        $_SESSION['rol'] = $rolUsuaraio;

        
    }

    if (isset($_SESSION['rol'])) {

        if($_SESSION['rol'] == "Estudiante"){
            
            header("Location: estudiante.php");
    
        }

        if($_SESSION['rol'] == "Profesor"){
            header("Location: profesor.php");
    
        }
    }


?>

