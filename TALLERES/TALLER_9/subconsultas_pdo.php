
<?php
    require_once "config_pdo.php";

    try {
        // 1. Productos que tienen un precio mayor al promedio de su categoría
        $sql = "SELECT p.nombre, p.precio, c.nombre as categoria,
                (SELECT AVG(precio) FROM productos WHERE categoria_id = p.categoria_id) as promedio_categoria
                FROM productos p
                JOIN categorias c ON p.categoria_id = c.id
                WHERE p.precio > (
                    SELECT AVG(precio)
                    FROM productos p2
                    WHERE p2.categoria_id = p.categoria_id
                )";

        $stmt = $pdo->query($sql);
        
        echo "<h3>Productos con precio mayor al promedio de su categoría:</h3>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "Producto: $"."{$row['nombre']}, Precio: $"."{$row['precio']}, ";
            echo "Categoría: {$row['categoria']}, Promedio categoría: $"." {$row['promedio_categoria']}<br>";
        }

        // 2. Clientes con compras superiores al promedio
        $sql = "SELECT c.nombre, c.email,
                (SELECT SUM(total) FROM ventas WHERE cliente_id = c.id) as total_compras,
                (SELECT AVG(total) FROM ventas) as promedio_ventas
                FROM clientes c
                WHERE (
                    SELECT SUM(total)
                    FROM ventas
                    WHERE cliente_id = c.id
                ) > (
                    SELECT AVG(total)
                    FROM ventas
                )";

        $stmt = $pdo->query($sql);
        
        echo "<h3>Clientes con compras superiores al promedio:</h3>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "Cliente: {$row['nombre']}, Total compras: $"." {$row['total_compras']}, ";
            echo "Promedio general: $"."{$row['promedio_ventas']}<br>";
        }



        //3 productos que no se han vendido
        $sql = "
            SELECT nombre FROM taller9_db.productos AS p
            WHERE p.id NOT IN (
                SELECT  p.id  
                FROM taller9_db.productos AS p, taller9_db.detalles_venta AS dv, taller9_db.ventas AS v 
                WHERE dv.venta_id = v.id AND dv.producto_id = p.id	
            )
        ";

        $stmt = $pdo->query($sql);

        echo "<h3>Productos sin ventas:</h3>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "Producto sin ventas: <br> {$row['nombre']}";
        }


        //4 Listar las categorías con el número de productos y el valor total del inventario

        $sql = "
            
            SELECT p.nombre AS nombre, p.stock AS en_inventario, (stock * precio) AS total_inventairo 
            FROM taller9_db.productos AS p , taller9_db.categorias AS c
            WHERE c.id = p.categoria_id

        ";

        $stmt = $pdo->query($sql);

        echo "<h3>inventario de productos:</h3>";
        echo "<table>";
        echo "<tbody><th>NOMBRE</th><th>en_inventario</th> <th>TOTAL_INVENTARIO</th></tbody>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr> <th>{$row['nombre']}</th> <th>{$row['en_inventario']}</th><th> {$row['total_inventairo']}</th> </tr>";
        }
        echo "</table>";

       

    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $pdo = null;
?>