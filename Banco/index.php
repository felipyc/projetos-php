<?php

    session_start();

    require_once("conecta.php");

    if( $_SESSION['usuario']['conta'] != NULL ){

      if( !empty($_POST['pConta']) AND !empty($_POST['pValor'])  ){
        //proteção temporária
        if( $_POST['pValor'] < 0 ){
            $_POST['pValor'] = -1 * $_POST['pValor'];
        }
        //verifica se conta a ser enviada existe e já pega o saldo dela
        $sql = "SELECT saldo FROM banco where conta  = :para";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(":para", $_POST['pConta']);
        $sql->execute();
        $saldoDeQuemRecebeu = $sql->fetch();
        if( $sql->rowCount() > 0 ){
            //Inserindo no historico de transações
            $sql = "INSERT INTO historicobanco VALUES (default, :de, :para, :tipo, :valor, now())";
            $sql = $pdo->prepare($sql);
            $sql->bindvalue(":de", $_SESSION['usuario']['conta']['conta']);
            $sql->bindvalue(":para", $_POST['pConta']);
            $sql->bindvalue(":tipo", 1);
            $sql->bindvalue(":valor", $_POST['pValor']);
            $sql->execute();
            //Atualizando conta de quem enviou
            $sql = "UPDATE banco set saldo = :saldo where conta  = :de";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":saldo", $_SESSION['usuario']['conta']['saldo'] - $_POST['pValor']);
            $sql->bindValue(":de", $_SESSION['usuario']['conta']['conta']);
            $sql->execute();
            //Atualizando conta de quem recebeu
            $sql = "UPDATE banco set saldo = :saldo where conta  = :para";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":saldo", $saldoDeQuemRecebeu['saldo'] + $_POST['pValor']);
            $sql->bindValue(":para", $_POST['pConta']);
            $sql->execute();
        }
      }
      //Atualizando informações do usuário logado
      $sql = "SELECT * FROM banco WHERE id = :id";
      $sql = $pdo->prepare($sql);
      $sql->bindValue( ":id", $_SESSION['usuario']['conta']['id'] );
      $sql->execute();
      $sql = $sql->fetch();
      $_SESSION['usuario']['conta'] = $sql;
      //pegando novo historico de atualizações do usuário
      $sql = "SELECT * FROM historicobanco WHERE de = :conta OR para = :conta";
      $sql = $pdo->prepare($sql);
      $sql->bindValue(":conta", $_SESSION['usuario']['conta']['conta']);
      $sql->execute();
      $sql = $sql->fetchAll();
      $_SESSION['usuario']['historico'] = $sql;
    }else{
      header("Location: login.html");
    }

?>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  </head>
  <body>
  
    <div class="container-fluid bg-dark">
        <div class="container">
            <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Banco Einsten</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="sair.php">Sair</a>
                </li>
                </ul>
            </div>
            </nav>
        </div>
    </div>
    
  <div class="container p-0">
        <!-- PARTE 1 -->
        <!-- <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
          <a class="navbar-brand" href="#">Banco Einsten</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="sair.php">Sair</a>
              </li>
            </ul>
          </div>
        </nav> -->
        <!-- PARTE 2: NOME DO USUÁRIO LOGADO -->
        <div class="my-3">
            <h1 class="text-center"  style="font-size: 25px;">
                <?php
                    echo "Bem vindo(a) ".$_SESSION['usuario']['conta']['titular'];
                ?>
            </h1>
        </div>
        <!-- PARTE 3: SALDO DO USUÁRIO LOGADO -->
        <div class="my-3">
            <h1 class="text-center"  style="font-size: 20px;">
                Saldo:<br>
                <?php
                    echo "R$ ".$_SESSION['usuario']['conta']['saldo'].",00";
                ?>
            </h1>
        </div>
        <!-- PARTE 4: FUNCIONALIDADE FAZER TRANSAÇÃO E HISTORICO DE TRANSACOES -->
        <div class="row m-0">
          <!-- FAZER TRANSACAO -->
          <div class="col-12 col-lg-6">
            <h1 class="text-center " style="font-size: 20px;">Fazer Transação</h1>  
            <form method="post" class="text-center">
              <div class="form-group">  
                <input type="number" class="form-control" placeholder="Conta a ser enviada." name="pConta"><br>
              </div>
              <div class="form-group">
                <label class="sr-only" for="parte4_input_valor">Valor a ser transferido</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">R$</div>
                  </div>
                  <input type="number" class="form-control" id="parte4_input_valor" placeholder="Valor a ser transferido" name="pValor">
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
          </div>
          <!-- MOSTRA HISTORICO DE TRANSACOES -->
          <div class="col-12 col-lg-6">
            <h1 class="text-center" style="font-size: 20px;">Histórico de transações:</h1>
            <form action="">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Inicio:</span>
                    </div>
                    <input type="date" class="form-control" placeholder="data" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Fim:</span>
                    </div>
                    <input type="date" class="form-control" placeholder="data" aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </form>
            <div class="table-responsive-sm">
                <table class="table table-striped table-sm table-hover p-0">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">De</th>
                            <th scope="col">Para</th>
                            <th scope="col">Tipo da operação</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Data</th>
                        </tr>
                    </thead>
                    <tbody style="">
                        <?php
                            $contador = 1;
                            foreach( $_SESSION['usuario']['historico'] as $historico ){
                                echo "
                                    <tr>
                                        <th scope='row'>".$contador."</th>
                                        <td style='word-break: break-all;'>".$historico['de']."</td>
                                        <td style='word-break: break-all;'>".$historico['para']."</td>
                                        <td style='word-break: break-all;'>". (($historico['tipo'])?"Depósito":"Retirada") ."</td>
                                        <td style='word-break: break-all;'>".$historico['valor']."</td>
                                        <td style='word-break: break-all;'>".date('d/m/Y H:i', strtotime($historico['data_operacao']))."</td>
                                    </tr>    
                                ";
                                $contador++;
                            }
                        ?>
                    </tbody>
                </table>
            </div>
          </div>
        </div>
        <!-- PARTE 5 -->
        <div style="height: 2000px;width: 100%;">
             
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
