<?php
    try{
        
        //dados para conexão com o banco
        $hostname = '127.0.0.1';
        $database = 'cadastro';
        $username = 'root';
        $password = '';
        
        //criando objeto para conexão
        $pdo = new PDO("mysql:host=$hostname;dbname=$database;charset=utf8", $username,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        
        //entradas
        $nome = 'Pedro';
        $id = 5;
        
        //query
        $sql = "UPDATE usuarios SET nome = :novonome WHERE id = :id";
        
        //query protegida
        $sql = $pdo->prepare($sql);
        $sql->bindValue(':novonome', $nome);
        $sql->bindValue(':id', $id);
        $sql->execute();//equivale $pdo->query($sql);
        
        //verificando se o objeto está vazio
        if($sql->rowCount() > 0){
            
            foreach($sql->fetchAll() as $posts){
                
                
                
            }
            
        }else{
            echo "NÃO há usuários cadastrados";
        }
        
    }catch(PDOException $e){
        echo "Falhou a entrada no banco de dados: ". $e->getMessage();
    }
?>