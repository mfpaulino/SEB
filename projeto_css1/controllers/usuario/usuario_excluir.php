<?php
//altera_usuario.php
$inc = "sim";
require_once('../../config.inc.php');

if(isset($_GET['flag']) and $_GET['flag'] == md5("usuario_excluir")){

	session_start();

	require_once(PATH . '/componentes/internos/php/conexao.inc.php');

	$cpf = $_SESSION['cpf'];

	$con_del   = $mysqli->query("DELETE FROM usuarios WHERE cpf = '$cpf'");
	$con_teste = $mysqli->query("SELECT cpf FROM usuarios WHERE cpf = '$cpf'");

	if($con_teste->num_rows == 0){
		session_destroy();
	}
	header(sprintf("Location:../../index.php"));
}
else {
	include_once(PATH .'/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>
