<?php include("includes/session.php");?>
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
									<h2>Identidade Organizacional</h2>
									<span class="byline">Utilize o formulário abaixo para cadastrar os dados da empresa, como a visão, a missão e os valores organizacionais.</span>
								</header>
								<form method="post" action="identidade.php?plano_estrategico=<?php echo $_GET['plano_estrategico']?>">
								<?php include('errors.php');
								listarIdentidade()?>
							  	<!--<div class="input-group">
							  		<label>Visão da empresa.</label> 
							  		<textarea name="visao" style="resize: none;"><?php echo (isset($_POST['visao']) ? $_POST['visao'] : '')?></textarea>
							  	</div>
							  	<div class="input-group">
							  		<label>Missão da empresa.</label>
							  		<textarea name="missao" style="resize: none;"><?php echo (isset($_POST['missao']) ? $_POST['missao'] : '')?></textarea>
							  	</div>
							  	<div class="input-group">
							  		<label>Valores da empresa.</label>
							  		<textarea name="valores" style="resize: none;"><?php echo (isset($_POST['missao']) ? $_POST['missao'] : '')?></textarea>
							  	</div>-->
							  	<hr>
							  	<div class="input-group">
							  		<button type="submit" class="button" name="reg_indentidade">Salvar</button>
							  	</div>
							  	<hr>
							  </form>
							</section>
						</div>
					</div>
				</div>
			</div>
<?php  include("includes/footer.php");?>