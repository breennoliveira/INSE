<?php include("includes/session.php");?>
<?php include("includes/header.php");?>
<?php include("includes/navegation.php");?>
<?php include("server.php");?>

<!-- Main -->
	<div id="main" class="wrapper style4">
			<div id="content" class="container2 small">
				<header class="major">
					<h2 class="welcome">Bem vindo <?php echo $_SESSION['nomefantasia'] ?>!</h2>
				<?php if(possuiPEECriado() == 0) : ?>
					<span class="byline welcome">Você ainda não possui nenhum Plano Estratégico</span>
				</header>
					<div align="center"><a href="identidade.php?plano_estrategico=new">Clique aqui para criar o seu primeiro Plano Estratégico</a></div>
				<!-- Mostrar lista de PEE's criados da empresa -->
				<?php else : ?>
				</header>
					<?php listarPEEs()?>
					<div align="center"><a href="identidade.php?plano_estrategico=new">Novo Plano Estratégico</a></div>
				<?php endif ?>
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