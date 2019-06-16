<?php include("includes/session.php");?>
<?php include("includes/header.php");?>
<?php include("server.php");?>
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
									<h2>Objetivos</h2>
									<span class="byline">Utilize o formulário abaixo para cadastrar os objetivos presentes no plano estratégico empresarial.</span>
								</header>
								<form method="post" id="uau_objetivo" name="reg_objetivo" action="objetivos.php?plano_estrategico=<?php echo $_GET['plano_estrategico']?>">
								<?php include('errors.php'); ?>
							  	<?php listarObjetivos()?>
								<br>
								<div class="input-group" align="right">
										<input type="button" class="small" id="add_objetivo" value="Novo Objetivo"></input>
								</div>
								<hr>
									<div class="input-group">
										<button type="submit" class="button" name="reg_objetivo">Salvar</button>
									</div>
								<hr>
							  </form>
							</section>
						</div>
					</div>
				</div>
			</div>
<script>
$(document).ready(function(){
	var x = 1;
	$('#add_objetivo').click(function(e){
		e.preventDefault();
		x++;
		$('.objetivos_input').append("<div><br><label>Objetivo</label><textarea name='objetivo[]' maxlength='255' value='new' style='resize: none;'></textarea><input type='hidden' name='id[]' value='new'></input><a href='#' class='remove_field' id='new' style='margin-left:10px;'>Remover</a></div>");
		//var_dump($_GET);
	});

	$('.objetivos_input').on("click",".remove_field", function(e){ //user click on remove text links
        e.preventDefault();
		$(this).parent('div').remove();
		//$('#uau_objetivo').submit();
		var x = $(this).attr("id");
		$.ajax({
          url: "includes/functions.php",
		  data: { removerObjetivo: x },
          type: "POST"});
		//$('.objetivos_input').append(x);
		
		x--;
    });

});
</script>

<?php  include("includes/footer.php");?>