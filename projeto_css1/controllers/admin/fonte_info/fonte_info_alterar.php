<?php
//fonte_info_alterar.php

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

		$fonte_info 			= isset($_POST['fonte_info']) ? mysqli_real_escape_string($mysqli, $_POST['fonte_info']) : "";

		$fonte_info_atual 	= $_POST['fonte_info_atual'];//tipo hidden
		$id_fonte_info 		= $_POST['id_fonte_info'];//tipo hidden

		$validar = new validaForm();

		$validar->set('Fonte de Informação', 	 $fonte_info)->is_required();

		if ($validar->validate()){
			$altera = "nao";

			if ($fonte_info <> "" and $fonte_info <> $fonte_info_atual){

				$con_fonte_info = $mysqli->prepare("UPDATE adm_fontes_informacao SET fonte_info = ? WHERE id_fonte_info ='$id_fonte_info'");
				$con_fonte_info->bind_param('s', $fonte_info);
				$resultado = $con_fonte_info->execute();

				if($resultado){

					/** log **/
					$log = "Alterou a Área \"<u>" . $fonte_info_atual . "</u>\" para <u>" . $fonte_info . "</u>.";
					$con_log = $mysqli->query("INSERT INTO logs SET cpf = '$cpf', codom = '$codom_usuario', acao = '$log', tabela = 'adm_fontes_informacao'");
					/** fim log **/

					$_SESSION['alterar_fonte_info'] = "Fonte de Informação alterada com sucesso!";
					$altera = "sim";
				}
			}
			if($altera == "nao"){
				$_SESSION['alterar_nada_fonte_info'] = "AVISO: nenhuma alteração foi realizada!";
				$_SESSION['botao'] = "warning";
			}
		}
		else {
			$_SESSION['alterar_erro_validacao_fonte_info'] = "ERRO A-019: dados inconsistentes, preencha novamente o formulário!";
			$_SESSION['alterar_lista_erro_validacao_fonte_info'] = $validar->get_errors(); //Captura os erros de todos os campos
			$_SESSION['botao'] = "danger";
		}
	}
	else if($acao == "excluir"){

		$fonte_info = explode("|", $_POST['fonte_info']);//valor recebido do select_altera_fonte_info
		$id_fonte_info = $fonte_info[0];
		$fonte_info = $fonte_info[1];

		$con_del   = $mysqli->query("DELETE FROM adm_fontes_informacao WHERE id_fonte_info = '$id_fonte_info'");
		$con_teste = $mysqli->query("SELECT id_fonte_info FROM adm_fontes_informacao WHERE id_fonte_info = '$id_fonte_info'");

		if($con_teste->num_rows == 0){

			/** log **/
			$log = "Excluiu a Fonte de Informação <u>" . $fonte_info . "</u>.";
			$con_log = $mysqli->query("INSERT INTO logs SET cpf = '$cpf', codom = '$codom_usuario', acao = '$log', tabela = 'adm_fontes_informacao'");
			/** fim log **/

			$_SESSION['alterar_fonte_info'] = "Fonte de Informação excluída com sucesso!";
		}
		else{
			$_SESSION['alterar_nada_fonte_info'] = "ERRO A-020: fonte de informação não excluída. Por favor, tente novamente!";
			$_SESSION['botao'] = "danger";
		}
	}
	$flag = md5("fonte_info_alterar");
	header("Location:../../../admin.php?flag=$flag");
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>