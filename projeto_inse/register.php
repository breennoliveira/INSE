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
								<h3>Informações da Empresa</h3>
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
								  <?php listarRamos() ?>
							  	</div>
								<div class="">
							  	  <label>Endereço</label>
							  	  <input type="text" maxlength='255' name="endereco" value="<?php echo isset($_POST['endereco']) ? $_POST['endereco'] : '' ?>">
							  	</div>
								  <div style="float : left;">
							  	  <label>Numero</label>
							  	  <input type="text" maxlength='255' name="numero" value="<?php echo isset($_POST['numero']) ? $_POST['numero'] : '' ?>">
								  </div>								
								  <div style="float: left;" class="">
							  	  <label>Complemento</label>
							  	  <input type="text"  style="width: 80%;" maxlength='255' name="complemento" value="<?php echo isset($_POST['complemento']) ? $_POST['complemento'] : '' ?>">
								  </div>								
								  <div>
							  	  <label>Bairro</label>
							  	  <input type="text"  style="width: 25.8%;" maxlength='255' name="bairro" value="<?php echo isset($_POST['bairro']) ? $_POST['bairro'] : '' ?>">
								  </div>							
								  <div style="float: left;" class="">
							  	  <label>Cidade</label>
							  	  <input type="text" style="width: 80%;" maxlength='255' name="cidade" value="<?php echo isset($_POST['cidade']) ? $_POST['cidade'] : '' ?>">
								  </div>
								  <div style="float: left;" class="">	
							  	  <label>Estado</label>
							  	  <input type="text" style="width: 80%;" maxlength='255' name="estado" value="<?php echo isset($_POST['estado']) ? $_POST['estado'] : '' ?>">
								  </div>		
								  <div class="">
							  	  <label>CEP</label>
							  	  <input type="text" style="width: 10%;" maxlength='255' name="cep" value="<?php echo isset($_POST['cep']) ? $_POST['cep'] : '' ?>">
							  	</div>
								<br>
								<h3>Informações do Responsável</h3>
								<div class="">
							  	  <label>Nome</label>
							  	  <input type="text" style="width: 50.4%;" maxlength='255' name="nome" value="<?php echo isset($_POST['nome']) ? $_POST['nome'] : '' ?>">
							  	</div>
								<div class="">
							  	  <label>Sobrenome</label>
							  	  <input type="text" style="width: 50.4%;" maxlength='255' name="sobrenome" value="<?php echo isset($_POST['sobrenome']) ? $_POST['sobrenome'] : '' ?>">
							  	</div>
								<div class="">
							  	  <label>Gênero</label>
							  	  <input type="text" style="width: 50.4%;" maxlength='255' name="genero" value="<?php echo isset($_POST['genero']) ? $_POST['genero'] : '' ?>">
							  	</div>
								<div>
							  	  <label>Telefone</label>
							  	  <input type="text" style="width: 12%;" maxlength='100' placeholder="(DDD) X XXXX XXXX" name="telefone" value="<?php echo isset($_POST['telefone']) ? $_POST['telefone'] : '' ?>">
							  	</div>
							  	<div class="">
							  	  <label>Endereço de Email</label>
							  	  <input type="email" maxlength='100' name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>">
							  	</div>
								<div class="">
							  	  <label>Confirmação de Email</label>
							  	  <input type="email" maxlength='100' name="confir_email">
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