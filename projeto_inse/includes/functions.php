<?php

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

//Listagens

function listarPEEs(){

	// Set variables

	$db = mysqli_connect('localhost', 'root', '', 'inse');

	$stmt = mysqli_prepare($db, "SELECT * FROM plano_estrategico WHERE empresa = ?");
	mysqli_stmt_bind_param($stmt, "i", $_SESSION['idempresa']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	while($row = mysqli_fetch_array($result)){
		
		echo '<a href=identidade.php?plano_estrategico=',$row['id'],'>', $row['id'], ' ', $row['visao'], ' ', $row['comeco'], ' ', $row['fim'], '</a>', '<br>';

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

}

function listarObjetivos(){

	$i = 1;

	$db = mysqli_connect('localhost', 'root', '', 'inse');

	$stmt = mysqli_prepare($db, "SELECT * FROM objetivo WHERE plano_estrategico = ?");
	mysqli_stmt_bind_param($stmt, "i", $_GET['plano_estrategico']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	if(mysqli_num_rows($result) > 0){

		while($row = mysqli_fetch_array($result)){

			echo "<div class='input-group'>
					<label>Objetivo</label>
					<textarea name='objetivo[]' value=", $i, " style='resize: none;'>", $row['objetivo'], "</textarea>
					<input type='hidden' name='id[]' value=", $row['id'],">
				  </div>";
			$i++;
		}
	}
	else{

		echo "<div class='input-group'>
					<label>Objetivo</label>
					<textarea name='objetivo[]' value='new' style='resize: none;'></textarea>
			  </div>
			  <div class='input-group'>
					<label>Objetivo</label>
					<textarea name='objetivo[]' value='new' style='resize: none;'></textarea>
			  </div>
			  <div class='input-group'>
					<label>Objetivo</label>
					<textarea name='objetivo[]' value='new' style='resize: none;'></textarea>
			  </div>";

	}
}

function listarIdentidade(){

	$db = mysqli_connect('localhost', 'root', '', 'inse');

	$stmt = mysqli_prepare($db, "SELECT * FROM plano_estrategico WHERE id = ?");
	mysqli_stmt_bind_param($stmt, "i", $_GET['plano_estrategico']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	$row = mysqli_fetch_assoc($result);

	echo "<div class='input-group'>
							  		<label>Visao da empresa</label>
							  		<textarea name='visao' style='resize: none;'>", $row['visao'], "</textarea>
							  	</div>
							  	<div class='input-group'>
							  		<label>Missao da empresa</label>
							  		<textarea name='missao' style='resize: none;'>", $row['missao'], "</textarea>
							  	</div>
							  	<div class='input-group'>
							  		<label>Valores da empresa</label>
							  		<textarea name='valores' style='resize: none;'>", $row['valores'], "</textarea>
							  	</div>";

}

//Inserções

function inserirObjetivo($objetivo, $perspectiva){

	$db = mysqli_connect('localhost', 'root', '', 'inse');

	$sql = 'INSERT INTO `objetivo` (objetivo, plano_estrategico, perspectiva_bsc) VALUES (?, ?, ?)';

	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, "sis", $objetivo, $_GET['plano_estrategico'], $perspectiva);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_close($stmt);

}

function inserirIdentidade($visao, $missao, $valores){
	
	$db = mysqli_connect('localhost', 'root', '', 'inse');

	$sql = 'INSERT INTO `plano_estrategico` (visao, missao, valores, comeco, fim, ativo, publicado, empresa) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';

	$comeco = '2019-06-09';
	$fim = '2019-06-10';
	$ativo = 0;
	$publicado = 0;

	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, "sssssiii", $visao, $missao, $valores, $comeco, $fim, $ativo, $publicado, $_SESSION['idempresa']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_close($stmt);

	return mysqli_insert_id($db);

	print_r($result);
}


//Alterações

function alterarObjetivo($objetivo, $perspectiva, $id){

	$db = mysqli_connect('localhost', 'root', '', 'inse');

	$sql = 'UPDATE objetivo SET objetivo = ?, perspectiva_bsc = ? WHERE id = ?';
	
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, 'ssi', $objetivo, $perspectiva, $id);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_close($stmt);

}

function alterarIdentidade($visao, $missao, $valores){

	$db = mysqli_connect('localhost', 'root', '', 'inse');

	$sql = 'UPDATE plano_estrategico SET visao = ?, missao = ?, valores = ? WHERE id = ?';
	
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, 'sssi', $visao, $missao, $valores, $_GET['plano_estrategico']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_close($stmt);

}

?>