<?php
/*Primeiramente, as letras Googlon são classificadas em dois grupos: as letras s, j, n, c e q são 
chamadas "letras tipo foo", enquanto que as demais são conhecidas como "letras tipo bar".
Os linguistas descobriram que as preposições em Googlon são as palavras de 4 letras que terminam 
numa letra tipo foo, mas onde não ocorre a letra l. Portanto, é fácil ver que existem 21 preposições 
no Texto A. E no Texto B, quantas preposições existem?*/


include 'textob.php';
//separando o texto por espaços
$texto_separado = explode(' ', $textob);
$array_foo = ["s", "j", "n", "c", "q"];
$result = 0;   

foreach($texto_separado as $key => $texto){
    $texto_separado[$key] = preg_replace('/[\x00-\x1F\x7F\xA0]/u', '', $texto);
}

foreach($texto_separado as $texto){
    if(strlen($texto) == 4){
        $letra_final = substr($texto, -1);
        if(in_array($letra_final, $array_foo)){
            $pos = strrpos($texto, "l");
            if($pos === false){
                $result++;                
            }
        }
    }
}
echo "Existem $result Preposições<br>";



/*
Um outro fato interessante descoberto pelos linguistas é que, no Googlon, os verbos sempre são 
palavras de 7 ou mais letras que terminam numa letra tipo bar. Além disso, se um verbo começa com 
uma letra tipo foo, o verbo está em primeira pessoa.
Assim, lendo o Texto A, é possível identificar 160 verbos no texto, dos quais 37 estão em primeira pessoa.
Já no Texto B, quantos são os verbos?
E quantos verbos do Texto B estão em primeira pessoa?
*/

$cont_primeira_pessoa = 0;
$cont_verbos = 0;

$texto_separado2 = explode(' ', $textob);

foreach($texto_separado2 as $key => $texto){
    $texto_separado2[$key] = preg_replace('/[\x00-\x1F\x7F\xA0]/u', '', $texto);
}

$array_bar = ["k", "m", "g", "w", "z", "t", "x", "d", "r", "p", "f", "l", "b", "v", "h"];

foreach($texto_separado2 as $texto2){    
    if(strlen($texto2) >= 7){
        $ultima_letra = substr($texto2, -1); 
        if(in_array($ultima_letra, $array_bar)) {
            $cont_verbos++;   
            $primeira_letra = substr($texto2, 0, 1);
            if(in_array($primeira_letra, $array_foo)){
                $cont_primeira_pessoa++;
            }                    
        }  
        
    }
}

echo "Verbos: $cont_verbos <br>";
echo "Verbos Primeira pessoa: $cont_primeira_pessoa";

?>