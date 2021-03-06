﻿<?php
//functions.php é usado para insert/select/update/remove, ou seja, tudo que tiver a ver com banco de dados
//https://www.geradorcnpj.com/script-validar-cnpj-php.htm
// CNPJ Stuff
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
function adicionaMascaraCNPJ($cnpj){
	return preg_replace("/([0-9]{2})([0-9]{3})([0-9]{3})([0-9]{4})([0-9]{2})/", "$1.$2.$3/$4-$5", $cnpj);
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
	$stmt = mysqli_prepare($db, "SELECT * FROM usuario WHERE email = ?");
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
	$stmt = mysqli_prepare($db, "SELECT * FROM usuario WHERE email = ?");
	mysqli_stmt_bind_param($stmt, "s", $email);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$row = mysqli_fetch_array($result);
	$numrows = mysqli_num_rows($result);
	if($numrows == 1 && password_verify($senha, $row['senha'])){
		
		$_SESSION['idusuario'] = $row['id'];
		$stmt = mysqli_prepare($db, "SELECT * FROM empresa WHERE id = ?");
		mysqli_stmt_bind_param($stmt, "i", $row['empresa']);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$row = mysqli_fetch_array($result);
		$_SESSION['nomefantasia'] = $row['nomefantasia'];
		$_SESSION['idempresa'] = $row['id'];
		$return = 1;
	}
	else{
		$return = 0;
	}
	
	mysqli_stmt_close($stmt);
	mysqli_close($db);
	return $return;
}
//Listagens
function listarPEEs(){

	$true = true;
	$false = false;

	$db = mysqli_connect('localhost', 'root', '', 'inse');
	
	$stmt = mysqli_prepare($db, "SELECT * FROM plano_estrategico WHERE empresa = ? AND ativo = ? AND publicado = ?");
	mysqli_stmt_bind_param($stmt, "iii", $_SESSION['idempresa'], $true, $true);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	echo '<section class="pee-section"><h2>Plano Estratégico em Vigência</h2>';

	if(mysqli_num_rows($result) > 0){
		echo '<table>
			  <th class="center c5">Título</th>
			  <th class="center c2">Data Inicio</th>
			  <th class="center c2">Data Fim</th>
			  <th class="center c1">Opções</th>';

		while($row = mysqli_fetch_array($result)){
		
			echo '<tr><td class="left center">', $row['titulo'], '</td><td class="center">', $row['comeco'], '</td><td class="center">', $row['fim'],'</td><td class="center"><a href=identidade.php?plano_estrategico=', $row['id'], '><input type="image" alt="Editar Plano" title="Editar Plano" src="images/edit.png"></input></a>&nbsp&nbsp<input type="image" title="Remover Plano" alt="Remover Plano" class="removerPlano" src="images/delete.png" id="', $row['id'], '"></input></td></tr>';

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
	}
	else{
		echo '<h4>Você não possui nenhum Plano Estratégico em Vigência</h4>';
	}
	echo '</section><hr>';

	$stmt = mysqli_prepare($db, "SELECT * FROM plano_estrategico WHERE empresa = ? AND ativo = ? AND publicado = ?");
	mysqli_stmt_bind_param($stmt, "iii", $_SESSION['idempresa'], $false, $false);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	echo '<section class="pee-section"><h2>Planos Estratégicos em Preparação</h2>';

	if(mysqli_num_rows($result) > 0){
		echo '<table>
			  <th class="center c5">Título</th>
			  <th class="center c2">Data Inicio</th>
			  <th class="center c2">Data Fim</th>
			  <th class="center c1">Opções</th>';

		while($row = mysqli_fetch_array($result)){
		
			echo '<tr><td class="left center">', $row['titulo'], '</td><td class="center">', $row['comeco'], '</td><td class="center">', $row['fim'],'</td><td class="center"><a href=identidade.php?plano_estrategico=', $row['id'], '><input type="image" alt="Editar Plano" title="Editar Plano" src="images/edit.png"></input></a>&nbsp&nbsp<input type="image" title="Deletar Plano" alt="Deletar Plano" class="removerPlano" src="images/delete.png" id="', $row['id'], '"></input></td></tr>';

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
	}
	else{
		echo '<h4>Você não possui nenhum Plano Estratégico em Preparação</h4>';
	}
	echo '</section><hr>';

	$stmt = mysqli_prepare($db, "SELECT * FROM plano_estrategico WHERE empresa = ? AND ativo = ? AND publicado = ?");
	mysqli_stmt_bind_param($stmt, "iii", $_SESSION['idempresa'], $false, $true);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	echo '<section class="pee-section"><h2>Planos Estratégicos Passados</h2>';

	if(mysqli_num_rows($result) > 0){
		echo '<table>
			  <th class="center c5">Título</th>
			  <th class="center c2">Data Inicio</th>
			  <th class="center c2">Data Fim</th>
			  <th class="center c1">Opções</th>';

		while($row = mysqli_fetch_array($result)){
		
			echo '<tr><td class="left center">', $row['titulo'], '</td><td class="center">', $row['comeco'], '</td><td class="center">', $row['fim'],'</td><td class="center"><a href=identidade.php?plano_estrategico=', $row['id'], '><input type="image" alt="Editar Plano" title="Editar Plano" src="images/edit.png"></input></a>&nbsp&nbsp<input type="image" title="Deletar Plano" alt="Deletar Plano" class="removerPlano" src="images/delete.png" id="', $row['id'], '"></input></td></tr>';

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
	}
	else{
		echo '<h4>Você não possui nenhum Plano Estratégico Passado</h4>';
	}
	echo '</section><hr>';



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
	echo "<style>
			table {
			  border-collapse: collapse;
			  width: 150%;
			}
			td, th {
			  text-align: left;
			  padding: 8px;
			}
			</style><div class='objetivos_input'>";
	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_array($result)){
			echo "<table>
					<th><Objetivo</th><th>Perspectiva do BSC</th>
					<tr><td><textarea maxlength='255' rows='3' name='objetivo[]' value=", $i, " style='resize: none;'>", $row['objetivo'], "</textarea>
					<!--<td><input type='radio' name='perspectiva_bsc[", $i ,"]' value='Econômico-Financeira'", ($row['perspectiva_bsc'] == 'Econômico-Financeira' ? 'checked' : ''), ">Econômico-Financeira<br>
					<input type='radio' name='perspectiva_bsc[", $i ,"]' value='Clientes'", ($row['perspectiva_bsc'] == 'Clientes' ? 'checked' : ''), ">Clientes<br>
					<input type='radio' name='perspectiva_bsc[", $i ,"]' value='Processos Internos'", ($row['perspectiva_bsc'] == 'Processos Internos' ? 'checked' : ''), ">Processos Internos<br>
					<input type='radio' name='perspectiva_bsc[", $i ,"]' value='Aprendizado e Crescimento'", ($row['perspectiva_bsc'] == 'Aprendizado e Crescimento' ? 'checked' : ''), ">Aprendizado e Crescimento<br>-->
					<input type='hidden' name='id[]' value=", $row['id'],"></input>
					<a href='#' class='remove_field' id=", $row['id']," style='margin-left:10px;'>Remove</a></td></tr>
				  </table>";
			$i++;
		}
	}
	else{
		echo "<table>
				<th>Objetivo</th><th>Perspectiva do BSC</th>
				<tr><td><textarea maxlength='255' rows='3' name='objetivo[]' value='new' style='resize: none;'></textarea></td>
				<!--<td><input type='radio' name='perspectiva_bsc[", $i ,"]' value='Econômico-Financeira'>Econômico-Financeira<br>
				<input type='radio' name='perspectiva_bsc[", $i ,"]' value='Clientes'>Clientes<br>
				<input type='radio' name='perspectiva_bsc[", $i ,"]' value='Processos Internos'>Processos Internos<br>
				<input type='radio' name='perspectiva_bsc[", $i ,"]' value='Aprendizado e Crescimento'>Aprendizado e Crescimento<br>-->
				<input type='hidden' name='id[]' value='new'></input></td></tr>
			  </table>";
			  $i++;
	}
	echo '</div>';
	$result = mysqli_stmt_close($stmt);
	mysqli_close($db);
	return $i;
}
function listarObjetivosnew(){
	$db = mysqli_connect('localhost', 'root', '', 'inse');
	$stmt = mysqli_prepare($db, "SELECT * FROM objetivo WHERE plano_estrategico = ?");
	mysqli_stmt_bind_param($stmt, "i", $_GET['plano_estrategico']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	echo "<div class='objetivos_input'>";
	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_array($result)){
			echo "<div><h4>Objetivo</h4>
						<textarea maxlength='255' rows='3' name='objetivo[]' style='resize: none;'>", $row['objetivo'], "</textarea>
						<input type='hidden' name='objid[]' value=", $row['id'],"></input>
						<a href=estrategias.php?plano_estrategico=", $_GET['plano_estrategico'], "&objetivo=", $row['id'], "><button type='button' class='button small'>Estratégias</button></a>
						<a href=metas.php?plano_estrategico=", $_GET['plano_estrategico'], "&objetivo=", $row['id'], "><button type='button' class='button small'>Metas</button></a>
						<button type='button' class='button small remove' id=", $row['id'],">Remover</button>
				  </div>";
		}
	}
	else{
		echo "<div>
					<h4>Objetivo</h4>
						<textarea maxlength='255' rows='3' name='objetivo[]' value='new' style='resize: none;'></textarea>
						<input type='hidden' name='objid[]' value='new'></input>
				  </div>";
	}
	echo "</div>";
	$result = mysqli_stmt_close($stmt);
	mysqli_close($db);
}
function listarEstrategias($idobjetivo){
	$count = 0;
	$db = mysqli_connect('localhost', 'root', '', 'inse');
	$stmt = mysqli_prepare($db, "SELECT objetivo FROM objetivo WHERE id = ?");
	mysqli_stmt_bind_param($stmt, "i", $idobjetivo);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$row = mysqli_fetch_array($result);
	echo "<h4>Objetivo</h4><textarea maxlength='255' disabled style='resize:none;' >", $row['objetivo'], "</textarea><br>";
	$stmt = mysqli_prepare($db, "SELECT * FROM estrategia WHERE objetivo = ?");
	mysqli_stmt_bind_param($stmt, "i", $idobjetivo);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	echo "<div class='estrategias_input'>";
	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_array($result)){
			echo "<table>
					<col class='c4'><th class='left'><br>Estratégia</th></col><th><br>Perspectiva do BSC</th><th><br>Impacto</th><th class='center'>Grau de Contribuição<br>Triple Bottom Line</th>
					<tr><td class='left'><textarea maxlength='255' rows='3' name='estrategia[]' value=", $count, " style='resize: none;'>", $row['estrategia'], "</textarea>
					<button type='button' class='button small remove' id=", $row['id'], ">Remover</button></td>
					<td><input type='radio' name='perspectiva_bsc[", $count , "]' value='Econômico-Financeira'", ($row['perspectiva_bsc'] == 'Econômico-Financeira' ? 'checked' : ''), ">Econômico-Financeira<br>
					<input type='radio' name='perspectiva_bsc[", $count , "]' value='Clientes'", ($row['perspectiva_bsc'] == 'Clientes' ? 'checked' : ''), ">Clientes<br>
					<input type='radio' name='perspectiva_bsc[", $count , "]' value='Processos Internos'", ($row['perspectiva_bsc'] == 'Processos Internos' ? 'checked' : ''), ">Processos Internos<br>
					<input type='radio' name='perspectiva_bsc[", $count , "]' value='Aprendizado e Crescimento'", ($row['perspectiva_bsc'] == 'Aprendizado e Crescimento' ? 'checked' : ''), ">Aprendizado e Crescimento<br>
					<input type='hidden' name='estid[]' value=", $row['id'], "></input></td>
					<td><img class='icon' src='images/ambiental.png' alt='Sustentabilidade Ambiental' title='Sustentabilidade Ambiental'><select name='ambiental[", $count , "]'>
					<option value='100' ", ($row['impacto_ambiental'] == '100' ? 'selected' : ''), ">100</option>
					<option value='200' ", ($row['impacto_ambiental'] == '200' ? 'selected' : ''), ">200</option>
					<option value='300' ", ($row['impacto_ambiental'] == '300' ? 'selected' : ''), ">300</option></select><br>
					<img class='icon' src='images/economica.png' alt='Sustentabilidade Econômica' title='Sustentabilidade Econômica'><select name='economica[", $count , "]'>
					<option value='100' ", ($row['impacto_economico'] == '100' ? 'selected' : ''), ">100</option>
					<option value='200' ", ($row['impacto_economico'] == '200' ? 'selected' : ''), ">200</option>
					<option value='300' ", ($row['impacto_economico'] == '300' ? 'selected' : ''), ">300</option></select><br>
					<img class='icon' src='images/social.png' alt='Sustentabilidade Social' title='Sustentabilidade Social'><select name='social[", $count , "]'>
					<option value='100' ", ($row['impacto_social'] == '100' ? 'selected' : ''), ">100</option>
					<option value='200' ", ($row['impacto_social'] == '200' ? 'selected' : ''), ">200</option>
					<option value='300' ", ($row['impacto_social'] == '300' ? 'selected' : ''), ">300</option></select></td>
					<td><select class='center' name='grau[", $count , "]'>
					<option value='1' ", ($row['grau_contribuicao'] == '1' ? 'selected' : ''), ">1</option>
					<option value='2' ", ($row['grau_contribuicao'] == '2' ? 'selected' : ''), ">2</option>
					<option value='3' ", ($row['grau_contribuicao'] == '3' ? 'selected' : ''), ">3</option></select></td></tr>
				  </table>";
			$count++;
		}
	}
	else{
		echo "<table>
				<col class='c4'><th class='left'><br>Estratégia</th></col><th><br>Perspectiva do BSC</th><th><br>Impacto</th><th class='center'>Grau de Contribuição<br>Triple Bottom Line</th>
				<tr><td class='left'><textarea maxlength='255' rows='3' name='estrategia[]' value='new' style='resize: none;'></textarea></td>
				<td><input type='radio' name='perspectiva_bsc[", $count , "]' value='Econômico-Financeira'>Econômico-Financeira<br>
				<input type='radio' name='perspectiva_bsc[", $count , "]' value='Clientes'>Clientes<br>
				<input type='radio' name='perspectiva_bsc[", $count , "]' value='Processos Internos'>Processos Internos<br>
				<input type='radio' name='perspectiva_bsc[", $count , "]' value='Aprendizado e Crescimento'>Aprendizado e Crescimento<br>
				<input type='hidden' name='estid[]' value='new'></input></td>
				<td><img class='icon' src='images/ambiental.png' alt='Sustentabilidade Ambiental' title='Sustentabilidade Ambiental'><select name='ambiental[", $count , "]'>
				<option value='100'>100</option>
				<option value='200'>200</option>
				<option value='300'>300</option></select><br>
				<img class='icon' src='images/economica.png' alt='Sustentabilidade Econômica' title='Sustentabilidade Econômica'><select name='economica[", $count , "]'>
				<option value='100'>100</option>
				<option value='200'>200</option>
				<option value='300'>300</option></select><br>
				<img class='icon' src='images/social.png' alt='Sustentabilidade Social' title='Sustentabilidade Social'><select name='social[", $count , "]'>
				<option value='100'>100</option>
				<option value='200'>200</option>
				<option value='300'>300</option></select></td>
				<td><select class='center' name='grau[", $count , "]'>
				<option value='1'>1</option>
				<option value='2'>2</option>
				<option value='3'>3</option></select></td></tr>
			  </table>";
			  $count++;
	}
	echo "</div>";
	$result = mysqli_stmt_close($stmt);
	mysqli_close($db);
	return $count;
}
function listarMetas($idobjetivo){
	$i = 0;
	$db = mysqli_connect('localhost', 'root', '', 'inse');
	$stmt = mysqli_prepare($db, "SELECT objetivo FROM objetivo WHERE id = ?");
	mysqli_stmt_bind_param($stmt, "i", $idobjetivo);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$row = mysqli_fetch_array($result);
	echo "<h4>Objetivo</h4><textarea maxlength='255' disabled style='resize:none;' >", $row['objetivo'], "</textarea><br>";
	$stmt = mysqli_prepare($db, "SELECT * FROM meta WHERE objetivo = ?");
	mysqli_stmt_bind_param($stmt, "i", $idobjetivo);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	echo "<div class='metas_input'>";
	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_array($result)){
			echo "<table><th class='left' width='100%'>Meta</th><th>Data limite</th>
						<tr><td class='left'><input type='text' maxlength='255' name='meta[]' value='", $row['meta'], "'></input>
						<a href=indicadores.php?plano_estrategico=", $_GET['plano_estrategico'], "&objetivo=", $idobjetivo, "&meta=", $row['id'] , ">
						<button type='button' class='button small'>Indicadores</button></a>
						<button type='button' class='button small remove' id=", $row['id'],">Remover</button>
						<td><input type='date' name='data_limite[]' value='", !empty($row['data_limite']) ? $row['data_limite'] : (isset($_POST['data_limite']) ? $_POST['data_limite'] : '') ,"'></input></td>
						<input type='hidden' name='metid[]' value=", $row['id'],"></input></td></tr>
					</table>";
			$i++;
		}
	}
	else{
		echo "<table>
				<th class='left' width='100%'>Meta</th><th>Data limite</th>
				<tr><td class='left'><input type='text' maxlength='255' name='meta[]' placeholder='Insira uma Meta aqui'></input></td>
				<td><input type='date' name='data_limite[]' value='", isset($_POST['data_limite']) ? $_POST['data_limite'] : '' ,"'></input>
				<input type='hidden' name='metid[]' value='new'></input></td></tr>
			</table>";
			  $i++;
	}
	echo "</div>";
	$result = mysqli_stmt_close($stmt);
	mysqli_close($db);
	return $i;
}
function listarIndicadores($idmeta){
	$db = mysqli_connect('localhost', 'root', '', 'inse');
	$stmt = mysqli_prepare($db, "SELECT meta FROM meta WHERE id = ?");
	mysqli_stmt_bind_param($stmt, "i", $idmeta);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$row = mysqli_fetch_array($result);
	echo "<h4>Meta</h4><input type='text' maxlength='255' disabled value='", $row['meta'], "'></input><br>";
	$stmt = mysqli_prepare($db, "SELECT * FROM indicador WHERE meta = ?");
	mysqli_stmt_bind_param($stmt, "i", $idmeta);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	echo "<div class='indicadores_input'>";
	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_array($result)){
			echo "<div><h4>Indicador</h4>
						<textarea maxlength='255' rows='3' name='indicador[]' style='resize: none;'>", $row['indicador'], "</textarea>
						<input type='hidden' name='indid[]' value=", $row['id'],"></input>
						<button type='button' class='button small remove' id=", $row['id'],">Remove</a>
					</div>";
		}
	}
	else{
		echo "<div><h4>Indicador</h4>
				<textarea maxlength='255' rows='3' name='indicador[]' value='new' style='resize: none;'></textarea>
				<input type='hidden' name='indid[]' value='new'></input>
			</div>";
	}
	echo "</div>";
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
			<h4>Titulo do Plano Estrategico</h4>
				<input type='text' style='width: 100%;' name='titulo' maxlength='100' value='", !empty($row['titulo']) ? $row['titulo'] : (isset($_POST['titulo']) ? $_POST['titulo'] : ''), "'></input>
		  </div>
		  <br>
		  <div class='input-group'>
		  <table>
			<td class='center'><h4>Data Inicio</h4>
				<input type='date' name='comeco' value='", !empty($row['comeco']) ? $row['comeco'] : (isset($_POST['comeco']) ? $_POST['comeco'] : '') ,"'></input></td>
			<td class='center'><h4>Data Fim</h4>
				<input type='date' name='fim' value='", !empty($row['fim']) ? $row['fim'] : (isset($_POST['fim']) ? $_POST['fim'] : '') ,"'></input></td>
		  </table>
		  </div>
		  <div class='input-group'>
			<h4>Visao da empresa</h4>
				<textarea name='visao' maxlength='255' style='resize: none;'>", !empty($row['visao']) ? $row['visao'] : (isset($_POST['visao']) ? $_POST['visao'] : ''), "</textarea>
		  </div><br>
		  <div class='input-group'>
		  	<h4>Missao da empresa</h4>
				<textarea name='missao' maxlength='255' style='resize: none;'>", !empty($row['missao']) ? $row['missao'] : (isset($_POST['missao']) ? $_POST['missao'] : ''), "</textarea>
		  </div>";
	$stmt = mysqli_prepare($db, "SELECT * FROM valor WHERE plano_estrategico = ?");
	mysqli_stmt_bind_param($stmt, "i", $_GET['plano_estrategico']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	echo "<div class='valores_input'>";
	if(mysqli_num_rows($result) > 0){
		$i=0;
		while($row = mysqli_fetch_array($result)){
			echo "<div><br><label>Valores da empresa</label>
					<input type='text' style='width: 100%;' maxlength='100' name='valor[]' value='", $row['valor'], "'></input>
					<input type='hidden' name='id[]' value='", $row['id'],"'></input>
					<button type='button' id='", $row['id'],"'class='button small remove'>Remover</a></div>";
		}
		if(isset($_POST['valor'])){
			foreach ($_POST['valor'] as $valor){
				$id = array_slice($_POST['id'],$i,1);
				if($id['0'] == 'new'){
					echo "<div><br><label>Valores da empresa</label>
						<input type='text' style='width: 100%;' maxlength='100' name='valor[]' value='", $valor, "'></input>
						<input type='hidden'style='width: 100%;' name='id[]' value='new'></input>
						<button type='button' id='new'class='button small remove'>Remover</button></div>";
				}
				$i++;
			}
		}
	}
	else{
		if(isset($_POST['valor'])){
			foreach ($_POST['valor'] as $valor){
				echo "<div><br><label>Valores da empresa</label>
					<input type='text' style='width: 100%;' maxlength='100' name='valor[]' value='", $valor, "'></input>
					<input type='hidden'style='width: 100%;' name='id[]' value='new'></input>", count($_POST['valor']) == 1 && $valor == '' ? "</div>" : "<button type='button' id='new' class='button small remove'>Remover</button></div>";
			}
		}
		else{
			echo "<div><br><label>Valores da empresa</label>
					<input type='text'style='width: 100%;' maxlength='100' name='valor[]' placeholder='Insira um valor aqui'></input>
					<input type='hidden' style='width: 100%;' name='id[]' value='new'></input></div>";
		}
	}
	echo "</div>";
	//echo "</table><div align='right'><button class='more' id='add_valor' name='add_valor'>Adicionar Valor</button></div>";
	$result = mysqli_stmt_close($stmt);
	mysqli_close($db);
}

