<?php include("includes/session.php");?>
<?php include("includes/header.php");?>
<?php include("includes/navegation.php");?>
<?php include("server.php");?>

<!-- Main -->
	<div id="main" class="wrapper style4">
		<div class="row">
			<?php include("includes/planos_sidebar.php");?>
				<div id="content" class="container2 small" style="margin-left: 80px;">
				<header class="major">
					<h2 class="welcome">PLANOS ESTRATÉGICOS</h2><hr>
				<?php if(possuiPEECriado() == 0) : ?>
					<span class="byline welcome">Você ainda não possui nenhum Plano Estratégico</span>
				</header>
					<div align="center"><a href="identidade.php?plano_estrategico=new">Clique aqui para criar o seu primeiro Plano Estratégico</a></div>
				<!-- Mostrar lista de PEE's criados da empresa -->
				<?php else : ?>
				</header>
					<?php listarPEEs()?>
					<?php endif ?>
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
			data: {"removerPlano": x},
			success:function(data){
				console.log('success');
				console.log(data)},
			error:function(){
				console.log('failed');
			}
			});
		window.location.reload();
		//$('#teste').append(x);
		//$('#teste').load();
	});

});
</script>

<?php include("includes/footer.php");?>