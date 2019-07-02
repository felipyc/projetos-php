<?php
    
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

?>