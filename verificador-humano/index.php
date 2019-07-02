<?php
    session_start();
    // $_SESSION = array();
    // session_destroy();
?>
<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h1>Verificador humanos</h1>
        <form>
            <?php

                if( isset($_SESSION['resultado']) && !empty($_GET['pResultado']) ){
                    
                    if( $_SESSION['resultado'] == intval($_GET['pResultado']) ){
                        echo "<p>Você é um humano.</p>";
                    }else{
                        echo "<p>Resultado errado, tente novamente.</p>";
                    }
                    
                    $n1 = rand(1,10);
                    $n2 = rand(1,10);

                    switch(rand(1,4)){
                        case 1:
                            $op = '+';
                            $resultado = $n1 + $n2;
                            $_SESSION['resultado'] = $resultado;
                            break;
                        case 2:
                            $op = '-';
                            $resultado = $n1 - $n2;
                            $_SESSION['resultado'] = $resultado;
                            break;
                        case 3:
                            $op = '/';
                            $resultado = $n1 / $n2;
                            $_SESSION['resultado'] = $resultado;
                            break;
                        case 4:
                            $op = '*';
                            $resultado = $n1 * $n2;
                            $_SESSION['resultado'] = $resultado;
                            break;
                    }
                    echo $n1." ".$op." ".$n2." = "; 

                }else{
                    
                    $n1 = rand(1,10);
                    $n2 = rand(1,10);

                    switch(rand(1,4)){
                        case 1:
                            $op = '+';
                            $resultado = $n1 + $n2;
                            $_SESSION['resultado'] = $resultado;
                            break;
                        case 2:
                            $op = '-';
                            $resultado = $n1 - $n2;
                            $_SESSION['resultado'] = $resultado;
                            break;
                        case 3:
                            $op = '/';
                            $resultado = $n1 / $n2;
                            $_SESSION['resultado'] = $resultado;
                            break;
                        case 4:
                            $op = '*';
                            $resultado = $n1 * $n2;
                            $_SESSION['resultado'] = $resultado;
                            break;
                    }
                    echo $n1." ".$op." ".$n2." = ";    

                }
            ?>
            <input type="number" name="pResultado"><br>
            <button type="submit">Calcular</button>
        </form>
    </body>
</html>