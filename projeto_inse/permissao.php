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
							<span class="byline">Abaixo você pode alterar as permissões do grupo.</span>
							<hr>
								<form method="post" action="permissao.php?idgrupo=<?php echo $_GET['idgrupo']?>">
									<?php include('errors.php'); ?>
									<?php listarPermissao();
									//$funcionalidade = utf8_encode(getFuncionalidade($_GET['idpermissao']));?>
									<hr>
								</form>
						</header>
					</section>
				</div>
</div>
<script type="text/javascript">
				
</script>

<?php  include("includes/footer.php");?>