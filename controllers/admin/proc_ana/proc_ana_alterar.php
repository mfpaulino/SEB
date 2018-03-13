<?php
//proc_ana_alterar.php

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

		$proc_ana 			= isset($_POST['proc_ana']) ? $_POST['proc_ana'] : "";

		$proc_ana_atual 	= $_POST['proc_ana_atual'];//tipo hidden
		$id_proc_ana 		= $_POST['id_proc_ana'];//tipo hidden

		$validar = new validaForm();

		$validar->set('Procedimento de Análise', 	 $proc_ana)->is_required();

		if ($validar->validate()){
			$altera = "nao";

			if ($proc_ana <> "" and $proc_ana <> $proc_ana_atual){

				$con_proc_ana = $mysqli->prepare("UPDATE adm_proc_analise SET proc_ana = ? WHERE id_proc_ana ='$id_proc_ana'");
				$con_proc_ana->bind_param('s', $proc_ana);
				$resultado = $con_proc_ana->execute();

				if($resultado){

					/** log **/
					$log = "Alterou Procedimento de Análise \"<u>" . $proc_ana_atual . "</u>\" para <u>" . $proc_ana . "</u>.";
					$con_log = $mysqli->query("INSERT INTO logs SET cpf = '$cpf', codom = '$codom_usuario', acao = '$log', tabela = 'adm_proc_analise'");
					/** fim log **/

					$_SESSION['alterar_proc_ana'] = "Procedimento de Análise alterado com sucesso!";
					$altera = "sim";
				}
			}
			if($altera == "nao"){
				$_SESSION['alterar_nada_proc_ana'] = "AVISO: nenhuma alteração foi realizada!";
				$_SESSION['botao'] = "warning";
			}
		}
		else {
			$_SESSION['alterar_erro_validacao_proc_ana'] = "ERRO 063: dados inconsistentes, preencha novamente o formulário!";
			$_SESSION['alterar_lista_erro_validacao_proc_ana'] = $validar->get_errors(); //Captura os erros de todos os campos
			$_SESSION['botao'] = "danger";
		}
	}
	else if($acao == "excluir"){

		$proc_ana = explode("|", $_POST['proc_ana']);//valor recebido do select_altera_proc_ana
		$id_proc_ana = $proc_ana[0];
		$proc_ana = $proc_ana[1];

		/*** verificando se existe alguma vinculação com questao ***/
		$con_teste1 = $mysqli->query("SELECT id_questao FROM adm_questoes WHERE id_proc_ana_vinc like '%:\"$id_proc_ana\";%'");

		if($con_teste1->num_rows == 0){

			//exclui apenas se nao houver nenhuma vinculação com questao
			$con_del   = $mysqli->query("DELETE FROM adm_proc_analise WHERE id_proc_ana = '$id_proc_ana'");
		}

		$con_teste = $mysqli->query("SELECT id_proc_ana FROM adm_proc_analise WHERE id_proc_ana = '$id_proc_ana'");
		if($con_teste->num_rows == 0){

			/** log **/
			$log = "Excluiu o Possível Achado <u>" . $proc_ana . "</u>.";
			$con_log = $mysqli->query("INSERT INTO logs SET cpf = '$cpf', codom = '$codom_usuario', acao = '$log', tabela = 'adm_proc_analise'");
			/** fim log **/

			$_SESSION['alterar_proc_ana'] = "Procedimento de Análise excluído com sucesso!";
		}
		else{
			$_SESSION['alterar_nada_proc_ana'] = "ERRO 064: procedimento de análise não excluído. Por favor, tente novamente!<br />Verifique se não há vinculações ativas.";
			$_SESSION['botao'] = "danger";
		}
	}
	$flag = md5("proc_ana_alterar");
	header("Location:../../../admin.php?flag=$flag");
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>