function listarPesquisa(){
	if (!isset($_POST['nome'])){
		return ;
	}

	if (empty($_POST['nome']) || strlen($_POST['nome']) < 3){
		
		echo "<div class='alert alert-danger alert-dismissible' role='alert'>Valor de pesquisa inválido!
	   <button type='button' class='close' data-dismiss='alert' aria-label='Fechar'><span aria-hidden='true'>&times;</span></button></div>";
		
		return ;
		}

	$nome = "%".$_POST['nome']."%";

	$db = mysqli_connect('localhost', 'root', '', 'inse');
	$stmt = mysqli_prepare($db, "SELECT * FROM empresa WHERE nomefantasia LIKE ?");
	mysqli_stmt_bind_param($stmt, "s", $nome);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	if (mysqli_num_rows($result) == 0) {
		
		echo "<div class='alert alert-danger alert-dismissible' role='alert'>Nenhuma empresa foi encontrada!
		<button type='button' class='close' data-dismiss='alert' aria-label='Fechar'><span aria-hidden='true'>&times;</span></button></div>";

		return;

	}

	$row = mysqli_fetch_all($result);

	echo "<section class='pee-section'><table><tr><th class='center'>Razão Social</th><th class='center'>Nome Fantasia</th><th class='center'>Ramo de Atuação</th><th class='center'>Opções</th></tr>";

	 foreach ($row as $empresa){
		if($empresa[3] != '0000'){
			
			$stmt = mysqli_prepare($db, "SELECT * FROM ramo_atuacao WHERE id = ?");
			mysqli_stmt_bind_param($stmt, "i", $empresa[4]);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			
			$row2 = mysqli_fetch_array($result);

			echo "<tr><td>", $empresa[1], "</td><td>", $empresa[2], "</td><td>", utf8_decode($row2['atividade']), "</td><td class='center'><a href=detalhes.php?empresa=", $empresa[0], "><input type='image' alt='Editar Plano' title='Editar Plano' src='images/information.png'></input></a></td></tr>";
		}
	 }

	 echo "</table></section><hr>";

}

