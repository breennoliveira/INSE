<?php include("includes/session.php");?>
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
							<p><a href="identidade.php?plano_estrategico=new">Clique aqui para criar o seu primeiro Plano Estrategico</a></p>
						<!-- Mostrar lista de PEE's criados da empresa -->
						<?php else : ?>
							<?php listarPEEs()?>
							<p><a href="identidade.php?plano_estrategico=new">Novo Plano Estrategico</a></p>
						<?php endif ?>
					</header>
				</section>
			</div>
		</div>
	</div>
</div>


<?php include("includes/footer.php");?>