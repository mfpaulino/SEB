<?php
$inc = "sim";
include_once('../../path.inc.php');
include_once(PATH. '/componentes/internos/php/conexao.inc.php');

session_start();

if (isset($_SESSION['cpf'])){

	$ultimo_acesso = date('Y-m-d H:i:s');

	$sql = "UPDATE usuarios SET ultimo_acesso = '$ultimo_acesso'";
	$mysqli->query($sql);
	$mysqli->close();

	session_destroy();
	session_start();

	$flag = isset($_GET['flag']) ? $_GET['flag'] : "";

	if ($flag == md5("logout")){

		$_SESSION['logout'] = "Logout realizado com sucesso!";
		$_SESSION['botao'] = "success";
	}
	else {
		$flag = md5("acesso_indevido");

		$_SESSION['logout'] = "ERRO L01: usuário desconectado pelo sistema!<br />(Tentativa de acesso indevido!)";
		$_SESSION['botao'] = "danger";
	}
	header(sprintf("Location:../../index.php?flag=$flag"));
}
else {
	include_once ACESSO_NEGADO;
}
?>