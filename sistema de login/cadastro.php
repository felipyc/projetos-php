<?php
    /*
        PÁGINA PARA CADASTRO DE USUÁRIOS NOVOS COM CÓDIGO DE CONVITE
    */ 
    //pedindo arquivos php externos
    require "conecta.php";

    if(!empty($_GET['codeinvite'])){
        $codeinvite = $_GET['codeinvite'];
    }else{
        $codeinvite = '';
    }
?>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="refresh" content="">
        <link rel="stylesheet" href="_assets/_css/cadastro.css">
    </head>
    <body>
        
        <div id="delimitador">

            <div id="panelLogin">
                
                <div class="plSeparapartes">
                    <div id="plLogo">
                        Appness
                    </div>
                </div>

                <div id="mensagem__erro" class="plSeparapartes">
                    <?php
                        if( !empty($_POST['pNome']) AND !empty($_POST['pEmail']) AND !empty($_POST['pSenha']) AND !empty($_POST['pCodeinvite']) ){

                            $email = addslashes($_POST['pEmail']);
                            $senha = md5(addslashes($_POST['pSenha']));

                            //verifica se já tem email cadastrado
                            $sql = " SELECT email FROM sistema WHERE email = :email";
                            $sql = $pdo->prepare($sql);
                            $sql->bindValue(":email", $email);
                            $sql->execute();

                            if($sql->rowCount() > 0){
                                echo "Email já cadastrado.";
                            }else{
                                //verifica se o code de convite existe
                                $sql = " SELECT limiteconvite FROM sistema WHERE codeinvite = :codeinvite AND limiteconvite <= 5";
                                $sql = $pdo->prepare($sql);
                                $sql->bindValue(":codeinvite", $_POST['pCodeinvite']);
                                $sql->execute();

                                if($sql->rowCount() > 0){
                                    //Limite de cadastros por link até 5, aumenta de 1 em 1
                                    $limiteconvite = $sql->fetch();//solução temporária
                                    $aumentaAte5 = $limiteconvite['limiteconvite'];
                                    $sql = "UPDATE sistema SET limiteconvite = :limiteconvite WHERE codeinvite = :codeinvite";
                                    $sql = $pdo->prepare($sql);
                                    $sql->bindValue(":limiteconvite", ++$aumentaAte5);
                                    $sql->bindValue(":codeinvite", $_POST['pCodeinvite']);
                                    $sql->execute();

                                    //cadastrando novo usuário
                                    $sql = "INSERT INTO sistema VALUES (DEFAULT, :nome, :email, :senha, '', :codeinvite, '1')";
                                    $sql = $pdo->prepare($sql);
                                    $sql->bindValue(":nome", $_POST['pNome']);
                                    $sql->bindValue(":email", $_POST['pEmail']);
                                    $sql->bindValue(":senha", md5($_POST['pSenha']));
                                    $sql->bindValue(":codeinvite", md5($_POST['pEmail']));//gera o codeinvite com md5 do email
                                    $sql->execute();
                                    
                                    //Query para saber o id do usuário cadastrado
                                    $sql = "SELECT id FROM sistema WHERE email = :email";
                                    $sql = $pdo->prepare($sql);
                                    $sql->bindValue(":email", $_POST['pEmail']);
                                    $sql->execute();
                                    $id = $sql->fetch();
                                    //criar a pasta com o id
                                    mkdir("_assets/_phpdata/_users/".$id['id']."", 0777);
                                    mkdir("_assets/_phpdata/_users/".$id['id']."/_galeriauser-".$id['id']."", 0777);
                                    header('Location: login.php');//redirecindo para login, para se cadastrar
                                }else{
                                    echo "Código de convite inválido ou estorou o limite.";
                                }
                            }
                        }
                    ?>
                </div>

                <form method="post">
                    
                    <div class="plSeparapartes">
                        <input class="inputcampos" type="text" name="pNome" placeholder="Nome">
                    </div>
                        
                    <div class="plSeparapartes">
                        <input class="inputcampos" type="email" name="pEmail" placeholder="Email">
                    </div>
                    
                    <div class="plSeparapartes">
                        <input class="inputcampos"type="password" name="pSenha" placeholder="Senha">
                    </div>

                    <div class="plSeparapartes">
                        <input class="inputcampos" type="text" value="<?php echo $codeinvite;?>" name="pCodeinvite" placeholder="Código de convite">
                    </div>
                    
                    <div id="informacoes_extras" class="plSeparapartes">
                        <a href="login.php">Voltar para área de login</a>
                    </div>

                    <div id="buttonsend"  class="plSeparapartes">
                        <button type="submit">Cadastrar-se</button>
                    </div>

                </form>
                       
            </div>

        </div>

    </body>
</html>


                                        



