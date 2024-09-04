<?php

include 'funciones_tienda.php';

$productos = [
    'camisa' => 50,
    'pantalon' => 70,
    'zapatos' => 80,
    'calcetines' => 10,
    'gorra' => 25
];

$carrito = [
    'camisa' => 2,
    'pantalon' => 1,
    'zapatos' => 1,
    'calcetines' => 3,
    'gorra' => 0
];

$subtotal = 0;

foreach ($carrito as $producto => $cantidad) {
    if ($cantidad > 0) {
        $subtotal += $productos[$producto] * $cantidad;
    }
}


$descuento = calcular_descuento($subtotal);
$impuesto = aplicar_impuesto($subtotal);
$total = calcular_total($subtotal, $descuento, $impuesto);


?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen de Compra</title>
</head>
<style>
    td {
        padding:20px;
        border-style:solid;
    }

    .resumen_general {
        border-style:solid;
        padding: 40px;
        
    }
    .contenido_web {
        display:flex;
        flex-direction:column;
        gap:20px;
    }
    .text-center {
        text-align:center;
    }

</style>
<body>
    <h1>Resumen de Compra</h1>
    <div class="contenido_web">
        <table>
            <tr>
                <td>Producto</th>
                <td class='text-center'>Cantidad</th>
                <td class='text-center'>Precio Unitario</th>
                <td class='text-center'>Precio Total</th>
            </tr>
            
            <?php foreach ($carrito as $producto => $cantidad): ?>
                <?php if ($cantidad > 0): ?>
                    <tr>
                        <td><?php echo $producto; ?></td>
                        <td class='text-center'><?php echo $cantidad; ?></td>
                        <td class='text-center'><?php echo '$' . number_format($productos[$producto], 2); ?></td>
                        <td class='text-center'><?php echo '$' . number_format($productos[$producto] * $cantidad, 2); ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
            
            
        </table>
        
        

        <div class='resumen_general'> 
            <p><strong>Subtotal:</strong> $<?php echo number_format($subtotal, 2); ?></p>
            <p><strong>Descuento aplicado:</strong> $<?php echo number_format($descuento, 2); ?></p>
            <p><strong>Impuesto (7%):</strong> $<?php echo number_format($impuesto, 2); ?></p>
            <p><strong>Total a pagar:</strong> $<?php echo number_format($total, 2); ?></p>
        </div>
    </div>
</body>
</html>
