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
							<span class="byline">Gerencie as permissoes do sistema</span>
								<hr>
									<form action="register_permissons.php" method="">
										<input type="hidden" name="" value="">
										<button type="submit" name="" style="margin-bottom: 10px; border-color: #2B8334;color: white;background: #2B8334;">Add Grupo</button>
									</form>
									<?php 

										$db = mysqli_connect('localhost', 'root', '', 'inse');
										$stmt = mysqli_prepare($db, "SELECT p.id, f.nome_func, g.grupo FROM permissao as p INNER JOIN funcionalidade as f on p.funcionalidade = f.id INNER JOIN grupo as g on p.grupo = g.id");
										mysqli_stmt_execute($stmt);
										$result = mysqli_stmt_get_result($stmt);
									?>
									<table class="table table-bordered"  id="dataTable" width="100%" cellspacing="0">
										<thead>
										  <tr style="background-color: #322B83; color: white;">
											<th>ID</th>
											<th>Funcionalidades</th>
											<th>Grupo</th>
											<th></th>
											<th></th>
											<th>Editar</th>
											<th>Deletar</th>
										  </tr>
										</thead>
										<tbody>
											
											<?php 
											while($row = mysqli_fetch_array($result)){
											?>
												<tr>
												<td><?php echo $row['id'];?></td>
												<td><?php echo $row['nome_func'];?></td>
												<td><?php echo $row['grupo'];?></td>
												<td></td>
												<td></td>
												<td>										  
													<form action="" method="post">
														<input type="hidden" name="" value="<?php echo $row['id'];?>">
														<button  type="submit" name="" class="btn btn-success" style="border-color: #2B8334;color: white;background: #2B8334;" > Editar </button>
													</form>
												</td>
											<td>
												<form action="" method="post">
												  <input type="hidden" name="" value="<?php echo $row['id'];?>">
												  <button type="submit" name="" class="btn btn-danger" style="border-color: red ;color: white;background: red;" > Deletar </button>
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
						</header>
					</section>
							</div>
</div>
<script type="text/javascript">
				document.getElementById('ramo').value = "<?php echo $ramo ?>";
</script>

<?php  include("includes/footer.php");?>