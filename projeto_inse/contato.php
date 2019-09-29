<?php include("includes/session.php");?>
<?php include("includes/header.php");?>
<?php include("includes/navegation.php");?>
<?php include("server.php");?>

<div id="main" class="wrapper style4">

				<!-- Content -->
				<div id="content" class="container2 extrasmall">
					<section>
						<header class="major">
							<h2 class="welcome">Converse com a gente!</h2>
						</header>
								<form method="post" action="">
							  	<!--<?php include('errors.php'); ?>-->
								  <div class="input-group">
							  		<label>Digite seu nome</label>
							  		<input type="text" name="nome">
							  	</div>
							  	<div class="input-group">
							  		<label>Digite seu email</label>
							  		<input type="email" name="emailcontato">
							  	</div>
								<div class="input-group">
							  		<label>Digite sua mensagem</label>
							  		<textarea maxlength='500' value='new'></textarea>
							  	</div>
							  	<hr>
							  	<div class="input-group">
							  		<button type="submit" class="button" name="">Enviar</button>
								  </div>
							  	<hr>
							  </form>						
					</section>
				</div>
			</div>

		
<?php  include("includes/footer.php");?>