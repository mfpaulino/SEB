<?php
//tipo_evento_alterar.php

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

		$tipo_evento 			= isset($_POST['tipo_evento']) ? mysqli_real_escape_string($mysqli, $_POST['tipo_evento']) : "";

		$tipo_evento_atual 	= $_POST['tipo_evento_atual'];//tipo hidden
		$id_tipo_evento 		= $_POST['id_tipo_evento'];//tipo hidden

		$validar = new validaForm();

		$validar->set('Tipo de Evento', 	 $tipo_evento)->is_required();

		if ($validar->validate()){
			$altera = "nao";

			if ($tipo_evento <> "" and $tipo_evento <> $tipo_evento_atual){

				$con_tipo_evento = $mysqli->prepare("UPDATE adm_tipo_evento SET tipo_evento = ? WHERE id_tipo_evento ='$id_tipo_evento'");
				$con_tipo_evento->bind_param('s', $tipo_evento);
				$resultado = $con_tipo_evento->execute();

				if($resultado){

					/** log **/
					$log = "Alterou o Tipo de Evento \"<u>" . $tipo_evento_atual . "</u>\" para <u>" . $tipo_evento . "</u>.";
					$con_log = $mysqli->query("INSERT INTO logs SET cpf = '$cpf', codom = '$codom_usuario', acao = '$log', tabela = 'adm_tipo_evento'");
					/** fim log **/

					$_SESSION['alterar_tipo_evento'] = "Tipo de Evento alterado com sucesso!";
					$altera = "sim";
				}
			}
			if($altera == "nao"){
				$_SESSION['alterar_nada_tipo_evento'] = "AVISO: nenhuma alteração foi realizada!";
				$_SESSION['botao'] = "warning";
			}
		}
		else {
			$_SESSION['alterar_erro_validacao_tipo_evento'] = "ERRO A-019: dados inconsistentes, preencha novamente o formulário!";
			$_SESSION['alterar_lista_erro_validacao_tipo_evento'] = $validar->get_errors(); //Captura os erros de todos os campos
			$_SESSION['botao'] = "danger";
		}
	}
	else if($acao == "excluir"){

		$tipo_evento = explode("|", $_POST['tipo_evento']);//valor recebido do select_altera_tipo_evento
		$id_tipo_evento = $tipo_evento[0];
		$tipo_evento = $tipo_evento[1];

		$con_del   = $mysqli->query("DELETE FROM adm_tipo_evento WHERE id_tipo_evento = '$id_tipo_evento'");
		$con_teste = $mysqli->query("SELECT id_tipo_evento FROM adm_tipo_evento WHERE id_tipo_evento = '$id_tipo_evento'");

		if($con_teste->num_rows == 0){

			/** log **/
			$log = "Excluiu o Tipo de Evento <u>" . $tipo_evento . "</u>.";
			$con_log = $mysqli->query("INSERT INTO logs SET cpf = '$cpf', codom = '$codom_usuario', acao = '$log', tabela = 'adm_tipo_evento'");
			/** fim log **/

			$_SESSION['alterar_tipo_evento'] = "Tipo de Evento excluído com sucesso!";
		}
		else{
			$_SESSION['alterar_nada_tipo_evento'] = "ERRO A-020: tipo de evento não excluído. Por favor, tente novamente!";
			$_SESSION['botao'] = "danger";
		}
	}
	$flag = md5("tipo_evento_alterar");
	header("Location:../../../admin.php?flag=$flag");
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>