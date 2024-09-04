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
       
        $texto = strtolower($texto);
        
        for ($i=0; $i < strlen($texto); $i++) {  
            if( $texto[$i] == "a" || $texto[$i] == "e" || $texto[$i] == "i" || $texto[$i] == "o" || $texto[$i] == "u"){
                $texto_out .= $texto[$i];
            }
        }
            
        return strlen($texto_out);
    }

    function invertir_palabras($texto){
        $array = explode(" ", $texto);
        $array_out = [];
        $str_out = "";
        

        foreach($array as $item){
            if($item != "" ) {
                array_push($array_out, $item);
            }
        }

        // array con palabras listo para contar.
        // falta imprimirlo alrevez.

        for ($i=count($array_out) - 1; $i >= 0; $i--) { 
            $str_out .= $array_out[$i] . " ";
            
        }

        return $str_out;

       
    }

    echo invertir_palabras('hola mundo ');
    

    

   



    

?>