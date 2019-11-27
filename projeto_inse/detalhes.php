<?php include("includes/session.php");?>
<?php include("includes/header.php");?>
<?php include("includes/navegation.php");?>
<?php include("server.php");?>
<script src="js/xepOnline.jqPlugin.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<div id="main" class="wrapper style4">
				<!-- Content -->
				<div id="content" class="container2 small">
					<section>
						<?php listarDetalhesEmpresa(); ?>
					</section>
				</div>
			</div>
<?php  include("includes/footer.php");?>