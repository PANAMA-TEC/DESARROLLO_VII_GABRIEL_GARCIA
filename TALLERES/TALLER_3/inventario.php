<?php

    require_once 'fn_inventario.php';

    $archivo_json = 'inventario.json';

    // Leer el inventario desde el archivo JSON
    $inventario = leer_inventario($archivo_json);

    // Ordenar el inventario alfabéticamente por nombre del producto
    ordenar_inventario_por_nombre($inventario);

    // Mostrar un resumen del inventario ordenado
    mostrar_resumen_inventario($inventario);

    // Calcular el valor total del inventario
    $valor_total = calcular_valor_total($inventario);
    echo "\nValor total del inventario: $" . number_format($valor_total, 2) . "\n";

    // Generar un informe de productos con stock bajo
    generar_informe_stock_bajo($inventario);

?>
