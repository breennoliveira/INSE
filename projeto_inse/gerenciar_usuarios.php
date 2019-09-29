<?php include("includes/session.php");?>
<?php include("includes/header.php");?>
<?php include("includes/navegation.php");?>
<?php include("server.php");?>

<div id="main" class="wrapper style4">

				<!-- Content -->
				<div id="content" class="container2 medium">
					<section>
						<header class="major">
							<h2>Bem vindo <?php echo $_SESSION['nomefantasia'] ?>!</h2>
							<span class="byline">Abaixo você pode gerenciar os usuários atrelados à sua empresa</span>
						</header>
								<hr>
									<form action="registrar_usuario.php" method="">
										<input type="hidden" name="" value="">
										<button  type="submit" name="" style="margin-bottom: 10px; border-color: #2B8334;color: white;background: #2B8334;">Add Usuario</button>
									</form>
									<?php 

										$db = mysqli_connect('localhost', 'root', '', 'inse');
										$stmt = mysqli_prepare($db, "SELECT u.id, u.email, u.nome, e.razaosocial, g.grupo FROM usuario as u INNER JOIN empresa as e on u.empresa = e.id INNER JOIN grupo as g on u.grupo = g.id WHERE u.empresa = '".$_SESSION['idempresa']."'");
										mysqli_stmt_execute($stmt);
										$result = mysqli_stmt_get_result($stmt);
									?>
									
									<table class="table table-bordered"  id="dataTable" width="100%" cellspacing="0">
										<thead>
										  <tr style="background-color: #322B83; color: white;">
											<th>Empresa</th>
											<th>Nome</th>
											<th>Email</th>
											<th>Grupo</th>
											<th>Editar </th>
											<th>Desativar </th>
										  </tr>
										</thead>
										<tbody>
										<?php 
											while($row = mysqli_fetch_array($result)){
											?>
										  <tr>
											<td><?php echo $row['razaosocial'];?></td>
											<td><?php echo $row['nome'];?></td>
											<td><?php echo $row['email'];?></td>
											<td><?php echo $row['grupo'];?></td>
											<td>
												<form action="usuario.php?idusuario=<?php echo $row['id']?>" method="post">
													<input type="hidden" name="">
													<button  type="submit" name="" class="btn btn-success" style="border-color: #2B8334;color: white;background: #2B8334;" > Editar </button>
												</form>
											</td>
											<td>
												<form action="" method="post">
												  <input type="hidden" name="alt_usuario">
												  <button type="submit" name="" class="btn btn-danger" style="border-color: red ;color: white;background: red;" > Desativar </button>
												</form>
											</td>
										  </tr>
										  <?php 
										  }
										  ?>
										 </tbody>
								    </table>
										<hr>
											<form method="post" action="">
											<hr>
										</form>
					</section>
							</div>
</div>
<script type="text/javascript">
				document.getElementById('grupo').value = "<?php echo $grupo ?>";
</script>

<?php  include("includes/footer.php");?>