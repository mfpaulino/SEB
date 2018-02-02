<?php
/**************************************************************
* Local/nome do script: admin/questao/questao_vincular_info_req.php
* Só executa se for chamado pelo formulario, senão chama o script de "acesso negado"
* Ao final de tudo, redireciona para o admin.php
* *************************************************************/

session_start();

$inc = "sim";
include_once('../../../config.inc.php');

if (isset($_POST['flag']) and isset($_SESSION['cpf'])){

	require_once(PATH . '/controllers/autenticacao/autentica.inc.php');

	$id_questao = $_POST['id_questao'];

	$busca_info_req = $mysqli->query("SELECT id_info_req FROM adm_info_requeridas");
	$qtde = $busca_info_req->num_rows;//apenas para calcular a quantidade de info_reqs

	$id_info_req = "";

	for($i = 1; $i <= $qtde; $i++){
		if($_POST[$i] <> ""){
			$id_info_req = $id_info_req.$_POST[$i].",";//concatena os id_info_req com ",".
		}
	}

	if($id_info_req <> ""){
		$id_info_req = substr($id_info_req, 0, -1);//elimina a ultima ",".
		$id_info_req = explode(",",$id_info_req);//cria um array separando pelas ",".
		$id_info_req_vinc = serialize($id_info_req);//cria uma string com o array serializado
	}
	else{
		$id_info_req_vinc = "";
	}

	$con_vinc = $mysqli->query("UPDATE adm_questoes SET id_info_req_vinc = '$id_info_req_vinc' where id_questao = '$id_questao'");//atualiza a lista de info_reqs vinculadas

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
