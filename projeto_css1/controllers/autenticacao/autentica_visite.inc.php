<?php
//autentica_visite.php
session_start();
if (!isset($_SESSION['cpf'])){
	header(sprintf("Location: index.php"));
}
else {
	$cpf = $_SESSION['cpf'];
	$ultimoAcesso = $_SESSION['ultimoAcesso'];

	$agora = date("Y-m-d H:i:s");
	$tempo_inatividade = (strtotime($agora)-strtotime($ultimoAcesso));

	if($tempo_inatividade >= TEMPO_MAX_INATIVIDADE){ // TEMPO_SESSAO vem de constantes.inc.php
		session_destroy();

		$flag = md5("msg_inatividade");

		header(sprintf("Location: index.php?flag=$flag"));
	}
	else {
		$_SESSION["ultimoAcesso"] = $agora; //renovo o ultimo acesso
	}

	if($_SESSION['acesso'] == 'liberado'){
		header(sprintf("Location: index.php" ));
	}
	include_once(PATH . '/controllers/autenticacao/perfil.inc.php');
}
?>