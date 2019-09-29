<?php include("includes/session.php");?>
<?php include("includes/header.php");?>
<?php include("server.php");?>
<?php include("includes/navegation.php");?>
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
							  	<?php listarResumo(); ?>
								<hr>
									<button id="publicar" name="publicar" class="button alt">Publicar</button>
									<button id="print_resumo" name="print_resumo" class="button alt">Download</button>
								<hr>
							</section>
						</div>
					</div>
				</div>
			</div>

<script type="text/javascript">
      
	  google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales'],
          ['2004',  50],
		  [, 50]
        ]);

        var options = {
          title: 'Company Performance',
          curveType: 'function',
		  enableInteractivity: 'false',
          legend: { position: 'bottom' }
        };

		var chart_div = document.getElementById('curve_chart');
		var chart = new google.visualization.PieChart();

		google.visualization.events.addListener(chart, 'ready', function (chart_div) {
        chart_div.innerHTML = '<img src="' + chart.getImageURI() + '">';
        console.log(chart_div.innerHTML);
      });


        chart.draw(data, options);
      }
</script>

<script>
$(document).ready(function(){

	$('#publicar').click(function(e){
		var x = "<?php echo $_GET['plano_estrategico'] ?>";  // Passa o id do plano estrategico, nao estava conseguindo acessar pelo functions.php
		$.ajax({
          url: "includes/functions.php",
		  data: { publicar_pee: x },
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
			render: "download",
			pageWidth: "11in",
			pageHeight: "8.5in",
			pageMargin: ".25in"});
	});

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
		//$('.objetivos_input').append(x);
		
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