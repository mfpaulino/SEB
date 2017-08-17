<?php
$inc = "sim";
include_once('../../config.inc.php');

if(isset($_POST['flag'])){

	session_start();

	require_once(PATH .'/componentes/internos/php/bcript.inc.php');

	$cpf 	 = isset($_POST['cpf']) ? $_POST['cpf']: "";
	$senha 	 = isset($_POST['senha']) ? $_POST['senha']: "";
	$captcha = isset($_POST['captcha']) ? $_POST['captcha']: "";


	$sql = "select * from usuarios where cpf = '$cpf'";
	$con_login = $mysqli->query($sql);

	$row_login = $con_login->fetch_assoc();

	if($con_login->num_rows == 0){
		$_SESSION['acesso_usuario_inexistente'] = "ERRO A-01: usuário não cadastrado!";
	}
	else if(!Bcrypt::check($senha, $row_login['senha'])){
		$_SESSION['senha_errada'] = "ERRO A-02: senha incorreta!";
	}
	else if(strtolower($_SESSION['captcha']) <> strtolower($captcha)){
		$_SESSION['erro_captcha'] = "ERRO A-003: código captcha incorreto!";
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

		header("Location:../../". PAGINA_VISITANTE);
	}
	else if ($_SESSION['acesso'] == "liberado"){
		header("Location:../../". PAGINA_INICIAL);
	}
	else {
		$flag = md5("usuario_acessar");
		$_SESSION['botao'] = "danger";
		header("Location:../../index.php?flag=$flag");
	}
}
else {
	include_once(PATH .'/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>
