<?php
//poss_achado_alterar.php

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

		$poss_achado 			= isset($_POST['poss_achado']) ? mysqli_real_escape_string($mysqli, $_POST['poss_achado']) : "";

		$poss_achado_atual 	= $_POST['poss_achado_atual'];//tipo hidden
		$id_poss_achado 		= $_POST['id_poss_achado'];//tipo hidden

		$validar = new validaForm();

		$validar->set('Possível Achado', 	 $poss_achado)->is_required();

		if ($validar->validate()){
			$altera = "nao";

			if ($poss_achado <> "" and $poss_achado <> $poss_achado_atual){

				$con_poss_achado = $mysqli->prepare("UPDATE adm_poss_achados SET poss_achado = ? WHERE id_poss_achado ='$id_poss_achado'");
				$con_poss_achado->bind_param('s', $poss_achado);
				$resultado = $con_poss_achado->execute();

				if($resultado){

					/** log **/
					$log = "Alterou a Informação Requerida \"<u>" . $poss_achado_atual . "</u>\" para <u>" . $poss_achado . "</u>.";
					$con_log = $mysqli->query("INSERT INTO logs SET cpf = '$cpf', codom = '$codom_usuario', acao = '$log', tabela = 'adm_poss_achados'");
					/** fim log **/

					$_SESSION['alterar_poss_achado'] = "Possível Achado alterado com sucesso!";
					$altera = "sim";
				}
			}
			if($altera == "nao"){
				$_SESSION['alterar_nada_poss_achado'] = "AVISO: nenhuma alteração foi realizada!";
				$_SESSION['botao'] = "warning";
			}
		}
		else {
			$_SESSION['alterar_erro_validacao_poss_achado'] = "ERRO 058: dados inconsistentes, preencha novamente o formulário!";
			$_SESSION['alterar_lista_erro_validacao_poss_achado'] = $validar->get_errors(); //Captura os erros de todos os campos
			$_SESSION['botao'] = "danger";
		}
	}
	else if($acao == "excluir"){

		$poss_achado = explode("|", $_POST['poss_achado']);//valor recebido do select_altera_poss_achado
		$id_poss_achado = $poss_achado[0];
		$poss_achado = $poss_achado[1];

		/*** verificando se existe alguma vinculação com questao ***/
		$con_teste1 = $mysqli->query("SELECT id_questao FROM adm_questoes WHERE id_poss_achado_vinc like '%:\"$id_poss_achado\";%'");

		if($con_teste1->num_rows == 0){

			//exclui apenas se nao houver nenhuma vinculação com questao
			$con_del   = $mysqli->query("DELETE FROM adm_poss_achados WHERE id_poss_achado = '$id_poss_achado'");
		}

		$con_teste = $mysqli->query("SELECT id_poss_achado FROM adm_poss_achados WHERE id_poss_achado = '$id_poss_achado'");
		if($con_teste->num_rows == 0){

			/** log **/
			$log = "Excluiu o Possível Achado <u>" . $poss_achado . "</u>.";
			$con_log = $mysqli->query("INSERT INTO logs SET cpf = '$cpf', codom = '$codom_usuario', acao = '$log', tabela = 'adm_poss_achados'");
			/** fim log **/

			$_SESSION['alterar_poss_achado'] = "Possível Achado excluído com sucesso!";
		}
		else{
			$_SESSION['alterar_nada_poss_achado'] = "ERRO 059: possível achado não excluído. Por favor, tente novamente!<br />Verifique se não há vinculações ativas.";
			$_SESSION['botao'] = "danger";
		}
	}
	$flag = md5("poss_achado_alterar");
	header("Location:../../../admin.php?flag=$flag");
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>