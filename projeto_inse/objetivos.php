<?php include("includes/session.php");?>
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
									<h2>Objetivos</h2>
									<span class="byline">Utilize o formulário abaixo para cadastrar os objetivos presentes no plano estratégico empresarial.</span>
								</header>
								<form method='post' name='reg_objetivo'>
									<?php include('errors.php'); calcularIndicadores();?>
							  		<?php $i = listarObjetivosnew()?>
									<div class="clearfix">
										<input type="button" class="button small" id="add_objetivo" value="Novo Objetivo"></input>
									</div>
									<hr>
										<div>
											<button type="submit" class="button alt" name="reg_objetivo">Salvar</button>
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

	$('#add_objetivo').click(function(e){
		e.preventDefault();

		$('.objetivos_input').append("<div><h4>Objetivo</h4><textarea maxlength='255' rows='3' name='objetivo[]' value='new' style='resize: none;'></textarea><input type='hidden' name='objid[]' value='new'></input><button type='button' class='button small remove' id='new'>Remove</button></div>");

		//$('.objetivos_input').append("<table><th><b>Objetivo</b></th><th><b>Perspectiva do BSC</b></th><tr><td><textarea maxlength='255' rows='3' name='objetivo[]' value='new' style='resize: none;'></textarea></td><td><input type='radio' name='perspectiva_bsc[" + x + "]' value='Econômico-Financeira'>Econômico-Financeira<br><input type='radio' name='perspectiva_bsc[" + x + "]' value='Clientes'>Clientes<br><input type='radio' name='perspectiva_bsc[" + x + "]' value='Processos Internos'>Processos Internos<br><input type='radio' name='perspectiva_bsc[" + x + "]' value='Aprendizado e Crescimento'>Aprendizado e Crescimento<br><input type='hidden' name='id[]' value='new'></input><a href='#' class='remove_field' id='new' style='margin-left:10px;'>Remover</a></td></tr></table>");
		//var_dump($_GET);
	});

	$('#add_meta').click(function(e){
		e.preventDefault();

		$('.metas_input').append("<div><label>Objetivo</label><textarea maxlength='255' rows='3' name='meta[]' value='new' style='resize: none;'></textarea><input type='hidden' name='metid[]' value='new'></input><button type='button' class='button small remove' id='new'>Remove</a></div>");

		//$('.objetivos_input').append("<table><th><b>Objetivo</b></th><th><b>Perspectiva do BSC</b></th><tr><td><textarea maxlength='255' rows='3' name='objetivo[]' value='new' style='resize: none;'></textarea></td><td><input type='radio' name='perspectiva_bsc[" + x + "]' value='Econômico-Financeira'>Econômico-Financeira<br><input type='radio' name='perspectiva_bsc[" + x + "]' value='Clientes'>Clientes<br><input type='radio' name='perspectiva_bsc[" + x + "]' value='Processos Internos'>Processos Internos<br><input type='radio' name='perspectiva_bsc[" + x + "]' value='Aprendizado e Crescimento'>Aprendizado e Crescimento<br><input type='hidden' name='id[]' value='new'></input><a href='#' class='remove_field' id='new' style='margin-left:10px;'>Remover</a></td></tr></table>");
		//var_dump($_GET);
	});

	$('#add_indicador').click(function(e){
		e.preventDefault();

		$('.indicadores_input').append("<div><label>Objetivo</label><textarea maxlength='255' rows='3' name='indicador[]' value='new' style='resize: none;'></textarea><input type='hidden' name='indid[]' value='new'></input><button type='button' class='button small remove' id='new'>Remover</a></div>");

		//$('.objetivos_input').append("<table><th><b>Objetivo</b></th><th><b>Perspectiva do BSC</b></th><tr><td><textarea maxlength='255' rows='3' name='objetivo[]' value='new' style='resize: none;'></textarea></td><td><input type='radio' name='perspectiva_bsc[" + x + "]' value='Econômico-Financeira'>Econômico-Financeira<br><input type='radio' name='perspectiva_bsc[" + x + "]' value='Clientes'>Clientes<br><input type='radio' name='perspectiva_bsc[" + x + "]' value='Processos Internos'>Processos Internos<br><input type='radio' name='perspectiva_bsc[" + x + "]' value='Aprendizado e Crescimento'>Aprendizado e Crescimento<br><input type='hidden' name='id[]' value='new'></input><a href='#' class='remove_field' id='new' style='margin-left:10px;'>Remover</a></td></tr></table>");
		//var_dump($_GET);
	});

	$('.objetivos_input').on("click",".button.small.remove", function(e){ //user click on remove text links
        e.preventDefault();
		$(this).parent('div').remove();
		//$(this).closest('table').remove();    ---    sera usado para perspectivas em estrategia
		//$('#uau_objetivo').submit();
		var x = $(this).attr("id");
		$.ajax({
          url: "includes/functions.php",
		  data: { removerObjetivo: x },
          type: "POST"});
		window.location.reload();
		
    });

	$('.metas_input').on("click",".button.small.remove", function(e){ //user click on remove text links
        e.preventDefault();
		$(this).parent('div').remove();
		//$(this).closest('table').remove();    ---    sera usado para perspectivas em estrategia
		//$('#uau_objetivo').submit();
		var x = $(this).attr("id");
		$.ajax({
          url: "includes/functions.php",
		  data: { removerMeta: x },
          type: "POST"});
		//$('.objetivos_input').append(x);
		

    });

	$('.indicadores_input').on("click",".button.small.remove", function(e){ //user click on remove text links
        e.preventDefault();
		$(this).parent('div').remove();
		//$(this).closest('table').remove();    ---    sera usado para perspectivas em estrategia
		//$('#uau_objetivo').submit();
		var x = $(this).attr("id");
		$.ajax({
          url: "includes/functions.php",
		  data: { removerIndicador: x },
          type: "POST"});
		//$('.objetivos_input').append(x);
		

    });

});
</script>

<?php  include("includes/footer.php");?>