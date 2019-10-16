						<!-- Sidebar -->
						<div id="sidebar" class="2u">
							<section>
								<header class="major">
									<h2>Menu</h2>
								</header>	
								<ul class="default">

								    <?php

									$db = mysqli_connect('localhost', 'root', '', 'inse');	
									$stmt = mysqli_prepare($db, "SELECT p.funcionalidade FROM usuario AS u INNER JOIN grupo AS g on u.grupo = g.id INNER JOIN permissao AS p on p.grupo = g.id WHERE u.id = ? ");
									mysqli_stmt_bind_param($stmt, "i", $_SESSION['idusuario']);
									mysqli_stmt_execute($stmt);
									$result = mysqli_stmt_get_result($stmt);
									$row = array();
																	
									while($row = $result->fetch_array(MYSQLI_NUM))
									{
										        foreach ($row as $r)
												{
														if ($r == 4)
														{
															echo '<li><a href="identidade.php?plano_estrategico=new">Novo Plano Estrategico</a></li>';
											
														}
												}												
									}
									?>									
								</ul>
							</section>
						</div>
