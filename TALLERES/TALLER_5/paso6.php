<?php
// 1. Crear un arreglo multidimensional de ventas por región y producto
$ventas = [
    "Norte" => [
        "Producto A" => [100, 120, 140, 110, 130],
        "Producto B" => [85, 95, 105, 90, 100],
        "Producto C" => [60, 55, 65, 70, 75]
    ],
    "Sur" => [
        "Producto A" => [80, 90, 100, 85, 95],
        "Producto B" => [120, 110, 115, 125, 130],
        "Producto C" => [70, 75, 80, 65, 60]
    ],
    "Este" => [
        "Producto A" => [110, 115, 120, 105, 125],
        "Producto B" => [95, 100, 90, 105, 110],
        "Producto C" => [50, 60, 55, 65, 70]
    ],
    "Oeste" => [
        "Producto A" => [90, 85, 95, 100, 105],
        "Producto B" => [105, 110, 100, 115, 120],
        "Producto C" => [80, 85, 75, 70, 90]
    ]
];

// 2. Función para calcular el promedio de ventas
function promedioVentas($ventas) {
    return array_sum($ventas) / count($ventas);
}

// 3. Calcular y mostrar el promedio de ventas por región y producto
echo "Promedio de ventas por región y producto:\n";
foreach ($ventas as $region => $productos) {
    echo "$region:\n";
    foreach ($productos as $producto => $ventasProducto) {
        $promedio = promedioVentas($ventasProducto);
        echo "  $producto: " . number_format($promedio, 2) . "\n";
    }
    echo "\n";
}

// 4. Función para encontrar el producto más vendido en una región
function productoMasVendido($productos) {
    $maxVentas = 0;
    $productoTop = '';
    foreach ($productos as $producto => $ventas) {
        $totalVentas = array_sum($ventas);
        if ($totalVentas > $maxVentas) {
            $maxVentas = $totalVentas;
            $productoTop = $producto;
        }
    }
    return [$productoTop, $maxVentas];
}

// 5. Encontrar y mostrar el producto más vendido por región
echo "Producto más vendido por región:\n";
foreach ($ventas as $region => $productos) {
    [$productoTop, $ventasTop] = productoMasVendido($productos);
    echo "$region: $productoTop (Total: $ventasTop)\n";
}

// 6. Calcular las ventas totales por producto
$ventasTotalesPorProducto = [];
foreach ($ventas as $region => $productos) {
    foreach ($productos as $producto => $ventasProducto) {
        if (!isset($ventasTotalesPorProducto[$producto])) {
            $ventasTotalesPorProducto[$producto] = 0;
        }
        $ventasTotalesPorProducto[$producto] += array_sum($ventasProducto);
    }
}

echo "\nVentas totales por producto:\n";
arsort($ventasTotalesPorProducto);
foreach ($ventasTotalesPorProducto as $producto => $total) {
    echo "$producto: $total\n";
}

// 7. Encontrar la región con mayores ventas totales
$ventasTotalesPorRegion = array_map(function($productos) {
    return array_sum(array_map('array_sum', $productos));
}, $ventas);

$regionTopVentas = array_keys($ventasTotalesPorRegion, max($ventasTotalesPorRegion))[0];
echo "\nRegión con mayores ventas totales: $regionTopVentas\n";

// TAREA: Implementa una función que analice el crecimiento de ventas
// Calcula y muestra el porcentaje de crecimiento de ventas del primer al último mes
// para cada producto en cada región. Identifica el producto y la región con mayor crecimiento.
// Tu código aquí

$informe_crecimiento = [
    "region_x" => [
        "producto_x" => "%",
        "producto_xn" => "%"
    ],
    "region_xn" => [
        "producto_x" => "%",
        "producto_xn" => "%"
    ],

];

/***
 * 
 * 2. Calcular el crecimiento de las ventas
 * Para esto se necesita ver el primer dia del mes y el ultimo con el objetivo de sacar un % de crecimiento.
 * 
 * 
 */

// Obtener el ultimo valor del arreglo
// echo end($datos_ventas['Region_1']['Producto_A']);
// Obtener el primer valor del arreglo
// echo  reset($datos_ventas['Region_1']['Producto_A']);
echo "<br><br> Pruebas personales: ";

function preparar_informe_crecimiento ($my_data) {
    $array_salida = [

    ];
    foreach ($my_data as $nombre_region => $nombre_producto) {
        foreach ($nombre_producto as $nombre_producto => $valores_registrados) {
            $sumatoria_ventas_x_producto = 0;
            $valor_anterior = 0;
            foreach ($valores_registrados as $value) {
                
               
                if( !isset( $array_salida[$nombre_region]) ){
                    $array_salida[$nombre_region] = [];
                    // print_r($array_salida);
                }
        
                if( !isset( $array_salida[$nombre_region][$nombre_producto]) ){
                   
                    $array_salida[$nombre_region][$nombre_producto] = [];
    
                    
                }
                
                $my_value = 0;
                if( $valor_anterior != 0){
                    $my_value = (($value - $valor_anterior ) / $valor_anterior) * 100;
                    
    
                } else {
                    $my_value = 0;
                }
    
                array_push($array_salida[$nombre_region][$nombre_producto], [
                   number_format($my_value,2)
                ]);
    
                $valor_anterior = $value;
                
            }
        }
    }

    return $array_salida;

}


function printSalesTable($data) {
    echo '<table border="1">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Región</th>';
    echo '<th>Producto</th>';
    echo '<th>Mes 1</th>';
    echo '<th>Mes 2</th>';
    echo '<th>Mes 3</th>';
    echo '<th>Mes 4</th>';
    echo '<th>Mes 5</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    foreach ($data as $region => $products) {
        foreach ($products as $product => $sales) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($region) . '</td>';
            echo '<td>' . htmlspecialchars($product) . '</td>';
            
            foreach ($sales as $monthSales) {
                foreach ($monthSales as $monthValue) {
                    echo '<td>' . htmlspecialchars($monthValue) . '</td>';
                }
            }
            
            echo '</tr>';
        }
    }

    echo '</tbody>';
    echo '</table>';
}

printSalesTable(preparar_informe_crecimiento($ventas));
//print_r($informe_crecimiento);




?>
      