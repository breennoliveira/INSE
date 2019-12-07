<?php
	header('Content-type:application/json;charset=utf-8');
	header('Access-Control-Allow-Origin: localhost');

	/* soak in the passed variable or set our own */
	$ramo = isset($_GET['ramo']) ? $_GET['ramo'] : '%';
	$estado = isset($_GET['estado']) ? $_GET['estado'] : '%';
	$cidade = isset($_GET['cidade']) ? $_GET['cidade'] : '%';

	$db = mysqli_connect('localhost', 'root', '', 'inse');
	$stmt = mysqli_prepare($db, "SELECT a.nomefantasia, b.impacto, d.cidade, d.estado, e.atividade FROM empresa a
								INNER JOIN plano_estrategico c ON c.empresa = a.id
								INNER JOIN impacto b ON b.plano_estrategico = c.id
								INNER JOIN endereco d ON a.endereco = d.id
								INNER JOIN ramo_atuacao e ON a.ramo = e.id
	                            WHERE b.perspectiva_bsc = 'Geral'
								AND b.dimensao = 'Geral' AND e.atividade LIKE ? AND d.cidade LIKE ? AND d.estado LIKE ? ORDER BY b.impacto DESC");
	
	echo mysqli_error($db);

	mysqli_stmt_bind_param($stmt, "sss", $ramo, $cidade, $estado);

	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	/* create one master array of the records */
	$array = array();
	if(mysqli_num_rows($result)) {
		while($row = mysqli_fetch_assoc($result)) {
			$array[] = Array('Empresa'=>$row['nomefantasia'], 'Impacto'=>$row['impacto'],'Cidade'=>$row['cidade'], 'Estado'=>$row['estado'], 'Ramo'=>$row['atividade']);
			 //array_push($array, $array2);
		}
	}


	echo json_encode($array, JSON_UNESCAPED_UNICODE);
	/* disconnect from the db */
	mysqli_close($db);
?>