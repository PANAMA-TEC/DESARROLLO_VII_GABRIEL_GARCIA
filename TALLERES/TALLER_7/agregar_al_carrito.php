<?php
    require 'config_sesion.php';

    // Validar ID del producto  
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    if ($id) {
        // Incrementar la cantidad del producto en el carrito
        if (isset($_SESSION['carrito'][$id])) {
            $_SESSION['carrito'][$id]++;
        } else {
            $_SESSION['carrito'][$id] = 1;
        }
    }

    header('Location: productos.php');
    exit();
?>