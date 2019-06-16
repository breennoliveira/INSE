<?php require "includes/functions.php";
//server.php é usado para validação da campos, e identificar qual ação será feita insert/update

	if(!isset($_SESSION['idempresa'])){
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
		$numero = "";
		$complemento= "";
		$bairro = "";
		$cidade = "";
		$cep = "";
		$responsavel = "";
		$telefone = "";
		$errors = array(); 


		// connect to the database
		$db = mysqli_connect('localhost', 'root', '', 'inse');

		// REGISTER USER
		if (isset($_POST['reg_user'])) {
		  // receive all input values from the form
		  /*$razaosocial = mysqli_real_escape_string($db, $_POST['razaosocial']);
		  $nomefantasia = mysqli_real_escape_string($db, $_POST['nomefantasia']);
		  $cnpj = mysqli_real_escape_string($db, $_POST['cnpj']);
		  $ramo = $_POST['ramo'];
		  $email = mysqli_real_escape_string($db, $_POST['email']);
		  $senha = mysqli_real_escape_string($db, $_POST['senha']);
		  $confir_senha = mysqli_real_escape_string($db, $_POST['confir_senha']);*/

		  // form validation: ensure that the form is correctly filled ...
		  // by adding (array_push()) corresponding error unto $errors array
		  if (empty($_POST['razaosocial'])) { array_push($errors, "Razão Social é obrigatório"); }
		  if (empty($_POST['nomefantasia'])) { array_push($errors, "Nome fantasia é obrigatório"); }
		  if (empty($_POST['cnpj'])) { array_push($errors, "CNPJ é obrigatório"); } else{
		  if (!validaCNPJ($_POST['cnpj'])) { array_push($errors, "CNPJ inválido"); } }
		  if (empty($_POST['ramo'])) { array_push($errors, "Ramo de atução é obrigatório"); }
		  if (empty($_POST['endereco'])) { array_push($errors, "Endereço é obrigatório"); }
		  if (empty($_POST['numero'])) { array_push($errors, "Número é obrigatório, caso não tenha número, digite SN"); }
		  if (empty($_POST['bairro'])) { array_push($errors, "Bairro é obrigatório"); }
		  if (empty($_POST['cidade'])) { array_push($errors, "Cidade é obrigatório"); }
		  if (empty($_POST['cep'])) { array_push($errors, "CEP é obrigatório"); }
		  if (empty($_POST['responsavel'])) { array_push($errors, "Nome de responsável é obrigatório"); }
		  if (empty($_POST['telefone'])) { array_push($errors, "Telefone é obrigatório"); }
		   if (empty($_POST['email'])) { array_push($errors, "Email é obrigatório"); }
		   if ($_POST['email'] != $_POST['confir_email']) { array_push($errors, "Os emails não são iguais"); } 
		  if (empty($_POST['senha'])) { array_push($errors, "Senha é obrigatória"); }
		  if ($_POST['senha'] != $_POST['confir_senha']) { array_push($errors, "As senhas não são iguais"); } 

		  // first check the database to make sure 
		  // a user does not already exist with the same username and/or email
		  /*$user_check_query = "SELECT * FROM empresa WHERE cnpj='$cnpj' OR email='$email' LIMIT 1";
		  $result = mysqli_query($db, $user_check_query);
		  $user = mysqli_fetch_assoc($result);
  
		  if ($user) { // if user exists
			if ($user['cnpj'] === $cnpj) {
			  array_push($errors, "Já existe um cadastro dessa empresa");
			}

			if ($user['email'] === $email) {
			  array_push($errors, "Já existe um email cadastrado");
			}
		  }*/

		  if(existeCNPJ($_POST['cnpj'])){
			array_push($errors, "Já existe um cadastro com esse CNPJ");
		  }

		  if(existeEmail($_POST['email'])){
			array_push($errors, "Já existe um cadastro com esse email");
		  }

		  // Finally, register user if there are no errors in the form
		  if (count($errors) == 0) {
  			$password = md5($_POST['senha']); // --------- solucao temporaria;

  			//$query = "INSERT INTO empresa (razaosocial, nomefantasia, cnpj, ramo, endereco, responsavel, telefone, email, senha, confir_senha) 
  			//		  VALUES('$razaosocial', '$nomefantasia', '$cnpj', '$ramo', '$endereco', '$responsavel' , '$telefone' , '$email', '$password', '$confir_senha')";
  			//mysqli_query($db, $query);

			inserirEmpresa($_POST['razaosocial'], $_POST['nomefantasia'], $_POST['cnpj'], $_POST['ramo'], $_POST['endereco'], $_POST['numero'], $_POST['complemento'], $_POST['bairro'], $_POST['cidade'], $_POST['cep'], $_POST['responsavel'], $_POST['telefone'], $_POST['email'], $password, $_POST['confir_senha']);

  			$_SESSION['success_flash'] = "Cadastrado com sucesso";
  			header('location: index.php');

		  }
		}

		// LOGIN USER
		if (isset($_POST['login_user'])) {
		  //$email = mysqli_real_escape_string($db, $_POST['email']);
		  //$senha = mysqli_real_escape_string($db, $_POST['senha']);

		  if (empty($_POST['email']) OR !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
			array_push($errors, "Verifique o campo Email");
		  }
		  if (empty($_POST['senha'])) {
			array_push($errors, "Verifique o campo Senha");
		  }

		  if (count($errors) == 0) {
			$senha = md5($_POST['senha']);
			if (loginCorreto($_POST['email'], $senha)){
				header('location: empresa.php');
			}
			else{
				array_push($errors, "O email/senha estão errados, verifique e tente novamente");
			}
			/*$query = "SELECT * FROM empresa WHERE email='$email' AND senha='$senha'";
			$results = mysqli_query($db, $query);
			$user = mysqli_fetch_assoc($results);
			if (mysqli_num_rows($results) == 1) {
			  $_SESSION['nomefantasia'] = $user['nomefantasia'];
			  $_SESSION['idempresa'] = $user['id'];
			  header('location: empresa.php');
			}else {
			  array_push($errors, "O email/senha estão errados, verifique e tente novamente");
			}*/
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
			if (empty($_POST['valor'])) { array_push($errors, "O campo Valores é obrigatório"); }
			if (empty($_POST['comeco'])) { array_push($errors, "O campo Data Inicio é obrigatório"); }
			if (empty($_POST['fim'])) { array_push($errors, "O campo Data Fim é obrigatório"); }
			if(isset($_POST['valor'])) {
				foreach($_POST['valor'] as $valor){
					if ($valor == '') { array_push($errors, "O campo Valores é obrigatório"); break;}
				}
			}
		
			if (count($errors) == 0) {
				/*$query = "INSERT INTO identidade (visao, missao, valores) 
						VALUES('$visao', '$missao', '$valores')";
				mysqli_query($db, $query);
				//$_SESSION['success_flash'] = "Cadastrado com sucesso";*/

				if($_GET['plano_estrategico'] == 'new'){
					$_GET['plano_estrategico'] = inserirIdentidade();
					header('location: identidade.php?plano_estrategico='.$_GET['plano_estrategico']);
				}
				else{
					alterarIdentidade();
				}

				$i = 0;
				if(isset($_POST['valor'])){
					foreach($_POST['valor'] as $valor){
						$id = array_slice($_POST['id'],$i,1);
						if($valor != ''){
							if($id['0'] != 'new'){
								alterarValor($valor, $id['0']);
							//echo 'VALOR ALTERADO';
							}
							else{
								inserirValor($valor);
							//print_r('VALOR INSERIDO');
							}
						}
						$i++;
					}
					header('location: identidade.php?plano_estrategico='.$_GET['plano_estrategico']);
				}
			}
		}

		//CADASTRAR OBJETIVOS
		if (isset($_POST['reg_objetivo'])) {

			if(empty($_POST['objetivo'])){ array_push($errors, "O campo Objetivo é obrigatório"); }

			if (count($errors) == 0){
				$i = 0;
				foreach($_POST['objetivo'] as $objetivo){
					if ($objetivo != ''){
						$id = array_slice($_POST['id'],$i,1);
						if($id['0'] != 'new'){
						alterarObjetivo($objetivo,'',$id['0']);
						}
						else{
							inserirObjetivo($objetivo,'');
						}
					}
					$i++;
				}
				header('location: objetivos.php?plano_estrategico='.$_GET['plano_estrategico']);
			}
		}

		if(isset($_POST['alt_empresa'])) {
			
			if (empty($_POST['nomefantasia'])) { array_push($errors, "Nome fantasia é obrigatório"); }
			if (empty($_POST['ramo'])) { array_push($errors, "Ramo de atução é obrigatório"); }
			if (empty($_POST['endereco'])) { array_push($errors, "Endereço é obrigatório"); }
			if (empty($_POST['numero'])) { array_push($errors, "Número é obrigatório, caso não tenha número, digite SN"); }
			if (empty($_POST['bairro'])) { array_push($errors, "Bairro é obrigatório"); }
			if (empty($_POST['cidade'])) { array_push($errors, "Cidade é obrigatório"); }
			if (empty($_POST['cep'])) { array_push($errors, "CEP é obrigatório"); }
			if (empty($_POST['responsavel'])) { array_push($errors, "Nome de responsável é obrigatório"); }
			if (empty($_POST['telefone'])) { array_push($errors, "Telefone é obrigatório"); }
			if (empty($_POST['email'])) { array_push($errors, "Email é obrigatório"); }

			if(count($errors) == 0){
				alterarEmpresa();
			}

		}
	}
?>