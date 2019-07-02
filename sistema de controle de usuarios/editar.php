<?php
    //fetch(); $dados->fetch(); Armazena apenas um objeto('array')
    //fetchAll(); $dados->fetchAll(); Armazena todos os objetos('array de arrays')
    require "config.php";

    //validação quando o usuário for redirecionado
    if( isset($_GET['id']) && !empty($_GET['id']) && empty($_POST['naorepete']) ){
        
        //protegendo as variaveis da query 
        $id = addslashes($_GET['id']);
        
        //query
        $sql = "SELECT * FROM sistema WHERE id = :id";    

        //query do server
        
        $sql = $pdo->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){//caso o usuário altere o id manualmente e não tenha no banco de dados
            $dados = $sql->fetch();//armazena uma linha ao contrario de fetchAll
        }else{
            header("Location: index.php");
        }

    }else{
        header("Location: index.php");
    }

    //validação quando o usuário alterar os dados
    if( !empty($_POST['pNome']) AND !empty($_POST['pEmail']) AND !empty($_POST['pSenha']) ){

        //variaveis da query protegida
        $id = addslashes($_GET['id']);//atribuição necessária, quando os dados forem enviados
        $nome = addslashes($_POST['pNome']);
        $email = addslashes($_POST['pEmail']);
        $senha = md5(addslashes($_POST['pSenha']));
        
        //query
        $sql = "UPDATE sistema SET nome = :nome, email = :email, senha = :senha  WHERE id = :id";    

        //query do server
        
        $sql = $pdo->prepare($sql);
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":senha", $senha);
        $sql->bindValue(":id", $id);
        $sql->execute();

        //redirecionando para a pagina inicial, depois da alteração ser feita
        header("Location: index.php");        

    }

?>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <style>
            *{
                font-family: sans-serif;
            }
            h1{
                text-align: center;
            }
            
            /* estilo do formulário que altera os dados */
            .estilo_div_form{
                margin: 10px 10px;
            }
                .estilo_div_form > input{
                    padding: 10px;
                    width: 100%;
                }
                
                #div_button{
                    text-align: center;
                }
                    #div_button > button{
                        padding: 10px;
                        border-radius: 5px;
                        background-color: white;
                        border: 2px solid orange;
                    }
            
        </style>
    </head>
    <body>
        
        <!-- atualizar dados do antigo usuário -->
        <h1>Atualizar dados do antigo usuário</h1>
        <form method="post">

            <div class="estilo_div_form">
                <label for="hNome">Nome:</label><br>
                <input type="text" id="hNome" name="pNome" value="<?php echo $dados['nome']; ?>" maxlength="50"><br>
            </div>
            
            <div class="estilo_div_form">
                <label for="hEmail">Email:</label><br>
                <input type="email" id="hEmail" name="pEmail" value="<?php echo $dados['email']; ?>" maxlength="50"><br>
            </div>
            
            <div class="estilo_div_form">
                <label for="hSenha">Senha:</label><br>
                <input type="password" id="hSenha" name="pSenha" placeholder="Digite a nova senha" maxlength="20" required="required"><br>
            </div>      

            <div id="div_button" class="estilo_div_form">
                <button type="submit" name="naorepete" value="1">Atualizar</button>
            </div>      

        </form>

    </body>
</html>