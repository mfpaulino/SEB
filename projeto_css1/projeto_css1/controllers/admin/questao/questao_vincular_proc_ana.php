<?php
/**************************************************************
* Local/nome do script: admin/questao/questao_vincular_proc_ana.php
* Só executa se for chamado pelo formulario, senão chama o script de "acesso negado"
* Ao final de tudo, redireciona para o admin.php
* *************************************************************/

session_start();

$inc = "sim";
include_once('../../../config.inc.php');

if (isset($_POST['flag']) and isset($_SESSION['cpf'])){

	require_once(PATH . '/controllers/autenticacao/autentica.inc.php');

	$id_questao = $_POST['id_questao'];

	$busca_proc_ana = $mysqli->query("SELECT id_proc_ana FROM adm_proc_analise");
	$qtde = $busca_proc_ana->num_rows;//apenas para calcular a quantidade de proc_ana

	$id_proc_ana = "";

	for($i = 1; $i <= $qtde; $i++){
		if($_POST[$i] <> ""){
			$id_proc_ana = $id_proc_ana.$_POST[$i].",";//concatena os id_proc_ana com ",".
		}
	}

	if($id_proc_ana <> ""){
		$id_proc_ana = substr($id_proc_ana, 0, -1);//elimina a ultima ",".
		$id_proc_ana = explode(",",$id_proc_ana);//cria um array separando pelas ",".
		$id_proc_ana_vinc = serialize($id_proc_ana);//cria uma string com o array serializado
	}
	else{
		$id_proc_ana_vinc = "";
	}

	$con_vinc = $mysqli->query("UPDATE adm_questoes SET id_proc_ana_vinc = '$id_proc_ana_vinc' where id_questao = '$id_questao'");//atualiza a lista de proc_anas vinculadas

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
