<?php
$inc = "sim";
include('../../../config.inc.php');
include(PATH . '/componentes/internos/php/funcoes.inc.php');
include(PATH . '/controllers/autenticacao/autentica.inc.php');


/************* gerar uma lista com os id das auditorias dependendo do usuario que estiver logado (unidade/icfex/cciex) **/
$sql = "SELECT id_auditoria, unidades FROM plan_auditoria";
$con_auditorias = $mysqli->query($sql);

while ($rows =  $con_auditorias->fetch_assoc()){

	/****** relacao unidades **********************/
	$om = substr($rows['unidades'], 0, -1);//codom
	$lst_om = "";

	$con_om = $mysqli->query("SELECT sigla FROM cciex_om WHERE codom IN ($om)");
	//$con_om = $mysqli1->query("SELECT sigla FROM cciex_om WHERE codom IN ($om)");
	while($row_om = $con_om->fetch_assoc()){
		$lst_om = $lst_om . $row_om['sigla'].", ";//sigla_unidade
	}

	$lst_om = substr($lst_om, 0, -2);
	/*********** relação de unid contr interno *************/
	$con_uci = $mysqli->query("SELECT icfex FROM cciex_om WHERE codom IN ($om)");
	$lst_uci = "";

	while($row_uci = $con_uci->fetch_assoc()){

		$cod_uci = $row_uci['icfex'];//pega o cod da unid cont interno

		if($nr_ci == $cod_uci or $nr_ci == '0'){
			$lst_id = $lst_id . $rows['id_auditoria'] . ',';
		}
		elseif($nr_ci == ''){
			$om_array = explode(",", $om);
			if(in_array($codom_usuario, $om_array)){
				$lst_id = $lst_id . $rows['id_auditoria'] . ',';
			}
		}
	}
}
$lst_id = substr($lst_id, 0, -1);//elimino a última "," da string.
$lst_id = explode(",", $lst_id);
$lst_id = array_unique($lst_id);
$lst_id = implode(",", $lst_id);
//echo $lst_id;
/**********************************************************************************************************************************/

$sql = "SELECT plan_auditoria.*, id_tipo_evento FROM plan_auditoria, adm_tipo_evento WHERE tipo = tipo_evento AND id_auditoria IN ($lst_id) ORDER BY ano DESC, id_auditoria DESC";
$con_auditorias = $mysqli->query($sql);

$output = array();
while ($rows =  $con_auditorias->fetch_assoc()){
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

	$con_mtz_plan = $mysqli->query("SELECT id_mtz_plan FROM plan_mtz_plan WHERE id_auditoria = ".$rows['id_auditoria']);
	if($con_mtz_plan->num_rows <> 0){
		$existe_matriz = "sim";
	}
	else {$existe_matriz = "";
	}

	if (in_array("plan_aud_edit", $lista_permissoes)){
		$acao = '
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
		<a href="#" class="fa fa-trash"
			data-tooltip="tooltip" title="Excluir"
			data-toggle="confirmation"
			data-on-confirm = "excluirAuditoria"
			data-id="'.$rows['id_auditoria'].'"
			data-placement="left"
			data-btn-ok-label="Continuar"
			data-btn-ok-icon="glyphicon glyphicon-share-alt"
			data-btn-ok-class="btn-success"
			data-btn-cancel-label="Parar"
			data-btn-cancel-icon="glyphicon glyphicon-ban-circle"
			data-btn-cancel-class="btn-danger"
			data-content="Confirma?">
		</a>';
		if($existe_matriz == "sim"){
			$cad = "";

			$view = '
			<a href="#"
				data-toggle="modal" title="Visualizar Matriz"
				data-target="#modalAlterarAuditoria"
				data-id_auditoria="'.$rows['id_mtz_planejamento'].'"
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
				data-dt_alt="'.$rows['data_alt'].'"><i class="fa fa-search"></i>
			</a>';

			$edit = '
			<a href="#"
				data-toggle="modal" title="Alterar Dados"
				data-target="#modalAlterarAuditoria"
				data-id_auditoria="'.$rows['id_mtz_planejamento'].'"
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
				data-dt_alt="'.$rows['data_alt'].'"><i class="fa fa-edit"></i>
			</a>';
			}
			else{
				$cad = '
				<a href="#"
					data-toggle="modal" title="Cadastrar"
					data-target="#modalCadastrarMtzPlanejamento"
					data-id_auditoria="'.$rows['id_auditoria'].'"><i class="fa fa-plus-square"></i>
				</a>';

				$view = "";
				$edit = "";
			}
	}
	else $acao = "";

	$output[] = array(
		'ano' => $rows['ano'],
		'uci' => $lst_uci,
		'unidades' => $lst_om,
		'natureza' => $rows['natureza'],
		'tipo' => $rows['tipo'],
		'periodo' => $periodo,
		'equipe' => $lst_equipe,
		'nup' => $rows['nup'],
		'acao' => $acao,
		'mtz_acao1' => $cad,
		'mtz_acao2' => $view,
		'mtz_acao3' => $edit,
		'prog_trab_acao1' => $acao1,
		'prog_trab_acao2' => $acao2,
		'prog_trab_acao3' => $acao3
	);
}

echo json_encode($output);
?>