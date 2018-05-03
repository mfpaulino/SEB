<?php
$inc = "sim";
include('../../../config.inc.php');
include(PATH.'/componentes/internos/php/funcoes.inc.php');
/** teste *
if($id_perfil_om == 2 or $id_perfil_om == 3){
	//$criterio_codom = $condicao_codom; // com a ICFEx UG
	$criterio_codom = " AND codom IN ($lista_codom)"; //(sem a ICFEx UG)
}
else {
	$criterio_codom = "";
}
$sql = "SELECT plan_auditoria.*, id_tipo_evento FROM plan_auditoria, adm_tipo_evento WHERE tipo = tipo_evento ORDER BY ano DESC, id_auditoria DESC";
/** fim teste **/

$sql = "SELECT plan_auditoria.*, id_tipo_evento FROM plan_auditoria, adm_tipo_evento WHERE tipo = tipo_evento ORDER BY ano DESC, id_auditoria DESC";
$con_auditorias = $mysqli->query($sql);

$output = array();
while ($rows =  $con_auditorias->fetch_assoc()){

	$periodo = converter_data($rows['inicio']). " a " . converter_data($rows['fim']);
	$tipo = $rows['id_tipo_evento'] . "|" .$rows['tipo'];

	/****** relacao unidades **********************/
	$om = substr($rows['unidades'], 0, -1);
	$lst_om = "";

	$con_om = $mysqli->query("SELECT sigla FROM cciex_om WHERE codom IN ($om)");
	//$con_om = $mysqli1->query("SELECT sigla FROM cciex_om WHERE codom IN ($om)");
	while($row_om = $con_om->fetch_assoc()){
		$lst_om = $lst_om . $row_om['sigla'].", ";
	}

	$lst_om = substr($lst_om, 0, -2);

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

	$output[] = array(
		'ano' => $rows['ano'],
		'unidades' => $lst_om,
		'natureza' => $rows['natureza'],
		'tipo' => $rows['tipo'],
		'periodo' => $periodo,
		'equipe' => $lst_equipe,
		'nup' => $rows['nup'],
		'acao' => '
		<a href="#" class="fa fa-edit"
			data-tooltip="tooltip"  title="Editar"
			data-toggle="modal"
			data-target="#modalAlterarAuditoria"
			data-id_auditoria="'.$rows['id_auditoria'].'"
			data-ano="'.$rows['ano'].'"
			data-nup="'.$rows['nup'].'"
			data-equipe="'.$rows['equipe'].'"
			data-ch_equipe="'.$rows['chefe'].'"
			data-natureza="'.$rows['natureza'].'"
			data-unidades="'.$rows['unidades'].'"
			data-periodo="'.$periodo.'"
			data-tipo="'.$tipo.'"
			data-user_cad="'.$rows['user_cad'].'"
			data-user_alt="'.$rows['user_alt'].'"
			data-dt_cad="'.$rows['data_cad'].'"
			data-dt_alt="'.$rows['data_alt'].'">
		</a>
		&nbsp;&nbsp;
		<a href="#" title="Excluir" class="fa fa-trash"
			data-toggle="confirmation"
			data-on-confirm = "excluirAuditoria"
			data-id="'.$rows['id_auditoria'].'"
			data-tooltip="tooltip"
			data-placement="left"
			data-btn-ok-label="Continuar"
			data-btn-ok-icon="glyphicon glyphicon-share-alt"
			data-btn-ok-class="btn-success"
			data-btn-cancel-label="Parar"
			data-btn-cancel-icon="glyphicon glyphicon-ban-circle"
			data-btn-cancel-class="btn-danger"
			data-title="Excluir"
			data-content="Confirma?">
		</a>'
	);
}

echo json_encode($output);
?>