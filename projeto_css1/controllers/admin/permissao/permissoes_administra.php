<?php
/**************************************************************
* Local/nome do script: admin/permissao/permissoes_administra.php
* Só executa se for chamado pelo formulario, senão chama o script de "acesso negado"
* Ao final de tudo, redireciona para o admin.php
* *************************************************************/

session_start();

$inc = "sim";
include_once('../../../config.inc.php');

if (isset($_POST['flag']) and isset($_SESSION['cpf'])){

	require_once(PATH . '/controllers/autenticacao/autentica.inc.php');

	$id_permissao = $_POST['id_permissao'];

	$busca_perfis = $mysqli->query("SELECT id_perfil_admin FROM adm_perfis_administra");
	$qtde = $busca_perfis->num_rows;//apenas para calcular a quantidade de perfis

	$id_perfis = "";

	for($i = 1; $i <= $qtde; $i++){

		if($_POST[$i] <> ""){

			$id_perfis = $id_perfis.$_POST[$i].",";//concatena os id_perfis com ",".
		}
	}

	if($id_perfis <> ""){
		$id_perfis = substr($id_perfis, 0, -1);//elimina a ultima ",".
		$id_perfis = explode(",",$id_perfis);//cria um array separando pelas ",".
		$id_perfis_vinc = serialize($id_perfis);//cria uma string com o array serializado
	}
	else{
		$id_perfis_vinc = "";
	}

	$con_vinc = $mysqli->query("UPDATE adm_permissoes SET lista_perfis = '$id_perfis_vinc' where id_permissao = '$id_permissao'");

	if ($mysqli->affected_rows <> 0 ){
		$_SESSION['permissao_administrar'] = "Alteração realizada com sucesso!";
		$_SESSION['botao'] = "success";
	}
	else{
		$_SESSION['permissao_administrar'] = "Nenhuma alteração foi realizada!";
		$_SESSION['botao'] = "warning";

	}
	$flag = md5("permissao_administrar");
	header(sprintf("Location:../../../admin.php?flag=$flag"));
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>
