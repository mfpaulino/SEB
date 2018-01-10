<?php
//categoria_alterar.php

session_start();

$inc = "sim";
include_once('../../../config.inc.php');

if(isset($_POST['flag']) and isset($_SESSION['cpf'])){

	$acao = $_POST['flag'];

	$_SESSION['botao'] = "success";

	require_once(PATH . '/controllers/autenticacao/autentica.inc.php');
	require_once(PATH . '/componentes/internos/php/validaForm.class.php');
	require_once(PATH . '/componentes/internos/php/funcoes.inc.php');

	if($acao == "alterar"){

		$area 			= isset($_POST['area']) ? mysqli_real_escape_string($mysqli, $_POST['area']) : "";

		$area_atual 	= $_POST['area_atual'];//tipo hidden
		$id_area 		= $_POST['id_area'];//tipo hidden

		$validar = new validaForm();

		$validar->set('Área', 	 $area)->is_required();

		if ($validar->validate()){
			$altera = "nao";

			if ($area <> "" and $area <> $area_atual){

				$con_area = $mysqli->prepare("UPDATE adm_areas SET area = ? WHERE id_area ='$id_area'");
				$con_area->bind_param('s', $area);
				$resultado = $con_area->execute();

				if($resultado){

					/** log **/
					$log = "Alterou a Área \"<u>" . $area_atual . "</u>\" para <u>" . $area . "</u>.";
					$con_log = $mysqli->query("INSERT INTO logs SET cpf = '$cpf', codom = '$codom_usuario', acao = '$log', tabela = 'adm_areas'");
					/** fim log **/

					$_SESSION['alterar_area'] = "Área alterada com sucesso!";
					$altera = "sim";
				}
			}
			if($altera == "nao"){
				$_SESSION['alterar_nada_area'] = "AVISO: nenhuma alteração foi realizada!";
				$_SESSION['botao'] = "warning";
			}
		}
		else {
			$_SESSION['alterar_erro_validacao_area'] = "ERRO ADM-001: dados inconsistentes, preencha novamente o formulário!";
			$_SESSION['alterar_lista_erro_validacao_area'] = $validar->get_errors(); //Captura os erros de todos os campos
			$_SESSION['botao'] = "danger";
		}
	}
	else if($acao == "excluir"){

		$area = explode("|", $_POST['area']);//valor recebido do select_altera_area
		$id_area = $area[0];
		$area = $area[1];

		$con_del   = $mysqli->query("DELETE FROM adm_areas WHERE id_area = '$id_area'");
		$con_teste = $mysqli->query("SELECT id_area FROM adm_areas WHERE id_area = '$id_area'");

		if($con_teste->num_rows == 0){

			/** log **/
			$log = "Excluiu a Área <u>" . $area . "</u>.";
			$con_log = $mysqli->query("INSERT INTO logs SET cpf = '$cpf', codom = '$codom_usuario', acao = '$log', tabela = 'adm_areas'");
			/** fim log **/

			$_SESSION['alterar_area'] = "Área excluída com sucesso!";
		}
		else{
			$_SESSION['alterar_nada_area'] = "ERRO ADM-002: área não excluída. Por favor, tente novamente!";
			$_SESSION['botao'] = "danger";
		}
	}
	$flag = md5("area_alterar");
	header("Location:../../../admin.php?flag=$flag");
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>