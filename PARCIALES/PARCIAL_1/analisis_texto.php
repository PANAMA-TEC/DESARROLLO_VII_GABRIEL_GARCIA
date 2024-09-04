

<!DOCTYPE html>
  <head>
    <title> Curso general de PHP</title>
    <link rel="stylesheet" href="./index.css">
  </head>

    <style>
        td {
            padding: 20px;
            border-style: solid;
            
        }

        .text-center {
            text-align:center;
        }

    </style>
  <body>
    <table>
        <tr>
            <td> frase actual</td> <td class='text-center'> numero de palabras</td> <td class='text-center'>contar_palabras</td><td class='text-center'> invertir_palabras</td>
        </tr>
        
            <?php 
                require_once './utilidades_texto.php';
                $frases = ["mi nombre es gabriel garcia y soy responsable", "trabajo de analista de aplicaciones OT", "me gusta el orden y limpeza"];
                
                foreach( $frases as $element ){
                    echo "<tr>";
                    echo "<td>";
                    echo $element;
                    echo "</td>";
                    echo "<td class='text-center'>";
                    echo contar_palabras($element);
                    echo "</td>";
                    echo "<td class='text-center'>";
                    echo contar_vocales($element);
                    echo "</td>";
                    echo "<td  class='text-center'>";
                    echo invertir_palabras($element);
                    echo "</td>";
                    echo "</tr>";
                }

            ?>     
        </tr>

    </table>
   
        
  </body>
</html>
