<?php

    // Leer el inventario desde el archivo JSON y convertirlo en un array de productos
    function leer_inventario($archivo_json) {
        $contenido = file_get_contents($archivo_json);
        return json_decode($contenido, true);
    }

    // Ordenar el inventario alfabéticamente por nombre del producto
    function ordenar_inventario_por_nombre(&$inventario) {
        usort($inventario, function($a, $b) {
            return strcmp($a['nombre'], $b['nombre']);
        });
    }

    // Mostrar un resumen del inventario ordenado (nombre, precio, cantidad)
    function mostrar_resumen_inventario($inventario) {
        echo str_repeat("-", 40) . "<br>";
        echo "Resumen del Inventario:<br>";
        echo str_repeat("-", 40) . "<br>";
        
        echo "<table>";
            echo "<tr>";
                echo "<td>";
                    echo str_pad("Producto", 20);
                echo "</td>"; 
                echo "<td>";
                    echo str_pad("Precio", 10);
                echo "</td>";
                echo "<td>";
                    echo "Cantidad";
                echo "</td>";
            echo "</tr>";
    
        
        
        foreach ($inventario as $producto) {
            echo "<tr>";
                echo "<td>";
                    echo str_pad($producto['nombre'], 20); 
                echo "</td>";

                echo "<td>";
                    echo str_pad($producto['precio'], 10);
                echo "</td>";

                echo "<td>";
                    echo $producto['cantidad']; 
                echo "</td>";
            echo "</tr>";  
        }
        echo "</table>";

        echo str_repeat("-", 40) . "<br>";
    }

    // Calcular el valor total del inventario
    function calcular_valor_total($inventario) {
        $valor_total = array_sum(array_map(function($producto) {
            return $producto['precio'] * $producto['cantidad'];
        }, $inventario));
        return $valor_total;
    }

    // Generar un informe de productos con stock bajo (menos de 5 unidades)
    function generar_informe_stock_bajo($inventario) {
        $productos_bajo_stock = array_filter($inventario, function($producto) {
            return $producto['cantidad'] < 5;
        });

        if (count($productos_bajo_stock) > 0) {
            echo "<br>Productos con stock bajo (menos de 5 unidades):<br>";
            echo str_pad("Producto", 20) . str_pad("Precio", 10) . "Cantidad<br>";
            echo str_repeat("-", 40) . "<br>";

            foreach ($productos_bajo_stock as $producto) {
                echo str_pad($producto['nombre'], 20) . str_pad($producto['precio'], 10) . $producto['cantidad'] . "<br>";
            }
        } else {
            echo "<br>No hay productos con stock bajo.<br>";
        }
    }

?>
