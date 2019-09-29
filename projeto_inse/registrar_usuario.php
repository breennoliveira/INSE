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
							<form method="post" action="registrar_usuario.php">
							  	<?php include('errors.php'); ?>
								<div class="">
							  	  <label>Nome</label>
							  	  <input type="text" style="width: 50.4%;" maxlength='255' name="nome" value="<?php echo isset($_POST['nome']) ? $_POST['nome'] : '' ?>">
							  	</div>
								<div class="">
							  	  <label>Sobrenome</label>
							  	  <input type="text" style="width: 50.4%;" maxlength='255' name="sobrenome" value="<?php echo isset($_POST['sobrenome']) ? $_POST['sobrenome'] : '' ?>">
							  	</div>
								<div class="">
							  	  <label>Genero</label>
							  	  <input type="text" style="width: 50.4%;" maxlength='255' name="genero" value="<?php echo isset($_POST['genero']) ? $_POST['genero'] : '' ?>">
							  	</div>
							  	<div class="">
							  	  <label>Email</label>
							  	  <input type="email" maxlength='100' name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>">
							  	</div>
								<div class="">
							  	  <label>Confirmacao de Email</label>
							  	  <input type="email" maxlength='100' name="confir_email">
							  	</div>
							  	<div class="">
							  	  <label>Senha</label>
							  	  <input type="password" name="senha">
							  	</div>
								<br>
								<h3>Funcionalidades do sistema</h3>
							  	<div class="">
							  	  <label>Escolha um grupo de acesso </label>
								  <br>
								  <br>
								  <?php listarGrupos() ?>
							  	</div>
								<br>
								<div class="">
							  	  <button type="submit" class="button" name="reg_usuario">Criar</button>
							  	</div>
							 </form>
						</header>
					</section>
				</div>
				
</div>
<script type="text/javascript">
				document.getElementById('grupo').value = "<?php echo $grupo ?>";
</script>

<?php  include("includes/footer.php");?>