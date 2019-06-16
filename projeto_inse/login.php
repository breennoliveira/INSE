<?php include("includes/header.php");?>
<?php include("includes/navegation.php");?>
<?php include("server.php");?>

<div id="main" class="wrapper style4">

				<!-- Content -->
				<div id="content" class="container">
					<section>
						<header class="major">
							<h2>Faça seu login</h2>
							<span class="byline">Já possui uma conta? Faça o login!</span>
							<hr>
								<form method="post" action="login.php">
							  	<?php include('errors.php'); ?>
								  <div class="input-group">
							  		<label>Digite seu email</label>
							  		<input type="email" name="email" >
							  	</div>
							  	<div class="input-group">
							  		<label>Digite sua senha</label>
							  		<input type="password" name="senha">
							  	</div>
							  	<hr>
							  	<div class="input-group">
							  		<button type="submit" class="button" name="login_user">Login</button>
								  </div>
							  	<hr>
							  	<p>
							  		Ainda não possui cadastro? <a href="register.php">Clique aqui</a>
							  	</p>
							  </form>
						</header>
						
					</section>
				</div>
			</div>

		
<?php  include("includes/footer.php");?>