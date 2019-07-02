<?php

    /* 
        A lógica especial:
        converte o valor do padrão brasileiro para o padrão americano.
    */

    session_star();

    if( isset($_POST['tipo']) && empty($_POST['tipo']) == false ){
        $tipo = $_POST['tipo']; 
        //converte para o padrão americano
        $valor = str_replace(",",".", $_POST['valor']);
        //converte string para float para poder salvar no banco e fazer operações
        $valor = floatval($valor);
        //
        $sql = $pdo->prepare("INSERT INTO historico (id_conta, tipo, valor, data_operacao) VALUES (:id_conta, :tipo, :valor, NOW())");
        $sql->bindValue(":id_conta", $_SESSION['banco']);
        $sql->bindValue(":tipo", $tipo);
        $sql->bindValue(":valor", $valor);
        $sql->execute();

        header("Location: index.php");
        exit;
    }

?>
<!DOCTYPE html><!-- diz que tem html5 e permiti os recursos exclusivos dele -->
<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <form method="post">
            Tipo de trnsação:<br>
            <select name="tipo">
                <option value="0"></option>
                <option value="1"></option>
            </select>
            Valor:<br>
            <!-- atributo pattern do html5 permiti filtrar o que pode ser digitado pelo usuário -->
            <input type="text" name="valor" pattern="[0-9.,]{1,}"><br><br>
            <input type="submit" value="adicionar">
        </form>
    </body>
</html>