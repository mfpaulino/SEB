<?php
/**************************************************************
* Local/nome do script: correio/correio_mover.php
* Só executa se for chamado pelo formulario, senão chama o script de "acesso negado"
* Recebe o comando de mover do script mailbox_input.php
* Em caso de erros, cria variaveis de sessão com mensagens de alertas que serão utilizadas
* pelo script usuario/alertas.inc.php(incluido pelo index.php)
* Em caso de tudo certo, grava no BD
* Ao final de tudo, redireciona para o mailbox_input.php
* *************************************************************/
session_start();

$inc = "sim";

include_once('../../config.inc.php');

if (isset($_GET['flag'])and isset($_SESSION['cpf'])){

	require_once(PATH . '/controllers/autenticacao/autentica.inc.php');

	$id_correio = $_GET['flag'];
	$pasta = 'ja_lidos';

	$con_update = $mysqli->prepare("UPDATE correio_recebidos SET pasta = ? WHERE id_correio = ? AND destinatario = ?");
	$con_update->bind_param('sii', $pasta,$id_correio,$id_usuario);
	$con_update->execute();

	if($con_update->affected_rows <> 0){

		$_SESSION['correio_mover_sucesso'] = "Mensagem movida com sucesso!";
		$_SESSION['botao'] = "success";
	}
	else{

		$_SESSION['correio_mover_erro'] = "ERRO C-03: msg não movida, tente novamente!<br />Em caso de persistir o erro, entrar em contato com o suporte técnico.";
		$_SESSION['botao'] = "danger";
	}

	$flag = md5("correio_mover");
	header(sprintf("Location:../../mailbox_input.php?flag=$flag"));
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>
