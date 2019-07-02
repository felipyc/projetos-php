<?php
    
    //iniciando sessão
    session_start();
    $id = $_SESSION['id'];

    //chamando arquivos necessários
    require "conecta.php";
    
    //inicio 
    if( !empty($_SESSION['id']) ){//verifica se id está vazio
        
        //query dos dados do usuário
        $sql = "SELECT * FROM sistema WHERE id = :id";
        $usuario_logado = $pdo->prepare($sql);
        $usuario_logado->bindValue(":id", $id);
        $usuario_logado->execute();
        
        if($usuario_logado->rowCount() > 0){//verifica se o id é valido
            
            //informações do usuário logado, as colunas do banco de dados referente ao id dele
            $usuario_logado = $usuario_logado->fetch();

            //verificando se tem imagens armazenadas
            $sql = "SELECT * FROM galeriausers WHERE donoimagem = :id";
            $galeriaimagens = $pdo->prepare($sql);
            $galeriaimagens->bindValue(":id", $id);
            $galeriaimagens->execute();

            //troca a image do  perfil
            if( isset($_FILES['imagemperfil']) AND !empty($_FILES['imagemperfil']) ){
                
                $imagemPerfil = $_FILES['imagemperfil'];    
                $extensaoArquivo = substr($imagemPerfil['type'],6,10);
                if($extensaoArquivo !== 'php'){
                    move_uploaded_file( $imagemPerfil['tmp_name'], '_assets/_phpdata/_users/'.$id.'/'.$id.'-imagemperfil.'.$extensaoArquivo );    
                    $sql = "UPDATE sistema SET imagemperfil = :nomeimagem WHERE id = :id";
                    $sql = $pdo->prepare($sql);
                    $sql->bindValue(":nomeimagem", $id.'-imagemperfil.'.$extensaoArquivo);
                    $sql->bindValue(":id", $id);
                    $sql->execute();
                }                
            }
			//troca imagens da galeria do usuário
            if( isset($_FILES['galeriaimagens']) AND !empty($_FILES['galeriaimagens']) ){
                
                //armazenando upload dos arquivos
                $galeriaImagensR = $_FILES['galeriaimagens'];    

                if( $galeriaimagens->rowCount() == 0){//se estiver vazio usa insert into

                    for( $conta = 0 ; $conta<= 14 ; $conta++){
                        
                        if(!empty($galeriaImagensR['tmp_name'][$conta])){
                          //retorna a extensão do arquivo
                          $extensaoArquivo = substr($galeriaImagensR['type'][$conta],6,10);
                          if($extensaoArquivo !== 'php'){//verifica se a extensão do arquivo não é php
                            //move upload para pasta _phpdata/...
                            move_uploaded_file( $galeriaImagensR['tmp_name'][$conta], '_assets/_phpdata/_users/'.$id.'/_galeriauser-'.$id.'/'.$id.'-'.($conta+1).'-galeria.'.$extensaoArquivo ); 
                            //nome da imagem na pasta que vai ser salva
                            $nome_imagem = $id.'-'.($conta+1).'-galeria.'.$extensaoArquivo;  
                            //inserindo imagens
                            $sql = "INSERT INTO galeriausers VALUES (DEFAULT, :id, :nomedaimagem)";
                            $sql = $pdo->prepare($sql);
                            $sql->bindValue(":id", $id);
                            $sql->bindValue(":nomedaimagem", $nome_imagem);
                            $sql->execute();
                          }else{
                            //prevenção temporária
                            $sql = "INSERT INTO galeriausers VALUES (DEFAULT, :id, :nomedaimagem)";
                            $sql = $pdo->prepare($sql);
                            $sql->bindValue(":id", $id);
                            $sql->bindValue(":nomedaimagem", '');
                            $sql->execute();    
                          }
                        }else{
                          //prevenção temporária
                          $sql = "INSERT INTO galeriausers VALUES (DEFAULT, :id, :nomedaimagem)";
                          $sql = $pdo->prepare($sql);
                          $sql->bindValue(":id", $id);
                          $sql->bindValue(":nomedaimagem", '');
                          $sql->execute();
                        }
                    }   
                }else{//se estiver conteudo usa update
                    $galeriaUserChave = $galeriaimagens->fetchAll();

                    for( $conta = 0 ; $conta<= 14 ; $conta++){
                        if(!empty($galeriaImagensR['tmp_name'][$conta])){
                            
                            $extensaoArquivo = substr($galeriaImagensR['type'][$conta],6,10);//retorna a extensão do arquivo
                        
                            if($extensaoArquivo !== 'php'){//verifica se a extensão do arquivo não é php
                                move_uploaded_file( $galeriaImagensR['tmp_name'][$conta], '_assets/_phpdata/_users/'.$id.'/_galeriauser-'.$id.'/'.$id.'-'.($conta+1).'-galeria.'.$extensaoArquivo ); 
                                //nome da imagem na pasta que vai ser salva
                                $nome_imagem = $id.'-'.($conta+1).'-galeria.'.$extensaoArquivo;  
                                
                                //sobrescrevendo imagens
                                $sql = "UPDATE galeriausers SET caminhodaimagem = :nomedaimagem WHERE id = :id AND donoimagem = :donoimagem";
                                $sql = $pdo->prepare($sql);
                                $sql->bindValue(":nomedaimagem", $nome_imagem);
                                $sql->bindValue(":id", $galeriaUserChave[$conta]['id']);
                                $sql->bindValue(":donoimagem", $id);
                                $sql->execute();
                            }  
                        }           
                    }   
                }    
			}
        }else{
            header("Location: login.php");
        }
    }else{
        header("Location: login.php");
    }

