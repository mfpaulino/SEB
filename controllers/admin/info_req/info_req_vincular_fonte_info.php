<?php
/**************************************************************
* Local/nome do script: admin/info_req/info_req_vincular_fonte_info.php
* Só executa se for chamado pelo formulario, senão chama o script de "acesso negado"
* Ao final de tudo, redireciona para o admin.php
* *************************************************************/

session_start();

$inc = "sim";
include_once('../../../config.inc.php');

if (isset($_POST['flag']) and isset($_SESSION['cpf'])){

	require_once(PATH . '/controllers/autenticacao/autentica.inc.php');

	$id_info_req = $_POST['id_info_req'];

	$busca_fonte_info = $mysqli->query("SELECT id_fonte_info FROM adm_fontes_informacao");
	$qtde = $busca_fonte_info->num_rows;//apenas para calcular a quantidade de fonte_infos

	$id_fonte_info = "";

	for($i = 1; $i <= $qtde; $i++){
		if($_POST[$i] <> ""){
			$id_fonte_info = $id_fonte_info.$_POST[$i].",";//concatena os id_fonte_info com ",".
		}
	}

	if($id_fonte_info <> ""){
		$id_fonte_info = substr($id_fonte_info, 0, -1);//elimina a ultima ",".
		$id_fonte_info = explode(",",$id_fonte_info);//cria um array separando pelas ",".
		$id_fonte_info_vinc = serialize($id_fonte_info);//cria uma string com o array serializado
	}
	else{
		$id_fonte_info_vinc = "";
	}

	$con_vinc = $mysqli->query("UPDATE adm_info_requeridas SET id_fonte_info_vinc = '$id_fonte_info_vinc' where id_info_req = '$id_info_req'");//atualiza a lista de info_reqfonte_infos vinculadas

	if ($mysqli->affected_rows <> 0 ){
		$_SESSION['info_req_vincular'] = "Alteração de vinculação realizada com sucesso!";
		$_SESSION['botao'] = "success";
	}
	else{
		$_SESSION['area_vincular'] = "Nenhuma alteração foi realizada!";
		$_SESSION['botao'] = "warning";

	}
	$flag = md5("info_req_vincular");
	header(sprintf("Location:../../../admin.php?flag=$flag"));
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>
