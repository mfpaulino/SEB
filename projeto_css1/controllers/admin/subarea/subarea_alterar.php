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

		$subarea = isset($_POST['subarea']) ? mysqli_real_escape_string($mysqli, $_POST['subarea']) : "";

		$subarea_atual 	= $_POST['subarea_atual'];//tipo hidden
		$id_subarea 	= $_POST['id_subarea'];//tipo hidden

		$validar = new validaForm();

		$validar->set('Subárea', 	 $subarea)->is_required();

		if ($validar->validate()){
			$altera = "nao";

			if ($subarea <> "" and $subarea <> $subarea_atual){

				$con_subarea = $mysqli->prepare("UPDATE adm_subareas SET subarea = ? WHERE id_subarea ='$id_subarea'");
				$con_subarea->bind_param('s', $subarea);
				$resultado = $con_subarea->execute();

				if($resultado){

					/** log **/
					$log = "Alterou a Subárea \"<u>" . $subarea_atual . "</u>\" para <u>" . $subarea . "</u>.";
					$con_log = $mysqli->query("INSERT INTO logs SET cpf = '$cpf', codom = '$codom_usuario', acao = '$log', tabela = 'adm_subareas'");
					/** fim log **/

					$_SESSION['alterar_subarea'] = "Subárea alterada com sucesso!";
					$altera = "sim";
				}
			}
			if($altera == "nao"){
				$_SESSION['alterar_nada_subarea'] = "AVISO: nenhuma alteração foi realizada!";
				$_SESSION['botao'] = "warning";
			}
		}
		else {
			$_SESSION['alterar_erro_validacao_subarea'] = "ERRO 078: dados inconsistentes, preencha novamente o formulário!";
			$_SESSION['alterar_lista_erro_validacao_subarea'] = $validar->get_errors(); //Captura os erros de todos os campos
			$_SESSION['botao'] = "danger";
		}
	}
	else if($acao == "excluir"){

		$subarea = explode("|", $_POST['subarea']);//valor recebido do select_subarea

		$con_del   = $mysqli->query("DELETE FROM adm_subareas WHERE id_subarea = '$subarea[0]'");
		$con_teste = $mysqli->query("SELECT id_subarea FROM adm_subareas WHERE id_subarea = '$subarea[0]'");

		if($con_teste->num_rows == 0){

			/** log **/
			$log = "Excluiu a Subarea <u>" . $subarea[1] . "</u>.";
			$con_log = $mysqli->query("INSERT INTO logs SET cpf = '$cpf', codom = '$codom_usuario', acao = '$log', tabela = 'adm_subareas'");
			/** fim log **/

			$_SESSION['alterar_subarea'] = "Subárea excluída com sucesso!";
		}
		else{
			$_SESSION['alterar_nada_subarea'] = "ERRO 079: área não excluída. Por favor, tente novamente!";
			$_SESSION['botao'] = "danger";
		}
	}
	$flag = md5("subarea_alterar");
	header("Location:../../../admin.php?flag=$flag");
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>