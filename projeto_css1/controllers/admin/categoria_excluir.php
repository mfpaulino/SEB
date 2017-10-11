<?php
//altera_usuario.php
session_start();

$inc = "sim";
require_once('../../config.inc.php');

if(isset($_POST['flag']) and $_POST['flag'] == md5("categoria_excluir") and isset($_SESSION['cpf'])){

	$id_categoria = $_POST['categoria'];

	require_once(PATH . '/controllers/autenticacao/autentica.inc.php');

	$con_del   = $mysqli->query("DELETE FROM adm_categorias WHERE id_categoria = '$id_categoria'");
	$con_teste = $mysqli->query("SELECT id_categoria FROM adm_categorias WHERE id_categoria = '$id_categoria'");

	if($con_teste->num_rows == 0){

		$_SESSION['categoria_excluir_sucesso'] = "Categoria excluída com sucesso!";
		$_SESSION['botao'] = "success";
	}
	else{
		$_SESSION['categoria_excluir_erro'] = "ERRO A-005: categoria não excluída. Por favor, tente novamente!";
		$_SESSION['botao'] = "danger";
	}
	$flag = md5("categoria_excluir");
	header(sprintf("Location:../../admin.php?flag=".$flag));
}
else {
	include_once(PATH .'/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>
