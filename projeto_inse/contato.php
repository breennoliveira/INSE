<?php include("includes/session.php");?>
<?php include("includes/header.php");?>
<?php include("includes/navegation.php");?>
<div id="main" class="wrapper style4">

				<!-- Content -->
				<div id="content" class="container">
					<section>
						<header class="major">
							<h2>Converse com a gente!</h2>
							<span class="byline"></span>
							<hr>
								<form method="post" action="">
							  	<!--<?php include('errors.php'); ?>-->
								  <div class="input-group">
							  		<label>Digite seu nome</label>
							  		<input type="text" name="nome" style="width: 50%;" >
							  	</div>
							  	<div class="input-group">
							  		<label>Digite seu email</label>
							  		<input type="email" name="emailcontato">
							  	</div>
								<div class="input-group">
							  		<label>Digite sua mensagem</label>
							  		<textarea maxlength='500' value='new' style='width: 50%; resize: none;'></textarea>
							  	</div>
							  	<hr>
							  	<div class="input-group">
							  		<button type="submit" class="button" name="">Enviar</button>
								  </div>
							  	<hr>
							  </form>
						</header>
						
					</section>
				</div>
			</div>

		
<?php  include("includes/footer.php");?>