<?php
//senha.inc.php

function geraSenha($tipo="L N S L N L N N"){
     $tipo = explode(" ", $tipo);

     $padrao_letras = "a|b|c|d|e|f|g|h|i|j|l|m|n|o|p|q|r|s|t|u|v|x|w|y|z"; //A|B|C|D|E|F|G|H|I|J|K|L|M|N|P|Q|R|S|T|U|V|X|W|Y|Z|
     $padrao_numeros = "2|3|4|5|6|7|8|9";
     $padrao_simbolos = "#|@";

     $array_letras = explode("|", $padrao_letras);
     $array_numeros = explode("|", $padrao_numeros);
     $array_simbolos = explode("|", $padrao_simbolos);

     $senha = "";

     for ($i = 0; $i < sizeOf($tipo); $i++){
          if ($tipo[$i] == "L"){
             $senha.= $array_letras[array_rand($array_letras,1)];
          }
          else{
               if ($tipo[$i] == "N"){
                    $senha.= $array_numeros[array_rand($array_numeros,1)];
               }
               else{
                    if ($tipo[$i] == "S"){
                      $senha.= $array_simbolos[array_rand($array_simbolos,1)];
                    }
               }
          }
     }
     return $senha;
}
?>