<?php
//usuario/alertas.inc.php
//envia msg de erro para o script index.php

if ($inc == "sim"){

	session_start();

	if (isset($_GET['flag'])){

		$flag = $_GET['flag'];
		$botao = $_SESSION['botao'];

		if($flag == md5("usuario_cadastrar")){

			$msg0 = $_SESSION['erro_validacao_cadastrar'];
			$msg1 = $_SESSION['sucesso_cadastro'];
			$msg2 = $_SESSION['duplo_cpf'];
			$msg3 = $_SESSION['duplo_email'];
			$msg4 = $_SESSION['erro_cadastro'];
			$lista_erro_validacao = $_SESSION['lista_erro_validacao_cadastrar'];
		}
		else {
			unset($_SESSION['erro_validacao_cadastrar']);
			unset($_SESSION['sucesso_cadastro']);
			unset($_SESSION['duplo_cpf']);
			unset($_SESSION['duplo_email']);
			unset($_SESSION['erro_cadastro']);
			unset($_SESSION['lista_erro_validacao_cadastrar']);
		}
		if($flag == md5("usuario_alterar")){
			$msg0 = $_SESSION['alterar_erro_validacao'];
			$msg1 = $_SESSION['alterar_rg'];
			$msg2 = $_SESSION['alterar_posto'];
			$msg3 = $_SESSION['alterar_nome_guerra'];
			$msg4 = $_SESSION['alterar_nome'];
			$msg5 = $_SESSION['alterar_email_erro'];
			$msg6 = $_SESSION['alterar_email'];
			$msg7 = $_SESSION['alterar_ritex'];
			$msg8 = $_SESSION['alterar_celular'];
			$msg9 = $_SESSION['alterar_codom'];
			$msg10 = $_SESSION['alterar_perfil'];
			$msg11 = $_SESSION['alterar_avatar'];
			$msg12 = $_SESSION['excluir_avatar'];
			$msg13 = $_SESSION['alterar_nada'];
			$lista_erro_validacao = $_SESSION['alterar_lista_erro_validacao'];
		}
		else {
			unset($_SESSION['alterar_erro_validacao']);
			unset($_SESSION['alterar_rg']);
			unset($_SESSION['alterar_posto']);
			unset($_SESSION['alterar_nome_guerra']);
			unset($_SESSION['alterar_nome']);
			unset($_SESSION['alterar_email_erro']);
			unset($_SESSION['alterar_email']);
			unset($_SESSION['alterar_ritex']);
			unset($_SESSION['alterar_celular']);
			unset($_SESSION['alterar_codom']);
			unset($_SESSION['alterar_perfil']);
			unset($_SESSION['alterar_avatar']);
			unset($_SESSION['excluir_avatar']);
			unset($_SESSION['alterar_nada']);
			unset($_SESSION['alterar_lista_erro_validacao']);
		}
		if($flag == md5("senha_alterar")){

			$msg0 = $_SESSION['alterar_senha_erro_validacao'];
			$msg1 = $_SESSION['alterar_senha_sucesso'];
			$msg2 = $_SESSION['alterar_senha_erro_bd'];
			$lista_erro_validacao = $_SESSION['alterar_senha_erro_validacao_lista'];
		}
		else {
			unset($_SESSION['alterar_senha_erro_validacao']);
			unset($_SESSION['alterar_senha_sucesso']);
			unset($_SESSION['alterar_senha_erro_bd']);
			unset($_SESSION['alterar_senha_erro_validacao_lista']);
		}

		if($flag == md5("senha_recuperar")){

			$msg1 = $_SESSION['senha_enviada'];
			$msg2 = $_SESSION['senha_usuario_inexistente'];
			$msg3 = $_SESSION['senha_nao_enviada'];

		}
		else {
			unset($_SESSION['senha_enviada']);
			unset($_SESSION['senha_usuario_inexistente']);
			unset($_SESSION['senha_nao_enviada']);
		}

		if($flag == md5("usuario_acessar")){

			$msg1 = $_SESSION['acesso_usuario_inexistente'];
			$msg2 = $_SESSION['senha_errada'];
			$msg3 = $_SESSION['erro_captcha'];

		}
		else{
			unset($_SESSION['acesso_usuario_inexistente']);
			unset($_SESSION['senha_errada']);
			unset($_SESSION['erro_captcha']);
		}

		if($flag == md5("logout") or $flag == md5("acesso_indevido")){

			$msg1 = $_SESSION['logout'];
		}
		else{
			unset($_SESSION['logout']);
		}
		/*
		if($flag == md5("usuario_excluir")){

			$msg0 = $_SESSION['usuario_excluir_sucesso'];
			$msg1 = $_SESSION['usuario_excluir_erro'];

			if($msg0 <> ""){
				$pagina = "controllers/autenticacao/logout.php?flag=$flag";
			}
		}
		else{
			unset($_SESSION['usuario_excluir_sucesso']);
			unset($_SESSION['usuario_excluir_erro']);
		}
		*/
		$msg="x";
	}
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>