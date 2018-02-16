<?php
//info_req_alterar.php

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

		$info_req 			= isset($_POST['info_req']) ? mysqli_real_escape_string($mysqli, $_POST['info_req']) : "";

		$info_req_atual 	= $_POST['info_req_atual'];//tipo hidden
		$id_info_req 		= $_POST['id_info_req'];//tipo hidden

		$validar = new validaForm();

		$validar->set('Informação Requerida', 	 $info_req)->is_required();

		if ($validar->validate()){
			$altera = "nao";

			if ($info_req <> "" and $info_req <> $info_req_atual){

				$con_info_req = $mysqli->prepare("UPDATE adm_info_requeridas SET info_req = ? WHERE id_info_req ='$id_info_req'");
				$con_info_req->bind_param('s', $info_req);
				$resultado = $con_info_req->execute();

				if($resultado){

					/** log **/
					$log = "Alterou a Informação Requerida \"<u>" . $info_req_atual . "</u>\" para <u>" . $info_req . "</u>.";
					$con_log = $mysqli->query("INSERT INTO logs SET cpf = '$cpf', codom = '$codom_usuario', acao = '$log', tabela = 'adm_info_requeridas'");
					/** fim log **/

					$_SESSION['alterar_info_req'] = "Informação Requerida alterada com sucesso!";
					$altera = "sim";
				}
			}
			if($altera == "nao"){
				$_SESSION['alterar_nada_info_req'] = "AVISO: nenhuma alteração foi realizada!";
				$_SESSION['botao'] = "warning";
			}
		}
		else {
			$_SESSION['alterar_erro_validacao_info_req'] = "ERRO 053: dados inconsistentes, preencha novamente o formulário!";
			$_SESSION['alterar_lista_erro_validacao_info_req'] = $validar->get_errors(); //Captura os erros de todos os campos
			$_SESSION['botao'] = "danger";
		}
	}
	else if($acao == "excluir"){

		$info_req = explode("|", $_POST['info_req']);//valor recebido do select_altera_info_req
		$id_info_req = $info_req[0];
		$info_req = $info_req[1];

		/*** verificando se existe alguma vinculação com questao ou fonte info ***/
		$con_teste1 = $mysqli->query("SELECT id_questao FROM adm_questoes WHERE id_info_req_vinc like '%:\"$id_info_req\";%'");
		$con_teste2 = $mysqli->query("SELECT id_info_req FROM adm_info_requeridas WHERE id_info_req = '$id_info_req' AND id_fonte_info_vinc <> ''");

		if($con_teste1->num_rows == 0 and $con_teste2->num_rows == 0){

			//exclui apenas se nao houver nenhuma vinculação com questao ou fonte info
			$con_del   = $mysqli->query("DELETE FROM adm_info_requeridas WHERE id_info_req = '$id_info_req'");
		}

		$con_teste = $mysqli->query("SELECT id_info_req FROM adm_info_requeridas WHERE id_info_req = '$id_info_req'");
		if($con_teste->num_rows == 0){

			/** log **/
			$log = "Excluiu a Informação Requerida <u>" . $info_req . "</u>.";
			$con_log = $mysqli->query("INSERT INTO logs SET cpf = '$cpf', codom = '$codom_usuario', acao = '$log', tabela = 'adm_info_requeridas'");
			/** fim log **/

			$_SESSION['alterar_info_req'] = "Informação Requerida excluída com sucesso!";
		}
		else{
			$_SESSION['alterar_nada_info_req'] = "ERRO 054: informação requerida não excluída. Por favor, tente novamente!<br />Verifique se não há vinculações ativas.";
			$_SESSION['botao'] = "danger";
		}
	}
	$flag = md5("info_req_alterar");
	header("Location:../../../admin.php?flag=$flag");
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>