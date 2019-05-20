<?php
session_start();

if(isset($_SESSION['success_flash']))
{
  echo '<div class="bg-success"><p class="text-success text-center">'.$_SESSION['success_flash'].'</p></div>';
  unset($_SESSION['success_flash']);
}

if(isset($_SESSION['error_flash']))
{
  echo '<div class="bg-danger"><p class=" text-center">'.$_SESSION['error_flash'].'</p></div>';
  unset($_SESSION['error_flash']);
}


// initializing variables
$razaosocial = "";
$nomefantasia    = "";
$cnpj    = "";
$ramo    = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'inse');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $razaosocial = mysqli_real_escape_string($db, $_POST['razaosocial']);
  $nomefantasia = mysqli_real_escape_string($db, $_POST['nomefantasia']);
  $cnpj = mysqli_real_escape_string($db, $_POST['cnpj']);
  $ramo = mysqli_real_escape_string($db, $_POST['ramo']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $senha = mysqli_real_escape_string($db, $_POST['senha']);
  $confir_senha = mysqli_real_escape_string($db, $_POST['confir_senha']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($razaosocial)) { array_push($errors, "Razão Social é obrigatório"); }
  if (empty($nomefantasia)) { array_push($errors, "Nome fantasia é obrigatório"); }
  if (empty($cnpj)) { array_push($errors, "CNPJ é obrigatório"); }
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
  	$password = md5($senha);//encrypt the password before saving in the database

  	$query = "INSERT INTO empresa (razaosocial, nomefantasia, cnpj, ramo, email, senha, confir_senha) 
  			  VALUES('$razaosocial', '$nomefantasia', '$cnpj', '$ramo', '$email', '$password', '$confir_senha')";
  	mysqli_query($db, $query);
  	$_SESSION['success_flash'] = "Cadastrado com sucesso";
  	header('location: index.php');

  }
}

// ... 


// LOGIN USER
if (isset($_POST['login_user'])) {
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $senha = mysqli_real_escape_string($db, $_POST['senha']);

  if (empty($email)) {
    array_push($errors, "Verifique o campo Email");
  }
  if (empty($senha)) {
    array_push($errors, "Verifique o campo Senha");
  }

  if (count($errors) == 0) {
    $senha = md5($senha);
    $query = "SELECT * FROM empresa WHERE email='$email' AND senha='$senha'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['razaosocial'] = $razaosocial;
      header('location: empresa.php');
    }else {
      array_push($errors, "O email/senha estão errados, verifique e tente novamente");
    }
  }
}


function has_permission($permisson = 'admin')
{ 
  global $user_data;
  $permissons = explode(',', $user_data['permissions']);
  if(in_array($permisson,$permissons,true))
  {
    return true;
  }
  else
  {
    return false;
  }
}



?>