<?php
//functions.php é usado para insert/select/update/remove, ou seja, tudo que tiver a ver com banco de dados
//https://www.geradorcnpj.com/script-validar-cnpj-php.htm

function validaCNPJ($cnpj = null) {

	// Verifica se um número foi informado
	if(empty($cnpj)) {
		return false;
	}

	// Elimina possivel mascara
	$cnpj = preg_replace("/[^0-9]/", "", $cnpj);
	$cnpj = str_pad($cnpj, 14, '0', STR_PAD_LEFT);
	
	// Verifica se o numero de digitos informados é igual a 14 
	if (strlen($cnpj) != 14) {
		return false;
	}
	
	// Verifica se nenhuma das sequências invalidas abaixo 
	// foi digitada. Caso afirmativo, retorna falso
	else if ($cnpj == '00000000000000' || 
		$cnpj == '11111111111111' || 
		$cnpj == '22222222222222' || 
		$cnpj == '33333333333333' || 
		$cnpj == '44444444444444' || 
		$cnpj == '55555555555555' || 
		$cnpj == '66666666666666' || 
		$cnpj == '77777777777777' || 
		$cnpj == '88888888888888' || 
		$cnpj == '99999999999999') {
		return false;
		
	 // Calcula os digitos verificadores para verificar se o
	 // CPF é válido
	 } else {   
	 
		$j = 5;
		$k = 6;
		$soma1 = 0;
		$soma2 = 0;

		for ($i = 0; $i < 13; $i++) {

			$j = $j == 1 ? 9 : $j;
			$k = $k == 1 ? 9 : $k;

			$soma2 += ($cnpj{$i} * $k);

			if ($i < 12) {
				$soma1 += ($cnpj{$i} * $j);
			}

			$k--;
			$j--;

		}

		$digito1 = $soma1 % 11 < 2 ? 0 : 11 - $soma1 % 11;
		$digito2 = $soma2 % 11 < 2 ? 0 : 11 - $soma2 % 11;

		return (($cnpj{12} == $digito1) and ($cnpj{13} == $digito2));
	 
	}
}

//Checagens

