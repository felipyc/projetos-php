<html>
	<head>
		<meta charset="utf8">
		<style>
			*{
				box-sizing: border-box;
				font-family: sans-serif;
			}
			
			#pesquisaData{
				
			}
				#pesquisaData button{
					border: none;
					padding: 5px;
					
				}
			
			section{
				max-width: 1000px;
				margin: auto;
			}
				.news{
					height: 150px;
					
					clear: both;
					
					margin: 10px 0;
					padding: 5px 5px;
					border-radius: 10px;
					
				}
					.newsImage{
						float: left;
						
					}
					.newsInfo{
						min-width: 200px;
						margin-left: 100px;
						padding: 5px;
						
					}
						.newsInfo h1,.newsInfo h2,.newsInfo p{
							margin: 0;
							padding: 0;
							font-weight: 100;
							font-size: 15px;
						}	
							.newsInfo a{
								text-decoration: none;
							}
							span.newsAutor, span.newsAutor a{
								color: green;
							}
						.newsInfo p{
							color: gray;
						}
		</style>
	</head>
	<body>
		<div id="pesquisaData" style="text-align: center;">
			<form method="get">
				Escolha a data:
				<input type="date" name="dataHoraNoticia">
				<button type="submit">Enviar</button>
			</form>
		</div>
		<section>
			
			<?php
				try{
					
					$hostname = '127.0.0.1';
					$username = 'root';
					$password = '';
					$database = 'cadastro';
					
					$pdo = new PDO("mysql:host=$hostname;dbname=$database;charset=utf8", $username,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
					
					if(!empty($_GET['dataHoraNoticia'])){
						$dataNoticia = " WHERE data LIKE '".$_GET['dataHoraNoticia']."%';";
						$sql = "SELECT * FROM posts".$dataNoticia;
					}else{
						$sql = "SELECT * FROM posts;";
					}
					
					$sql = $pdo->query($sql);
					
					if($sql->rowCount() > 0){
						
						foreach($sql->fetchAll() as $posts){
							
							echo "
								<article>
									<div class='news'>
										<div  class='newsImage'>
											<img src='_img/".$posts['imgsrc']."' alt='' style='width: 100px;height: 100px;'>
										</div>
										<div  class='newsInfo'>
											<h1><a href=''>".$posts['titulo']."</a></h1>
											<h2><span class='newsAutor'>Autor: <a href=''>".$posts['autor']."</a></span> - ".$posts['data']."</h2>
											<p>".$posts['descricao']."</p>
										</div>
									</div>
								</article>
							";
							
						}
						
					}else{
						echo "NÃO há usuários cadastrados";
					}
					
				}catch(PDOException $e){
					echo "Falhou a entrada no banco de dados: ". $e->getMessage();
				}
			?>
			
		</section>
	</body>
</hmtl>