<?php include("includes/session.php");?>
<?php include("includes/header.php");?>
<?php include("includes/navegation.php");?>
<?php include("server.php");?>

<div id="main" class="wrapper style4">

				<!-- Content -->
				<div id="content" class="container">
					<section>
						<header class="major">
							<h2>Bem vindo <?php echo $_SESSION['nomefantasia'] ?>!</h2>
							<span class="byline">Gerencie os usuarios do sistema</span>
								<hr>
									<form action="" method="">
										<input type="hidden" name="" value="">
										<button  type="submit" name="" style="margin-bottom: 10px; border-color: #2B8334;color: white;background: #2B8334;">Add Usuario</button>
									</form>
									<table class="table table-bordered"  id="dataTable" width="100%" cellspacing="0">
										<thead>
										  <tr style="background-color: #322B83; color: white;">
											<th>Empresa</th>
											<th>Nome</th>
											<th>Email</th>
											<th>Telefone</th>
											<th>Perfil</th>
											<th>Editar </th>
											<th>Desativar </th>
										  </tr>
										</thead>
										<tbody>
										  <tr>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td>
												<form action="" method="post">
													<input type="hidden" name="" value="">
													<button  type="submit" name="" class="btn btn-success" style="border-color: #2B8334;color: white;background: #2B8334;" > Editar </button>
												</form>
											</td>
											<td>
												<form action="" method="post">
												  <input type="hidden" name="" value="">
												  <button type="submit" name="" class="btn btn-danger" style="border-color: red ;color: white;background: red;" > Desativar </button>
												</form>
											</td>
										  </tr>
										 </tbody>
								    </table>
										<hr>
											<form method="post" action="">
											<hr>
										</form>
						</header>
					</section>
							</div>
</div>
<script type="text/javascript">
				document.getElementById('ramo').value = "<?php echo $ramo ?>";
</script>

<?php  include("includes/footer.php");?>