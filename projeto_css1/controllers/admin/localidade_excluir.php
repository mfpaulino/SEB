<?php
//altera_usuario.php
$inc = "sim";
require_once('../../config.inc.php');

if(isset($_POST['flag']) and $_POST['flag'] == md5("localidade_excluir")){

	$id_localidade = $_POST['localidade'];

	require_once(PATH . '/controllers/autenticacao/autentica.inc.php');

	$con_del   = $mysqli->query("DELETE FROM adm_localidades WHERE id_localidade = '$id_localidade'");
	$con_teste = $mysqli->query("SELECT id_localidade FROM adm_localidades WHERE id_localidade = '$id_localidade'");

	if($con_teste->num_rows == 0){

		$_SESSION['localidade_excluir_sucesso'] = "Localidade excluída com sucesso!";
	}
	else{
		$_SESSION['localidade_excluir_erro'] = "ERRO A-005: localidade não excluída. Por favor, tente novamente!";
		$_SESSION['botao'] = "danger";
	}
	$flag = md5("localidade_excluir");
	header(sprintf("Location:../../admin.php?flag=".$flag));
}
else {
	include_once(PATH .'/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>
