<?php include("includes/header.php");?>
<?php include("includes/navegation.php");?>
<?php include("server.php");?>

<div id="main" class="wrapper style4">

				<!-- Content -->
				<div id="content" class="container">
					<section>
						<header class="major">
							<h2>Crie sua conta</h2>
							<span class="byline">Registre-se em nosso site e aproveite nossos serviços</span>
								<hr>
								<form method="post" action="register.php">
							  	<?php include('errors.php'); ?>
							  	<div class="">
							  	  <label>Razão Social</label>
							  	  <input type="text" maxlength='100' name="razaosocial" value="<?php echo isset($_POST['razaosocial']) ? $_POST['razaosocial'] : '' ?>">
							  	</div>
							  	<div class="">
							  	  <label>Nome fantasia</label>
							  	  <input type="text" maxlength='100' name="nomefantasia" value="<?php echo isset($_POST['nomefantasia']) ? $_POST['nomefantasia'] : '' ?>">
							  	</div>
							  	<div class="">
							  	  <label>Numero CNPJ</label>
							  	  <input type="text" maxlength='18' name="cnpj" value="<?php echo isset($_POST['cnpj']) ? $_POST['cnpj'] : '' ?>">
							  	</div>
							  	<div class="">
							  	  <label>Ramo de atuação</label><br>
								  <select id="ramo" name="ramo">
									<option value="Indústria">Indústria</option>
									<option value="Comércio">Comércio</option>
									<option value="Serviços">Serviços</option>
								  </select>
							  	</div>
								<div class="">
							  	  <label>Endereço</label>
							  	  <input type="text" maxlength='255' name="endereco" value="<?php echo isset($_POST['endereco']) ? $_POST['endereco'] : '' ?>">
							  	</div>
								<div class="">
							  	  <label>Nome do Responsável</label>
							  	  <input type="text" maxlength='255' name="responsavel" value="<?php echo isset($_POST['responsavel']) ? $_POST['responsavel'] : '' ?>">
							  	</div>
								<div class="">
							  	  <label>Telefone</label>
							  	  <input type="text" maxlength='100' name="telefone" value="<?php echo isset($_POST['telefone']) ? $_POST['telefone'] : '' ?>">
							  	</div>
							  	<div class="">
							  	  <label>Endereço de Email</label>
							  	  <input type="email" maxlength='100' name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>">
							  	</div>
							  	<div class="">
							  	  <label>Senha</label>
							  	  <input type="password" name="senha">
							  	</div>
							  	<div class="">
							  	  <label>Confirmação de senha</label>
							  	  <input type="password" name="confir_senha">
							  	  <hr>
							  	</div>
							  	<div class="">
							  	  <button type="submit" class="button" name="reg_user">Criar</button>
							  	</div>
							  	<hr>
							  	<p>
							  	Já possui cadastro? <a href="login.php">Clique aqui</a>
							  	</p>
							  </form>
						</header>
						
					</section>
				</div>
			</div>

<script type="text/javascript">
	document.getElementById('ramo').value = "<?php echo $_POST['ramo'];?>"; // Para guardar o valor selecionado em ramo.
</script>
		
<?php  include("includes/footer.php");?>