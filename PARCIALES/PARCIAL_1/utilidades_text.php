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

    function contar_vocales($texto) {
        $texto = $texto;
        $texto_out = "";
       
        strtolower($texto);
        echo $texto;

        for ($i=0; $i < strlen($texto); $i++) {  
            if( $texto[$i] == "a" || $texto[$i] == "e" || $texto[$i] == "i" || $texto[$i] == "o" || $texto[$i] == "u"){
                $texto_out .= $texto[$i];
            }
        }
            
        return strlen($texto_out);
    }

    

    echo contar_vocales("holA mUndo__")



    

?>