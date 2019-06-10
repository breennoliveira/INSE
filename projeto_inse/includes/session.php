<?php 

  session_start(); 


  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['nomefantasia']);
	unset($_SESSION['idempresa']);
  	header("location: login.php");
  }
?>