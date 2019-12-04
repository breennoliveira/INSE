<?php include("includes/session.php");?>
<?php include("includes/blocker.php");?>
<?php include("includes/header.php");?>
<?php include("includes/navegation.php");?>
<?php include("server.php");?>
<script src="js/xepOnline.jqPlugin.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<!-- Main -->

			<div id="main" class="wrapper style4">
				<div class="container2">
					<div class="row">
						<?php include("includes/sidebar.php");?>
						<!-- Content -->
						<div id="content" class="8u skel-cell-important">
							<section>
								<?php include('errors.php'); ?>
							  	<?php $counter = listarResumo(); ?>
								<hr>
									<button id="publicar" name="publicar" class="button alt">Publicar</button>
									<button id="print_resumo" name="print_resumo" class="button alt">Download</button>
								<hr>
							</section>
						</div>
					</div>
				</div>
			</div>

<script>
$(document).ready(function(){

	$('#publicar').click(function(e){
		var x = "<?php echo $_GET['plano_estrategico'] ?>";  // Passa o id do plano estrategico, nao estava conseguindo acessar pelo functions.php
		var idempresa = "<?php echo $_SESSION['idempresa'] ?>";
		$.ajax({
          url: "includes/functions.php",
		  data: { publicar_pee: x,
				  idempresa: idempresa},
          type: "POST",
		  success:function(data){
				console.log('success');
				console.log(data)},
			error:function(){
				console.log('failed');
			}
			});
	});

	$('#print_resumo').click(function(e){
		xepOnline.Formatter.Format('resumo', {
			render: "newin",
			pageWidth: "11in",
			pageHeight: "8.5in",
			pageMargin: ".25in"});
	});

});
</script>

<?php  include("includes/footer.php");?>