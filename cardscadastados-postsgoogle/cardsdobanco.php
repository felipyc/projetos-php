<html>
	<head>
		<meta charset="utf-8">
		<style>
			*{
				box-sizing: border-box;
				font-family: sans-serif;
			}
			body{
				margin: 0;
				padding: 0;
			}
			
			#limitador{
				position: relative;
				max-width: 1205px;
				
				margin: auto;
				
				background-color: #a8a39a;
			}
			
				#menuEsquerda{
					position: fixed;
					
					
					width: 300px;
					height: 100vh;
					
					
					padding: 10px;
					border:2px solid#f2f2f2;
					background-color: white; 
				}
				
				#menuEscolhido{
					
					
					margin-left: 305px;
					
					border:2px solid #f2f2f2;
				}
					#menuETitulo{
						height: 100px;
						
						background-color: white; 
						
						line-height: 100px;
						text-align: center;
					}
					#menuECorpo{
						
						border-top: 2px solid #f2f2f2;
						background-color: #d0ddb3;
					}
						.menuECCards{
							float: left;
							width: 300px;
							
							margin: 5px;
							
							border: 2px solid #dde8c9;
							background-color: white;
							
						}
							#menuECCInfo{
								padding: 5px;
								background-color: black;
								color: white;
								font-weight: bold;
							}
							
							#menuECCH{
								height: 150px;
								padding-top: 30px;
								background-color: #fff6d1;
								text-align: center;
							}
								#menuECCH img{
									border-radius: 50px;
									
								}
							
							#menuECCB{
								padding: 5px;
							}
		</style>
	</head>
	<body>
		<div id="limitador">
			<div id="menuEsquerda">
				awd
			</div>
			<div id="menuEscolhido">
				<div id="menuETitulo">
						TITULO DO CONTEUDO
				</div>
				<div id="menuECorpo">
					<!-- CRIANDO CARDS COM PHP E COLOCANDO INFORMAÇÕES DO BANCO DE DADOS -->
					<?php
						
						//Validação caso o acesso ao banco de dados de errado
						
						try{
							
							//Conexão com banco de dados
							
							$hostname = '127.0.0.1';
							$username = 'root';
							$password = '';
							$database = 'cadastro';
							
							$pdo = new PDO("mysql:host=$hostname;dbname=$database;charset=utf8", $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
							
							//Fazendo requisão para o banco de dados
							
							$sql = "SELECT * FROM gafanhotos";
							$sql = $pdo->query($sql);
							
							//Validação para caso o objeto esteja vazio
							
							if($sql->rowCount() > 0){
								//var_dump($sql);não funciona sem fetchALL
								//fetchALL tem haver com orientado a objetos, ele pega $sql que é um objeto e transforma em array de array
								$registro = 1;
								foreach($sql->fetchAll() as $usuario){
									if($usuario['sexo'] == 'M'){
										$srcImg = 'user-male.png';
									}else{
										$srcImg = 'user-fem.png';
									}
									echo "
											<div class='menuECCards'>
												<div id='menuECCInfo'>
													Usuário: $registro
												</div>
												<div id='menuECCH'>
													<img src='_img/$srcImg' alt='' style='width: 100px;height: 100px;'>
												</div>
												<div id='menuECCB'>
													<div>Nome: ".$usuario['nome']."</div>
													<div>Profissao: ".$usuario['profissao']."</div>
													<div>Nascimento: ".$usuario['nascimento']."</div>
													<div>Sexo: ".$usuario['sexo']."</div>
													<div>Peso: ".$usuario['peso']."</div>
													<div>Altura: ".$usuario['altura']."</div>
													<div>Nacionalidade: ".$usuario['nacionalidade']."</div>
												</div>
											</div>
										";
									
									$registro++;
								}

							}else{
								echo "NÃO há usuários cadastrados";
							}
							
						}catch (PDOException $e){
							echo "Falhou a entrada no banco de dados: ". $e->getMessage();  
						}
						
					?>
					<div style="clear: both;">
					</div>
				</div>
				<div style="clear: both;">
				</div>
			</div>
		<div>
	</body>
</hmtl>