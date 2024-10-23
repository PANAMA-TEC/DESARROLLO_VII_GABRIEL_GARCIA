<?php
    session_start();
    // Destruir todas las variables de sesión
    $_SESSION = array();
    // Destruir la sesión
    session_destroy();


    header("Location: index.php");
    exit();

?>