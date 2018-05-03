<?php
//questao_alterar.php

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

		$questao 			= isset($_POST['questao']) ? $_POST['questao'] : "";

		$questao_atual 	= $_POST['questao_atual'];//tipo hidden
		$id_questao 		= $_POST['id_questao'];//tipo hidden

		$validar = new validaForm();

		$validar->set('Questão', 	 $questao)->is_required();

		if ($validar->validate()){
			$altera = "nao";

			if ($questao <> "" and $questao <> $questao_atual){

				$con_questao = $mysqli->prepare("UPDATE adm_questoes SET questao = ? WHERE id_questao ='$id_questao'");
				$con_questao->bind_param('s', $questao);
				$resultado = $con_questao->execute();

				if($resultado){

					/** log **/
					$log = "Alterou a Questão \"<u>" . $questao_atual . "</u>\" para <u>" . $questao . "</u>.";
					$con_log = $mysqli->query("INSERT INTO logs SET cpf = '$cpf', codom = '$codom_usuario', acao = '$log', tabela = 'adm_questoes'");
					/** fim log **/

					$_SESSION['alterar_questao'] = "Questão alterada com sucesso!";
					$altera = "sim";
				}
			}
			if($altera == "nao"){
				$_SESSION['alterar_nada_questao'] = "AVISO: nenhuma alteração foi realizada!";
				$_SESSION['botao'] = "warning";
			}
		}
		else {
			$_SESSION['alterar_erro_validacao_questao'] = "ERRO 073: dados inconsistentes, preencha novamente o formulário!";
			$_SESSION['alterar_lista_erro_validacao_questao'] = $validar->get_errors(); //Captura os erros de todos os campos
			$_SESSION['botao'] = "danger";
		}
	}
	else if($acao == "excluir"){

		$questao = explode("|", $_POST['questao']);//valor recebido do select_altera_questao
		$id_questao = $questao[0];
		$questao = $questao[1];

		/*** verificando se existe alguma vinculação com subarea, informação requerida, possível achado, procedimento de análise ou proc de coleta de dados. ***/
		$con_teste1 = $mysqli->query("SELECT id_subarea FROM adm_subareas WHERE id_questao_vinc like '%:\"$id_questao\";%'");
		$con_teste2 = $mysqli->query("SELECT id_questao FROM adm_questoes WHERE id_questao = '$id_questao' AND (id_info_req_vinc <> '' OR id_poss_achado_vinc <> '' OR id_proc_ana_vinc <> '' OR id_proc_coleta_vinc <> '')");

		if($con_teste1->num_rows == 0 and $con_teste2->num_rows == 0){

			//exclui apenas se nao houver nenhuma vinculação com area ou questao
			$con_del   = $mysqli->query("DELETE FROM adm_questoes WHERE id_questao = '$id_questao'");
		}

		$con_teste = $mysqli->query("SELECT id_questao FROM adm_questoes WHERE id_questao = '$id_questao'");
		if($con_teste->num_rows == 0){

			/** log **/
			$log = "Excluiu a Questão <u>" . $questao . "</u>.";
			$con_log = $mysqli->query("INSERT INTO logs SET cpf = '$cpf', codom = '$codom_usuario', acao = '$log', tabela = 'adm_questoes'");
			/** fim log **/

			$_SESSION['alterar_questao'] = "Questão excluída com sucesso!";
		}
		else{
			$_SESSION['alterar_nada_questao'] = "ERRO 074: questão não excluída. Por favor, tente novamente!<br />Verifique se não há vinculações ativas.";
			$_SESSION['botao'] = "danger";
		}
	}
	$flag = md5("questao_alterar");
	header("Location:../../../admin.php?flag=$flag");
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>