<?php

	
	/* soak in the passed variable or set our own */
	$ramo = isset($_GET['ramo']) ? $_GET['ramo'] : '*';
	$estado = isset($_GET['estado']) ? $_GET['estado'] : '*'; 
	$cidade = isset($_GET['cidade']) ? $_GET['cidade'] : '*'; 
	
	$db = mysqli_connect('localhost', 'root', '', 'inse');
	$stmt = mysqli_prepare($db, "SELECT a.nomefantasia, b.impacto, d.cidade, d.estado FROM empresa a, impacto b, plano_estrategico c, endereco d WHERE c.empresa = a.id AND c.ativo = true AND b.plano_estrategico = c.id AND a.endereco = c.id AND b.perspectiva_bsc = 'Geral' AND b.dimensao = 'Geral' AND a.ramo = ? AND d.cidade = 'Campinas' AND d.estado = 'São Paulo' ORDER BY b.impacto DESC");
	mysqli_stmt_bind_param($stmt, "iss", $ramo, $cidade, $estado);

	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	/* create one master array of the records */
	$array = array();
	if(mysqli_num_rows($result)) {
		while($row = mysqli_fetch_assoc($result)) {
			$array[] = array('Empresa'=>$row['nomefantasia'], 'Impacto'=>$row['impacto'],'Cidade'=>$row['Cidade'], 'Estado'=>$row['estado']);
		}
	}

	
	$json = $array;
	echo json_encode($json);
	/* disconnect from the db */
	mysqli_close($db);
?>