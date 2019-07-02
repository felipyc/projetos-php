<?php

  //CONEXÃO COM O BANCO DE DADOS
  
  try{

    $hostname = '127.0.0.1';//endereço do banco de dadoss
    $database = 'cadastro'; //nome de banco
    $username = 'root'; //nome do usuário do login
    $password = ''; //senha para login 

    $pdo = new PDO( "mysql:host=$hostname;dbname=$database;charset=utf8", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") );

  }catch(PDOExecption $e){//retorna erro por falha na conexão
    echo "Erro a se conectar ao banco de dados: ".$e->getMessage();
  }

  function calculo_idade($data) {
        //Data atual
        $dia = date('d');
        $mes = date('m');
        $ano = date('Y');
        //Data do aniversário
        $nascimento = explode('-', $data);
        
        // $dianasc = ($nascimento[0]);
        // $mesnasc = ($nascimento[1]);
        // $anonasc = ($nascimento[2]);
        
        // se for formato do banco, use esse código em vez do de cima!
        
        $nascimento = explode('-', $data);
        $dianasc = ($nascimento[2]);
        $mesnasc = ($nascimento[1]);
        $anonasc = ($nascimento[0]);
        
        //Calculando sua idade
        $idade = $ano - $anonasc; // simples, ano- nascimento!
        if ($mes < $mesnasc) // se o mes é menor, só subtrair da idade
        {
            $idade--;
            return $idade;
        }
        elseif ($mes == $mesnasc && $dia <= $dianasc) // se esta no mes do aniversario mas não passou ou chegou a data, subtrai da idade
        {
            $idade--;
            return $idade;
        }
        else // ja fez aniversario no ano, tudo certo!
        {
            return $idade;
        }
    }

    //echo "teste";


?>


<html lang="pt-br">

  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="_assets/_css/estilo.css">  
  </head>

  <body>
    <!-- FILTRO PARA ORDEM QUE AS INFORMAÇÕES VÃO SER MOSTRADAS NA TABELA QUE MOSTRA OS USUÁRIOS -->
    <div style="text-align: center;">
        
        <form method="post">
            <label for="select_Filtro">Filtrar a ordem que as informações vão ser mostradas:</label>
            <select name="ordemUsuarios" id="select_Filtro" onchange="this.form.submit()">
                <option value="ordemPadrao" 
                <?php 
                    if( !empty($_POST['ordemUsuarios']) ){
                        echo ( !empty($_POST['ordemUsuarios']) OR $_POST['ordemUsuarios'] == 'ordemPadrao' )?'selected="selected"':'';
                    }
                ?> >Padrão</option>
                <option value="ordemNomesAlfabeto" 
                <?php 
                    if( !empty($_POST['ordemUsuarios']) ){
                        echo ( $_POST['ordemUsuarios'] == 'ordemNomesAlfabeto' ) ?'selected="selected"':'';  
                    }
                ?> 
                >Pelo nome</option>
                <option value="ordemIdade" 
                <?php 
                    if( !empty($_POST['ordemUsuarios']) ){
                        echo ( $_POST['ordemUsuarios'] == 'ordemIdade' ) ?'selected="selected"':'';  
                    }
                ?> 
                >Pela idade</option>
            </select>
        </form>

    </div>
    <!-- TABELA QUE MOSTRA OS USUÁRIOS -->
    <table id="tabela_mostra-usuarios">
        <tr id="tabela_mostra_usuario_header">
            <td>Posição</td>
            <td>Nome</td>
            <td>Idade</td>
        </tr>
        <?php
            /*
                Por que esta tag php foi aberta?
                mostra usuários do banco de dados na tabela
            */

            //Query com os dados dos usuários com ou sem filtro
            if( !empty($_POST['ordemUsuarios']) AND $_POST['ordemUsuarios'] === 'ordemNomesAlfabeto'){
                $sql = "SELECT id,nome,nascimento FROM gafanhotos ORDER BY nome";
            }else{
                if( !empty($_POST['ordemUsuarios']) AND $_POST['ordemUsuarios'] === 'ordemIdade'){
                    $sql = "SELECT id,nome,nascimento FROM gafanhotos ORDER BY nascimento DESC";
                }else{
                    if( empty($_POST['ordemUsuarios']) OR $_POST['ordemUsuarios'] === 'ordemPadrao') {
                        $sql = "SELECT id,nome,nascimento FROM gafanhotos";
                    }
                }
            }
            $sql = $pdo->prepare($sql);
            $sql->execute();

            //Mostrando dados dos usuários
            $conta = 1;
            foreach($sql->fetchAll() as $usuario){
                echo "
                    <tr class='cor_tabela_alternada'>
                        <td class='tabela_mostra_usuario_posicao cor_tabela_alternado'>
                            ".$conta++."
                        </td>
                        <td >
                            ".$usuario['nome']."
                        </td>
                        <td >
                            ".calculo_idade($usuario['nascimento'])."
                        </td>
                    </tr>
                ";
            }
        ?>
    </table>
  </body>
</html>