function listarDetalhesEmpresa(){

	$db = mysqli_connect('localhost', 'root', '', 'inse') or die(mysqli_error($db));
	$stmt = mysqli_prepare($db, "SELECT * FROM empresa WHERE id = ?");
	mysqli_stmt_bind_param($stmt, "i", $_GET['empresa']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	$empresa = mysqli_fetch_array($result);

	echo "<header class='major'><h2 class='welcome'>", $empresa['nomefantasia'], "</h2>";

	$stmt = mysqli_prepare($db, "SELECT * FROM plano_estrategico WHERE empresa = ? AND ativo = true");
	mysqli_stmt_bind_param($stmt, "i", $_GET['empresa']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	if (mysqli_num_rows($result) == 0){
		echo "<br><label>Essa empresa não possúi nada públicado ainda!</label>";
		return;
	}

	echo "</header>";

	$plano = mysqli_fetch_array($result);

	$stmt = mysqli_prepare($db, "SELECT * FROM impacto WHERE plano_estrategico = ? AND perspectiva_bsc = 'Geral' AND dimensao = 'Geral'");
	mysqli_stmt_bind_param($stmt, "i", $plano['id']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	$geral = mysqli_fetch_array($result);

	$stmt = mysqli_prepare($db, "SELECT * FROM impacto WHERE plano_estrategico = ? AND perspectiva_bsc = 'Geral' AND dimensao = 'Economica'");
	mysqli_stmt_bind_param($stmt, "i", $plano['id']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	$economica = mysqli_fetch_array($result);

	$stmt = mysqli_prepare($db, "SELECT * FROM impacto WHERE plano_estrategico = ? AND perspectiva_bsc = 'Geral' AND dimensao = 'Social'");
	mysqli_stmt_bind_param($stmt, "i", $plano['id']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	$social = mysqli_fetch_array($result);

	$stmt = mysqli_prepare($db, "SELECT * FROM impacto WHERE plano_estrategico = ? AND perspectiva_bsc = 'Geral' AND dimensao = 'Ambiental'");
	mysqli_stmt_bind_param($stmt, "i", $plano['id']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	$ambiental = mysqli_fetch_array($result);

	echo "Plano em Execução: ", $plano['titulo'], "<br>";
	echo "Visão do Plano: ", $plano['visao'], "<br>";
	echo "Missão do Plano: ", $plano['missao'], "<br>";
	echo "Impacto Geral: ", $geral['impacto'], "<br>";

	echo "<table class='charts'><tr><th class='center'>Distribuição entre Dimensões de Sustentabilidade</th><th class='center'>Nota de Sustentabilidade Geral</th></tr><tr>";
	echo "<td class='center'><div id='curve_chart0'></div></td>";
	echo "<td class='center'><div id='curve_chart1'></div></td></tr>";
	echo "<tr><th colspan='2' class='center'>Impacto na Sustentabilidade ao Longo do Tempo</th></tr><tr><td colspan='2' class='center'><div id='line_chart0'></div></td>";
	echo "</tr></table></div>";

	$porAcao = 8.1 - (INT)$geral['impacto'];
	echo"
	<script type='text/javascript'>
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {

		var data = google.visualization.arrayToDataTable([
			['', ''],
			['Impacto Geral', ", $geral['impacto'], "],
			['', ", $porAcao, "]
			]);

		var options = {
			curveType: 'function',
			enableInteractivity: 'false',
			pieStartAngle: 180,
			legend: 'none',
			width: 380,
			height: 300,
			slices: {
			0: { color: '#2B8334' },
			1: { color: 'red', textStyle: {color: 'red'} }
			}
		};
		

		var chart_div = document.getElementById('curve_chart1');
		var chart = new google.visualization.PieChart(chart_div);

		google.visualization.events.addListener(chart, 'ready', function () {
			chart_div.innerHTML = '<img src=' + chart.getImageURI() + '>';
		});

		chart.draw(data, options);
		}
	</script>";

	echo"
	<script type='text/javascript'>
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {

		var data = google.visualization.arrayToDataTable([
			['Dimensao', 'Impacto'],
			['Economica', ", $economica['impacto'], "],
			['Social', ", $social['impacto'], "],
			['Ambiental', ", $ambiental['impacto'], "]
			]);

		var options = {
			curveType: 'function',
			enableInteractivity: 'false',
			pieStartAngle: 180,
			legend: 'bottom',
			width: 380,
			height: 300,
			slices: {
			0: { color: '#2B8334' },
			1: { color: '#322B83' }
			}
		};
		

		var chart_div = document.getElementById('curve_chart0');
		var chart = new google.visualization.PieChart(chart_div);

		google.visualization.events.addListener(chart, 'ready', function () {
			chart_div.innerHTML = '<img src=' + chart.getImageURI() + '>';
		});

		chart.draw(data, options);
		}
	</script>";

	$stmt = mysqli_prepare($db, "SELECT * FROM plano_estrategico WHERE empresa = ? AND publicado = 1 ORDER BY fim ASC");
	mysqli_stmt_bind_param($stmt, "i", $_GET['empresa']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	$row = mysqli_fetch_all($result);

	echo"
	<script type='text/javascript'>
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {

		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Data');
		data.addColumn('number', 'Impacto Geral');
		data.addColumn({type: 'number', role: 'annotation'});";

	foreach ($row as $plano) {
		
		$stmt = mysqli_prepare($db, "SELECT * FROM impacto WHERE plano_estrategico = ? AND perspectiva_bsc = 'Geral' AND dimensao = 'Geral'");
		mysqli_stmt_bind_param($stmt, "i", $plano[0]);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$row2 = mysqli_fetch_array($result);

		if ($plano[6] == 1){
			echo "data.addRows([['Plano em Execução (", substr($plano[4], 0, 4), " - ",  substr($plano[5], 0, 4) ,")', ", $row2['impacto'], ", ", $row2['impacto'], "]]);";
		}else{
			echo "data.addRows([['", substr($plano[4], 0, 4), " - ",  substr($plano[5], 0, 4), "', ", $row2['impacto'], ", ", $row2['impacto'], "]]);";
		}
	}
	
	echo "var options = {
			enableInteractivity: 'false',
			legend: 'bottom',
			width: 800,
			height: 420,
			vAxis: {ticks: [0, 0.3, 0.8, 1.2, 2.4, 3.6, 5.4, 8.1]},
		};
		

		var chart_div = document.getElementById('line_chart0');
		var chart = new google.visualization.LineChart(chart_div);

		google.visualization.events.addListener(chart, 'ready', function () {
			chart_div.innerHTML = '<img src=' + chart.getImageURI() + '>';
		});

		chart.draw(data, options);
		}
	</script>";



	
	return;
}

function listarResumo(){ // Array $perspectiva_bsc = 0 - Econômico-Financeira, 1 - Clientes, 2 - Processos Internos, 3 - Aprendizado e Crescimento, 4 - Geral
						// Array $dimensao = 0 - Econômica, 1 - Social, 2 - Ambiental, 3 - Geral

	$db = mysqli_connect('localhost', 'root', '', 'inse');

	$true = 1;
	$false = 0;
	$geral = Array('','','','');
	$perspectiva_bsc = Array('Econômico-Financeira','Clientes','Processos Internos','Aprendizado e Crescimento', 'Geral');
	$dimensao = Array('Economica', 'Social', 'Ambiental', 'Geral');
	$counter = Array(0,0,0,0);

	echo "<div id='resumo' name='resumo'><header class='major'><h2>Resumo de Sustentabilidade do Plano</h2></header><hr>
		  <table class='resumo'><tr><thead><th colspan='2'></th><th colspan='3'>Impacto nas dimensões da Sustentabilidade</th><th>Triple Bottom Line</th><th>Indicador de Sustentabilidade por Ação do PEE</th></thead></tr>
		  <tr><th class='c1'>Perspectivas</th><th class='c4'>Ações</th><th class='c1'>A-Econômica</th><th class='c1'>B-Social</th><th class='c1'>C-Ambiental</th><th class='c1'>D-Grau de Contribuição</th><th class='c1'>AxBxCxD/10^7</th></tr>";

	for($i=0;$i<4;$i++){

		$stmt = mysqli_prepare($db, "SELECT * FROM estrategia INNER JOIN objetivo ON estrategia.objetivo = objetivo.id WHERE estrategia.perspectiva_bsc = ? AND objetivo.plano_estrategico = ? ORDER BY estrategia.estrategia ASC");
		mysqli_stmt_bind_param($stmt, "si", $perspectiva_bsc[$i], $_GET['plano_estrategico']);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		if (mysqli_num_rows($result) > 0) {
			$counter[$i] = 1;
		}
	
		echo "<td class='center' rowspan='", mysqli_num_rows($result) + 2, "'>", $perspectiva_bsc[$i], "</td>";	

		while($row = mysqli_fetch_array($result)){
		
			echo "<tr><td>", $row['estrategia'], "</td><td>", $row['impacto_economico'], "</td><td>", $row['impacto_social'], "</td><td>", $row['impacto_ambiental'], "</td><td>", $row['grau_contribuicao'], "</td><td>", $row['indicador_sustentabilidade'], "</td></tr>";
		
		}

		echo "<tr><td></td>";

		$stmt = mysqli_prepare($db, "SELECT * FROM impacto WHERE perspectiva_bsc = ? AND dimensao = ? AND plano_estrategico = ?");
	

		for($j=0;$j<3;$j++){
			mysqli_stmt_bind_param($stmt, "ssi", $perspectiva_bsc[$i], $dimensao[$j], $_GET['plano_estrategico']);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			$row = mysqli_fetch_array($result);
			echo "<td class='highlight'>", (INT)$row['impacto'], "</td>";
		}
	

		echo "<td></td><td></td></td></tr>";

	}
	
	echo "<br><tr><td>Geral</td><td></td>";
	
	for($i=0;$i<3;$i++){
		mysqli_stmt_bind_param($stmt, "ssi", $perspectiva_bsc[4], $dimensao[$i], $_GET['plano_estrategico']);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$row = mysqli_fetch_array($result);
		
		echo "<td class='highlight'>", (INT)$row['impacto'], "</td>";

		$geral[$i] = (INT)$row['impacto'];
		
	}

	$counter[0] += $counter[1] + $counter[2] + $counter[3];
	if ($counter[0] != 4){
		echo "<div class='alert alert-danger alert-dismissible' role='alert'>É Recomendado que seu Plano Estratégico tenha pelo menos uma ação por Perspectiva do BSC!
	   <button type='button' class='close' data-dismiss='alert' aria-label='Fechar'><span aria-hidden='true'>&times;</span></button></div>";
	}
	
	mysqli_stmt_bind_param($stmt, "ssi", $perspectiva_bsc[4], $dimensao[3], $_GET['plano_estrategico']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$row = mysqli_fetch_array($result);

	$geral[3] = (FLOAT)$row['impacto'];
	
	echo "<td></td><td class='highlight'>", $row['impacto'], "</td></tr></table>";

	$titles = Array('Impacto na Sustentabilidade Economica', 'Impacto na Sustentabilidade Social', 'Impacto na Sustentabilidade Ambiental', 'Impacto na Sustentabilidade Geral');
	$i=0;
	/*echo "<div class='grid-container'>";
	echo "<div class='grid-item'><div id='curve_chart0' style='width: 200px; height: 200px'></div></div>";
	echo "<div class='grid-item'><div id='curve_chart1' style='width: 200px; height: 200px'></div></div>";
	echo "<div class='grid-item'><div id='curve_chart2' style='width: 200px; height: 200px'></div></div>";
	echo "<div class='grid-item'><div id='curve_chart3' style='width: 200px; height: 200px'></div></div>";
	echo "</div>";*/
	echo "<table class='charts'><tr><th class='center'>Distribuição entre Dimensões de Sustentabilidade</th><th class='center'>Nota de Sustentabilidade Geral</th></tr><tr>";
	echo "<td class='center'><div id='curve_chart0'></div></td>";
	echo "<td class='center'><div id='curve_chart1'></div></td></tr>";
	echo "<tr><th colspan='2' class='center'>Impacto na Sustentabilidade ao Longo do Tempo</th></tr><tr><td colspan='2' class='center'><div id='line_chart0'></div></td>";
	echo "</tr></table></div>";

	$porAcao = 8.1 - (INT)$row['impacto'];
	echo"
	<script type='text/javascript'>
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {

		var data = google.visualization.arrayToDataTable([
			['', ''],
			['Impacto Geral', ", $row['impacto'], "],
			['', ", $porAcao, "]
			]);

		var options = {
			curveType: 'function',
			enableInteractivity: 'false',
			pieStartAngle: 180,
			legend: 'none',
			width: 380,
			height: 300,
			slices: {
			0: { color: '#2B8334' },
			1: { color: 'red', textStyle: {color: 'red'} }
			}
		};
		

		var chart_div = document.getElementById('curve_chart1');
		var chart = new google.visualization.PieChart(chart_div);

		google.visualization.events.addListener(chart, 'ready', function () {
			chart_div.innerHTML = '<img src=' + chart.getImageURI() + '>';
		});

		chart.draw(data, options);
		}
	</script>";

	echo"
	<script type='text/javascript'>
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {

		var data = google.visualization.arrayToDataTable([
			['Dimensao', 'Impacto'],
			['Economica', ", $geral[0], "],
			['Social', ", $geral[1], "],
			['Ambiental', ", $geral[2], "]
			]);

		var options = {
			curveType: 'function',
			enableInteractivity: 'false',
			pieStartAngle: 180,
			legend: 'bottom',
			width: 380,
			height: 300,
			slices: {
			0: { color: '#2B8334' },
			1: { color: '#322B83' }
			}
		};
		

		var chart_div = document.getElementById('curve_chart0');
		var chart = new google.visualization.PieChart(chart_div);

		google.visualization.events.addListener(chart, 'ready', function () {
			chart_div.innerHTML = '<img src=' + chart.getImageURI() + '>';
		});

		chart.draw(data, options);
		}
	</script>";

	$stmt = mysqli_prepare($db, "SELECT * FROM plano_estrategico WHERE empresa = ? AND publicado = ? ORDER BY fim ASC");
	mysqli_stmt_bind_param($stmt, "ii", $_SESSION['idempresa'], $true);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$row = mysqli_fetch_all($result);

	

	echo"
	<script type='text/javascript'>
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {

		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Data');
		data.addColumn('number', 'Impacto Geral');
		data.addColumn({type: 'number', role: 'annotation'});";

	$flag = 0;

	foreach ($row as $plano) {
		
		$stmt = mysqli_prepare($db, "SELECT * FROM impacto WHERE plano_estrategico = ? AND perspectiva_bsc = ? AND dimensao = ?");
		mysqli_stmt_bind_param($stmt, "iss", $plano[0], $perspectiva_bsc[4], $dimensao[3]);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$row2 = mysqli_fetch_array($result);

		if ($plano[0] == $_GET['plano_estrategico']){
			$flag = 1;
		}

		if ($plano[6] == 1){
			echo "data.addRows([['Plano em Execução (", substr($plano[4], 0, 4), " - ",  substr($plano[5], 0, 4) ,")', ", $row2['impacto'], ", ", $row2['impacto'], "]]);";
		}else{
			if ($plano[0] == $_GET['plano_estrategico']){
				echo "data.addRows([['Plano Selecionado (", substr($plano[4], 0, 4), " - ",  substr($plano[5], 0, 4), ")', ", $geral[3], ", ", $geral[3], "]]);";
			}else{
				echo "data.addRows([['", substr($plano[4], 0, 4), " - ",  substr($plano[5], 0, 4), "', ", $row2['impacto'], ", ", $row2['impacto'], "]]);";
			}
		}
	}

	if (!$flag){
		echo "data.addRows([['Plano Selecionado', ", $geral[3], ", ", $geral[3], "]]);";
	}
	
	echo "var options = {
			enableInteractivity: 'false',
			legend: 'bottom',
			width: 800,
			height: 420,
			vAxis: {ticks: [0, 0.3, 0.8, 1.2, 2.4, 3.6, 5.4, 8.1]},
		};
		

		var chart_div = document.getElementById('line_chart0');
		var chart = new google.visualization.LineChart(chart_div);

		google.visualization.events.addListener(chart, 'ready', function () {
			chart_div.innerHTML = '<img src=' + chart.getImageURI() + '>';
		});

		chart.draw(data, options);
		}
	</script>";

	return $counter;
}



function listarEmpresa(){
	$db = mysqli_connect('localhost', 'root', '', 'inse');
	$stmt = mysqli_prepare($db, "SELECT * FROM empresa WHERE id = ?");
	mysqli_stmt_bind_param($stmt, "i", $_SESSION['idempresa']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$empresa = mysqli_fetch_array($result);
	$stmt = mysqli_prepare($db, "SELECT * FROM endereco WHERE id = ?");
	mysqli_stmt_bind_param($stmt, "i", $empresa['endereco']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$endereco = mysqli_fetch_array($result);
	$stmt = mysqli_prepare($db, "SELECT * FROM usuario WHERE id = ?");
	mysqli_stmt_bind_param($stmt, "i", $_SESSION['idusuario']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$usuario = mysqli_fetch_array($result);
	$stmt = mysqli_prepare($db, "SELECT * FROM telefone WHERE usuario = ?");
	mysqli_stmt_bind_param($stmt, "i", $_SESSION['idusuario']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$telefone = mysqli_fetch_array($result);
	echo '<div class="">
				<label>Razão Social</label>
				<input type="text" maxlength="100" name="razaosocial" disabled value="',$empresa['razaosocial'],'">
			</div>
			<div class="">
				<label>Nome fantasia</label>
				<input type="text" maxlength="100" name="nomefantasia" value="',$empresa['nomefantasia'],'">
			</div>
			<div class="">
				<label>Numero CNPJ</label>
				<input type="text" maxlength="18" name="cnpj" disabled value="',adicionaMascaraCNPJ($empresa['cnpj']),'">
			</div>
			<div class="">
				<label>Ramo de atuação</label><br>
				',listarRamos(),'
			</div>
			<div class="">
				<label>Endereço</label>
				<input type="text" maxlength="255" name="endereco" value="',$endereco['endereco'],'">
			</div>
			<div style="float : left;">
				<label>Numero</label>
				<input type="text" style="width: 80%;" maxlength="255" name="numero" value="',$endereco['numero'],'">
			</div>								
			<div style="float: left;" class="">
				<label>Complemento</label>
				<input type="text"  style="width: 90%;" maxlength="255" name="complemento" value="',$endereco['complemento'],'">
			</div>								
			<div>
				<label>Bairro</label>
				<input type="text"  style="width: 25.8%; ;" maxlength="255" name="bairro" value="',$endereco['bairro'],'">
			</div>
			<div style="float: left;" class="">
				<label>Cidade</label>
				<input type="text" style="width: 80%;" maxlength="255" name="cidade" value="',$endereco['cidade'],'">
			</div>								  								
			<div style="float: left;" class="">	
				<label>Estado</label>
				<input type="text" style="width: 80%;" maxlength="255" name="estado" value="',$endereco['estado'],'">
			</div>
			<div class="">
				<label>CEP</label>
				<input type="text" style="width: 26%;" maxlength="255" name="cep" value="',$endereco['cep'],'">
			</div>
			<div class="">
				<label>Nome</label>
				<input type="text" maxlength="255" name="nome" value="',$usuario['nome'],'">
			</div>
			<div class="">
				<label>Sobrenome</label>
				<input type="text" style="width: 50.4%;" maxlength="255" name="sobrenome" value="',$usuario['sobrenome'],'">
			</div>
			<div class="">
				<label>Gênero</label>
				<input type="text" style="width: 50.4%;" maxlength="255" name="genero" value="',$usuario['genero'],'">
			</div>
			<div class="">
				<label>Telefone</label>
				<input type="text" maxlength="15" placeholder="(DDD) X XXXX XXXX" name="telefone" value="',$telefone['telefone'],'">
			</div>
			<div class="">
				<label>Endereço de Email</label>
				<input type="email" maxlength="100" name="email" value="',$usuario['email'],'">
			</div>
			<hr>
			<div class="">
				<button type="submit" class="button" name="alt_empresa">Salvar</button>
			</div>';
	$result = mysqli_stmt_close($stmt);
	mysqli_close($db);
}



function listarUsuario(){
	$db = mysqli_connect('localhost', 'root', '', 'inse');
	$stmt = mysqli_prepare($db, "SELECT * FROM empresa WHERE id = ?");
	mysqli_stmt_bind_param($stmt, "i", $_SESSION['idempresa']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$empresa = mysqli_fetch_array($result);

	$stmt = mysqli_prepare($db, "SELECT * FROM usuario WHERE id = ?");
	mysqli_stmt_bind_param($stmt, "i", $_GET['idusuario']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$usuario = mysqli_fetch_array($result);

	echo '<div class="">
		  <label>Nome</label>
			  	   <input type="text" maxlength="255" name="nome" value="',$usuario['nome'],'">
		  </div>
		  <div class="">
			  <label>Sobrenome</label>
			 	  <input type="text"  maxlength="255" name="sobrenome" value="',$usuario['sobrenome'],'">
		 </div>
		 <div class="">
		  	  <label>Genero</label>
			  	  <input type="text" maxlength="255" name="genero" value="',$usuario['genero'],'">
		</div>
		<div class="">
		  	  <label>Email</label>
			  	  <input type="email" maxlength="100" name="email" value="',$usuario['email'],'">
		</div>
		<div class="">
		  	  <label></label>
			  	  <input type="hidden" maxlength="100" name="senha" value="',$usuario['senha'],'">
				  <br>
		</div>
		<br>
		<h3>Funcionalidades do sistema</h3>
			<div class="">
				<label>Grupo de acesso</label><br>
				', listarGrupos(),'
		</div>
		<br>
		<div class="">
				<button type="submit" class="button" name="alt_usuario" >Salvar</button>
		</div>
		<br>
		<h3>Alterar senha</h3>
		<br>
		<div class="">
		<label>Nova Senha</label>
		<input type="text" maxlength="100" name="senha1" value="">
		<br>
		</div>
		<div class="">
		<label>Digite nova senha novamente</label>
		<input type="text" maxlength="100" name="confirm" value="">
		<br>
		</div>
		<br>
		<div class="">
		<button type="submit" class="button" name="alt_usuario1" >Salvar</button>
		</div>';

	$result = mysqli_stmt_close($stmt);
	mysqli_close($db);
}


function listarPermissao(){

	$db = mysqli_connect('localhost', 'root', '', 'inse');
	$stmt = mysqli_prepare($db, "SELECT * FROM grupo WHERE id = ?");
	mysqli_stmt_bind_param($stmt, "i", $_GET['idgrupo']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$row = mysqli_fetch_array($result);

	echo '<div class="">
		  <label>Grupo </label>
			  	   <input type="text" style="width: 50.4%;"maxlength="255" id="grupo" name="grupo" value="', $row['grupo'],'">
		  </div>
		<br>
		<h3>Funcionalidades do sistema</h3>
			<div class="">
				<label>Grupo de acesso</label><br>
				', listarFuncionalidades(),'
			</div>
		<br>
		<div class="">
		  	  <button type="submit" class="button" name="alt_permissao">Salvar</button>
		</div>';

	$result = mysqli_stmt_close($stmt);
	mysqli_close($db);
}

function listarRamos(){
	$db = mysqli_connect('localhost', 'root', '', 'inse');
	$stmt = mysqli_prepare($db, "SELECT * FROM ramo_atuacao WHERE ramo = ?");
	$x = "Industrial";
	mysqli_stmt_bind_param($stmt, "s", $x);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	echo "<select id='ramo' name='ramo'><optgroup label='Industrial'>";
	while($row = mysqli_fetch_array($result)){
		echo "<option>",utf8_encode($row['atividade']),"</option>";
	}
	$x = "Comercial";
	mysqli_stmt_bind_param($stmt, "s", $x);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	echo "</optgroup><optgroup label='Comercial'>";
	while($row = mysqli_fetch_array($result)){
		echo "<option>",utf8_encode($row['atividade']),"</option>";
	}
	$x = "Servicos";
	mysqli_stmt_bind_param($stmt, "s", $x);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	echo "</optgroup><optgroup label='Serviços'>";
	while($row = mysqli_fetch_array($result)){
		echo "<option>",utf8_encode($row['atividade']),"</option>";
	}
	
	echo "</optgroup></select>";
}

function listarGrupos(){
	$db = mysqli_connect('localhost', 'root', '', 'inse');
	$stmt = mysqli_prepare($db, "SELECT * FROM grupo");
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	echo "<select id='grupo' name='grupo'>";
	while($row = mysqli_fetch_array($result)){
		echo "<option>",utf8_encode($row['grupo']),"</option>";
	}
	echo "</select>";
}

function listarFuncionalidades(){

	$db = mysqli_connect('localhost', 'root', '', 'inse');
	$stmt = mysqli_prepare($db, "SELECT * FROM funcionalidade");
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	while($row = mysqli_fetch_array($result)){
		
		$stmt2 = mysqli_prepare($db, "SELECT * FROM permissao WHERE grupo = ? AND funcionalidade = ?");
		mysqli_stmt_bind_param($stmt2, "ii", $_GET['idgrupo'], $row['id']);
		mysqli_stmt_execute($stmt2);
		$result2 = mysqli_stmt_get_result($stmt2);
		$post = "";
		if(isset($_POST['nome_func'])){
			for($i=0;$i<count($_POST['nome_func']);$i++){
				if($_POST['nome_func'][$i] == $row['id']){
					$post = "checked";
				}
			}
		}
		echo "<tr><td>";
		echo "<input type='checkbox' name='nome_func[]'  value='", $row['id'], "'";
		echo mysqli_num_rows($result2) ? "checked" : $post ;
		echo "/>";
		echo $row['nome_func'];
		echo "</td></tr><br>";
	}
}

//Getter

function getRamo(){ // Retorna o ramo de atuação da empresa que está logada no momento (String).
	$db = mysqli_connect('localhost', 'root', '', 'inse');
	$stmt = mysqli_prepare($db, "SELECT * FROM empresa WHERE id = ?");
	mysqli_stmt_bind_param($stmt, "i", $_SESSION['idempresa']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$ramo = mysqli_fetch_array($result);
	$stmt = mysqli_prepare($db, "SELECT * FROM ramo_atuacao WHERE id = ?");
	mysqli_stmt_bind_param($stmt, "i", $ramo['ramo']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$row = mysqli_fetch_array($result);
	return $row['atividade'];
}

function getGrupo($idusuario){ // Retorna o ramo de atuação da empresa que está logada no momento (String).
	
	$db = mysqli_connect('localhost', 'root', '', 'inse');
	$stmt = mysqli_prepare($db, "SELECT * FROM usuario WHERE id = ?");
	mysqli_stmt_bind_param($stmt, "i", $idusuario);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$grupo = mysqli_fetch_array($result);
	
	$stmt = mysqli_prepare($db, "SELECT * FROM grupo WHERE id = ?");
	mysqli_stmt_bind_param($stmt, "i", $grupo['grupo']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$row = mysqli_fetch_array($result);
	return $row['grupo'];
}




//Inserções
function inserirPermissao ($funcionalidade, $grupo)
{
	$db = mysqli_connect('localhost', 'root', '', 'inse');

	//permissoes
	$sql = 'INSERT INTO permissao (funcionalidade, grupo)
			VALUES (?, ?)';
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, "ii", $funcionalidade, $grupo);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_close($stmt);
	
	mysqli_close($db);

}
function inserirGrupo($grupo){
	
	$db = mysqli_connect('localhost', 'root', '', 'inse');

	$sql = 'INSERT INTO grupo (grupo, empresa) VALUES (?, ?)';
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, "si", $grupo, $_SESSION['idempresa']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_close($stmt);

	return mysqli_insert_id($db);
}

function inserirEmpresa($razaosocial, $nomefantasia, $cnpj, $ramo, $endereco, $numero, $complemento, $bairro, $cidade, $estado, $cep, $nome, $sobrenome, $genero , $telefone , $email, $senha){
	$db = mysqli_connect('localhost', 'root', '', 'inse');
	$cnpj = preg_replace("/[^0-9]/", "", $cnpj);
	$cnpj = str_pad($cnpj, 14, '0', STR_PAD_LEFT);
	$sql = 'SELECT * FROM ramo_atuacao WHERE atividade = ?';
	$ramo = utf8_decode($ramo);
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, "s", $ramo);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	
	$row = mysqli_fetch_array($result);
	$sql = 'INSERT INTO endereco (endereco, numero, complemento, bairro, cidade, estado, cep)
			VALUES (?, ?, ?, ?, ?, ?, ?)';
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, "sssssss", $endereco, $numero, $complemento, $bairro, $cidade, $estado, $cep);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_close($stmt);
	$endereco = mysqli_insert_id($db);
	$sql = 'INSERT INTO empresa (razaosocial, nomefantasia, cnpj, ramo, endereco)
			VALUES (?, ?, ?, ?, ?)';
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, "sssii", $razaosocial, $nomefantasia, $cnpj, $row['id'], $endereco);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_close($stmt);
	$empresa = mysqli_insert_id($db);
	$sql = 'INSERT INTO usuario (nome, sobrenome, genero, email, senha, empresa, grupo)
			VALUES (?, ?, ?, ?, ?, ?, ?)';
	$grupo = 1; // Implementação futura
	
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, "sssssis", $nome, $sobrenome, $genero, $email, $senha, $empresa, $grupo);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_close($stmt);
	$usuario = mysqli_insert_id($db);

	$sql = 'INSERT INTO telefone (usuario, telefone)
			VALUES (?, ?)';
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, "is", $usuario, $telefone);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_close($stmt);
	
	mysqli_close($db);
}


function inserirUsuario($email, $senha, $nome, $sobrenome, $genero, $grupo){

	$db = mysqli_connect('localhost', 'root', '', 'inse');

	$sql = 'SELECT * FROM grupo WHERE grupo = ?';
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, "s", $grupo);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	$row = mysqli_fetch_array($result);
		
	$sql = 'INSERT INTO usuario (email, senha, nome, sobrenome, genero, empresa, grupo) VALUES (?, ?, ?, ?, ?, ?, ?)';
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, "sssssii", $email, $senha, $nome, $sobrenome, $genero, $_SESSION['idempresa'], $row['id'] );
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_close($stmt);

	 mysqli_close($db);
}

function inserirObjetivo($objetivo){

	$db = mysqli_connect('localhost', 'root', '', 'inse');
	$sql = 'INSERT INTO objetivo (objetivo, plano_estrategico) VALUES (?, ?)';
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, "si", $objetivo, $_GET['plano_estrategico']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_close($stmt);
	mysqli_close($db);
}
function inserirEstrategia($estrategia, $perspectiva_bsc, $impacto_ambiental, $impacto_economico, $impacto_social, $grau_contribuicao, $objid){
	$db = mysqli_connect('localhost', 'root', '', 'inse');
	
	$indicador = $impacto_economico * $impacto_social * $impacto_ambiental * $grau_contribuicao;
	$indicador = $indicador/10000000;
	$sql = 'INSERT INTO estrategia (estrategia, perspectiva_bsc, impacto_ambiental, impacto_economico, impacto_social, grau_contribuicao, indicador_sustentabilidade, objetivo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, "ssiiiidi", $estrategia, $perspectiva_bsc, $impacto_ambiental, $impacto_economico, $impacto_social, $grau_contribuicao, $indicador, $objid);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_close($stmt);
	mysqli_close($db);
}
function inserirMeta($meta , $data, $objid){
	$db = mysqli_connect('localhost', 'root', '', 'inse');
	$sql = 'INSERT INTO meta (meta, data_limite, objetivo) VALUES (?, ?, ?)';
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, "ssi", $meta, $data, $objid);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_close($stmt);
	mysqli_close($db);
}
function inserirIndicador($indicador, $metid){
	$db = mysqli_connect('localhost', 'root', '', 'inse');
	$sql = 'INSERT INTO indicador (indicador, meta) VALUES (?, ?)';
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, "si", $indicador, $metid);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_close($stmt);
	mysqli_close($db);
}
function inserirIdentidade(){
	
	$perspectiva_bsc = Array('Econômico-Financeira','Clientes','Processos Internos','Aprendizado e Crescimento', 'Geral');
	$dimensao = Array('Economica', 'Social', 'Ambiental', 'Geral');

	$db = mysqli_connect('localhost', 'root', '', 'inse');
	$sql = 'INSERT INTO plano_estrategico (titulo, visao, missao, comeco, fim, ativo, publicado, empresa) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
	$ativo = (isset($_POST['ativo']) ? $_POST['ativo'] : 0);
	$publicado = (isset($_POST['publicado']) ? $_POST['publicado'] : 0);
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, "sssssiii", $_POST['titulo'], $_POST['visao'], $_POST['missao'], $_POST['comeco'], $_POST['fim'], $ativo, $publicado, $_SESSION['idempresa']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_close($stmt);
	$id = mysqli_insert_id($db);

	$zero = 0;
	$sql = 'INSERT INTO impacto (perspectiva_bsc, dimensao, impacto, plano_estrategico) VALUES (?, ?, ?, ?)';
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	for($i=0; $i<5; $i++){
		for($j=0; $j<4; $j++){
			$per = $perspectiva_bsc[$i];
			$dim = $dimensao[$j];
			mysqli_stmt_bind_param($stmt, "ssii", $per, $dim, $zero, $id);
			mysqli_stmt_execute($stmt);
		}
	}
	return $id;
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
function alterarEmpresa(){
	$db = mysqli_connect('localhost', 'root', '', 'inse');
	$sql = 'SELECT * FROM ramo_atuacao WHERE atividade = ?';
	$ramo = utf8_decode($_POST['ramo']);
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, "s", $ramo);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	
	$row = mysqli_fetch_array($result);
	$sql = 'UPDATE empresa SET nomefantasia = ?, ramo = ? WHERE id = ?';
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, 'sii', $_POST['nomefantasia'], $row['id'], $_SESSION['idempresa']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_close($stmt);
	$sql = 'SELECT * FROM empresa WHERE id = ?';
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, 'i', $_SESSION['idempresa']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$row = mysqli_fetch_array($result);
	$sql = 'UPDATE endereco SET endereco = ?, numero = ?, complemento = ?, bairro = ?, cidade = ?, estado =?, cep = ? WHERE id = ?';
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, 'sssssssi', $_POST['endereco'], $_POST['numero'], $_POST['complemento'], $_POST['bairro'], $_POST['cidade'], $_POST['estado'], $_POST['cep'], $row['endereco']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_close($stmt);
	$sql = 'UPDATE usuario SET nome = ?, sobrenome = ?, genero = ?, email = ? WHERE id = ?';
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, 'ssssi', $_POST['nome'], $_POST['sobrenome'], $_POST['genero'], $_POST['email'], $_SESSION['idusuario']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_close($stmt);
	$sql = 'UPDATE telefone SET telefone = ? WHERE usuario = ?';
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, 'si', $_POST['telefone'], $_SESSION['idusuario']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_close($stmt);
	mysqli_close($db);
	$_SESSION['nomefantasia'] = $_POST['nomefantasia'];
}

function alterarUsuario(){

	$db = mysqli_connect('localhost', 'root', '', 'inse');
	
	$sql = 'SELECT * FROM grupo WHERE grupo = ?';
	
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, "s", $_POST['grupo']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$row = mysqli_fetch_array($result);
	
	$sql = 'UPDATE usuario SET grupo = ? WHERE id = ?';
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, 'si', $row['id'], $_GET['idusuario']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_close($stmt);

	$sql = 'UPDATE usuario SET email = ?, senha = ?, nome = ?, sobrenome = ?, genero = ? WHERE id = ?';
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, 'sssssi', $_POST['email'], $_POST['senha'], $_POST['nome'], $_POST['sobrenome'], $_POST['genero'], $_GET['idusuario']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_close($stmt);
	
	mysqli_close($db);
}

function alterarUsuarioSenha(){

	$db = mysqli_connect('localhost', 'root', '', 'inse');

	$options = [
				'memory_cost' => 1<<17, // 128 Mb
				'time_cost'   => 4,
				'threads'     => 4,
			];

	$senha =  password_hash($_POST['senha1'], PASSWORD_ARGON2ID, $options);  // hash com argon2id

	$sql = 'UPDATE usuario SET senha = ? WHERE id = ?';
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, 'si', $senha, $_GET['idusuario']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_close($stmt);
	
	mysqli_close($db);
}



function alterarPermissao(){

	$db = mysqli_connect('localhost', 'root', '', 'inse');
	
	$sql = 'UPDATE grupo SET grupo = ? WHERE id = ?';
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, 'si', $_POST['grupo'], $_GET['idgrupo']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_close($stmt);

	$sql = 'DELETE FROM permissao WHERE grupo = ?';
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, 'i', $_GET['idgrupo']);
	mysqli_stmt_execute($stmt);

	foreach($_POST['nome_func'] as $func){
		inserirPermissao($func[0],$_GET['idgrupo']);
	}
	mysqli_close($db);
}


function alterarObjetivo($objetivo, $id){
	$db = mysqli_connect('localhost', 'root', '', 'inse');
	$sql = 'UPDATE objetivo SET objetivo = ? WHERE id = ?';
	
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, 'si', $objetivo, $id);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_close($stmt);
	mysqli_close($db);
}
function alterarEstrategia($estrategia, $perspectiva_bsc, $impacto_ambiental, $impacto_economico, $impacto_social, $grau_contribuicao, $id){
	$db = mysqli_connect('localhost', 'root', '', 'inse');
	
	$indicador = $impacto_economico * $impacto_social * $impacto_ambiental * $grau_contribuicao;
	$indicador = $indicador/10000000;
	$sql = 'UPDATE estrategia SET estrategia = ?, perspectiva_bsc = ?, impacto_ambiental = ?, impacto_economico = ?, impacto_social = ?, grau_contribuicao = ?, indicador_sustentabilidade = ? WHERE id = ?';
	
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, 'ssiiiidi', $estrategia, $perspectiva_bsc, $impacto_ambiental, $impacto_economico, $impacto_social, $grau_contribuicao, $indicador, $id);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_close($stmt);
	mysqli_close($db);
}
function alterarMeta($meta, $data, $id){
	$db = mysqli_connect('localhost', 'root', '', 'inse');
	$sql = 'UPDATE meta SET meta = ?, data_limite = ? WHERE id = ?';
	
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, 'ssi', $meta, $data, $id);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_close($stmt);
	mysqli_close($db);
}
function alterarIndicador($indicador, $id){
	$db = mysqli_connect('localhost', 'root', '', 'inse');
	$sql = 'UPDATE indicador SET indicador = ? WHERE id = ?';
	
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, 'si', $indicador, $id);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_close($stmt);
	mysqli_close($db);
}
function alterarIdentidade(){
	$db = mysqli_connect('localhost', 'root', '', 'inse');
	$sql = 'UPDATE plano_estrategico SET titulo = ?, visao = ?, missao = ?, comeco = ?, fim = ? WHERE id = ?';
	//$comeco = date("Y-m-d", strtotime($_POST['comeco']));
	//$fim = date("Y-m-d", strtotime($_POST['fim']));
	$ativo = (isset($_POST['ativo']) ? $_POST['ativo'] : 0);
	$publicado = (isset($_POST['publicado']) ? $_POST['publicado'] : 0);
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, 'sssssi', $_POST['titulo'], $_POST['visao'], $_POST['missao'], $_POST['comeco'], $_POST['fim'], $_GET['plano_estrategico']);
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
//Calculos
function calcularIndicadores(){          // Arrays $economico, $clientes, $processos e $aprendizado = 0 - Impacto Economico, 1 - Impacto Social, 2 - Impacto Ambiental, 3 - Impacto Geral
                                         // Array $perspectiva_bsc = 0 - Econômico-Financeira, 1 - Clientes, 2 - Processos Internos, 3 - Aprendizado e Crescimento, 4 - Geral
	$economico = Array(0 ,0, 0, 0);      // Array $dimensao = 0 - Econômica, 1 - Social, 2 - Ambiental, 3 - Geral
	$clientes = Array(0 ,0, 0, 0);
	$processos = Array(0 ,0, 0, 0);
	$aprendizado = Array(0 ,0, 0, 0);
	$numrows = Array(0, 0, 0, 0);
	$perspectiva_bsc = Array('Econômico-Financeira','Clientes','Processos Internos','Aprendizado e Crescimento', 'Geral');
	$dimensao = Array('Economica', 'Social', 'Ambiental', 'Geral');
	$counter = Array(0, 0, 0, 0);

	$db = mysqli_connect('localhost', 'root', '', 'inse');

	$sql = 'SELECT * FROM objetivo WHERE plano_estrategico = ?';
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, 'i', $_GET['plano_estrategico']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	$objetivo = mysqli_fetch_all($result, MYSQLI_ASSOC);

	foreach ($objetivo as $obj) {
		
		$sql = 'SELECT * FROM estrategia WHERE objetivo = ? AND perspectiva_bsc = ?';
	
		$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	
		mysqli_stmt_bind_param($stmt, 'is', $obj['id'], $perspectiva_bsc[0]); // Econômico-Financeira
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$numrows2 = mysqli_num_rows($result);

		if($numrows2 != 0){
		
			if($numrows2 == 1){
				$row = mysqli_fetch_array($result);
				$economico[0] += $row['impacto_economico'];
				$economico[1] += $row['impacto_social'];
				$economico[2] += $row['impacto_ambiental'];
				$economico[3] += $row['indicador_sustentabilidade'];
			}else{
				$row = mysqli_fetch_all($result, MYSQLI_ASSOC);
				foreach($row as $row2){
		
					$economico[0] += $row2['impacto_economico'];
					$economico[1] += $row2['impacto_social'];
					$economico[2] += $row2['impacto_ambiental'];
					$economico[3] += $row2['indicador_sustentabilidade'];
				}
			}
			$counter[0] = 1;
		}
		$numrows[0] += $numrows2;

		mysqli_stmt_bind_param($stmt, 'is', $obj['id'], $perspectiva_bsc[1]); // Clientes
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$numrows2 = mysqli_num_rows($result);

		if($numrows2 != 0){
			if($numrows2 == 1){
				$row = mysqli_fetch_array($result);
				$clientes[0] += $row['impacto_economico'];
				$clientes[1] += $row['impacto_social'];
				$clientes[2] += $row['impacto_ambiental'];
				$clientes[3] += $row['indicador_sustentabilidade'];
			}else{
				$row = mysqli_fetch_all($result, MYSQLI_ASSOC);
				foreach($row as $row2){
		
					$clientes[0] += $row2['impacto_economico'];
					$clientes[1] += $row2['impacto_social'];
					$clientes[2] += $row2['impacto_ambiental'];
					$clientes[3] += $row2['indicador_sustentabilidade'];
				}
			}
			$counter[1] = 1;
		}
		$numrows[1] += $numrows2;

		mysqli_stmt_bind_param($stmt, 'is', $obj['id'], $perspectiva_bsc[2]); // Processos Internos
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$numrows2 = mysqli_num_rows($result);

		if($numrows2 != 0){
			if($numrows2 == 1){
				$row = mysqli_fetch_array($result);
				$processos[0] += $row['impacto_economico'];
				$processos[1] += $row['impacto_social'];
				$processos[2] += $row['impacto_ambiental'];
				$processos[3] += $row['indicador_sustentabilidade'];
			}else{
				$row = mysqli_fetch_all($result, MYSQLI_ASSOC);
				foreach($row as $row2){
		
					$processos[0] += $row2['impacto_economico'];
					$processos[1] += $row2['impacto_social'];
					$processos[2] += $row2['impacto_ambiental'];
					$processos[3] += $row2['indicador_sustentabilidade'];
				}
			}
			$counter[2] = 1;
		}
		$numrows[2] += $numrows2;

		mysqli_stmt_bind_param($stmt, 'is', $obj['id'], $perspectiva_bsc[3]); // Aprendizado e Crescimento
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$numrows2 = mysqli_num_rows($result);

		if($numrows2 != 0){
			if($numrows2 == 1){
				$row = mysqli_fetch_array($result);
				$aprendizado[0] += $row['impacto_economico'];
				$aprendizado[1] += $row['impacto_social'];
				$aprendizado[2] += $row['impacto_ambiental'];
				$aprendizado[3] += $row['indicador_sustentabilidade'];
			}else{
				$row = mysqli_fetch_all($result, MYSQLI_ASSOC);
				foreach($row as $row2){
		
					$aprendizado[0] += $row2['impacto_economico'];
					$aprendizado[1] += $row2['impacto_social'];
					$aprendizado[2] += $row2['impacto_ambiental'];
					$aprendizado[3] += $row2['indicador_sustentabilidade'];
				}
			}
			$counter[3] = 1;
		}
		$numrows[3] += $numrows2;
	}

	if($numrows[0] == 0){$numrows[0]=1;}
	if($numrows[1] == 0){$numrows[1]=1;}
	if($numrows[2] == 0){$numrows[2]=1;}
	if($numrows[3] == 0){$numrows[3]=1;}

	$economico[0] /= $numrows[0];
	$economico[1] /= $numrows[0];
	$economico[2] /= $numrows[0];
	$economico[3] /= $numrows[0];
	$clientes[0] /= $numrows[1];
	$clientes[1] /= $numrows[1];
	$clientes[2] /= $numrows[1];
	$clientes[3] /= $numrows[1];
	$processos[0] /= $numrows[2];
	$processos[1] /= $numrows[2];
	$processos[2] /= $numrows[2];
	$processos[3] /= $numrows[2];
	$aprendizado[0] /= $numrows[3];
	$aprendizado[1] /= $numrows[3];
	$aprendizado[2] /= $numrows[3];
	$aprendizado[3] /= $numrows[3];

	$counter[0] += $counter[1] + $counter[2] + $counter[3];

	$impacto_economico = ($economico[0] + $clientes[0] + $processos[0] + $aprendizado[0])/($counter[0] == 0 ? 1 : $counter[0]);
	$impacto_social = ($economico[1] + $clientes[1] + $processos[1] + $aprendizado[1])/($counter[0] == 0 ? 1 : $counter[0]);
	$impacto_ambiental = ($economico[2] + $clientes[2] + $processos[2] + $aprendizado[2])/($counter[0] == 0 ? 1 : $counter[0]);
	$impacto_geral = ($economico[3] + $clientes[3] + $processos[3] + $aprendizado[3])/($counter[0] == 0 ? 1 : $counter[0]);

	$sql = 'UPDATE impacto SET impacto = ? WHERE perspectiva_bsc = ? AND dimensao = ? AND plano_estrategico = ?';
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));

	mysqli_stmt_bind_param($stmt, 'issi', $economico[0], $perspectiva_bsc[0], $dimensao[0], $_GET['plano_estrategico']); // Economico-Financeira / Impacto Economico
	mysqli_stmt_execute($stmt);

	mysqli_stmt_bind_param($stmt, 'issi', $clientes[0], $perspectiva_bsc[1], $dimensao[0], $_GET['plano_estrategico']); // Clientes / Impacto Economico
	mysqli_stmt_execute($stmt);

	mysqli_stmt_bind_param($stmt, 'issi', $processos[0], $perspectiva_bsc[2], $dimensao[0], $_GET['plano_estrategico']); // Processos Internos / Impacto Economico
	mysqli_stmt_execute($stmt);

	mysqli_stmt_bind_param($stmt, 'issi', $aprendizado[0], $perspectiva_bsc[3], $dimensao[0], $_GET['plano_estrategico']); // Aprendizado e Crescimento / Impacto Economico
	mysqli_stmt_execute($stmt);

	mysqli_stmt_bind_param($stmt, 'issi', $economico[1], $perspectiva_bsc[0], $dimensao[1],  $_GET['plano_estrategico']); // Economico-Financeira / Impacto Social
	mysqli_stmt_execute($stmt);

	mysqli_stmt_bind_param($stmt, 'issi', $clientes[1], $perspectiva_bsc[1], $dimensao[1],  $_GET['plano_estrategico']); // Clientes / Impacto Social
	mysqli_stmt_execute($stmt);

	mysqli_stmt_bind_param($stmt, 'issi', $processos[1], $perspectiva_bsc[2], $dimensao[1], $_GET['plano_estrategico']); // Processos Internos / Impacto Social
	mysqli_stmt_execute($stmt);
	
	mysqli_stmt_bind_param($stmt, 'issi', $aprendizado[1], $perspectiva_bsc[3], $dimensao[1], $_GET['plano_estrategico']); // Aprendizado e Crescimento / Impacto Social
	mysqli_stmt_execute($stmt);
	
	mysqli_stmt_bind_param($stmt, 'issi', $economico[2], $perspectiva_bsc[0], $dimensao[2], $_GET['plano_estrategico']); // Economico-Financeira / Impacto Ambiental
	mysqli_stmt_execute($stmt);
	
	mysqli_stmt_bind_param($stmt, 'issi', $clientes[2], $perspectiva_bsc[1], $dimensao[2], $_GET['plano_estrategico']); // Clientes / Impacto Ambiental
	mysqli_stmt_execute($stmt);

	mysqli_stmt_bind_param($stmt, 'issi', $processos[2], $perspectiva_bsc[2], $dimensao[2], $_GET['plano_estrategico']); // Processos Internos / Impacto Ambiental
	mysqli_stmt_execute($stmt);

	mysqli_stmt_bind_param($stmt, 'issi', $aprendizado[2], $perspectiva_bsc[3], $dimensao[2], $_GET['plano_estrategico']); // Aprendizado e Crescimento / Impacto Ambiental
	mysqli_stmt_execute($stmt);

	mysqli_stmt_bind_param($stmt, 'dssi', $economico[3], $perspectiva_bsc[0], $dimensao[3], $_GET['plano_estrategico']); // Economico-Financeira / Impacto Geral
	mysqli_stmt_execute($stmt);

	mysqli_stmt_bind_param($stmt, 'dssi', $clientes[3], $perspectiva_bsc[1], $dimensao[3], $_GET['plano_estrategico']); // Clientes / Impacto Geral
	mysqli_stmt_execute($stmt);

	mysqli_stmt_bind_param($stmt, 'dssi', $processos[3], $perspectiva_bsc[2], $dimensao[3], $_GET['plano_estrategico']); // Processos Internos / Impacto Geral
	mysqli_stmt_execute($stmt);

	mysqli_stmt_bind_param($stmt, 'dssi', $aprendizado[3], $perspectiva_bsc[3], $dimensao[3], $_GET['plano_estrategico']); // Aprendizado e Crescimento / Impacto Geral
	mysqli_stmt_execute($stmt);

	mysqli_stmt_bind_param($stmt, 'issi', $impacto_economico, $perspectiva_bsc[4], $dimensao[0], $_GET['plano_estrategico']); // Geral / Impacto Economico
	mysqli_stmt_execute($stmt);

	mysqli_stmt_bind_param($stmt, 'issi', $impacto_social, $perspectiva_bsc[4], $dimensao[1], $_GET['plano_estrategico']); // Geral / Impacto Social
	mysqli_stmt_execute($stmt);

	mysqli_stmt_bind_param($stmt, 'issi', $impacto_ambiental, $perspectiva_bsc[4], $dimensao[2], $_GET['plano_estrategico']); // Geral / Impacto Ambiental
	mysqli_stmt_execute($stmt);

	mysqli_stmt_bind_param($stmt, 'dssi', $impacto_geral, $perspectiva_bsc[4], $dimensao[3], $_GET['plano_estrategico']); // Geral / Impacto Geral
	mysqli_stmt_execute($stmt);

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

	calcularIndicadores();
}

