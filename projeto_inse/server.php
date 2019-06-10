<?php

require "includes/functions.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

if(session_status() == PHP_SESSION_NONE){
    //session has not started
    session_start();

if(isset($_SESSION['success_flash'])){
  echo '<div class="bg-success"><p class="text-success text-center">'.$_SESSION['success_flash'].'</p></div>';
  unset($_SESSION['success_flash']);
}

if(isset($_SESSION['error_flash'])){
  echo '<div class="bg-danger"><p class=" text-center">'.$_SESSION['error_flash'].'</p></div>';
  unset($_SESSION['error_flash']);
}

// initializing variables
$razaosocial = "";
$nomefantasia    = "";
$cnpj    = "";
$ramo    = "";
$email    = "";
$endereço = "";
$nomeresponsavel = "";
$telefone = "";
$errors = array(); 


// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'inse');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $razaosocial = mysqli_real_escape_string($db, $_POST['razaosocial']);
  $nomefantasia = mysqli_real_escape_string($db, $_POST['nomefantasia']);
  $cnpj = mysqli_real_escape_string($db, $_POST['cnpj']);
  $ramo = $_POST['ramo'];
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $senha = mysqli_real_escape_string($db, $_POST['senha']);
  $confir_senha = mysqli_real_escape_string($db, $_POST['confir_senha']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($razaosocial)) { array_push($errors, "Razão Social é obrigatório"); }
  if (empty($nomefantasia)) { array_push($errors, "Nome fantasia é obrigatório"); }
  if (empty($cnpj)) { array_push($errors, "CNPJ é obrigatório"); } else{
  if (!validaCNPJ($cnpj)) { array_push($errors, "CNPJ inválido"); } }
  if (empty($ramo)) { array_push($errors, "Ramo de atução é obrigatório"); }
  if (empty($email)) { array_push($errors, "Email é obrigatório"); }
  if (empty($senha)) { array_push($errors, "Senha é obrigatória"); }
  if ($senha != $confir_senha) {
	array_push($errors, "As senhas não são iguais");
  } 

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM empresa WHERE razaosocial='$razaosocial' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['razaosocial'] === $razaosocial) {
      array_push($errors, "Já existe um cadastro dessa empresa");
    }

    if ($user['email'] === $email) {
      array_push($errors, "Já existe um email cadastrado");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($senha); //encrypt the password before saving in the database

  	$query = "INSERT INTO empresa (razaosocial, nomefantasia, cnpj, ramo, email, senha, confir_senha) 
  			  VALUES('$razaosocial', '$nomefantasia', '$cnpj', '$ramo', '$email', '$password', '$confir_senha')";
  	mysqli_query($db, $query);
  	$_SESSION['success_flash'] = "Cadastrado com sucesso";
  	header('location: index.php');

  }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $senha = mysqli_real_escape_string($db, $_POST['senha']);

  if (empty($email) OR !filter_var($email,FILTER_VALIDATE_EMAIL)) {
    array_push($errors, "Verifique o campo Email");
  }
  if (empty($senha)) {
    array_push($errors, "Verifique o campo Senha");
  }

  if (count($errors) == 0) {
    $senha = md5($senha);
    $query = "SELECT * FROM empresa WHERE email='$email' AND senha='$senha'";
    $results = mysqli_query($db, $query);
	$user = mysqli_fetch_assoc($results);
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['nomefantasia'] = $user['nomefantasia'];
	  $_SESSION['idempresa'] = $user['id'];
      header('location: empresa.php');
    }else {
      array_push($errors, "O email/senha estão errados, verifique e tente novamente");
    }
  }
}

}
else
{

	if(isset($_SESSION['success_flash'])){
	  echo '<div class="bg-success"><p class="text-success text-center">'.$_SESSION['success_flash'].'</p></div>';
	  unset($_SESSION['success_flash']);
	}

	if(isset($_SESSION['error_flash'])){
	  echo '<div class="bg-danger"><p class=" text-center">'.$_SESSION['error_flash'].'</p></div>';
	  unset($_SESSION['error_flash']);
	}


	  // initializing variables
	$visao = "";
	$missao    = "";
	$valores    = "";
	$objetivo[]    = "";
	$perspectivas1    = "";
	$perspectivas2    = "";
	$perspectivas3    = "";

	$errors = array(); 

	// connect to the database
	$db = mysqli_connect('localhost', 'root', '', 'inse');

	// CADASTRAR IDENTIDADE ORGANIZACIONAL
	if (isset($_POST['reg_indentidade'])) {
		// receive all input values from the form
		/*$visao = mysqli_real_escape_string($db, $_POST['visao']);
		$missao = mysqli_real_escape_string($db, $_POST['missao']);
		$valores = mysqli_real_escape_string($db, $_POST['valores']);
		*/
		// form validation: ensure that the form is correctly filled ...
		// by adding (array_push()) corresponding error unto $errors array
		if (empty($_POST['visao'])) { array_push($errors, "O campo visão é obrigatório"); }
		if (empty($_POST['missao'])) { array_push($errors, "O campo missão é obrigatório"); }
		if (empty($_POST['valores'])) { array_push($errors, "O campo valores é obrigatório"); }

		if (count($errors) == 0) {
			/*$query = "INSERT INTO identidade (visao, missao, valores) 
					VALUES('$visao', '$missao', '$valores')";
			mysqli_query($db, $query);
			//$_SESSION['success_flash'] = "Cadastrado com sucesso";*/

			if($_GET['plano_estrategico'] == 'new'){
				$_GET['plano_estrategico'] = inserirIdentidade($_POST['visao'], $_POST['missao'], $_POST['valores']);
				header('location: identidade.php?plano_estrategico='.$_GET['plano_estrategico']);
			}
			else{
				alterarIdentidade($_POST['visao'], $_POST['missao'], $_POST['valores']);
			}
		}
	}

	  // CADASTRAR OBJETIVOS
	if (isset($_POST['reg_objetivo'])) {
		$i = 0;
		if(possuiObjetivos() == 0){
			foreach($_POST['objetivo'] as $objetivo) {
				if ($objetivo != ''){
					inserirObjetivo($objetivo,$_GET['plano_estrategico'],'');
				}
			}
		}
		else{
			foreach($_POST['objetivo'] as $objetivo){
				$id = array_slice($_POST['id'],$i,1);
				if($id != 'new'){
				alterarObjetivo($objetivo,'',$id['0']);
				}
				else{
					inserirObjetivo($objetivo,'');
				}
				$i++;
			}
		}
		/*$PEEid = $_POST['id'];
		$Objetivos = possuiObjetivos();
		$numObjetivos = mysqli_num_rows($Objetivos);
		if($numObjetivos == 0){
		$query = "INSERT INTO objetivo (objetivo, plano_estrategico, perspectivabsc) 
					VALUES('$objetivo1',' $PEEid ','$perspectivas1')";
		mysqli_query($db, $query);
		}
		else{
		$query = "UPDATE objetivo SET objetivo = "$objetivo1", perspectivabsc = "$perspectivas1")";
			mysqli_query($db, $query);
		}
		if($numObjetivos < 2){
		$query = "INSERT INTO objetivo (objetivo, plano_estrategico, perspectivabsc)
					VALUES('$objetivo2',' $PEEid ','$perspectivas2')";
		mysqli_query($db, $query);
		}
		else{
		$query = "UPDATE objetivo SET objetivo = "$objetivo2", perspectivabsc = "$perspectivas2")";
		mysqli_query($db, $query);
		}
		if($numObjetivos != 3){
		$query = "INSERT INTO objetivo (objetivo, plano_estrategico, perspectivabsc) 
				VALUES('$objetivo3',' $PEEid ','$perspectivas3')";
		mysqli_query($db, $query);
		}
		else{
		$query = "UPDATE objetivo SET objetivo = "$objetivo3", perspectivabsc = "$perspectivas3") WHERE ";
		mysqli_query($db, $query);
		}
		*/
	} 
}



?>