<?php
require 'config_sesion.php';

// Validar ID del producto
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if (isset($_SESSION['carrito'][$id])) {
    unset($_SESSION['carrito'][$id]);
}

header('Location: ver_carrito.php');
exit();
?>
