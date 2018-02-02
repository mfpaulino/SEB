<?php
/**************************************************************
* Local/nome do script: admin/questao/questao_vincular_poss_achado.php
* Só executa se for chamado pelo formulario, senão chama o script de "acesso negado"
* Ao final de tudo, redireciona para o admin.php
* *************************************************************/

session_start();

$inc = "sim";
include_once('../../../config.inc.php');

if (isset($_POST['flag']) and isset($_SESSION['cpf'])){

	require_once(PATH . '/controllers/autenticacao/autentica.inc.php');

	$id_questao = $_POST['id_questao'];

	$busca_poss_achado = $mysqli->query("SELECT id_poss_achado FROM adm_poss_achados");
	$qtde = $busca_poss_achado->num_rows;//apenas para calcular a quantidade de poss_achados

	$id_poss_achado = "";

	for($i = 1; $i <= $qtde; $i++){
		if($_POST[$i] <> ""){
			$id_poss_achado = $id_poss_achado.$_POST[$i].",";//concatena os id_poss_achado com ",".
		}
	}

	if($id_poss_achado <> ""){
		$id_poss_achado = substr($id_poss_achado, 0, -1);//elimina a ultima ",".
		$id_poss_achado = explode(",",$id_poss_achado);//cria um array separando pelas ",".
		$id_poss_achado_vinc = serialize($id_poss_achado);//cria uma string com o array serializado
	}
	else{
		$id_poss_achado_vinc = "";
	}

	$con_vinc = $mysqli->query("UPDATE adm_questoes SET id_poss_achado_vinc = '$id_poss_achado_vinc' where id_questao = '$id_questao'");//atualiza a lista de poss_achados vinculadas

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
