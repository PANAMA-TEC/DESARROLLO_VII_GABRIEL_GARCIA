<?php

    for($y = 1; $y <= 5; $y++ ){
        for($x = 1; $x <= $y ; $x++ ){
        
            echo "*";

        }
        echo "<br>";
    }

    echo "<br>";
    $x = 1;
    while($x <= 20){
        
        echo $x%2 == 0 ? "[".$x."]" : " ";
        $x++;

    }

    echo "<br><br>";
    $dw = 10;
    do{

        echo $dw == 5 ? "" : "[".$dw."]";
        $dw--;

    }while($dw >= 1)




?>
