<?php 
  session_start(); 

  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['razaosocial']);
	unset($_SESSION['idempresa']);
  	header("location: login.php");
  }
?>
<?php include("includes/header.php");?>
<?php include("includes/navegation.php");?>
<?php include("includes/banner.php");?>				
<?php include("includes/section1.php");?>	
<?php include("includes/section2.php");?>			
<?php include("includes/section3.php");?>			
<?php include("includes/team.php");?>			
<?php  include("includes/footer.php");?>