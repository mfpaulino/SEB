<?php
//admin/alertas.inc.php
//envia msg de erro para o script admin.php

if ($inc == "sim"){

	session_start();

	if (isset($_GET['flag'])){

		$flag = $_GET['flag'];
		$botao = $_SESSION['botao'];

		if($flag == md5("localidade_cadastrar")){

			$msg0 = $_SESSION['erro_validacao_cadastrar'];
			$msg1 = $_SESSION['sucesso_cadastro'];
			$msg2 = $_SESSION['localidade_duplicada'];
			$msg3 = $_SESSION['erro_cadastro'];
			$lista_erro_validacao = $_SESSION['lista_erro_validacao_cadastrar'];
		}
		else {
			unset($_SESSION['erro_validacao_cadastrar']);
			unset($_SESSION['sucesso_cadastro']);
			unset($_SESSION['localidade_duplicada']);
			unset($_SESSION['erro_cadastro']);
			unset($_SESSION['lista_erro_validacao_cadastrar']);
		}

		if($flag == md5("localidade_alterar")){
			$msg0 = $_SESSION['alterar_erro_validacao'];
			$msg1 = $_SESSION['alterar_localidade'];
			$msg2 = $_SESSION['alterar_nada'];
			$lista_erro_validacao = $_SESSION['alterar_lista_erro_validacao'];
		}
		else {
			unset($_SESSION['alterar_erro_validacao']);
			unset($_SESSION['alterar_localidade']);
			unset($_SESSION['alterar_nada']);
			unset($_SESSION['alterar_lista_erro_validacao']);
		}
		if($flag == md5("localidade_excluir")){

			$msg0 = $_SESSION['localidade_excluir_sucesso'];
			$msg1 = $_SESSION['localidade_excluir_erro'];
		}
		else{
			unset($_SESSION['localidade_excluir_sucesso']);
			unset($_SESSION['localidade_excluir_erro']);
		}

		$msg="sim";
	}
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>