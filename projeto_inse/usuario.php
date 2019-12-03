<?php include("includes/session.php");?>
<?php include("includes/blocker.php");?>
<?php include("includes/header.php");?>
<?php include("includes/navegation.php");?>
<?php include("server.php");?>

<div id="main" class="wrapper style4">

				<!-- Content -->
				<div id="content" class="container2 extrasmall" >
					<section>
						<header class="major">
							<h2 class="welcome">Bem vindo <?php echo $_SESSION['nomefantasia'] ?>!</h2>
							<span class="byline"></span>
								<hr>
								Abaixo você pode alterar dados cadastrais.
								<hr>
								<form method="post" action="usuario.php?idusuario=<?php echo $_GET['idusuario']?>">
									<?php include('errors.php'); ?>
									<?php listarUsuario();
									$grupo = utf8_encode(getGrupo($_GET['idusuario']));?>
									<hr>
								</form>
						</header>
					</section>
				</div>
</div>
<script type="text/javascript">
				document.getElementById('grupo').value = "<?php echo $grupo ?>";
</script>



<?php  include("includes/footer.php");?>