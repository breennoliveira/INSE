<?php 
  session_start(); 

  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['razaosocial']);
  	header("location: login.php");
  }
?>

<?php 
	include('server.php')
?>
<?php include("includes/header.php");?>
<?php include("includes/navegation.php");?>


<!-- Main -->

			<div id="main" class="wrapper style4">
				<div class="container">
					<div class="row">
						<?php include("includes/sidebar.php");?>
						<!-- Content -->
						<div id="content" class="8u skel-cell-important">
							<section>
								<header class="major">
									<h2>Objetivos</h2>
									<span class="byline">Utilize o formulário abaixo para cadastrar os objetivos presentes no plano estratégico empresarial.</span>
								</header>
								<form method="post" action="objetivos.php">
								<!--<?php include('errors.php'); ?>-->
							  	<div class="input-group">
							  		<label>Objetivo.</label>
							  		<textarea name="objetivo1" style="resize: none;"></textarea>
							  	</div>
							  	<div class="input-group">
							  		<label>Objetivo.</label>
							  		<textarea name="objetivo2" style="resize: none;"></textarea>
							  	</div>
							  	<div class="input-group">
							  		<label>Objetivo.</label>
							  		<textarea name="objetivo3" style="resize: none;"></textarea>
							  	</div>
							  	<hr>
							  	<div class="input-group">
							  		<button type="submit" class="button" name="">Salvar</button>
							  	</div>
							  	<hr>
							  </form>
							</section>
						</div>
					</div>
				</div>
			</div>
<?php  include("includes/footer.php");?>