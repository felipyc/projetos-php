<?php

    require_once("conecta.php");

    //puxando do banco as caracteristicas
    $sql = $pdo->query("SELECT caracteristicas FROM sistematags");

    //Função str_word_count() : Conta quantas palavras uma string possui.
    //Função explode() : Quebra uma string e coloca os itens em um vetor.
    //Função str_split() : Coloca cada letra de uma string em uma posição de um vetor.
    //Função implode() : Transforma um vetor inteiro em uma string.

    //conta a quantidade de indices de um array
    //echo count($caracteristicas);
    
    //Função explode() : Quebra uma string e coloca os itens em um vetor.
    //stripos(); procura uma palavra em uma string
    //substr_count(); retorn quantas palavras iguais tem dentro da string
    //str_replace(); substitui uma palavra por outra dentro de uma string
    
    //echo $caracteristicas[0]['caracteristicas'];
    echo "<br><br><br><br>";
    //$tags = explode(",", $caracteristicas[0]['caracteristicas']);
    // print_r(explode('|', $str, 2));
    //var_dump($tags);


    
    if( $sql->rowCount() > 0 ){
        //1 passo: pegar tudo e juntar em uma lista
        $lista = $sql->fetchAll();
        $carac = array();

        foreach($lista as $usuario){
            //2 passo: dividir uma string em substrings
            $palavras = explode(",",  $usuario['caracteristicas']);
            foreach( $palavras as $palavra ){
                //3 passo: limpar os espaços
                $palavra = trim($palavra);
                //4 passo: verificar se a variavel está setada
                if( isset($carac[$palavra]) ){
                    $carac[$palavra] ++;
                }else{
                    $carac[$palavra] = 1;
                }
            }
        }
        //5 passo: 
        $palavras = array_keys($carac);
        $contagens = array_values($carac);
        $maior = max($contagens);

        $tamanhos = array(11, 15, 20, 30);

        for( $x = 0 ; $x < count($palavras) ; $x++ ){

            $n = $contagens[$x] / $maior;
            $h = ceil($n * count($tamanhos));

            echo "<p style='font-size:".$tamanhos[$h-1]."px'>".$palavras[$x]."</p>";

        }

        var_dump($carac);
        
    

    }
    


    
    

?>