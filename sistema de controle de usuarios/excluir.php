<?php
    require "config.php";

    if(isset($_GET['id']) && !empty($_GET['id'])){

        $id = addslashes($_GET['id']);

        $sql = "DELETE FROM sistema WHERE id = :id ";

        $sql = $pdo->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        header('Location: index.php');

    }else{
        header('Location: index.php');
    }

?>