if(isset($_POST['removerEstrategia'])){ //Remover objetivo chamado por Ajax.. Nao achei um jeito melhor de fazer..
	
	$id = $_POST['removerEstrategia'];
	if($id != 'new'){
		$db = mysqli_connect('localhost', 'root', '', 'inse');

		$sql = 'DELETE FROM estrategia WHERE id = ?';
	
		$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
		mysqli_stmt_bind_param($stmt, 'i', $id);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_close($stmt);
		mysqli_close($db);
	}

	calcularIndicadores();

}

if(isset($_POST['removerMeta'])){ //Remover objetivo chamado por Ajax.. Nao achei um jeito melhor de fazer..
	
	$id = $_POST['removerMeta'];
	if($id != 'new'){
		$db = mysqli_connect('localhost', 'root', '', 'inse');

		$sql = 'DELETE FROM meta WHERE id = ?';
	
		$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
		mysqli_stmt_bind_param($stmt, 'i', $id);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_close($stmt);
		mysqli_close($db);
	}
}

if(isset($_POST['removerIndicador'])){ //Remover objetivo chamado por Ajax.. Nao achei um jeito melhor de fazer..
	
	$id = $_POST['removerIndicador'];
	if($id != 'new'){
		$db = mysqli_connect('localhost', 'root', '', 'inse');

		$sql = 'DELETE FROM indicador WHERE id = ?';
	
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

	echo $id;

	$db = mysqli_connect('localhost', 'root', '', 'inse');

	$sql = 'DELETE FROM plano_estrategico WHERE id = ?';
	
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, 'i', $id);
	mysqli_stmt_execute($stmt);
	echo mysqli_error($db);
	$result = mysqli_stmt_close($stmt);
	mysqli_close($db);

}

