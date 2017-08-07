<?php
//altera_usuario.php
require_once('../componentes/internos/php/constantes.inc.php');

if(isset($_POST['flag'])){

	session_start();

	require_once('../componentes/internos/php/cript.inc.php');
	require_once('../componentes/internos/php/conexao.inc.php');

	$cpf 				= $_SESSION['cpf'];

	$rg_atual			= $_POST['rg_atual'];
	$posto_atual 		= $_POST['posto_atual'];
	$nome_guerra_atual  = $_POST['nome_guerra_atual'];
	$nome_atual			= $_POST['nome_atual'];
	$email_atual 		= $_POST['email_atual'];

	$rg 				= $_POST['rg'];
	$posto 				= $_POST['posto'];
	$nome_guerra 		= $_POST['nome_guerra'];
	$nome 				= $_POST['nome'];
	$email 				= $_POST['email'];

	$altera= "nao";

	if ($rg <> "" and $rg <> $rg_atual){

		$con_rg = $mysqli->prepare("UPDATE usuarios SET rg = ? WHERE cpf ='$cpf'");
		$con_rg->bind_param('s', $rg);
		$con_rg->execute();

		if($con_rg->affected_rows <> 0 ){
				$altera = "sim";
				$msg_rg = "O RG foi alterado com sucesso!";
		}
	}
	if ($posto <> "" and $posto <> $posto_atual){
		$con_update = $mysqli->prepare("UPDATE usuarios SET id_posto = ? WHERE cpf ='$cpf'");
		$con_update->bind_param('s', $posto);
		$con_update->execute();

		if($con_update->affected_rows <> 0 ){
			$altera = "sim";
			$msg_posto = "O Posto/Grad foi alterado com sucesso!";
		}
	}
	if ($nome_guerra <> "" and $nome_guerra <> $nome_guerra_atual){
		$con_update = $mysqli->prepare("UPDATE usuarios SET nome_guerra = ? WHERE cpf ='$cpf'");
		$con_update->bind_param('s', $nome_guerra);
		$con_update->execute();

		if($con_update->affected_rows <> 0 ){
			$altera = "sim";
			$msg_nome_guerra = "O nome de guerra foi alterado com sucesso!";
		}
	}
	if ($nome <> "" and $nome <> $nome_atual){
		$con_update = $mysqli->prepare("UPDATE usuarios SET nome = ? WHERE cpf ='$cpf'");
		$con_update->bind_param('s', $nome);
		$con_update->execute();

		if($con_update->affected_rows <> 0 ){
			$altera = "sim";
			$msg_nome = "O nome foi alterado com sucesso!";
		}
	}
	if ($email <> "" and $email <> $email_atual){

		$sql = "SELECT email FROM usuarios WHERE email = '$email'";
		$con = $mysqli->query($sql);

		if ($con->affected_rows <> 0){
			$erro_email = "O e-mail digitado pertence a outro usuário!";
		}
		else {
			$con_update = $mysqli->prepare("UPDATE usuarios SET email = ? WHERE cpf ='$cpf'");
			$con_update->bind_param('s', $email);
			$con_update->execute();

			if($con_update->affected_rows <> 0 ){
				$altera = "sim";
				$msg_email = "O e-mail foi alterado com sucesso!";
			}
		}
	}
	if ($altera == "nao"){
		$flag = md5("alteracao_usuario_erro");
		header(sprintf("Location:../index_visite.php?flag=$flag"));
	}
	else {
		$flag = md5("alteracao_usuario_sucesso");
		header(sprintf("Location:../index_visite.php?flag=$flag"));
	}
}
else {

	include_once('../autenticacao/'.ACESSO_NEGADO);
}
?>
