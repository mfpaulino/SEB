<?php
//solicita_nova_senha.php

require_once('../componentes/internos/php/constantes.inc.php');
require_once('../componentes/internos/php/cript.inc.php');
require_once('../componentes/internos/php/conexao.inc.php');
require_once('../componentes/externos/PHPMailer/class.phpmailer.php');
require_once('../componentes/internos/php/email.inc.php');
require_once('../componentes/internos/php/senha.inc.php');

if(isset($_POST['flag'])){
	if($_POST['cpf'] <> ""){
		$cpf = $_POST['cpf'];

		$sql = "select cpf, id_posto, nome_guerra, email from usuarios where cpf = '$cpf'";
		$con_usuario = $mysqli->query($sql);

		$row_usuario = $con_usuario->fetch_assoc();

		if($con_usuario->num_rows == 0 ){
			$flag = md5("erro_usuario");//usuario nao cadastrado
		}
		else {
			$senha = geraSenha("L N L L S L N N");
			$nova_senha = encripta($row_usuario['cpf'],$senha);

			$msg = "Prezado(a) " . htmlentities($row_usuario['posto']) . " " . $row_usuario['nome_guerra'] . ",";
			$msg .= "<br />";
			$msg .= "sua senha foi redefinida em " . date('d-m-Y') . ".";
			$msg .= "<br />";
			$msg .= "<br />";
			$msg .= "A nova senha &eacute;:  <b>".$senha."</b>";
			$msg .= "<br />";
			$msg .= "<hr>";
			$msg .= "Mensagem enviada automaticamente pelo SIAUDI.";

			smtpmailer($row_usuario['email'], "siaudi@cciex.eb.mil.br", "SIAUDI",  "SIAUDI - ENVIO DE NOVA SENHA", $msg);

			if (!empty($error)) {

				$flag = md5("erro_nova_senha");
				header(sprintf("Location:../index.php?flag=$flag"));
			}
			else {
				$cpf = $row_usuario['cpf'];

				$con_update = $mysqli->prepare("UPDATE usuarios SET senha = ? WHERE cpf ='$cpf'");
				$con_update->bind_param('s', $nova_senha);
				$con_update->execute();
				$mysqli->close();

				$flag = md5("ok_nova_senha");
				header(sprintf("Location:../index.php?flag=$flag&flag1=$cpf"));
			}
		}
	}
}
else {

	include_once('../autenticacao/'.ACESSO_NEGADO);
}
?>