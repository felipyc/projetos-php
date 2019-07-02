<?php
    
    session_start();
    require("conecta.php");

     if( !empty($_POST['pAgencia']) AND !empty($_POST['pConta']) AND !empty($_POST['pDigito']) AND !empty($_POST['pSenha']) ){

        //pegando dados do usuário logado
        $sql = "SELECT * FROM banco WHERE agencia = :agencia AND conta = :conta AND digito = :digito AND senha = :senha";
        $sql = $pdo->prepare($sql);
        $sql->bindValue( ":agencia", $_POST['pAgencia'] );
        $sql->bindValue( ":conta", $_POST['pConta'] );
        $sql->bindValue( ":digito", $_POST['pDigito'] );
        $sql->bindValue( ":senha", md5($_POST['pSenha']) );
        $sql->execute();
        if( $sql->rowCount() > 0 ){
            $sql = $sql->fetch();
            $_SESSION['usuario']['conta'] = $sql;
            header("Location: index.php");
        }else{
            header("Location: login.html");
        }
     }else{
        header("Location: login.html");
     }
?>
