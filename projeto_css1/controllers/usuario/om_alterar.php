<?php
//altera_usuario.php

if(isset($_POST['flag'])){

	session_start();

	require_once('../componentes/internos/php/constantes.inc.php');
	require_once('../componentes/internos/php/cript.inc.php');
	require_once('../componentes/internos/php/conexao.inc.php');

	$cpf 		 = $_SESSION['cpf'];
	$codom_atual = $_POST['flag'];
	$codom 		 = $_POST['codom'];

	if ($codom <> "" and $codom <> $codom_atual){

		$con_update = $mysqli->prepare("UPDATE usuarios SET codom = ? WHERE cpf ='$cpf'");
		$con_update->bind_param('s', $codom);
		$con_update->execute();

		if($con_update->affected_rows <> 0 ){

			$flag = md5("alteracao_om_sucesso");
			header(sprintf("Location:../index_visite.php?flag=$flag"));
		}
		else{

			$flag = md5("alteracao_om_erro");
			header(sprintf("Location:../index_visite.php?flag=$flag"));
		}
	}
	else{
		$flag = md5("alteracao_om_erro");
		header(sprintf("Location:../index_visite.php?flag=$flag"));
	}

}
else {

	include_once('../autenticacao/'.ACESSO_NEGADO);
}
?>
