<?php include("includes/session.php");?>
<?php include("includes/header.php");?>
<?php include("includes/navegation.php");?>
<?php include("server.php");?>


<div id="main" class="wrapper style4">
	<div id="content" class="container">
					<section>
						<header class="major">
							<h2>Crie um novo grupo de permissoes</h2>
							<span class="byline">Escolha o nome do grupo de acesso e quais funcionalidades o usuario pode ter acesso</span>
								<hr>
							<form method="post" action="register_permissons.php">
							  	<?php include('errors.php'); ?>
								<h3>Grupo de permissao</h3>
							  	<div class="">
							  	  <label>Nome do grupo</label>
							  	  <input type="text" style="width: 50.4%;" maxlength='100' name="grupo" value="<?php echo isset($_POST['grupo']) ? $_POST['grupo'] : '' ?>">
							  	</div>
								<br>
								<hr style="border-top: 1px solid grey;">
								<h3>Funcionalidades do sistema</h3>
							  	<div class="">
							  	  <label>Escolha as funcionalidades que o grupo pode ter acesso</label>
								  <br>
								  <br>
								  <form action="" method="">
								  <?php listarFuncionalidades() ?>
							  	</div>
								<br>
								<div class="">
							  	  <button type="submit" class="button" name="reg_permissions">Criar</button>
							  	</div>
								 </form>
							  	<hr>
							 </form>
						</header>
					</section>
				</div>
				
</div>
<script type="text/javascript">
				document.getElementById('nome_func').value = "<?php echo $nome_func ?>";
</script>

<?php  include("includes/footer.php");?>