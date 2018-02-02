<?php
/**************************************************************
* Local/nome do script: admin/questao/questao_vincular_proc_coleta.php
* Só executa se for chamado pelo formulario, senão chama o script de "acesso negado"
* Ao final de tudo, redireciona para o admin.php
* *************************************************************/

session_start();

$inc = "sim";
include_once('../../../config.inc.php');

if (isset($_POST['flag']) and isset($_SESSION['cpf'])){

	require_once(PATH . '/controllers/autenticacao/autentica.inc.php');

	$id_questao = $_POST['id_questao'];

	$busca_proc_coleta = $mysqli->query("SELECT id_proc_coleta FROM adm_proc_coleta");
	$qtde = $busca_proc_coleta->num_rows;//apenas para calcular a quantidade de proc_coleta

	$id_proc_coleta = "";

	for($i = 1; $i <= $qtde; $i++){
		if($_POST[$i] <> ""){
			$id_proc_coleta = $id_proc_coleta.$_POST[$i].",";//concatena os id_proc_coleta com ",".
		}
	}

	if($id_proc_coleta <> ""){
		$id_proc_coleta = substr($id_proc_coleta, 0, -1);//elimina a ultima ",".
		$id_proc_coleta = explode(",",$id_proc_coleta);//cria um array separando pelas ",".
		$id_proc_coleta_vinc = serialize($id_proc_coleta);//cria uma string com o array serializado
	}
	else{
		$id_proc_coleta_vinc = "";
	}

	$con_vinc = $mysqli->query("UPDATE adm_questoes SET id_proc_coleta_vinc = '$id_proc_coleta_vinc' where id_questao = '$id_questao'");//atualiza a lista de proc_coletas vinculadas

	if ($mysqli->affected_rows <> 0 ){
		$_SESSION['questao_vincular'] = "Alteração de vinculação realizada com sucesso!";
		$_SESSION['botao'] = "success";
	}
	else{
		$_SESSION['questao_vincular'] = "Nenhuma alteração foi realizada!";
		$_SESSION['botao'] = "warning";

	}
	$flag = md5("questao_vincular");
	header(sprintf("Location:../../../admin.php?flag=$flag"));
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>
