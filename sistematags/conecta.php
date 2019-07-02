<?php
    
    try{

        $hostname = '';
        $database = 'cadastro';
        $username = 'root';
        $password = '';

        $pdo = new PDO("mysql:host=$hostname;dbname=$database;charset=utf8", $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

    }catch(PDOExeption $e){
        echo "Erro ao se conectar com os bancos de dados: " .$e->getMessage();
    }

?>