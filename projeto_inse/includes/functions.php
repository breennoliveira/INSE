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

function listarPEEs(){

	// Set variables

	$db = mysqli_connect('localhost', 'root', '', 'inse');

	$stmt = mysqli_prepare($db, "SELECT * FROM plano_estrategico WHERE empresa = ?");
	mysqli_stmt_bind_param($stmt, "i", $_SESSION['idempresa']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	while($row = mysqli_fetch_array($result)){
		
		//echo '<a href=identidade.php?id=',$row['id'],'>', $row['id'], ' ', $row['visao'], ' ', $row['comeco'], ' ', $row['fim'], '</a>', '<br>';

		echo '<form action="identidade.php" method="post">';
		echo '<input type="hidden" name="idPEE" value="', $row['id'], '">';
		echo '<input type="hidden" name="visao" value="', $row['visao'], '">';
		echo '<input type="hidden" name="missao" value="', $row['missao'], '">';
		echo '<input type="hidden" name="valores" value="', $row['valores'], '">';
		echo '<input type="hidden" name="comeco" value="', $row['comeco'], '">';
		echo '<input type="hidden" name="fim" value="', $row['fim'], '">';
		//value2="',$row['visao'],'" comeco="',$row['comeco'],'" fim="',$row['fim'],'"/>';
		echo '<button>', $row['id'], ' ', $row['visao'], ' ', $row['comeco'], ' ', $row['fim'], '</button>';
		echo '</form>';


	}

}

function possuiObjetivos(){

	$db = mysqli_connect('localhost', 'root', '', 'inse');

	$stmt = mysqli_prepare($db, "SELECT * FROM objetivo WHERE plano_estrategico = ?");
	mysqli_stmt_bind_param($stmt, "i", $_SESSION['idPEE']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	$numrows = mysqli_num_rows($result);

	mysqli_stmt_close($stmt);
	mysqli_close($db);

	return $result;

}


?>