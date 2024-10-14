<?php
    require 'config_sesion.php';

    if (!empty($_SESSION['carrito'])) {
        // Almacenar el nombre del usuario en una cookie
        setcookie('nombre_usuario', 'Usuario', time() + 86400, "/", "", true, true);

        // Vaciar el carrito
        $_SESSION['carrito'] = [];
        $mensaje = "Compra realizada con éxito.";
    } else {
        $mensaje = "El carrito está vacío.";
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
</head>
<body>
    <h1><?= htmlspecialchars($mensaje) ?></h1>
    <a href="productos.php">Volver a la tienda</a>
</body>
</html>
