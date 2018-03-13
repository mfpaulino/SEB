<?php
//proc_coleta_alterar.php

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

		$proc_coleta 			= isset($_POST['proc_coleta']) ? $_POST['proc_coleta'] : "";

		$proc_coleta_atual 	= $_POST['proc_coleta_atual'];//tipo hidden
		$id_proc_coleta 		= $_POST['id_proc_coleta'];//tipo hidden

		$validar = new validaForm();

		$validar->set('Procedimento de Análise', 	 $proc_coleta)->is_required();

		if ($validar->validate()){
			$altera = "nao";

			if ($proc_coleta <> "" and $proc_coleta <> $proc_coleta_atual){

				$con_proc_coleta = $mysqli->prepare("UPDATE adm_proc_coleta SET proc_coleta = ? WHERE id_proc_coleta ='$id_proc_coleta'");
				$con_proc_coleta->bind_param('s', $proc_coleta);
				$resultado = $con_proc_coleta->execute();

				if($resultado){

					/** log **/
					$log = "Alterou Procedimento de Coleta de Dados \"<u>" . $proc_coleta_atual . "</u>\" para <u>" . $proc_coleta . "</u>.";
					$con_log = $mysqli->query("INSERT INTO logs SET cpf = '$cpf', codom = '$codom_usuario', acao = '$log', tabela = 'adm_proc_coleta'");
					/** fim log **/

					$_SESSION['alterar_proc_coleta'] = "Procedimento de Coleta de Dados alterado com sucesso!";
					$altera = "sim";
				}
			}
			if($altera == "nao"){
				$_SESSION['alterar_nada_proc_coleta'] = "AVISO: nenhuma alteração foi realizada!";
				$_SESSION['botao'] = "warning";
			}
		}
		else {
			$_SESSION['alterar_erro_validacao_proc_coleta'] = "ERRO 068: dados inconsistentes, preencha novamente o formulário!";
			$_SESSION['alterar_lista_erro_validacao_proc_coleta'] = $validar->get_errors(); //Captura os erros de todos os campos
			$_SESSION['botao'] = "danger";
		}
	}
	else if($acao == "excluir"){

		$proc_coleta = explode("|", $_POST['proc_coleta']);//valor recebido do select_altera_proc_coleta
		$id_proc_coleta = $proc_coleta[0];
		$proc_coleta = $proc_coleta[1];

		/*** verificando se existe alguma vinculação com questao ***/
		$con_teste1 = $mysqli->query("SELECT id_questao FROM adm_questoes WHERE id_proc_coleta_vinc like '%:\"$id_proc_coleta\";%'");

		if($con_teste1->num_rows == 0){

			//exclui apenas se nao houver nenhuma vinculação com questao
			$con_del   = $mysqli->query("DELETE FROM adm_proc_coleta WHERE id_proc_coleta = '$id_proc_coleta'");
		}

		$con_teste = $mysqli->query("SELECT id_proc_coleta FROM adm_proc_coleta WHERE id_proc_coleta = '$id_proc_coleta'");
		if($con_teste->num_rows == 0){

			/** log **/
			$log = "Excluiu o Possível Achado <u>" . $proc_coleta . "</u>.";
			$con_log = $mysqli->query("INSERT INTO logs SET cpf = '$cpf', codom = '$codom_usuario', acao = '$log', tabela = 'adm_proc_coleta'");
			/** fim log **/

			$_SESSION['alterar_proc_coleta'] = "Procedimento de Coleta de Dados excluído com sucesso!";
		}
		else{
			$_SESSION['alterar_nada_proc_coleta'] = "ERRO 069: procedimento de coleta de dados não excluído. Por favor, tente novamente!<br />Verifique se não há vinculações ativas.";
			$_SESSION['botao'] = "danger";
		}
	}
	$flag = md5("proc_coleta_alterar");
	header("Location:../../../admin.php?flag=$flag");
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>