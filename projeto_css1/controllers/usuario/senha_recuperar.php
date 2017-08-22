<?php
/**************************************************************
* Local/nome do script: ./controllers/usuario/senha_recuperar.php
* Recebe o CPF do usuario
* Se o pedido foi feito pela tela de recupera senha:
* - Cria uma senha aleatória
* - Envia para o email cadastrado
* - Salva nova senha no BD
* Se a redefinição de senha for feito pelo admim:
* - a senha será igual ao CPF do usuario cuja senha está sendo redefinida
* - nao envia para o email
* *************************************************************/
session_start();

$inc = "sim";
include_once('../../config.inc.php');
include_once(PATH .'/componentes/internos/php/senha.inc.php');
include_once(PATH .'/componentes/internos/php/bcript.inc.php');
include_once(PATH .'/componentes/externos/PHPMailer/class.phpmailer.php');
include_once(PATH .'/componentes/internos/php/email.inc.php');

if(isset($_POST['flag'])){

	$pagina = $_POST['flag1'];

	$cpf = isset($_POST['cpf']) ? mysqli_real_escape_string($mysqli, $_POST['cpf']) : "";

	$sql = "select cpf, postos.posto, nome_guerra, email from usuarios, postos where cpf = '$cpf' and usuarios.id_posto = postos.id_posto";
	$con_usuario = $mysqli->query($sql);

	$row_usuario = $con_usuario->fetch_assoc();

	if($con_usuario->num_rows == 0 ){
		$_SESSION['usuario_inexistente'] = "ERRO: usuário não cadastrado!";
		$_SESSION['botao'] = "danger";
	}
	else if(!isset($_SESSION['cpf'])){//siginifica que o pedido veio do form_recuperar_senha
		$senha = geraSenha("L N L L S L N N");
		$nova_senha = Bcrypt::hash($senha);

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

			$_SESSION['senha_nao_enviada'] = "ERRO SE-01: a nova senha não pode ser enviada para o e-mail cadastrado!<br />Peça ao responsável pelo SIAUDI em sua Unidade para redefinir a senha manualmente.";
			$_SESSION['botao'] = "danger";
		}
		else {
			$_SESSION['senha_enviada'] = 'A nova senha foi enviada para o e-mail <kbd>'.strtoupper($row_usuario['email']).  '</kbd>.<br />Em caso de não recebimento, peça ao responsável pelo SIAUDI em sua Unidade para redefinir a senha manualmente.';
			$_SESSION['botao'] = "success";
		}
	}
	else {
		$nova_senha = Bcrypt::hash($cpf);//o cpf veio da tela do admin

		$_SESSION['senha_enviada'] = 'A senha foi redefinida com sucesso!<br /><br />Avise a(o) <kbd>&nbsp;'.strtoupper($row_usuario['posto'] . " " . $row_usuario['nome_guerra'] ).  '&nbsp;</kbd> que a nova senha é igual ao CPF.';
		$_SESSION['botao'] = "success";
	}

	$con_update = $mysqli->prepare("UPDATE usuarios SET senha = ? WHERE cpf ='$cpf'");
	$con_update->bind_param('s', $nova_senha);
	$con_update->execute();
	$mysqli->close();

	$flag = md5("senha_recuperar");
	header(sprintf("Location:../../".$pagina."?flag=$flag"));
}
else {
	include_once(PATH .'/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>