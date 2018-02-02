<?php
$inc = "sim";
include_once('../../config.inc.php');

if(isset($_POST['flag'])){

	session_start();

	if(isset($_SESSION['obriga_troca_senha'])){
		unset($_SESSION['obriga_troca_senha']);
	}

	require_once(PATH .'/componentes/internos/php/bcript.inc.php');

	$pagina_lock  = isset($_POST['flag']) ? $_POST['flag']: "";
	$cpf 	 = isset($_POST['cpf']) ? mysqli_real_escape_string($mysqli, $_POST['cpf']): "";
	$senha 	 = isset($_POST['senha']) ? mysqli_real_escape_string($mysqli, $_POST['senha']): "";
	$captcha = isset($_POST['captcha']) ? mysqli_real_escape_string($mysqli, $_POST['captcha']): "";

	$sql = "select * from usuarios where cpf = '$cpf'";
	$con_login = $mysqli->query($sql);

	$row_login = $con_login->fetch_assoc();

	if($con_login->num_rows == 0){
		$_SESSION['acesso_usuario_inexistente'] = "ERRO 001: usuário não cadastrado!";
	}
	else if(!Bcrypt::check($senha, $row_login['senha'])){
		$_SESSION['senha_errada'] = "ERRO 002: senha incorreta!";
	}
	else if($_SESSION['captcha'] <> $captcha and $_POST['flag1'] <> 'lock'){//se for chamado pela tela de lockscreen nao precisa do captcha
		$_SESSION['erro_captcha'] = "ERRO 003: código captcha incorreto!";
	}
	else{
		$_SESSION['cpf'] = $cpf;
		$_SESSION['ultimoAcesso'] = date("d-m-Y H:i:s");

		$sql_contador = "UPDATE usuarios SET qtde_acessos = (qtde_acessos + 1), acesso_anterior = ultimo_acesso, ultimo_acesso = NOW() WHERE cpf = '$cpf'";
		$con_contador = $mysqli->query($sql_contador); //contador de acessos por usuario

		if($row_login['status'] == "Habilitado"){
			$_SESSION['acesso'] = "liberado";
		}
		else {
			$_SESSION['acesso'] = "nao_liberado";
		}
	}
	if($_SESSION['cpf'] == $senha){
		$_SESSION['obriga_troca_senha'] = "sim";
		header("Location:../../index.php");
	}
	else if ($_SESSION['acesso'] == "nao_liberado"){

		header("Location:../../". PAGINA_VISITANTE);
	}
	else if ($_SESSION['acesso'] == "liberado"){
		header("Location:../../". PAGINA_INICIAL.'?flag='.$pagina_lock);
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
