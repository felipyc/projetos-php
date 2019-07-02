<?php   
    require 'config.php';
?>

<?php
    
    //verificando se o usuário já enviou os dados
    if(isset($_POST['pNome'])){
        //alterando banco de dados com as novas informações
        if( !empty($_POST['pNome']) AND !empty($_POST['pEmail']) AND !empty($_POST['pSenha']) ){
        
            //variaveis da query protegida
            $nome = addslashes($_POST['pNome']);
            $email = addslashes($_POST['pEmail']);
            $senha = md5(addslashes($_POST['pSenha']));
            
            //query
            $sql = "INSERT INTO sistema values (DEFAULT, :nome, :email, :senha)";
            
            //query do server
            //utilizei addslashes e prepare para proteger mais eu posso usar apenas prepare,bind e execute que é indicado
            $sql = $pdo->prepare($sql);
            $sql->bindValue(':nome', $nome);
            $sql->bindValue(':email', $email);
            $sql->bindValue(':senha', $senha);
            $sql->execute();//equivale $pdo->query($sql);

            header("Location: index.php");

        }else{
            echo 'Você preencheu todos os dados corretamente?Nada foi enviado, por favor preencha novamente e todos os campos.';
        }
    }

?>

<html>
    <head>
        <meta charset="utf-8">
        <style>
            *{
                font-family: sans-serif;
            }
            h1{
                text-align: center;
            }
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
        <div>
            <!-- inserindo novos usuarios utilizando formulário -->
            <h1>Inserir novos usuários</h1>
            <form method="post">

                <div class="estilo_div_form">
                    <label for="hNome">Nome:</label><br>
                    <input type="text" id="hNome" name="pNome" placeholder="Digite o nome do novo usuário" maxlength="50"><br>
                </div>
                
                <div class="estilo_div_form">
                    <label for="hEmail">Email:</label><br>
                    <input type="email" id="hEmail" name="pEmail" placeholder="Digite o email do novo usuário" maxlength="50"><br>
                </div>
                
                <div class="estilo_div_form">
                    <label for="hSenha">Senha:</label><br>
                    <input type="password" id="hSenha" name="pSenha" placeholder="Digite a nova senha do novo usuário" maxlength="20"><br>
                </div>      

                <div id="div_button" class="estilo_div_form">
                    <button type="submit">Enviar</button>
                </div>      

            </form>

        </div>
    </body>
</html>
