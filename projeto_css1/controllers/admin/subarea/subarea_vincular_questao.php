<?php
/**************************************************************
* Local/nome do script: admin/area/subarea_vincular_questao.php
* Só executa se for chamado pelo formulario, senão chama o script de "acesso negado"
* Ao final de tudo, redireciona para o admin.php
* *************************************************************/

session_start();

$inc = "sim";
include_once('../../../config.inc.php');

if (isset($_POST['flag']) and isset($_SESSION['cpf'])){

	require_once(PATH . '/controllers/autenticacao/autentica.inc.php');

	$id_subarea = $_POST['id_subarea'];

	$busca_questao = $mysqli->query("SELECT id_questao FROM adm_questoes");
	$qtde = $busca_questao->num_rows;//apenas para calcular a quantidade de questoes

	$id_questao = "";

	for($i = 1; $i <= $qtde; $i++){
		if($_POST[$i] <> ""){
			$id_questao = $id_questao.$_POST[$i].",";//concatena os id_questao com ",".
		}
	}

	if($id_questao <> ""){
		$id_questao = substr($id_questao, 0, -1);//elimina a ultima ",".
		$id_questao = explode(",",$id_questao);//cria um array separando pelas ",".
		$id_questao_vinc = serialize($id_questao);//cria uma string com o array serializado
	}
	else{
		$id_questao_vinc = "";
	}

	$con_vinc = $mysqli->query("UPDATE adm_subareas SET id_questao_vinc = '$id_questao_vinc' where id_subarea = '$id_subarea'");//atualiza a lista de questoes vinculadas

	if ($mysqli->affected_rows <> 0 ){
		$_SESSION['subarea_vincular'] = "Alteração de vinculação realizada com sucesso!";
		$_SESSION['botao'] = "success";
	}
	else{
		$_SESSION['subarea_vincular'] = "Nenhuma alteração foi realizada!";
		$_SESSION['botao'] = "warning";

	}
	$flag = md5("subarea_vincular");
	header(sprintf("Location:../../../admin.php?flag=$flag"));
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>
