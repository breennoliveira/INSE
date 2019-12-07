<?php
	header('Content-type:application/json;charset=utf-8');
	header('Access-Control-Allow-Origin: *');

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
	
	

	mysqli_stmt_bind_param($stmt, "sss", $ramo, $cidade, $estado);
	echo mysqli_error($db);
	mysqli_stmt_execute($stmt);
	echo mysqli_error($db);
	$result = mysqli_stmt_get_result($stmt);
	echo mysqli_error($db);
	/* create one master array of the records */
	$array = array();
	if(mysqli_num_rows($result)) {
		while($row = mysqli_fetch_assoc($result)) {
			$array[] = Array('Empresa'=>$row['nomefantasia'], 'Impacto'=>$row['impacto'],'Cidade'=>$row['cidade'], 'Estado'=>$row['estado'], 'Ramo'=>$row['atividade']);
			 //array_push($array, $array2);
			 echo mysqli_error($db);
		}
	}

	echo safe_json_encode($array);

	//echo var_dump(json_encode($array, JSON_UNESCAPED_UNICODE));
	//echo json_last_error();
	//echo json_encode($array, JSON_UNESCAPED_UNICODE);
	/* disconnect from the db */
	mysqli_close($db);


	function safe_json_encode($value, $options = 0, $depth = 512, $utfErrorFlag = false) {
    $encoded = json_encode($value, $options, $depth);
    switch (json_last_error()) {
        case JSON_ERROR_NONE:
            return $encoded;
        case JSON_ERROR_DEPTH:
            return 'Maximum stack depth exceeded'; // or trigger_error() or throw new Exception()
        case JSON_ERROR_STATE_MISMATCH:
            return 'Underflow or the modes mismatch'; // or trigger_error() or throw new Exception()
        case JSON_ERROR_CTRL_CHAR:
            return 'Unexpected control character found';
        case JSON_ERROR_SYNTAX:
            return 'Syntax error, malformed JSON'; // or trigger_error() or throw new Exception()
        case JSON_ERROR_UTF8:
            $clean = utf8ize($value);
            if ($utfErrorFlag) {
                return 'UTF8 encoding error'; // or trigger_error() or throw new Exception()
            }
            return safe_json_encode($clean, $options, $depth, true);
        default:
            return 'Unknown error'; // or trigger_error() or throw new Exception()

    }
}

function utf8ize($mixed) {
    if (is_array($mixed)) {
        foreach ($mixed as $key => $value) {
            $mixed[$key] = utf8ize($value);
        }
    } else if (is_string ($mixed)) {
        return utf8_encode($mixed);
    }
    return $mixed;
}



?>