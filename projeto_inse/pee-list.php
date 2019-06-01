<?php
  session_start(); 

  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['razaosocial']);
	unset($_SESSION['idempresa']);
  	header("location: login.php");
  }
?>
<?php include("includes/header.php");?>
<?php include("includes/navegation.php");?>
<?php require "includes/functions.php"; ?>

<!-- Main -->

<div id="main" class="wrapper style4">
	<div class="container">
		<div class="row">
			<!-- Content -->
			<div id="content" class="8u skel-cell-important">
				<section>
					<header class="major">
						<?php if(possuiPEECriado() == 0) : ?>
							<p><a href="empresa.php">Clique aqui para criar o seu primeiro Plano Estrategico</a></p>
						<!-- Mostrar lista de PEE's criados da empresa -->
						<?php else : ?>						
							<?php listarPEEs() ?>

						<?php endif ?>
					</header>
				</section>
			</div>
		</div>
	</div>
</div>


<?php include("includes/footer.php");?>