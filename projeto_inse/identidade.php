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
									<h2>Informações Organizacionais</h2>
									<span class="byline">Utilize o formulário abaixo para cadastrar os dados do plano estratégico, como a visão, a missão e os valores organizacionais.</span>
								</header>
								<form method="post" action="identidade.php?plano_estrategico=<?php echo $_GET['plano_estrategico']?>">
									<?php include('errors.php');
									listarIdentidade()?>
									<br>
									<div class="input-group" align="right">
										<input type="button" class="small" id="add_valor" value="Novo Valor"></input>
									</div>
							  		<hr>
							  		<div class="input-group">
							  			<button type="submit" class="button" name="reg_indentidade">Salvar</button>
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

	var x=1;

	$('#add_valor').click(function(e){
		e.preventDefault();
		x++;
		$('.valores_input').append("<div><br><label>Valores da empresa</label><input type='text' style='width: 100%;' maxlength='100' placeholder='Insira um valor aqui' name='valor[]'></input><input type='hidden' name='id[]' value='new'></input><a href='#' id='new' class='remove_field'>Remover</a></div>");
		//var_dump($_GET);
	});

	$('.valores_input').on("click",".remove_field", function(e){ //user click on remove text links
        e.preventDefault();
		$(this).parent('div').remove();
		var x = $(this).attr("id");
		$.ajax({
          url: "includes/functions.php",
		  data: { removerValor: x },
          type: "POST"})
		x--;
    });

});
</script>
<?php  include("includes/footer.php");?>