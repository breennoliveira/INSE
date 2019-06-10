						<!-- Nav -->
							<nav id="nav">
								<ul>
									<li class="active"><a href="index.php">Home</a></li>
									<!--<li>
										<a href="">Dropdown</a>
										<ul>
											<li><a href="#">Lorem ipsum dolor</a></li>
											<li><a href="#">Magna phasellus</a></li>
											<li><a href="#">Etiam dolore nisl</a></li>
											<li>
												<a href="">Phasellus consequat</a>
												<ul>
													<li><a href="#">Lorem ipsum dolor</a></li>
													<li><a href="#">Phasellus consequat</a></li>
													<li><a href="#">Magna phasellus</a></li>
													<li><a href="#">Etiam dolore nisl</a></li>
													<li><a href="#">Veroeros feugiat</a></li>
												</ul>
											</li>
											<li><a href="#">Veroeros feugiat</a></li>
										</ul>
									</li>!-->
									<?php if (!isset($_SESSION['nomefantasia'])) : ?>
									<li><a href="register.php">Criar conta</a></li>
									<li><a href="login.php">Login</a></li>
									<?php endif ?>
									<li><a href="">Contato</a></li>
									<!-- logged in user information -->
									<?php  if (isset($_SESSION['nomefantasia'])) : ?>
									    <li><a href="pee-list.php">Meus PEEs</a></li>
										<li><a href="empresa.php"><?php echo $_SESSION['nomefantasia']?></a></li>
									    <li><a href="index.php?logout='1'" style="color: red;"> Sair</a></li>
									<?php endif ?>
								</ul>
							</nav>
	
					</div>
				</div>