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
							<span class="byline">Abaixo você pode gerenciar as permissões do sistema</span>
						</header>
								<hr>
									<form action="register_permissons.php" method="">
										<input type="hidden" name="" value="">
										<button type="submit" name="" style="margin-bottom: 10px; border-color: #2B8334;color: white;background: #2B8334;">Add Grupo</button>
									</form>
									<?php 
										$default = 0;
										$db = mysqli_connect('localhost', 'root', '', 'inse');
										$stmt = mysqli_prepare($db, "SELECT  * from grupo WHERE empresa = ? OR empresa = ?");
										mysqli_stmt_bind_param($stmt, "ii", $_SESSION['idempresa'], $default);
										mysqli_stmt_execute($stmt);
										$result = mysqli_stmt_get_result($stmt);
									?>
									<table class="table table-bordered"  id="dataTable" width="100%" cellspacing="0">
										<thead>
										  <tr style="background-color: #322B83; color: white;">
											<th>ID</th>
											
											<th>Grupo</th>
											<th></th>
											<th></th>
											<th>Opções</th>
											<th></th>
										  </tr>
										</thead>
										<tbody>
											
											<?php 
											while($row = mysqli_fetch_array($result)){
											?>
												<tr>
												<td><?php echo $row['id'];?></td>
												<td><?php echo $row['grupo'];?></td>
												<td></td>
												<td></td>

													<?php if ($row['empresa'] != 0){?>
														<td>										  
														<a href="permissao.php?idgrupo=<?php echo $row['id']?>"><input type="image" title="Alterar Grupo" alt="Alterar Grupo" src="images/edit.png"></a>
														&nbsp&nbsp<input type="image" title="Remover Grupo" alt="Remover Grupo" class="removerGrupo" src="images/delete.png" id="<?php echo $row['id']?>"></input>
													</td>
														</td>
													<td>
													</td>
												  </tr>
												  <?php 
												  }
												  ?>
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
<script>
$(document).ready(function(){

	$('.removerGrupo').click(function(){
		var x = $(this).attr("id");
		$.ajax({
			type: "POST",
			url: "includes/functions.php",
			data: {"removerGrupo": x},
			success:function(data){
				console.log('success');
				console.log(data)},
			error:function(){
				console.log('failed');
			}
			});
		//window.location.reload();
		//$('#teste').append(x);
		//$('#teste').load();
	});

});
</script>

<?php  include("includes/footer.php");?>