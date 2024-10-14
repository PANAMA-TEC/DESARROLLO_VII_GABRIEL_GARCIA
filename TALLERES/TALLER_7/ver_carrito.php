<?php
require 'config_sesion.php';

// Lista de productos
$productos = [
    1 => ['nombre' => 'Producto 1', 'precio' => 10.00],
    2 => ['nombre' => 'Producto 2', 'precio' => 20.00],
    3 => ['nombre' => 'Producto 3', 'precio' => 15.00],
    4 => ['nombre' => 'Producto 4', 'precio' => 30.00],
    5 => ['nombre' => 'Producto 5', 'precio' => 25.00],
];

$total = 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito</title>
</head>
<body>
    <h1>Tu Carrito</h1>
    <ul>
        <?php if (!empty($_SESSION['carrito'])): ?>
            <?php foreach ($_SESSION['carrito'] as $id => $cantidad): ?>
                <?php
                $total += $productos[$id]['precio'] * $cantidad;
                ?>
                <li>
                    <?= htmlspecialchars($productos[$id]['nombre']) ?> - Cantidad: <?= htmlspecialchars($cantidad) ?>
                    <a href="eliminar_del_carrito.php?id=<?= $id ?>">Eliminar</a>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>El carrito está vacío.</li>
        <?php endif; ?>
    </ul>
    <p>Total: $<?= htmlspecialchars($total) ?></p>
    <a href="checkout.php">Finalizar Compra</a>
    <a href="productos.php">Seguir Comprando</a>
</body>
</html>