?>
<!-- <pre>
    <?php
        //var_dump($galeriaimagensrecebidas);
    ?>
</pre> -->


<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="_assets/_css/arearestrita.css">
        <script src="_assets/_js/arearestrita.js"></script>
        <!-- <meta http-equiv="refresh" content="2"> -->
    </head>
    <body>
        <!-- barra que mostra usuario logado e as opções -->
        <div id="menu-left">
            <div class="menu-left-separador">    
                <!-- IMAGEM DO PERFIL DO USUÁRIO LOGADO -->
                <div id="menu-left-parte1">
                    <?php
                        $sql = "SELECT * FROM sistema WHERE id = :id";
                        $usuario_logado = $pdo->prepare($sql);
                        $usuario_logado->bindValue(":id", $id);
                        $usuario_logado->execute();
                        $usuario_logado = $usuario_logado->fetch();
                        if($usuario_logado['imagemperfil'] != false){
                            echo "
                            <img id='menu-left-divs-imagemperfil' src='_assets/_phpdata/_users/".$id."/".$usuario_logado['imagemperfil']."' alt='' style='width: 150px;height: 150px;'>            
                            ";
                        }else{
                            echo "<div style='width: 200px;height:200px;'></div>";
                        }
                    ?>
                    
                    <!-- <img id="menu-left-divs-imagemperfil" src="_assets/_phpdata/_users/<?php // $id.'/'.$usuario_logado['imagemperfil'];
                    ?>" alt="" style="width: 150px;height: 150px;">     -->
                </div>
            </div>
            <div class="menu-left-separador">
                <div id="menu-left-parte2">
                    <?php echo $usuario_logado['nome']; ?>
                </div>
            </div>
            <div class="menu-left-separador">
                <div style="cursor:pointer;" onclick="mudaOpcao('opcao-escolhida-',1)">
                    Galeria
                </div>
            </div>
            <div class="menu-left-separador">
                <div style="cursor:pointer;" onclick="mudaOpcao('opcao-escolhida-',2)">
                    Configurações
                </div>    
            </div>
            <div class="menu-left-separador">
                <div id="link_convite">
                    <a href="http://localhost/estudo/cadastro.php?codeinvite=<?php echo $usuario_logado['codeinvite'];?>">Link para convite: http://localhost/projetox/cadastro.php?codeinvite=<?php echo $usuario_logado['codeinvite'];?></a>    
                </div>    
            </div>
            <div class="menu-left-separador">
                <div>
                    <a style="text-decoration: none;color: white;" href="sair.php">Sair</a>
                </div>
            </div>
        </div>
        
        <!-- parte que mostra a opção selecionada pelo usuario -->
        <div id="parte-opcao-escolhida">
            <!-- OPCAO GALERIA -->            
            <div id="opcao-escolhida-1" class="opcao-escolhida">
                <!-- GALERIA DE IMAGENS -->
                <div id="opcao-escolhida-1-galeria">
                    <!-- repetição de divs para a galeria -->
                    <?php
                        //verificando se tem imagens armazenadas
                        //prevenção temporária
                        $sql = "SELECT * FROM galeriausers WHERE donoimagem = :id";
                        $galeriaimagens = $pdo->prepare($sql);
                        $galeriaimagens->bindValue(":id", $id);
                        $galeriaimagens->execute();
                        $galeriaimagensrecebidas = $galeriaimagens->fetchAll();
                        //mostrando as imagens
                        foreach($galeriaimagensrecebidas as $imagem){
                            if($imagem['caminhodaimagem'] != false){
                                echo "
                                <div class='opcao-escolhida-1-galeria'>
                                    <img src='_assets/_phpdata/_users/".$id."/_galeriauser-".$id."/".$imagem['caminhodaimagem']."' style='width: 100%;height: 100%;'>
                                </div>
                            ";
                            }
                            
                        }
                        
                    ?>
                </div>
            </div>
            <!-- OPCAO CONFIGURACOES -->            
            <div id="opcao-escolhida-2" class="opcao-escolhida">
                
                <!-- MUDAR IMAGEM DO PERFIL -->
                <div class="parte-opcao-escolhida-separador">
                    <h1 style="text-align: center;">Mudar imagem do perfil atual</h1>
                </div>

                <div class="parte-opcao-escolhida-separador">
                    <form method="post" enctype="multipart/form-data">
                        
                        <div class="parte-opcao-escolhida-separador">
                            <input type="file" name="imagemperfil">
                        </div>

                        <div class="parte-opcao-escolhida-separador">
                            <button type="submit">Atualizar imagem do perfil</button>    
                        </div>
                    </form>
                </div>

                <!-- ALTERAR A GALERIA DE IMAGENS -->
                <div class="parte-opcao-escolhida-separador">
                    <h1 style="text-align: center;">Alterar a galeria de imagens</h1>
                </div>
                
                <div class="parte-opcao-escolhida-separador">
                    <form method="post" enctype="multipart/form-data"> 
                        <div class="parte-opcao-escolhida-separador">
                          <input type="file" multiple name="galeriaimagens[]">
                        </div>
                        <div class="parte-opcao-escolhida-separador">
                          <button type="submit">Enviar imagens da galeria</button>    
                        </div>
                    </form>
                </div>

            </div>
            <div style="clear: both;"></div>
        </div>
    </body>
</html>