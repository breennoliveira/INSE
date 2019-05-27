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
									<li><a href="register.php">Criar conta</a></li>
									<li><a href="login.php">Login</a></li>
									<li><a href="">Contato</a></li>
									<li>
										<!-- logged in user information -->
									    <?php  if (isset($_SESSION['razaosocial'])) : ?>
									    	<!--<p><strong><?php echo $_SESSION['razaosocial']?></strong></p>-->
									    	<a href="empresa.php">Empresa </a>&nbsp
									    	<a href="index.php?logout='1'" style="color: red;"> Sair</a>
									    <?php endif ?>
									</li>
								</ul>
							</nav>
	
					</div>
				</div>