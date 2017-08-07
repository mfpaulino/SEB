<?php
//$inc = "sim";
require_once('../componentes/internos/php/constantes.inc.php');
require_once( '../componentes/internos/php/cript.inc.php');
require_once( '../componentes/internos/php/conexao.inc.php');

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
		$flag = md5("erro_usuario");//usuario nao cadastrado
		header(sprintf("Location:../index.php?flag=$flag"));
	}
	elseif($row_login['senha'] <> $senha_criptografada){
		$flag = md5("erro_senha");//senha incorreta
		header(sprintf("Location:../index.php?flag=$flag"));
	}
	else{
		session_start();

		$_SESSION['cpf'] = $cpf;
		$_SESSION['ultimoAcesso']= date("d-m-Y H:i:s");

		if($row_login['status'] == "habilitado"){
			$_SESSION['acesso'] = "liberado";
			header(sprintf("Location:../".PAGINA_INICIAL));
		}
		else {
			$_SESSION['acesso'] = "nao_liberado";
			header(sprintf("Location:../".PAGINA_VISITANTE));
		}
	}
}
else {
	include_once ACESSO_NEGADO;
}
?>
