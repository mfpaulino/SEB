<?php
//logout.php
//$inc = "sim";
require_once '../componentes/internos/php/constantes.inc.php';
include_once '../componentes/internos/php/conexao.inc.php';

session_start();

if (isset($_SESSION['cpf'])){

	$ultimo_acesso = date('Y-m-d H:i:s');

	$sql = "UPDATE usuarios SET ultimo_acesso = '$ultimo_acesso'";
	$mysqli->query($sql);
	$mysqli->close();

	session_destroy();

	if(isset($_GET['flag'])){

		switch ($_GET['flag']){

			case md5("logout"):
				$flag= md5("msg_logout");
				break;

			case md5("troca_senha"):
				$flag= md5("msg_logout_troca_senha");
				break;

			case md5("acesso_indevido"):
				$indevido =  md5("msg_acesso_indevido");
				$flag= $indevido;
				break;
		}
		header(sprintf("Location:../index.php?flag=$flag"));
	}
	else {
		header(sprintf("Location:../index.php?flag=$indevido"));
	}
}
else {
	include_once ACESSO_NEGADO;
}
?>