if(isset($_POST['removerGrupo'])){ //Remover Plano chamado por Ajax.. Nao achei um jeito melhor de fazer..

	$id = $_POST['removerGrupo'];

	echo $id;

	$db = mysqli_connect('localhost', 'root', '', 'inse');

	$sql = 'DELETE FROM grupo WHERE id = ?';
	
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, 'i', $id);
	mysqli_stmt_execute($stmt);
	echo mysqli_error($db);
	$result = mysqli_stmt_close($stmt);
	mysqli_close($db);

}

if(isset($_POST['publicar_pee'])){

	$db = mysqli_connect('localhost', 'root', '', 'inse');

	$true = 1;
	$false = 0;

	$sql = 'SELECT * FROM plano_estrategico WHERE empresa = ? AND publicado = ? AND ativo = ?';
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, "iii", $_POST['idempresa'], $true, $true);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	echo mysqli_num_rows($result);

	if(mysqli_num_rows($result) != 0){	
		$row = mysqli_fetch_assoc($result);
		echo $row['id'];
		$sql = 'UPDATE plano_estrategico SET publicado = ?, ativo = ? WHERE id = ?';
	
		$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
		mysqli_stmt_bind_param($stmt, 'iii', $true, $false, $row['id']);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_close($stmt);

		
	}

	$sql = 'UPDATE plano_estrategico SET publicado = ?, ativo = ? WHERE id = ?';
	
	$stmt = mysqli_prepare($db, $sql) or die(mysqli_error($db));
	mysqli_stmt_bind_param($stmt, 'iii', $true, $true, $_POST['publicar_pee']);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_close($stmt);
	echo mysqli_error($db);
	mysqli_close($db);

}

// gerador de senha randomica

function generatePassword($qtyCaraceters = 8)
{
    //Letras minúsculas embaralhadas
    $smallLetters = str_shuffle('abcdefghijklmnopqrstuvwxyz');
 
    //Letras maiúsculas embaralhadas
    $capitalLetters = str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ');
 
    //Números aleatórios
    $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));
    $numbers .= 1234567890;
 
    //Caracteres Especiais
    $specialCharacters = str_shuffle('!@#$%*-');
 
    //Junta tudo
    $characters = $capitalLetters.$smallLetters.$numbers.$specialCharacters;
 
    //Embaralha e pega apenas a quantidade de caracteres informada no parâmetro
    $password = substr(str_shuffle($characters), 0, $qtyCaraceters);
 
    //Retorna a senha
    return $password;
}


?>
