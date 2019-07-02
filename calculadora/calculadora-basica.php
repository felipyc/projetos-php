<?php
    if( !empty($_GET['pValor1']) && !empty($_GET['pValor2']) && !empty($_GET['pOperacao']) ){
        
        $valor1 = floatval($_GET['pValor1']);
        $valor2 = floatval($_GET['pValor2']);
        $operacao = $_GET['pOperacao'];

        //get ou post sempre sera interpretado como uma string, mesmo se mandar um número
        /*
            essas funções convertem strings em int ou float
            intval();
            floatval();
            floatval("10") transforma em 10.0 
            floatval("5") transforma em 5.5 
            intval("5") transforma em 5
            intval("10") transforma em 10
        */

        switch($operacao){
            case '+':
                $resultado = $valor1 + $valor2;
                break;
            case '-':
                $resultado = $valor1 - $valor2;
                break;
            case '/':
                $resultado = $valor1 / $valor2;
                break;
            case '*':
                $resultado = $valor1 * $valor2;
                break;
        }
    }else{
        // header("Location: index.php");    
        // exit;
    }
?>
<!doctype hmtl>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <div style="margin: auto;width: 500px;">
            <h1 style="text-align: center;font-family:sans-serif;">Calculadora básica</h1>
            <form>
                <input type="number" name="pValor1">
                <select name="pOperacao" id="">
                    <!-- option sem value manda o que estiver dentro do option -->
                    <option>+</option>
                    <option>-</option>
                    <option>/</option>
                    <option>*</option>
                </select>
                <input type="number" name="pValor2">
                <button type="submit">Calcular</button>
            </form>
            <p>
                <?php 
                    if( isset($resultado) ){
                        echo $_GET['pValor1']." ".$_GET['pOperacao']." ".$_GET['pValor2']." = ".$resultado;
                    }
                ?>
            </p>
        </div>
    </body>
</html>