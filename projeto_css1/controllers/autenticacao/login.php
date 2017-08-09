<?php
session_start();

$inc = "sim";
include_once(__DIR__ .'/../../path.inc.php');

include_once(PATH .'/controllers/usuario/usuario_alertas_destruir.inc.php');

require_once(PATH .'/componentes/internos/php/constantes.inc.php');
require_once(PATH .'/componentes/internos/php/cript.inc.php');
require_once(PATH .'/componentes/internos/php/conexao.inc.php');



//login.php
//recebe os dados do script: pages/index.php

if(isset($_POST['flag'])){

	$cpf = isset($_POST['cpf']) ? $_POST['cpf']: "";
	$senha = isset($_POST['senha']) ? $_POST['senha']: "";

	$senha_criptografada = encripta($cpf,$senha);

	$sql = "select * from usuarios where cpf = '$cpf'";
	$con_login = $mysqli->query($sql);
	$mysqli->close();

	$row_login = $con_login->fetch_assoc();

	if($con_login->num_rows == 0){
		$_SESSION['acesso_usuario_inexistente'] = "ERRO: usuário não cadastrado!";
	}
	else if($row_login['senha'] <> $senha_criptografada){
		$_SESSION['senha_errada'] = "ERRO: senha incorreta!";
	}
	else{
		$_SESSION['cpf'] = $cpf;
		$_SESSION['ultimoAcesso']= date("d-m-Y H:i:s");

		if($row_login['status'] == "habilitado"){
			$_SESSION['acesso'] = "liberado";
		}
		else {
			$_SESSION['acesso'] = "nao_liberado";
		}
	}
	if ($_SESSION['acesso'] == "nao_liberado"){

		header(sprintf("Location:../../". PAGINA_VISITANTE));
	}
	else if ($_SESSION['acesso'] == "liberado"){
		header(sprintf("Location:../../". PAGINA_INICIAL));
	}
	else {
		$flag = md5("usuario_acessar");
		$_SESSION['botao'] = "danger";
		header(sprintf("Location:../../index.php?flag=$flag"));
	}
}
else {
	include_once(PATH .'/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>
