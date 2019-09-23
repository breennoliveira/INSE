<?php include("includes/session.php");?>
<?php include("includes/header.php");?>
<?php include("server.php");?>
<?php include("includes/navegation.php");?>

<!-- Main -->

			<div id="main" class="wrapper style4">
				<div class="container2">
					<div class="row">
						<?php include("includes/sidebar.php");?>
						<!-- Content -->
						<div id="content" class="8u skel-cell-important">
							<section>
								<header class="major">
									<a href="objetivos.php?plano_estrategico=<?php echo $_GET['plano_estrategico']?>"><</a>
									<h2>Estratégias</h2>
									<span class="byline">Utilize o formulário abaixo para cadastrar as ações estratégicas relacionadas ao seguinte objetivo:</span>
								</header>
								<form method="post" name="reg_estrategia">
									<?php include('errors.php'); ?>
							  		<?php $count = listarEstrategias($_GET['objetivo'])?>
									<div class="clearfix">
									</div>
									<hr>
										<input type="button" class="button small" id="add_estrategia" value="Nova Estratégia"></input>
										<button type="submit" class="button alt" name="reg_estrategia">Salvar</button>
									<hr>
								</form>
							</section>
						</div>
					</div>
				</div>
			</div>
<script>
$(document).ready(function(){
	
	var count = "<?php echo $count ?>";

	$('#add_estrategia').click(function(e){
		e.preventDefault();

		//$('.estrategias_input').append("<div><label>Objetivo</label><textarea maxlength='255' rows='3' name='objetivo[]' value='new' style='resize: none;'></textarea><input type='hidden' name='objid[]' value='new'></input><div class='container small'><button type='button' class='button small remove' id='new'>Remove</a></div></div>");

		$('.estrategias_input').append("<table><col class='c4'><th class='left'><br>Estratégia</th></col><th><br>Perspectiva do BSC</th><th><br>Impacto</th><th class='center'>Grau de Contribuição<br>Triple Bottom Line</th><tr><td class='left'><textarea maxlength='255' rows='3' name='estrategia[]' value='new' style='resize: none;'></textarea><button type='button' class='button small remove' id='new'>Remover</button></td><td><input type='radio' name='perspectiva_bsc[" + count + "]' value='Econômico-Financeira'>Econômico-Financeira<br><input type='radio' name='perspectiva_bsc["+ count +"]' value='Clientes'>Clientes<br><input type='radio' name='perspectiva_bsc["+ count +"]' value='Processos Internos'>Processos Internos<br><input type='radio' name='perspectiva_bsc["+ count +"]' value='Aprendizado e Crescimento'>Aprendizado e Crescimento<br><input type='hidden' name='estid[]' value='new'></input></td><td><img class='icon' src='images/ambiental.png' alt='Sustentabilidade Ambiental' title='Sustentabilidade Ambiental'><select name='ambiental[" + count + "]'><option value='100'>100</option><option value='200'>200</option><option value='300'>300</option></select><br><img class='icon' src='images/economica.png' alt='Sustentabilidade Econômica' title='Sustentabilidade Econômica'><select name='economica[" + count + "]'><option value='100'>100</option><option value='200'>200</option><option value='300'>300</option></select><br><img class='icon' src='images/social.png' alt='Sustentabilidade Social' title='Sustentabilidade Social'><select name='social[" + count + "]'><option value='100'>100</option><option value='200'>200</option><option value='300'>300</option></select></td><td><select class='center' name='grau[" + count + "]'><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option></select></td></tr></table>");
		//var_dump($_GET);
		count++;
	});

	$('.estrategias_input').on("click",".button.small.remove", function(e){ //user click on remove text links
        e.preventDefault();
		//$(this).parent('div').parent('div').remove();
		$(this).closest('table').remove();
		//$('#uau_objetivo').submit();
		var x = $(this).attr("id");
		$.ajax({
          url: "includes/functions.php",
		  data: { removerEstrategia: x },
          type: "POST"});
		//$('.objetivos_input').append(x);
		count--;
    });

});
</script>

<?php  include("includes/footer.php");?>