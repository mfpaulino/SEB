<?php
//usuario_excluir.php

session_start();

$inc = "sim";
require_once('../../config.inc.php');

if(isset($_POST['flag']) and isset($_SESSION['cpf'])){

	require_once(PATH . '/controllers/autenticacao/autentica_visite.inc.php');

	$con_del   = $mysqli->query("DELETE FROM usuarios WHERE cpf = '$cpf'");
	$con_teste = $mysqli->query("SELECT cpf FROM usuarios WHERE cpf = '$cpf'");

	if($con_teste->num_rows == 0){

		$dir = PATH . '/views/avatar/'; //Diretório para uploads
		unlink($dir.$cpf.'.jpg');//apaga os arquivos de imagem do usuario
		unlink($dir.$cpf.'.gif');
		unlink($dir.$cpf.'.png');

		if($_SESSION['acesso'] == "nao_liberado"){
			session_destroy();
		}
	}
	else{
		$_SESSION['usuario_excluir_erro'] = "ERRO U05: usuário não excluído. Por favor, tente novamente!";
		$_SESSION['botao'] = "danger";
	}
	header(sprintf("Location:../../guess.php"));
}
else {
	include_once(PATH .'/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>
