<?php 
    session_start();


    echo "Dashboard de profesor. <br><br>";
    echo "Bienvenido al dashboard de profesores " . $_SESSION['usuario'];

   


    $estudiantes_nota = [
        "gabriel garcia" => "A",
        "Javett Pineda" => "B",
        "Wilfredo Bernier" => "A",
        "Gadafy Rosario" => "B"
    ]

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    td {
        border-style: solid;
        padding: 20px;

    }

    table {
        margin-top: 50px;
    }

    a {
        margin-top: 50px;
    }
</style>
<body>

    <table>
        <tr>
            <td>Producto</th>
            <td class='text-center'>Estudiante</th>
        
        </tr>
    
        <?php 
            foreach ($estudiantes_nota as $key => $nota){
                echo "<tr>";
                echo "<td>".$key."</td>";
                echo "<td>".$nota."</td>";
                echo "</tr>";
            }
        
        
        ?>
      
        
        
        
        
    </table>
    <?php
        echo "<br><a href='logout.php'>Cerrar Session</a> <br><br>";
    ?>
</body>
</html>