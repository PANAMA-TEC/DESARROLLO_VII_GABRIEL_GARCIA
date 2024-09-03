<?php

    function contar_palabras($texto) {
        $array = explode(" ", $texto);
        $array_out = [];
        

        foreach($array as $item){
            if($item != "" ) {
                array_push($array_out, $item);
            }
        }

        return count($array_out);
    }

    echo contar_palabras(" hola mundo ")


?>