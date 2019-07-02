<?php
    //função mysql now(); armazena a data e a hora atual


    //CONEXÃO COM O BANCO DE DADOS

    try{//verifica se conseguiu se conectar

        $hostname = '127.0.0.1';
        $username = 'root';
        $password = '';
        $database = 'cadastro';
        
        $pdo = new PDO("mysql:host=$hostname;dbname=$database;charset=utf8", $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

    }catch(PDOExeption $e){//mostra o erro caso não conseguir se conectar
        echo "Erro ao logar no banco de dados".$e->getMessage();
    }

    
    /*
        //TRABALHANDO COM OS DADOS RECEBIDOS
    */ 
    
    //INSERINDO COMENTÁRIO DO USUÁRIO NO BANCO DE DADOS
    if( !empty($_POST['comentario_usuariologado']) ){

        $sql = " INSERT INTO sistemacomentarios VALUES ( DEFAULT, :donocomentario, :comentario, :datacomentario ) ";    
        $sql = $pdo->prepare($sql);
        $sql->bindValue(":donocomentario", 5);
        $sql->bindValue(":comentario", $_POST['comentario_usuariologado']);
        $sql->bindValue(":datacomentario", date('Y-m-d H:i:s'));
        $sql->execute();

    }

?>

<pre>
    <?php
        //var_dump($sql->fetchAll());
        //echo date('Y-m-d H:i:s');
    ?>    
</pre>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <!-- <meta http-equiv="refresh" content="1"> -->
        <link rel="stylesheet" href="_assets/_css/estilo.css">
    </head>
    <body>
        <!-- PARTE QUE FICA OS COMENTÁRIOS -->
        <div id="comentarios">
            <div class="comentarios_separador">    
                <h1 id="comentarios_dos_usuarios_titulo">Comentários dos usuários</h1>
            </div>
            <!-- MOSTRANDO COMENTÁRIOS -->
            <?php
                /*
                    Por que este php foi aberto:
                    Query com os comentarios
                */ 
                $sql = "SELECT s.nome, sc.comentario ,sc.datacomentario FROM sistema AS s INNER JOIN sistemacomentarios AS sc ON s.id = sc.donocomentario ORDER BY sc.datacomentario DESC";
                $sql = $pdo->prepare($sql);
                $sql->execute();
            
                foreach($sql->fetchAll() as $usuario){
            ?>
                <!-- ESTRUTURA QUE SEGURA O COMENTÁRIO DE CADA USUÁRIO -->
                <div class="comentario_usuario_molde">
                    <div class="comentarios_separador"> 
                        <h1 class="dono_comentario">Comentário de: <?php echo $usuario['nome']; ?> </h1>
                    </div>
                    <div class="comentarios_separador"> 
                        <h2 class="data_comentario">Data: <?php echo $usuario['datacomentario']; ?></h2>
                    </div>
                    <div class="comentario_do_dono_comentario">
                        <p>
                            <?php echo $usuario['comentario']; ?>
                        </p>
                    </div> 
                </div>
            <?php
                };
            ?>
            <!-- ENVIAR COMENTÁRIO -->
            <div class="comentario_usuario_molde">
                <form method="post">
                    <div class="comentarios_separador"> 
                        <h1 class="dono_comentario">Insira seu comentário aqui (UsuárioLogadoAtualmente)<?php //echo $usuario['nome']; ?>:</h1>
                    </div>    
                    <div class="comentarios_separador"> 
                        <textarea name="comentario_usuariologado" id="" cols="81" rows="10" maxlength="250"></textarea>    
                    </div> 
                    <div class="comentarios_separador"> 
                        <button type="submit">Enviar comentário</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>