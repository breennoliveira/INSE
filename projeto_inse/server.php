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
		  if (empty($_POST['cidade'])) { array_push($errors, "Cidade é obrigatório"); }
		  if (empty($_POST['estado'])) { array_push($errors, "Estado é obrigatório"); }
		  if (empty($_POST['cep'])) { array_push($errors, "CEP é obrigatório"); }
		  if (empty($_POST['nome'])) { array_push($errors, "Nome de responsável é obrigatório"); }
		  if (empty($_POST['sobrenome'])) { array_push($errors, "Sobrenome de responsável é obrigatório"); }
		  if (empty($_POST['genero'])) { array_push($errors, "Gênero é obrigatório"); }
		  if (empty($_POST['telefone'])) { array_push($errors, "Telefone é obrigatório"); }
		  if (empty($_POST['email'])) { array_push($errors, "Email é obrigatório"); }
		  if ($_POST['email'] != $_POST['confir_email']) { array_push($errors, "Os emails não são iguais"); } 
		  if (empty($_POST['senha'])) { array_push($errors, "Senha é obrigatória"); }
		  if ($_POST['senha'] != $_POST['confir_senha']) { array_push($errors, "As senhas não são iguais"); } 

		  if(existeCNPJ($_POST['cnpj'])){
			array_push($errors, "Já existe um cadastro com esse CNPJ");
		  }

		  if(existeEmail($_POST['email'])){
			array_push($errors, "Já existe um cadastro com esse email");
		  }

		  // Finally, register user if there are no errors in the form
		  if (count($errors) == 0) {

			$options = [
				'memory_cost' => 1<<17, // 128 Mb
				'time_cost'   => 4,
				'threads'     => 4,
			];

			$senha = password_hash($_POST['senha'], PASSWORD_ARGON2ID, $options);  // hash com argon2id

			inserirEmpresa($_POST['razaosocial'], $_POST['nomefantasia'], $_POST['cnpj'], $_POST['ramo'], $_POST['endereco'], $_POST['numero'], $_POST['complemento'], $_POST['bairro'], $_POST['cidade'], $_POST['estado'], $_POST['cep'], $_POST['nome'], $_POST['sobrenome'], $_POST['genero'], $_POST['telefone'], $_POST['email'], $senha);

  			$_SESSION['success_flash'] = "Cadastrado com sucesso";
  			header('location: login.php');

		  }
		}

		// LOGIN USER
		if (isset($_POST['login_user'])) {

		  if (empty($_POST['email']) OR !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
			array_push($errors, "Verifique o campo Email");
		  }
		  if (empty($_POST['senha'])) {
			array_push($errors, "Verifique o campo Senha");
		  }

		  if (count($errors) == 0) {
			
			//$senha = md5($_POST['senha']);
			if (loginCorreto($_POST['email'], $_POST['senha'])){
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

		$errors = array(); 

		// connect to the database
		$db = mysqli_connect('localhost', 'root', '', 'inse');

		// CADASTRAR IDENTIDADE ORGANIZACIONAL
		if (isset($_POST['reg_indentidade'])) {
			// receive all input values from the form
			// form validation: ensure that the form is correctly filled ...
			// by adding (array_push()) corresponding error unto $errors array
			if (empty($_POST['visao'])) { array_push($errors, "O campo visão é obrigatório"); }
			if (empty($_POST['missao'])) { array_push($errors, "O campo missão é obrigatório"); }
			if (!isset($_POST['valor'])) { array_push($errors, "O campo Valores é obrigatório"); }else{
				$valor = $_POST['valor'];
				if(count($_POST['valor']) == 1 && $valor[0] == ''){
					array_push($errors, "O campo Valores é obrigatório");
				}
			};
			if (empty($_POST['comeco'])) { array_push($errors, "O campo Data Inicio é obrigatório"); }
			if (empty($_POST['fim'])) { array_push($errors, "O campo Data Fim é obrigatório"); }
			
		
			if (count($errors) == 0) {

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
			
			if(!isset($_POST['objid'])){ array_push($errors, "O campo Objetivo é obrigatório"); }else{ if(count($_POST['objetivo']) != count($_POST['objid'])){ array_push($errors, "O campo Objetivo é obrigatório"); }}
			//if(count($_POST['perspectiva_bsc']) != count($_POST['id'])){ array_push($errors, "O campo Perspectiva do BSC é obrigatório"); }         Sera usado para linkar perspectiva com estrategia

			if (count($errors) == 0){
				foreach($_POST['objetivo'] as $objetivo){
					if ($objetivo != ''){
						$objid = array_slice($_POST['objid'],0,1);
						$_POST['objid'] = array_slice($_POST['objid'], 1);
						//$perspectiva_bsc = array_slice($_POST['perspectiva_bsc'],$i,1);       Sera usado para linkar perspectiva com estrategia
						if($objid['0'] != 'new'){
							alterarObjetivo($objetivo,$objid['0']);
						}
						else{
							inserirObjetivo($objetivo);
						}
					}
					$i++;
				}
				header('location: objetivos.php?plano_estrategico='.$_GET['plano_estrategico']);
			}
		}

		if (isset($_POST['reg_estrategia'])) {

			if(!isset($_POST['estid'])) { array_push($errors, "O campo Estratégia é obrigatório"); }else{ if(count($_POST['estrategia']) != count($_POST['estid'])){ array_push($errors, "O campo Estratégia é obrigatório"); if (count($_POST['perspectiva_bsc']) != count($_POST['estid'])){ array_push($errors, "O campo Perspectiva do BSC é obrigatório"); } }}
			//if(!isset($_POST['perspectiva_bsc'])){ array_push($errors, "O campo Perspectiva do BSC é obrigatório");}else{ if (count($_POST['perspectiva_bsc']) != count($_POST['estid'])){ array_push($errors, "O campo Perspectiva do BSC é obrigatório"); }}
			
			if (count($errors) == 0){
				$count = 0;
				foreach($_POST['estrategia'] as $estrategia){
					$perspectiva_bsc = array_slice($_POST['perspectiva_bsc'], $count, 1);
					$impacto_ambiental = array_slice($_POST['ambiental'], $count, 1);
					$impacto_economico = array_slice($_POST['economica'], $count, 1);
					$impacto_social = array_slice($_POST['social'], $count, 1);
					$grau_contribuicao = array_slice($_POST['grau'], $count, 1);
					$estid = array_slice($_POST['estid'], $count, 1);
					if (strlen(trim($estrategia))){
						if($estid['0'] != 'new'){
							alterarEstrategia($estrategia, $perspectiva_bsc['0'], $impacto_ambiental['0'], $impacto_economico['0'], $impacto_social['0'], $grau_contribuicao['0'], $estid['0']);
						}
						else{
							inserirEstrategia($estrategia, $perspectiva_bsc['0'], $impacto_ambiental['0'], $impacto_economico['0'], $impacto_social['0'], $grau_contribuicao['0'], $_GET['objetivo']);
						}
					}
					$count++;
				}
				calcularIndicadorPorEstrategia();
				header('location: estrategias.php?plano_estrategico='.$_GET['plano_estrategico'].'&objetivo='.$_GET['objetivo']);
			}
		}

		if (isset($_POST['reg_meta'])) {
			
			if(!isset($_POST['metid'])){ array_push($errors, "O campo Meta é obrigatório"); }else{ if(count($_POST['meta']) != count($_POST['metid'])){ array_push($errors, "O campo Meta é obrigatório"); }}

			if (count($errors) == 0){
				foreach($_POST['meta'] as $meta){
					if ($meta != ''){
						$metid = array_slice($_POST['metid'], 0, 1);
						$data_limite = array_slice($_POST['data_limite'], 0, 1);
						$_POST['metid'] = array_slice($_POST['metid'], 1);
						$_POST['data_limite'] = array_slice($_POST['data_limite'], 1);
						if($metid['0'] != 'new'){
							alterarMeta($meta, $data_limite['0'] , $metid['0']);
						}
						else{
							inserirMeta($meta, $data_limite['0'], $_GET['objetivo']);
						}
					}
					$i++;
				}
				header('location: metas.php?plano_estrategico='.$_GET['plano_estrategico'].'&objetivo='.$_GET['objetivo']);
			}
		}

		if (isset($_POST['reg_indicador'])) {
			
			if(!isset($_POST['indid'])){ array_push($errors, "O campo Indicador é obrigatório"); }else{ if(count($_POST['indicador']) != count($_POST['indid'])){ array_push($errors, "O campo indicador é obrigatório"); }}

			if (count($errors) == 0){
				foreach($_POST['indicador'] as $indicador){
					if ($indicador != ''){
						$indid = array_slice($_POST['indid'],0,1);
						$_POST['indid'] = array_slice($_POST['indid'], 1);
						if($indid['0'] != 'new'){
							alterarIndicador($indicador,$indid['0']);
						}
						else{
							inserirIndicador($indicador, $_GET['meta']);
						}
					}
					$i++;
				}
				header('location: indicadores.php?plano_estrategico='.$_GET['plano_estrategico'].'&objetivo='.$_GET['objetivo'].'&meta='.$_GET['meta']);
			}
		}

		if(isset($_POST['alt_empresa'])) {
			
			if (empty($_POST['nomefantasia'])) { array_push($errors, "Nome fantasia é obrigatório"); }
			if (empty($_POST['endereco'])) { array_push($errors, "Endereço é obrigatório"); }
			if (empty($_POST['numero'])) { array_push($errors, "Número é obrigatório, caso não tenha número, digite SN"); }
			if (empty($_POST['cidade'])) { array_push($errors, "Cidade é obrigatório"); }
			if (empty($_POST['estado'])) { array_push($errors, "Estado é obrigatório"); }
			if (empty($_POST['cep'])) { array_push($errors, "CEP é obrigatório"); }
			if (empty($_POST['nome'])) { array_push($errors, "Nome de responsável é obrigatório"); }
			if (empty($_POST['sobrenome'])) { array_push($errors, "Sobrenome de responsável é obrigatório"); }
			if (empty($_POST['genero'])) { array_push($errors, "Gênero é obrigatório"); }
			if (empty($_POST['telefone'])) { array_push($errors, "Telefone é obrigatório"); }

			if(count($errors) == 0){
				alterarEmpresa();
				header('location: empresa.php');
			}

		}
	}
?>
