<?php 
if(session_status() == PHP_SESSION_NONE){
	session_start();
}

  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['nomefantasia']);
	unset($_SESSION['idempresa']);
	unset($_SESSION['idusuario']);
  	header("location: login.php");
  }
?>