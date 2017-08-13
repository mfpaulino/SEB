<?php
//usuario/alertas.inc.php
//envia msg de erro para o script index.php

if ($inc == "sim"){

	session_start();

	if (isset($_GET['flag'])){

		$flag = $_GET['flag'];
		$pagina = $_SESSION['pagina'];
		$botao = $_SESSION['botao'];

		if($flag == md5("usuario_cadastrar")){

			$msg0 = $_SESSION['sucesso_cadastro'];

			$msg1 = $_SESSION['duplo_cpf'];
			$msg2 = $_SESSION['duplo_email'];
			$msg4 = $_SESSION['erro_cadastro'];
			$msg6 = $_SESSION['erro_validacao_cadastrar'];
			$lista_erro_validacao = $_SESSION['lista_erro_validacao_cadastrar'];
		}
		else {
			unset($_SESSION['sucesso_cadastro']);
			unset($_SESSION['duplo_cpf']);
			unset($_SESSION['duplo_email']);
			unset($_SESSION['erro_cadastro']);
			unset($_SESSION['erro_validacao_cadastrar']);
			unset($_SESSION['lista_erro_validacao_cadastrar']);
		}
		if($flag == md5("usuario_alterar")){

			$msg0 = $_SESSION['alterar_rg'];
			$msg1 = $_SESSION['alterar_posto'];
			$msg2 = $_SESSION['alterar_nome_guerra'];
			$msg3 = $_SESSION['alterar_nome'];
			$msg4 = $_SESSION['alterar_email_erro'];
			$msg5 = $_SESSION['alterar_email'];
			$msg7 = $_SESSION['alterar_ritex'];
			$msg8 = $_SESSION['alterar_celular'];
			$msg6 = $_SESSION['alterar_erro_validacao'];
			$lista_erro_validacao = $_SESSION['alterar_lista_erro_validacao'];
		}
		else {
			unset($_SESSION['alterar_rg']);
			unset($_SESSION['alterar_posto']);
			unset($_SESSION['alterar_nome_guerra']);
			unset($_SESSION['alterar_nome']);
			unset($_SESSION['alterar_email']);
			unset($_SESSION['alterar_email_erro']);
			unset($_SESSION['alterar_ritex']);
			unset($_SESSION['alterar_celular']);
			unset($_SESSION['alterar_erro_validacao']);
			unset($_SESSION['alterar_lista_erro_validacao']);
		}

		if($flag == md5("om_alterar")){

			$msg0 = $_SESSION['alterar_om_sucesso'];

			$msg1 = $_SESSION['alterar_om_erro_bd'];
			$msg6 = $_SESSION['alterar_om_erro_validacao'];

			$lista_erro_validacao = $_SESSION['alterar_om_erro_validacao_lista'];
		}
		else {
			unset($_SESSION['alterar_om_sucesso']);
			unset($_SESSION['alterar_om_erro_bd']);
			unset($_SESSION['alterar_om_erro_validacao']);
			unset($_SESSION['alterar_om_erro_validacao_lista']);
		}

		if($flag == md5("senha_alterar")){

			$msg0 = $_SESSION['alterar_senha_sucesso'];

			if($msg0 <> ""){
				$pagina = "controllers/autenticacao/logout.php?flag=$flag";
			}

			$msg1 = $_SESSION['alterar_senha_erro_bd'];
			$msg6 = $_SESSION['alterar_senha_erro_validacao'];

			$lista_erro_validacao = $_SESSION['alterar_senha_erro_validacao_lista'];
		}
		else {
			unset($_SESSION['alterar_senha_sucesso']);
			unset($_SESSION['alterar_senha_erro_bd']);
			unset($_SESSION['alterar_senha_erro_validacao']);
			unset($_SESSION['alterar_senha_erro_validacao_lista']);
		}

		if($flag == md5("senha_recuperar")){

			$msg0 = $_SESSION['senha_enviada'];

			$msg1 = $_SESSION['senha_usuario_inexistente'];
			$msg2 = $_SESSION['senha_nao_enviada'];

		}
		else {
			unset($_SESSION['senha_enviada']);
			unset($_SESSION['senha_usuario_inexistente']);
			unset($_SESSION['senha_nao_enviada']);
		}

		if($flag == md5("usuario_acessar")){

			$msg1 = $_SESSION['acesso_usuario_inexistente'];
			$msg2 = $_SESSION['senha_errada'];

		}
		else{
			unset($_SESSION['acesso_usuario_inexistente']);
			unset($_SESSION['senha_errada']);
		}

		if($flag == md5("logout") or $flag == md5("acesso_indevido")){

			$msg0 = $_SESSION['logout'];
		}
		else{
			unset($_SESSION['logout']);
		}

		$msg="x";

		//$flag = $_GET['flag'];
		/*

		if ($flag == md5("erro_usuario")){
			$msg = "ERRO! Usuário não cadastrado";
			$botao = "danger";
		}
		elseif($flag == md5("erro_senha")){
			$msg= "ERRO! Senha incorreta";
			$botao = "danger";
		}
		elseif($flag == md5("msg_inatividade")){
			$msg = "AVISO! Encerramento por inatividade";
			$botao = "danger";
		}
		elseif($flag == md5("msg_logout")){
			$msg = "Logout realizado com sucesso";
			$botao = "success";
		}
		elseif($flag == md5("cadastro_ok")){
			$msg = "Cadastro com sucesso";
			$botao = "info";
		}
		elseif($flag == md5("cadastro_erro")){
			$msg = "Cadastro não realizado";
			$botao = "danger";
		}
		elseif($flag == md5("erro_nova_senha")){
			$msg = "Erro: senha nao enviada<br />Fale com o administrador!";
			$botao = "danger";
		}
		elseif($flag == md5("ok_nova_senha")){
			$cpf = $_GET['flag1'];
			$con_usuario = $mysqli->query("SELECT email FROM usuarios WHERE cpf = '$cpf'");
			$row_usuario = $con_usuario->fetch_assoc();

			$msg = "Aviso: nova senha enviada para: ".$row_usuario['email'];
			$botao = "success";
		}
		elseif($flag == md5("alteracao_om_sucesso")){
			$msg = "Aviso: Unidade alterada com sucesso!<br />Nova Unidade: ".$denominacao_usuario;
			$botao = "success";
		}
		elseif($flag == md5("alteracao_om_erro")){
			$msg = "ERRO: Unidade não foi alterada!<br />Permanece ".$denominacao_usuario;
			$botao = "danger";
		}
		elseif($flag == md5("msg_logout_troca_senha")){
			$msg = "Aviso: Senha alterada com sucesso!<br />Faça login com a nova senha!";
			$botao = "success";
		}
		elseif($flag == md5("alteracao_senha_erro")){
			$msg = "ERRO: Senha não foi alterada!";
			$botao = "danger";
		}
		elseif($flag == md5("alteracao_usuario_sucesso")){
			$msg = "AVISO: dados alterados com sucesso!";
			$botao = "success";
		}
		elseif($flag == md5("alteracao_usuario_erro")){
			$msg = "ERRO: nenhuma alteração foi realizada!";
			$botao = "danger";
		}
		elseif($flag == md5("exclusao_usuario_sucesso")){
			$msg = "AVISO: cadastro excluído com sucesso!";
			$botao = "danger";
		}
		elseif($flag == md5("exclusao_usuario_erro")){
			$msg = "ERRO: exclusão não realizada!";
			$botao = "danger";
		}
		* */
	}
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>