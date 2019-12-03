<?php include("includes/session.php");?>
<?php include("includes/blocker.php");?>
<?php include("includes/header.php");?>
<?php include("includes/navegation.php");?>
<?php include("server.php");?>

<!-- Main -->

			<div id="main" class="wrapper style4">
				<div class="container2">
					<div class="row">
						<?php include("includes/sidebar.php");?>
						<!-- Content -->
						<div id="content" class="8u skel-cell-important">
							<section>
								<header class="major">
									<h2><a href="objetivos.php?plano_estrategico=<?php echo $_GET['plano_estrategico']?>"><input class="voltar" type="image" alt="Voltar" title="Voltar" src="images/Voltar.png"></input></a>Metas</h2>
									<span class="byline">Utilize o formulário abaixo para cadastrar as metas relacionadas ao seguinte objetivo:</span>
								</header>
								<form method='post' name='reg_meta'>
									<?php include('errors.php'); ?>
							  		<?php listarMetas($_GET['objetivo'])?>
									<div class="clearfix">
										<input type="button" class="button small" id="add_meta" value="Nova Meta"></input>
									</div>
									<hr>
										<div>
											<button type="submit" class="button alt" name="reg_meta">Salvar</button>
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

	$('#add_meta').click(function(e){
		e.preventDefault();

		//$('.metas_input').append("<div><label>Objetivo</label><textarea maxlength='255' rows='3' name='meta[]' value='new' style='resize: none;'></textarea><input type='hidden' name='metid[]' value='new'></input><button type='button' class='button small remove' id='new'>Remove</a></div>");

		$('.metas_input').append("<table><th class='left' width='100%'>Meta</th><th>Data limite</th><tr><td class='left'><input type='text' maxlength='255' name='meta[]' placeholder='Insira uma Meta aqui'></input><button type='button' class='button small remove' id='new'>Remover</button></td><td><input type='date' name='data_limite[]' value='new'></input><input type='hidden' name='metid[]' value='new'></input></td></tr></table>");
		//var_dump($_GET);
	});

	$('.metas_input').on("click",".button.small.remove", function(e){ //user click on remove text links
        e.preventDefault();
		//$(this).parent('div').remove();
		$(this).closest('table').remove();
		//$('#uau_objetivo').submit();
		var x = $(this).attr("id");
		$.ajax({
          url: "includes/functions.php",
		  data: { removerMeta: x },
          type: "POST"});
		//$('.objetivos_input').append(x);
		

    });

});
</script>

<?php  include("includes/footer.php");?>