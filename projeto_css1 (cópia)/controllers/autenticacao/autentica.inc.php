<?php
/********************************************************************************************
 * local/nome: ./controllers/autenticacao/autentica.inc.php                                 *
 * se nao estiver logado ou (se logado e nao liberado) redireciona para o index.php         *
 * se estiver liberado inclui o arquivo que gera todos os dados do usuario(perfil.inc.php)  *
 * ******************************************************************************************/
session_start();

if (!isset($_SESSION['cpf']) or $_SESSION['acesso'] == "nao_liberado"){
	header("Location: index.php");
}
elseif(isset($_SESSION['obriga_troca_senha'])){
	header("Location: index.php");
}
else {
	$cpf = $_SESSION['cpf'];
	$ultimoAcesso = $_SESSION['ultimoAcesso'];

	$agora = date("Y-m-d H:i:s");
	$tempo_inatividade = (strtotime($agora)-strtotime($ultimoAcesso));

	if($tempo_inatividade >= TEMPO_MAX_INATIVIDADE){ // TEMPO_SESSAO vem de constantes.inc.php
		session_destroy();

		$flag = md5("msg_inatividade");

		header("Location: index.php?flag=$flag");
	}
	else {
		$_SESSION["ultimoAcesso"] = $agora; //renovo o ultimo acesso
	}

	include_once(PATH . '/controllers/autenticacao/perfil.inc.php');
}
?>