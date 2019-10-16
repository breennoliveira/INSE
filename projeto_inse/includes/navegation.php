						<!-- Nav -->
							<nav id="nav">
								<ul>
									<li class="active"><a href="index.php">Home</a></li>
									<?php if (!isset($_SESSION['nomefantasia'])) : ?>
									<li><a href="register.php">Criar conta</a></li>
									<li><a href="login.php">Login</a></li>
									<?php endif ?>
									<li><a href="contato.php">Contato</a></li>
									<li><a href="pesquisa.php">Pesquisa</a></li>
									<!-- logged in user information -->
									<?php  if (isset($_SESSION['nomefantasia'])) : ?>
									    <li><a href="pee-list.php">Meus PEEs</a></li>
										<li><a href="empresa_inicio.php"><?php echo $_SESSION['nomefantasia']?></a></li>
									    <li><a href="index.php?logout='1'" style="color: red;"> Sair</a></li>
									<?php endif ?>
								</ul>
							</nav>
					</div>
				</div>