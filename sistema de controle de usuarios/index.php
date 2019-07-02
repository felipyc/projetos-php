<?php
    require 'config.php';
?>

<html lang="pt-br">
	<head>
		<meta charset="utf8">
		<style>
			/*  */
            table#tabela{
				width: 100%;
			}
				#tabela_cabecalho td{
					text-align: center;
				}
				tr.tabela_corpo td{
					padding: 10px;
				}
				.tabela_corpo:nth-child(even){
					background-color: #ff927a;
				}
				.tabela_corpo:nth-child(odd){
					background-color: #f7fcbd;
				}
				tr.tabela_corpo td a{
					text-decoration: none;
					color: black;
				}
					
		</style>
	</head>
	<body>
		<div>
			<button type="button"><a href="adicionar.php">Adicionar Novo Usuário</a></button>
		</div>
		<div>
			<table id="tabela">
				<tr id="tabela_cabecalho">
					<td>Nome</td>
					<td>E-mail</td>
					<td>Ações</td>
				</tr>

				<!-- Query para mostrar os usuários -->
                <?php
					$sql = "SELECT * FROM sistema";
					$sql = $pdo->query($sql);

					if($sql->rowCount() > 0){
						
						foreach($sql->fetchAll() as $usuario){
							echo "<tr class='tabela_corpo'>";
								echo "<td>".$usuario['nome']."</td>";
								echo "<td>".$usuario['email']."</td>";
								echo "<td>
											<a href='editar.php?id=".$usuario['id']."'>Editar</a>
											- 
											<a href='excluir.php?id=".$usuario['id']."'>Excluir</a>
									</td>";
							echo "</tr>";
						}

					}else{

					}
                ?>
			</table>
		</div>
	</body>
</html>