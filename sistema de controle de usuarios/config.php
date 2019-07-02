<?php
    try{
        
        //dados para conexão com o banco
        $hostname = '127.0.0.1';
        $database = 'cadastro';
        $username = 'root';
        $password = '';
        
        //criando objeto para conexão
        $pdo = new PDO("mysql:host=$hostname;dbname=$database;charset=utf8", $username,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        
        
        
    }catch(PDOException $e){
        echo "Falhou a entrada no banco de dados: ". $e->getMessage();
    }
?>