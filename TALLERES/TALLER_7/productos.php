<?php
require 'config_sesion.php';

// Lista de productos
$productos = [
    ['id' => 1, 'nombre' => 'Producto 1', 'precio' => 10.00],
    ['id' => 2, 'nombre' => 'Producto 2', 'precio' => 20.00],
    ['id' => 3, 'nombre' => 'Producto 3', 'precio' => 15.00],
    ['id' => 4, 'nombre' => 'Producto 4', 'precio' => 30.00],
    ['id' => 5, 'nombre' => 'Producto 5', 'precio' => 25.00],
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos</title>
</head>
<body>
    <h1>Lista de Productos</h1>
    <ul>
        <?php foreach ($productos as $producto): ?>
            <li>
                <?= htmlspecialchars($producto['nombre']) ?> - $<?= htmlspecialchars($producto['precio']) ?>
                <a href="agregar_al_carrito.php?id=<?= $producto['id'] ?>">Agregar al carrito</a>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="ver_carrito.php">Ver Carrito</a>
</body>
</html>
