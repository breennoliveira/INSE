<?php 

  if (!isset($_SESSION['idusuario'])) {
  	header("location: login.php");
	array_push($errors, "Voc� precisa estar logado para acessar essa p�gina!");
  }
?>