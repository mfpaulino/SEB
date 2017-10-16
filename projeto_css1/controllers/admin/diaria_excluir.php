<?php
//altera_usuario.php
session_start();

$inc = "sim";
require_once('../../config.inc.php');

if(isset($_POST['flag']) and $_POST['flag'] == md5("diaria_excluir") and isset($_SESSION['cpf'])){

	$id_diaria = $_POST['diaria'];

	require_once(PATH . '/controllers/autenticacao/autentica.inc.php');

	$con_del   = $mysqli->query("DELETE FROM adm_diarias WHERE id_diaria = '$id_diaria'");

	if($con_teste->num_rows == 0){

		$_SESSION['diaria_excluir_sucesso'] = "Diária excluída com sucesso!";
		$_SESSION['botao'] = "success";
	}
	else{
		$_SESSION['diaria_excluir_erro'] = "ERRO A-011: diária não excluída. Por favor, tente novamente!";
		$_SESSION['botao'] = "danger";
	}
	$flag = md5("diaria_excluir");
	header(sprintf("Location:../../admin.php?flag=".$flag));
}
else {
	include_once(PATH .'/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>
