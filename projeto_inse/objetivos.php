<?php include("includes/session.php");?>
<?php 
	include('server.php');
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
								<form method="post" action="objetivos.php?plano_estrategico=<?php echo $_GET['plano_estrategico']?>">
								<!--<?php include('errors.php'); ?>-->
							  	<?php listarObjetivos()?>
								<hr>
									<div class="input-group">
										<button type="submit" class="button" name="reg_objetivo">Salvar</button>
									</div>
								<hr>
							  </form>
							</section>
						</div>
					</div>
				</div>
			</div>
<?php  include("includes/footer.php");?>