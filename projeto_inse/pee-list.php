<?php include("includes/session.php");?>
<?php include("includes/header.php");?>
<?php include("server.php");?>
<?php include("includes/navegation.php");?>

<!-- Main -->



		<div id="main" class="wrapper style4">
				<div class="container">
					<div class="row">
						<!-- Content -->
						<div id="content" class="8u skel-cell-important">
							<section>
								<header class="major">
									<?php if(possuiPEECriado() == 0) : ?>
										<div align="right"><a href="identidade.php?plano_estrategico=new">Clique aqui para criar o seu primeiro Plano Estratégico</a></div>
									<!-- Mostrar lista de PEE's criados da empresa -->
									<?php else : ?>
										<?php listarPEEs()?>
										<div align="center"><a href="identidade.php?plano_estrategico=new">Novo Plano Estratégico</a></div>
									<?php endif ?>
								</header>
							</section>
						</div>
					</div>
				</div>
			</div>

<script>
$(document).ready(function(){

	$('.removerPlano').click(function(){
		var x = $(this).attr("id");
		$.ajax({
			type: "POST",
			url: "includes/functions.php",
			data: { removerPlano: x}});
		//$('#teste').append(x);
		//$('#teste').load();
	})

});
</script>

<?php include("includes/footer.php");?>