function possuiPEECriado(){

	$db = mysqli_connect('localhost', 'root', '', 'inse');

	$stmt = mysqli_prepare($db, "SELECT * FROM plano_estrategico WHERE empresa = ?");
	mysqli_stmt_bind_param($stmt, "i", $_SESSION['idempresa']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	$numrows = mysqli_num_rows($result);

	mysqli_stmt_close($stmt);
	mysqli_close($db);

	return $numrows;

}

function possuiObjetivos(){

	$db = mysqli_connect('localhost', 'root', '', 'inse');

	$stmt = mysqli_prepare($db, "SELECT * FROM objetivo WHERE plano_estrategico = ?");
	mysqli_stmt_bind_param($stmt, "i", $_GET['plano_estrategico']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	$numrows = mysqli_num_rows($result);

	mysqli_stmt_close($stmt);
	mysqli_close($db);

	return $numrows;

}

function possuiValores(){

	$db = mysqli_connect('localhost', 'root', '', 'inse');

	$stmt = mysqli_prepare($db, "SELECT * FROM valor WHERE plano_estrategico = ?");
	mysqli_stmt_bind_param($stmt, "i", $_GET['plano_estrategico']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	$numrows = mysqli_num_rows($result);

	mysqli_stmt_close($stmt);
	mysqli_close($db);

	return $numrows;

}

function existeCNPJ($cnpj){
	
	$db = mysqli_connect('localhost', 'root', '', 'inse');

	$stmt = mysqli_prepare($db, "SELECT * FROM empresa WHERE cnpj = ?");
	mysqli_stmt_bind_param($stmt, "s", $cnpj);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	$numrows = mysqli_num_rows($result);

	mysqli_stmt_close($stmt);
	mysqli_close($db);

	return $numrows;
}

function existeEmail($email){

	$db = mysqli_connect('localhost', 'root', '', 'inse');

	$stmt = mysqli_prepare($db, "SELECT * FROM empresa WHERE email = ?");
	mysqli_stmt_bind_param($stmt, "s", $email);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	$numrows = mysqli_num_rows($result);

	mysqli_stmt_close($stmt);
	mysqli_close($db);

	return $numrows;

}

function loginCorreto($email, $senha){
	
	$db = mysqli_connect('localhost', 'root', '', 'inse');

	$stmt = mysqli_prepare($db, "SELECT * FROM empresa WHERE email = ? AND senha = ?");
	mysqli_stmt_bind_param($stmt, "ss", $email, $senha);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	$numrows = mysqli_num_rows($result);

	if($numrows == 1){
		$row = mysqli_fetch_array($result);
		$_SESSION['nomefantasia'] = $row['nomefantasia'];
		$_SESSION['idempresa'] = $row['id'];
	}
	mysqli_stmt_close($stmt);
	mysqli_close($db);

	return $numrows;

}

//Listagens

function listarPEEs(){

	$db = mysqli_connect('localhost', 'root', '', 'inse');

	$stmt = mysqli_prepare($db, "SELECT * FROM plano_estrategico WHERE empresa = ?");
	mysqli_stmt_bind_param($stmt, "i", $_SESSION['idempresa']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	 echo '<table>
			<th>Título</th>
			<th>Data Inicio</th>
			<th>Data Fim</th>
			<th>Opções</th>';
	while($row = mysqli_fetch_array($result)){
		
		echo '<tr><td>', $row['titulo'], '</td><td>', $row['comeco'], '</td><td>', $row['fim'],'</td><td><a href=identidade.php?plano_estrategico=', $row['id'], '>Editar</a> | </td><td><a>Inativo</a> | <input type="image" class="removerPlano" id="',$row['id'], '" src="images/delete.png"></input></td></tr>';

		/*echo '<form action="identidade.php" method="post">';
		echo '<input type="hidden" name="plano_estrategico" value="', $row['id'], '">';
		echo '<input type="hidden" name="visao" value="', $row['visao'], '">';
		echo '<input type="hidden" name="missao" value="', $row['missao'], '">';
		echo '<input type="hidden" name="valores" value="', $row['valores'], '">';
		echo '<input type="hidden" name="comeco" value="', $row['comeco'], '">';
		echo '<input type="hidden" name="fim" value="', $row['fim'], '">';
		echo '<button>', $row['id'], ' ', $row['visao'], ' ', $row['comeco'], ' ', $row['fim'], '</button>';
		echo '</form>';
		*/

	}
	echo '</table>';

	$result = mysqli_stmt_close($stmt);
	mysqli_close($db);

}

function listarObjetivos(){

	$i = 0;

	$db = mysqli_connect('localhost', 'root', '', 'inse');

	$stmt = mysqli_prepare($db, "SELECT * FROM objetivo WHERE plano_estrategico = ?");
	mysqli_stmt_bind_param($stmt, "i", $_GET['plano_estrategico']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	echo "<div class='objetivos_input'>";
	if(mysqli_num_rows($result) > 0){

		while($row = mysqli_fetch_array($result)){

			echo "<div>
					<label>Objetivo</label>
					<textarea maxlength='255' name='objetivo[]' value=", $i, " style='resize: none;'>", $row['objetivo'], "</textarea>
					<input type='hidden' name='id[]' value=", $row['id'],"></input>
					<a href='#' class='remove_field' id=", $row['id']," style='margin-left:10px;'>Remove</a>
				  </div>";
			$i++;
		}
	}
	else{

		echo "<div>
				<label>Objetivo</label>
				<textarea maxlength='255' name='objetivo[]' value='new' style='resize: none;'></textarea>
				<input type='hidden' name='id[]' value='new'></input>
			  </div>";
	}
	echo '</div>';
	$result = mysqli_stmt_close($stmt);
	mysqli_close($db);
}

function listarIdentidade(){

	$db = mysqli_connect('localhost', 'root', '', 'inse');

	$stmt = mysqli_prepare($db, "SELECT * FROM plano_estrategico WHERE id = ?");
	mysqli_stmt_bind_param($stmt, "i", $_GET['plano_estrategico']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	$row = mysqli_fetch_assoc($result);

	//$date = date('d-m-Y', strtotime($date_from_sql)); //Convert date from php for use ----- not needed

	echo "<div class='input-group'>
			<label>Titulo do Plano Estrategico</label>
				<input type='text' style='width: 100%;' name='titulo' maxlength='100' value='", !empty($row['titulo']) ? $row['titulo'] : '', "'></input>
		  </div>
		  <br>
		  <div class='input-group'>
		  <table>
			<td><label>Data Inicio</label>
				<input type='date' name='comeco' value='", !empty($row['comeco']) ? $row['comeco'] : '' ,"'></input></td>
			<td><label>Data Fim</label>
				<input type='date' name='fim' value='", !empty($row['fim']) ? $row['fim'] : '' ,"'></input></td>
		  </table>
		  </div>
		  <div class='input-group'>
			<label>Visao da empresa</label>
				<textarea name='visao' maxlength='255' style='resize: none;'>", !empty($row['visao']) ? $row['visao'] : '', "</textarea>
		  </div><br>
		  <div class='input-group'>
		  	<label>Missao da empresa</label>
				<textarea name='missao' maxlength='255' style='resize: none;'>", !empty($row['missao']) ? $row['missao'] : '', "</textarea>
		  </div>";

	$stmt = mysqli_prepare($db, "SELECT * FROM valor WHERE plano_estrategico = ?");
	mysqli_stmt_bind_param($stmt, "i", $_GET['plano_estrategico']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	echo "<div class='valores_input'>";
	if(mysqli_num_rows($result) > 0){

		while($row = mysqli_fetch_array($result)){

			echo "<div><br><label>Valores da empresa</label>
					<input type='text' style='width: 100%;' maxlength='100' name='valor[]' value='", $row['valor'], "'></input>
					<input type='hidden'style='width: 100%;' name='id[]' value='", $row['id'],"'></input>
					<a href='#' id='", $row['id'],"'class='remove_field'>Remover</a></div>";
		}
	}
	else{
		echo "<label>Valores da empresa</label>
				<input type='text'style='width: 100%;' maxlength='100' name='valor[]' placeholder='Insira um valor aqui'></input>
				<input type='hidden' style='width: 100%;' name='id[]' value='new'></input>";
	}
	echo "</div>";
	//echo "</table><div align='right'><button class='more' id='add_valor' name='add_valor'>Adicionar Valor</button></div>";
	$result = mysqli_stmt_close($stmt);
	mysqli_close($db);
}

//Inserções

function inserirEmpresa($razaosocial, $nomefantasia, $cnpj, $ramo, $endereco, $responsavel , $telefone , $email, $password, $confir_senha){

	$db = mysqli_connect('localhost', 'root', '', 'inse');

	$cnpj = preg_replace("/[^0-9]/", "", $cnpj);
	$cnpj = str_pad($cnpj, 14, '0', STR_PAD_LEFT);

	$sql = 'INSERT INTO empresa (razaosocial, nomefantasia, cnpj, ramo, endereco, responsavel, telefone, email, senha, confir_senha)
			VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, "ssssssssss", $razaosocial, $nomefantasia, $cnpj, $ramo, $endereco, $responsavel , $telefone , $email, $password, $confir_senha);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_close($stmt);

	mysqli_close($db);
}

function inserirObjetivo($objetivo, $perspectiva){

	$db = mysqli_connect('localhost', 'root', '', 'inse');

	$sql = 'INSERT INTO `objetivo` (objetivo, plano_estrategico, perspectiva_bsc) VALUES (?, ?, ?)';

	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, "sis", $objetivo, $_GET['plano_estrategico'], $perspectiva);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_close($stmt);

	mysqli_close($db);

}

function inserirIdentidade(){
	
	$db = mysqli_connect('localhost', 'root', '', 'inse');

	$sql = 'INSERT INTO plano_estrategico (titulo, visao, missao, comeco, fim, ativo, publicado, empresa) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
	//$date = date('Y-m-d', strtotime($date_from_form)); //Convert date from php for use
	$ativo = (isset($_POST['ativo']) ? $_POST['ativo'] : 0);
	$publicado = (isset($_POST['publicado']) ? $_POST['publicado'] : 0);

	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, "sssssiii", $_POST['titulo'], $_POST['visao'], $_POST['missao'], $_POST['comeco'], $_POST['fim'], $ativo, $publicado, $_SESSION['idempresa']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_close($stmt);
	return mysqli_insert_id($db);
}

function inserirValor($valor){

	$db = mysqli_connect('localhost', 'root', '', 'inse');

	$sql = 'INSERT INTO valor (valor, plano_estrategico) VALUES (?, ?)';

	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, "si", $valor , $_GET['plano_estrategico']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_close($stmt);

	mysqli_close($db);
}


//Alterações

function alterarObjetivo($objetivo, $perspectiva, $id){

	$db = mysqli_connect('localhost', 'root', '', 'inse');

	$sql = 'UPDATE objetivo SET objetivo = ?, perspectiva_bsc = ? WHERE id = ?';
	
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, 'ssi', $objetivo, $perspectiva, $id);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_close($stmt);
	mysqli_close($db);

}

function alterarIdentidade(){

	$db = mysqli_connect('localhost', 'root', '', 'inse');

	$sql = 'UPDATE plano_estrategico SET titulo = ?, visao = ?, missao = ?, comeco = ?, fim = ?, ativo = ?, publicado = ? WHERE id = ?';

	//$comeco = date("Y-m-d", strtotime($_POST['comeco']));
	//$fim = date("Y-m-d", strtotime($_POST['fim']));
	$ativo = (isset($_POST['ativo']) ? $_POST['ativo'] : 0);
	$publicado = (isset($_POST['publicado']) ? $_POST['publicado'] : 0);

	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, 'sssssiii', $_POST['titulo'], $_POST['visao'], $_POST['missao'], $_POST['comeco'], $_POST['fim'], $ativo, $publicado, $_GET['plano_estrategico']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_close($stmt);
	mysqli_close($db);

}

function alterarValor($valor, $id){

	$db = mysqli_connect('localhost', 'root', '', 'inse');

	$sql = 'UPDATE valor SET valor = ? WHERE id = ?';
	
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, 'si', $valor, $id);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_close($stmt);
	mysqli_close($db);

}

//Remoções
/*
function removerObjetivo($id){ 

	$db = mysqli_connect('localhost', 'root', '', 'inse');

	$sql = 'DELETE FROM objetivo WHERE id = ?';
	
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, 'i', $id);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_close($stmt);
	mysqli_close($db);
}

function removerValor($id){ 

	$db = mysqli_connect('localhost', 'root', '', 'inse');

	$sql = 'DELETE FROM valor WHERE id = ?';
	
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, 'i', $id);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_close($stmt);
	mysqli_close($db);
}

function removerPlano($id){ 

	$db = mysqli_connect('localhost', 'root', '', 'inse');

	$sql = 'DELETE FROM plano_estrategico WHERE id = ?';
	
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, 'i', $id);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_close($stmt);
	mysqli_close($db);
}
*/

if(isset($_POST['removerObjetivo'])){ //Remover objetivo chamado por Ajax.. Nao achei um jeito melhor de fazer..
	
	$id = $_POST['removerObjetivo'];
	if($id != 'new'){
		$db = mysqli_connect('localhost', 'root', '', 'inse');

		$sql = 'DELETE FROM objetivo WHERE id = ?';
	
		$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
		mysqli_stmt_bind_param($stmt, 'i', $id);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_close($stmt);
		mysqli_close($db);
	}
}

if(isset($_POST['removerValor'])){ //Remover valor chamado por Ajax.. Nao achei um jeito melhor de fazer..

	$id = $_POST['removerValor'];

	if($id != 'new'){
		$db = mysqli_connect('localhost', 'root', '', 'inse');

		$sql = 'DELETE FROM valor WHERE id = ?';
	
		$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
		mysqli_stmt_bind_param($stmt, 'i', $id);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_close($stmt);
		mysqli_close($db);
	}

}

if(isset($_POST['removerPlano'])){ //Remover Plano chamado por Ajax.. Nao achei um jeito melhor de fazer..

	$id = $_POST['removerPlano'];

	$db = mysqli_connect('localhost', 'root', '', 'inse');

	$sql = 'DELETE FROM plano_estrategico WHERE id = ?';
	
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, 'i', $id);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_close($stmt);
	mysqli_close($db);

}


?>