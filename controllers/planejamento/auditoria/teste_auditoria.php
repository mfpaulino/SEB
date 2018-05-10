<?php
$inc = "sim";
include('../../../config.inc.php');
include(PATH . '/componentes/internos/php/funcoes.inc.php');
include(PATH . '/controllers/autenticacao/autentica.inc.php');

$id = $_POST['id'];
//$id = 172;
$sql = "SELECT plan_auditoria.*, id_tipo_evento FROM plan_auditoria, adm_tipo_evento WHERE tipo = tipo_evento AND id_auditoria = '$id' ORDER BY ano DESC, id_auditoria DESC";
$con_auditorias = $mysqli->query($sql);

//$output = array();
$rows =  $con_auditorias->fetch_assoc();
	/****** relacao unidades **********************/

	$om = substr($rows['unidades'], 0, -1);
	$lst_om = "";

	$con_om = $mysqli->query("SELECT sigla FROM cciex_om WHERE codom IN ($om)");
	//$con_om = $mysqli1->query("SELECT sigla FROM cciex_om WHERE codom IN ($om)");
	while($row_om = $con_om->fetch_assoc()){
		$lst_om = $lst_om . $row_om['sigla'].", ";
	}

	$lst_om = substr($lst_om, 0, -2);

	/*********** relação de unid contr interno *************/
	$con_uci = $mysqli->query("SELECT icfex FROM cciex_om WHERE codom IN ($om)");
	$lst_uci = "";

	while($row_uci = $con_uci->fetch_assoc()){

		$cod_uci = $row_uci['icfex'];//pega o cod da unid cont interno
		if($cod_uci == $nr_ci){
			$lst_id = $lst_id . $rows['id_auditoria'] . ',';
		}
		$uci = exibir_uci($cod_uci);//converte para a sigla
		$lst_uci = $lst_uci . $uci . ",";//cria uma string
	}

	$lst_uci = substr($lst_uci, 0, -1);//elimina a ultima "," da string
	$lst_uci = explode(',',$lst_uci);//converte para um array
	$lst_uci = array_unique($lst_uci);//elimina valores repetidos
	sort($lst_uci);//ordena
	$lst_uci = implode(", ", $lst_uci);//tansforma em string para exibição

	/********** chefe equipe **************************/
	$id_chefe = $rows['chefe'];
	$con_chefe = $mysqli->query("SELECT posto, nome_guerra FROM postos, usuarios WHERE postos.id_posto = usuarios.id_posto AND id_usuario = '$id_chefe'");
	$rows_chefe = $con_chefe->fetch_assoc();

	$chefe = $rows_chefe['posto'] . " " . $rows_chefe['nome_guerra'];

	/****** relação equipe **************************/
	$equipe = substr($rows['equipe'], 0, -1);
	$lst_equipe = "";

	$con_equipe = $mysqli->query("SELECT id_usuario, posto, nome_guerra FROM postos, usuarios WHERE postos.id_posto = usuarios.id_posto AND id_usuario IN ($equipe) ORDER BY postos.id_posto");
	while ($rows_equipe = $con_equipe->fetch_assoc()){
		if($id_chefe == $rows_equipe['id_usuario']){
			$var1 = '<span class="text-bold text-green">';
			$var2 = '</span>';
		}
		else {
			$var1 = '';
			$var2 = '';
		}
		$lst_equipe = $lst_equipe . $var1 . $rows_equipe['posto'] . " " . $rows_equipe['nome_guerra'] . $var2 . ", ";
	}
	$lst_equipe = substr($lst_equipe, 0, -2);
	/*****************************************************/

	$periodo = converter_data($rows['inicio']). " a " . converter_data($rows['fim']);
	$tipo = $rows['id_tipo_evento'] . "|" .$rows['tipo'];


	$output = array(
		'ano' => $rows['ano'],
		'uci' => $lst_uci,
		'unidades' => $lst_om,
		'natureza' => $rows['natureza'],
		'tipo' => $rows['tipo'],
		'periodo' => $periodo,
		'equipe' => $lst_equipe,
		'nup' => $rows['nup']

	);

echo json_encode($output);
?>