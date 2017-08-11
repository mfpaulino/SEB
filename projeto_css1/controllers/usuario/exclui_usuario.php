<?php
//altera_usuario.php
$inc = "sim";
include_once('../../path.inc.php');

if(isset($_GET['flag']) and $_GET['flag'] == md5("excluir_usuario")){

	session_start();

	require_once(PATH .'/componentes/internos/php/conexao.inc.php');

	$cpf = $_SESSION['cpf'];

	$mysqli->query("DELETE FROM usuarios WHERE cpf ='$cpf'");

	if($mysqli->affected_rows == 1 ){

		session_destroy();

		$flag = md5("exclusao_usuario_sucesso");
		header(sprintf("Location:../../index.php?flag=$flag"));
	}
	else {

		$flag = md5("exclusao_usuario_erro");
		header(sprintf("Location:../../index_visite.php?flag=$flag"));
	}
}
else {
	include_once('../autenticacao/'.ACESSO_NEGADO);
}
?>
