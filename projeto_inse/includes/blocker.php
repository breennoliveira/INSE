<?php 

  if (!isset($_SESSION['idusuario'])) {
  	header("location: login.php");
	array_push($errors, "Você precisa estar logado para acessar essa página!");
  }
?>