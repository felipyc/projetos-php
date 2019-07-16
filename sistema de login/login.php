<?php
    session_start();   
    require "conecta.php";

    $info = "";

    if( !empty($_POST['pEmail']) AND !empty($_POST['pSenha']) ){

        $email = addslashes($_POST['pEmail']);
        $senha = md5(addslashes($_POST['pSenha']));
        
        $sql = "SELECT * FROM sistema WHERE email = :email AND senha = :senha";

        $sql = $pdo->prepare($sql);
        $sql->bindValue(":email",$email);
        $sql->bindValue(":senha",$senha);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            $dados_usuario = $sql->fetch();
            $_SESSION['id'] = $dados_usuario['id'];
            header('Location: arearestrita.php');
            exit;
        }else{
            $info = "Dados de login incorreto.";
        }
    }

?>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="refresh" content="">
        <link rel="stylesheet" href="_assets/_css/login.css">
    </head>
    <body>
        
        <div id="delimitador">

            <div id="panelLogin">
                
                <div class="plSeparapartes">
                    <div id="plLogo">
                        GaleryBr
                    </div>
                </div>

                <div id="mensagem__erro" class="plSeparapartes">
                    <?=$info?>
                </div>

                <form method="post">
                    
                    <div class="plSeparapartes">
                        <input class="logincampos" type="email" name="pEmail" placeholder="Email">
                    </div>
                    
                    <div class="plSeparapartes">
                        <input class="logincampos"type="password" name="pSenha" placeholder="Senha">
                    </div>
                    
                    <div id="criar_uma_conta" class="plSeparapartes">
                        <a href="cadastro.php">Criar uma conta</a>
                    </div>

                    <div id="loginBotaoEnviar"  class="plSeparapartes">
                        <button type="submit">Entrar</button>
                    </div>

                </form>
                       
            </div>

        </div>

    </body>
</html>


                                        



