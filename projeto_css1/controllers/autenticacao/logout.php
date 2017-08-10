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

	if(isset($_GET['flag'])){

		$flag = $_GET['flag'];

		switch ($_GET['flag']){

			case md5("logout"):

				$_SESSION['logout'] = "Logout realizado com sucesso!";
				$_SESSION['botao'] = "success";

				break;

			case md5("alterar_senha"):

				$_SESSION['logout'] = "Em caso de login, usar a nova senha!";
				$_SESSION['botao'] = "primary";

				break;
		}
	}
	else {
		$_SESSION['logout'] = "ERRO: usuário desconectado pelo sistema!<br />(Tentativa de acesso indevido!!)";
		$_SESSION['botao'] = "danger";
	}
	header(sprintf("Location:../../index.php?flag=$flag"));
}
else {
	include_once ACESSO_NEGADO;
}
?>