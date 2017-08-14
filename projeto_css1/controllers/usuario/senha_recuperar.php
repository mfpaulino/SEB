<?php
/**************************************************************
* Local/nome do script: controllers/usuario/senha_recuperar.php
* Só executa se for chamado pelo formulario, senão chama o script de "acesso negado"
* primeiramente destroi as variaveis de sessao de alertas de usuario
* Recebe o CPF do script views/usuarios/form_senha_recuperar.inc.php
* Trata o valor recebido com o método mysqli: mysqli_real_escape_string
* Consulta o BD em busca de CPF
* Em caso de tudo certo, altera a senha no BD e envia para o email cadastrado
* Em caso de erros, cria variaveis de sessão com mensagens de alertas que serão utilizadas
* pelo script usuario/alertas.inc.php(incluido pelo index.php)
* Ao final de tudo, redireciona para o index.php
* *************************************************************/
session_start();

$inc = "sim";
include_once('../../config.inc.php');

include_once(PATH .'/controllers/usuario/usuario_alertas_destruir.inc.php');

require_once(PATH .'/componentes/internos/php/constantes.inc.php');
require_once(PATH .'/componentes/internos/php/bcript.inc.php');
require_once(PATH .'/componentes/internos/php/conexao.inc.php');
require_once(PATH .'/componentes/externos/PHPMailer/class.phpmailer.php');
require_once(PATH .'/componentes/internos/php/email.inc.php');
require_once(PATH .'/componentes/internos/php/senha.inc.php');

if(isset($_POST['flag'])){

	$cpf = isset($_POST['cpf']) ? mysqli_real_escape_string($mysqli, $_POST['cpf']) : "";

	$sql = "select cpf, postos.posto, nome_guerra, email from usuarios, postos where cpf = '$cpf' and usuarios.id_posto = postos.id_posto";
	$con_usuario = $mysqli->query($sql);

	$row_usuario = $con_usuario->fetch_assoc();

	if($con_usuario->num_rows == 0 ){
		$_SESSION['usuario_inexistente'] = "ERRO: usuário não cadastrado!";
		$_SESSION['botao'] = "danger";
	}
	else {
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
		$msg .= "<br />";
		$msg .= "Suporte t&eacute;cnico: 860-3572 (RITEx)";

		smtpmailer($row_usuario['email'], "siaudi@cciex.eb.mil.br", "SIAUDI",  "SIAUDI - ENVIO DE NOVA SENHA", $msg);

		if (!empty($error)) {

			$_SESSION['senha_nao_enviada'] = "ERRO SE-01: a nova senha não pode ser enviada para o e-mail cadastrado!<br />Peça ao responsável pelo SIAUDI em sua Unidade para redefinir a senha manualmente.";
			$_SESSION['botao'] = "danger";
		}
		else {
			$cpf = $row_usuario['cpf'];

			$con_update = $mysqli->prepare("UPDATE usuarios SET senha = ? WHERE cpf ='$cpf'");
			$con_update->bind_param('s', $nova_senha);
			$con_update->execute();
			$mysqli->close();

			$_SESSION['senha_enviada'] = 'A nova senha foi enviada para o e-mail  <span style="background-color:#000000;">&nbsp;'.strtoupper($row_usuario['email']).  '&nbsp;</span> .<br />Em caso de não recebimento, peça ao responsável pelo SIAUDI em sua Unidade para redefinir a senha manualmente.';
			$_SESSION['botao'] = "success";
		}
	}
	$flag = md5("senha_recuperar");
	header(sprintf("Location:../../index.php?flag=$flag"));
}
else {
	include_once(PATH .'/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>