<?php
/**************************************************************
* Local/nome do script: admin/area/area_vincular_subarea.php
* Só executa se for chamado pelo formulario, senão chama o script de "acesso negado"
* Ao final de tudo, redireciona para o admin.php
* *************************************************************/

session_start();

$inc = "sim";
include_once('../../../config.inc.php');

if (isset($_POST['flag']) and isset($_SESSION['cpf'])){

	require_once(PATH . '/controllers/autenticacao/autentica.inc.php');

	$id_area = $_POST['id_area'];

	$busca_subarea = $mysqli->query("SELECT id_subarea FROM adm_subareas");
	$qtde = $busca_subarea->num_rows;//apenas para calcular a quantidade de subareas

	$id_subarea = "";

	for($i = 1; $i <= $qtde; $i++){
		if($_POST[$i] <> ""){
			$id_subarea = $id_subarea.$_POST[$i].",";//concatena os id_subarea com ",".
		}
	}

	if($id_subarea <> ""){
		$id_subarea = substr($id_subarea, 0, -1);//elimina a ultima ",".
		$id_subarea = explode(",",$id_subarea);//cria um array separando pelas ",".
		$id_subarea_vinc = serialize($id_subarea);//cria uma string com o array serializado
	}
	else{
		$id_subarea_vinc = "";
	}

	$con_vinc = $mysqli->query("UPDATE adm_areas SET id_subarea_vinc = '$id_subarea_vinc' where id_area = '$id_area'");//atualiza a lista de subareas vinculadas

	if ($mysqli->affected_rows <> 0 ){
		$_SESSION['area_vincular'] = "Alteração de vinculação realizada com sucesso!";
		$_SESSION['botao'] = "success";
	}
	else{
		$_SESSION['area_vincular'] = "Nenhuma alteração foi realizada!";
		$_SESSION['botao'] = "warning";

	}
	$flag = md5("area_vincular");
	header(sprintf("Location:../../../admin.php?flag=$flag"));
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>
