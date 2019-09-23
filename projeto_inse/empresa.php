<?php include("includes/session.php");?>
<?php include("includes/header.php");?>
<?php include("includes/navegation.php");?>
<?php include("server.php");?>

<div id="main" class="wrapper style4">

				<!-- Content -->
				<div id="content" class="container">
					<section>
						<header class="major">
							<h2>Bem vindo <?php echo $_SESSION['nomefantasia'] ?>!</h2>
							<span class="byline"></span>
								<hr>
								Abaixo você pode alterar o cadastro da sua empresa.
								<hr>
								<form method="post" action="empresa.php">
									<?php include('errors.php'); ?>
									<?php listarEmpresa();
									$ramo = utf8_encode(getRamo());?>
									<hr>
								</form>
						</header>
					</section>
				</div>
</div>
<script type="text/javascript">
				document.getElementById('ramo').value = "<?php echo $ramo ?>";
</script>

<?php  include("includes/footer.php");?>