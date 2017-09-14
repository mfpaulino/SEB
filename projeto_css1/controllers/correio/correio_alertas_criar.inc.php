<?php
//correio/alertas.inc.php
//envia msg de erro para o script index.php

if ($inc == "sim"){

	session_start();

	if (isset($_GET['flag'])){

		$flag = $_GET['flag'];
		$botao = $_SESSION['botao'];

		if($flag == md5("correio_cadastrar")){

			$msg0 = $_SESSION['erro_validacao_correio'];
			$msg1 = $_SESSION['correio_envio_sucesso'];
			$msg4 = $_SESSION['correio_envio_erro'];
			$lista_erro_validacao = $_SESSION['lista_erro_validacao_correio'];
		}
		else {
			unset($_SESSION['erro_validacao_correio']);
			unset($_SESSION['correio_envio_sucesso']);
			unset($_SESSION['correio_envio_erro']);
			unset($_SESSION['lista_erro_validacao_correio']);
		}

		$msg_correio="exibir";
	}
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>