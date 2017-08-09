<?php
//solicita_nova_senha.php

require_once('../componentes/internos/php/constantes.inc.php');
require_once('../componentes/internos/php/cript.inc.php');
require_once('../componentes/internos/php/conexao.inc.php');

if(isset($_POST['flag'])){

	$cpf = $_POST['flag'];

	if($_POST['senha_nova'] <> "" and $_POST['senha_nova1'] <> "" and $_POST['senha_nova'] == $_POST['senha_nova1'] and strlen($_POST['senha_nova1']) >= 8 and $_POST['senha_nova'] <> $cpf){
		$senha_nova  = $_POST['senha_nova'];
		$senha_nova1 = $_POST['senha_nova1'];

		$senha_cript = encripta($cpf,$senha_nova1);

		$con_update = $mysqli->prepare("UPDATE usuarios SET senha = ? WHERE cpf ='$cpf'");
		$con_update->bind_param('s', $senha_cript);
		$con_update->execute();
		$mysqli->close();

		if($con_update->affected_rows == 1 ){

			$flag = md5("troca_senha");
			header(sprintf("Location:../autenticacao/logout.php?flag=$flag"));
		}
		else{

			$flag = md5("alteracao_senha_erro");
			header(sprintf("Location:../index_visite.php?flag=$flag"));
		}
	}
	else{
		$flag = md5("alteracao_senha_erro");
		header(sprintf("Location:../index_visite.php?flag=$flag"));
	}
}
else {

	include_once('../autenticacao/'.ACESSO_NEGADO);
}
?>
