<?php include("includes/session.php");?>
<?php include("includes/header.php");?>
<?php include("includes/navegation.php");?>
<?php include("server.php");?>
<?php header('Content-Type: text/html; charset=utf-8'); ?>


<div id="main" class="wrapper style4">

				<!-- Content -->
				<div id="content" class="container">
					<section>
						<header class="major">
							<h2>Bem vindo <?php echo $_SESSION['nomefantasia'] ?>!</h2>
							<span class="byline"></span>
								<hr>
								<div style="display: flex; justify-content: center;">
								<input class="butt" type="button" onclick="window.location.href = 'empresa.php';" value="ALTERAR DADOS CADASTRAIS"/>
								<input class="butt" type="button" onclick="window.location.href = 'gerenciar_usuarios.php';" value="GERENCIAR USUARIOS"/>
								<input class="butt" type="button" onclick="window.location.href = 'gerenciar_permiss.php';" value="GERENCIAR PERMISSOES"/>
								<input class="butt" type="button" onclick="window.location.href = 'empresa.php';" value=""/>
								</div>
								<hr>
						</header>
					</section>
				</div>
</div>
<?php  include("includes/footer.php");?>