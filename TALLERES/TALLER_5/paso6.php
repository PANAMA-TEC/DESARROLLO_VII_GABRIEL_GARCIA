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
//echo "Promedio de ventas por región y producto:\n";
foreach ($ventas as $region => $productos) {
    //echo "$region:\n";
    foreach ($productos as $producto => $ventasProducto) {
        $promedio = promedioVentas($ventasProducto);
        //echo "  $producto: " . number_format($promedio, 2) . "\n";
    }
    //echo "\n";
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
//echo "Producto más vendido por región:\n";
foreach ($ventas as $region => $productos) {
    [$productoTop, $ventasTop] = productoMasVendido($productos);
    //echo "$region: $productoTop (Total: $ventasTop)\n";
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

////echo "\nVentas totales por producto:\n";
arsort($ventasTotalesPorProducto);
foreach ($ventasTotalesPorProducto as $producto => $total) {
    //echo "$producto: $total\n";
}

// 7. Encontrar la región con mayores ventas totales
$ventasTotalesPorRegion = array_map(function($productos) {
    return array_sum(array_map('array_sum', $productos));
}, $ventas);

$regionTopVentas = array_keys($ventasTotalesPorRegion, max($ventasTotalesPorRegion))[0];
////echo "\nRegión con mayores ventas totales: $regionTopVentas\n";

// TAREA: Implementa una función que analice el crecimiento de ventas
// Calcula y muestra el porcentaje de crecimiento de ventas del primer al último mes
// para cada producto en cada región. Identifica el producto y la región con mayor crecimiento.
// Tu código aquí

////echo "<br><br> Pruebas personales: ";

// Funcion para calcular el % de crecimiento por mes para cada region y producto.
function porcentaje_crecimiento($my_data) {
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
    
                
                array_push($array_salida[$nombre_region][$nombre_producto], 
                   number_format($my_value,2)
                );
    
                $valor_anterior = $value;
                
            }
        }
    }

    return $array_salida;

}

function obtener_productos_maximos($datos) {
    $resultado = array();

    foreach ($datos as $region => $productos) {
        $porcentaje_maximo = -INF; // Inicializar con un valor muy bajo
        $producto_mejor = '';

        foreach ($productos as $producto => $porcentajes) {
            $maximo_producto = max($porcentajes); // Encuentra el porcentaje máximo para este producto
            
            if ($maximo_producto > $porcentaje_maximo) {
                $porcentaje_maximo = $maximo_producto;
                $producto_mejor = $producto;
            }
        }

        $resultado[$region] = $producto_mejor;
    }

    return $resultado;
}

// $productos_maximos = obtener_productos_maximos(porcentaje_crecimiento($ventas));
// print_r($productos_maximos);

function obtener_region_mayor_crecimiento($datos) {
    $resultado = array();

    foreach ($datos as $region => $productos) {
        $crecimiento_total = 0;

        foreach ($productos as $producto => $porcentajes) {
            $crecimiento_total += max($porcentajes); // Suma del máximo porcentaje de cada producto
        }

        $resultado[$region] = $crecimiento_total;
    }

    // Encuentra la región con el mayor crecimiento
    $region_mayor_crecimiento = array_search(max($resultado), $resultado);

    return $region_mayor_crecimiento;
}

// Llamar a la función y mostrar la región con el mayor crecimiento
// $region_maxima = obtener_region_mayor_crecimiento(porcentaje_crecimiento($ventas));
// //echo "La región con el mayor crecimiento es: " . $region_maxima;

function generar_tabla($datos) {
    $html = '<table border="1">';
    $html .= '<thead><tr><th>Región</th><th>Producto</th><th>0</th><th>1</th><th>2</th><th>3</th><th>4</th></tr></thead>';
    $html .= '<tbody>';
   
    print_r($datos);

    foreach ($datos['porcentaje_ventas'] as $region => $productos) {
        foreach ($productos as $producto => $porcentajes) {
            $html .= '<tr>';
            $html .= '<td>' . htmlspecialchars($region) . '</td>';
            $html .= '<td>' . htmlspecialchars($producto) . '</td>';
            foreach ($porcentajes as $porcentaje) {
                $html .= '<td>' . htmlspecialchars($porcentaje) . '</td>';
            }
            $html .= '</tr>';
        }
    }

    $html .= '</tbody></table>';
    
    // Agregar sección de productos con mayor crecimiento
    $html .= '<h2>Productos con Mayor Crecimiento</h2>';
    $html .= '<table border="1">';
    $html .= '<thead><tr><th>Región</th><th>Producto</th></tr></thead>';
    $html .= '<tbody>';
    foreach ($datos['productos_mayor_crecimiento'] as $region => $producto) {
        $html .= '<tr>';
        $html .= '<td>' . htmlspecialchars($region) . '</td>';
        $html .= '<td>' . htmlspecialchars($producto) . '</td>';
        $html .= '</tr>';
    }
    $html .= '</tbody></table>';

    // Agregar sección de región con mayor ventas
    $html .= '<h2>Región con Mayor Ventas</h2>';
    $html .= '<p>' . htmlspecialchars($datos['region_mayor_ventas']) . '</p>';

    return $html;
}

$informe_final = [
    'procentaje_ventas' => porcentaje_crecimiento($ventas),
    'productos_mayor_crecimiento' => obtener_productos_maximos(porcentaje_crecimiento($ventas)),
    'region_mayor_ventas' => obtener_region_mayor_crecimiento(porcentaje_crecimiento($ventas))
];

echo (json_encode($informe_final));

?>
      