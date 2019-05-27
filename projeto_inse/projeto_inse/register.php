<?php include("includes/header.php");?>
<?php include("includes/navegation.php");?>
<?php 
	include('server.php')
?>

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
							  	  <input type="text" name="razaosocial" value="<?php echo $razaosocial; ?>">
							  	</div>
							  	<div class="">
							  	  <label>Nome fantasia</label>
							  	  <input type="text" name="nomefantasia" value="<?php echo $nomefantasia; ?>">
							  	</div>
							  	<div class="">
							  	  <label>Numero CNPJ</label>
							  	  <input type="text" name="cnpj" value="<?php echo $cnpj; ?>">
							  	</div>
							  	<div class="">
							  	  <label>Ramo de atuação</label>
							  	  <input type="text" name="ramo" value="<?php echo $ramo; ?>">
							  	</div>
							  	<div class="">
							  	  <label>Endereço de Email</label>
							  	  <input type="email" name="email" value="<?php echo $email; ?>">
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

		
<?php  include("includes/footer.php");?>