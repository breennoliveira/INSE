<?php include("includes/session.php");?>
<?php include("includes/header.php");?>
<?php include("includes/navegation.php");?>
<?php include("server.php");?>

<div id="main" class="wrapper style4">

				<!-- Content -->
				<div id="content" class="container2 small">
					<section>
						<header class="major">
							<h2 class="welcome">Pesquise uma Empresa!</h2>
						</header>
						<?php include('errors.php'); ?>
						<form method="post" id="pesquisar" name="pesquisar" action="pesquisa.php">
							<label>Nome da Empresa</label>
							<input type="text" class="btnlado" id="nome" name="nome"><button type="submit" class="button small" name="">Enviar</button>
						</form>
						<div id="resultado"><?php listarPesquisa() ?></div>
					</section>
				</div>
			</div>
<?php  include("includes/footer.php");?>