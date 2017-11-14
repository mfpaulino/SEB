<?php
//admin/alertas.inc.php
//envia msg de erro para o script admin.php

if ($inc == "sim"){

	session_start();

	if (isset($_GET['flag'])){

		$flag = $_GET['flag'];
		$botao = $_SESSION['botao'];

		if($flag == md5("categoria_cadastrar")){

			$msg0 = $_SESSION['erro_validacao_cadastrar_categoria'];
			$msg1 = $_SESSION['sucesso_cadastro_categoria'];
			$msg2 = $_SESSION['categoria_duplicada'];
			$msg3 = $_SESSION['localidade_duplicada'];
			$msg4 = $_SESSION['erro_cadastro_categoria'];
			$lista_erro_validacao = $_SESSION['lista_erro_validacao_cadastrar_categoria'];
		}
		else {
			unset($_SESSION['erro_validacao_cadastrar_categoria']);
			unset($_SESSION['sucesso_cadastro_categoria']);
			unset($_SESSION['categoria_duplicada']);
			unset($_SESSION['erro_cadastro_categoria']);
			unset($_SESSION['lista_erro_validacao_cadastrar_categoria']);
		}

		if($flag == md5("categoria_alterar")){
			$msg0 = $_SESSION['alterar_erro_validacao_categoria'];
			$msg1 = $_SESSION['alterar_categoria'];
			$msg2 = $_SESSION['alterar_nada_categoria'];
			$lista_erro_validacao = $_SESSION['alterar_lista_erro_validacao_categoria'];
		}
		else {
			unset($_SESSION['alterar_erro_validacao_categoria']);
			unset($_SESSION['alterar_categoria']);
			unset($_SESSION['alterar_nada_categoria']);
			unset($_SESSION['alterar_lista_erro_validacao_categoria']);
		}

		if($flag == md5("diaria_cadastrar")){

			$msg0 = $_SESSION['erro_validacao_cadastrar_diaria'];
			$msg1 = $_SESSION['sucesso_cadastro_diaria'];
			$msg2 = $_SESSION['diaria_duplicada'];
			$msg4 = $_SESSION['erro_cadastro_diaria'];
			$lista_erro_validacao = $_SESSION['lista_erro_validacao_cadastrar_diaria'];
		}
		else {
			unset($_SESSION['erro_validacao_cadastrar_diaria']);
			unset($_SESSION['sucesso_cadastro_diaria']);
			unset($_SESSION['diaria_duplicada']);
			unset($_SESSION['erro_cadastro_diaria']);
			unset($_SESSION['lista_erro_validacao_cadastrar_diaria']);
		}

		if($flag == md5("diaria_alterar")){
			$msg0 = $_SESSION['alterar_erro_validacao_diaria'];
			$msg1 = $_SESSION['alterar_diaria'];
			$msg2 = $_SESSION['alterar_nada_diaria'];
			$lista_erro_validacao = $_SESSION['alterar_lista_erro_validacao_diaria'];
		}
		else {
			unset($_SESSION['alterar_erro_validacao_diaria']);
			unset($_SESSION['alterar_diaria']);
			unset($_SESSION['alterar_nada_diaria']);
			unset($_SESSION['alterar_lista_erro_validacao_diaria']);
		}

		if($flag == md5("user_alterar")){
			$msg0 = $_SESSION['alterar_erro_validacao_user'];
			$msg1 = $_SESSION['alterar_user'];
			$msg2 = $_SESSION['alterar_nada_user'];
			$lista_erro_validacao = $_SESSION['alterar_lista_erro_validacao_user'];
		}
		else {
			unset($_SESSION['alterar_erro_validacao_user']);
			unset($_SESSION['alterar_user']);
			unset($_SESSION['alterar_nada_user']);
			unset($_SESSION['alterar_lista_erro_validacao_user']);
		}

		if($flag == md5("area_cadastrar")){

			$msg0 = $_SESSION['erro_validacao_cadastrar_area'];
			$msg1 = $_SESSION['sucesso_cadastro_area'];
			$msg2 = $_SESSION['area_duplicada'];
			$msg4 = $_SESSION['erro_cadastro_area'];
			$lista_erro_validacao = $_SESSION['lista_erro_validacao_cadastrar_area'];
		}
		else {
			unset($_SESSION['erro_validacao_cadastrar_area']);
			unset($_SESSION['sucesso_cadastro_area']);
			unset($_SESSION['area_duplicada']);
			unset($_SESSION['erro_cadastro_area']);
			unset($_SESSION['lista_erro_validacao_cadastrar_area']);
		}

		if($flag == md5("area_vincular")){

			$msg0 = $_SESSION['area_vincular'];
		}
		else {
			unset($_SESSION['area_vincular']);
		}

		if($flag == md5("area_alterar")){
			$msg0 = $_SESSION['alterar_erro_validacao_area'];
			$msg1 = $_SESSION['alterar_area'];
			$msg2 = $_SESSION['alterar_nada_area'];
			$lista_erro_validacao = $_SESSION['alterar_lista_erro_validacao_area'];
		}
		else {
			unset($_SESSION['alterar_erro_validacao_area']);
			unset($_SESSION['alterar_area']);
			unset($_SESSION['alterar_nada_area']);
			unset($_SESSION['alterar_lista_erro_validacao_area']);
		}

		if($flag == md5("subarea_cadastrar")){

			$msg0 = $_SESSION['erro_validacao_cadastrar_subarea'];
			$msg1 = $_SESSION['sucesso_cadastro_subarea'];
			$msg2 = $_SESSION['subarea_duplicada'];
			$msg4 = $_SESSION['erro_cadastro_subarea'];
			$lista_erro_validacao = $_SESSION['lista_erro_validacao_cadastrar_subarea'];
		}
		else {
			unset($_SESSION['erro_validacao_cadastrar_subarea']);
			unset($_SESSION['sucesso_cadastro_subarea']);
			unset($_SESSION['subarea_duplicada']);
			unset($_SESSION['erro_cadastro_subarea']);
			unset($_SESSION['lista_erro_validacao_cadastrar_subarea']);
		}

		if($flag == md5("subarea_alterar")){
			$msg0 = $_SESSION['alterar_erro_validacao_subarea'];
			$msg1 = $_SESSION['alterar_subarea'];
			$msg2 = $_SESSION['alterar_nada_subarea'];
			$lista_erro_validacao = $_SESSION['alterar_lista_erro_validacao_subarea'];
		}
		else {
			unset($_SESSION['alterar_erro_validacao_subarea']);
			unset($_SESSION['alterar_subarea']);
			unset($_SESSION['alterar_nada_subarea']);
			unset($_SESSION['alterar_lista_erro_validacao_subarea']);
		}

		$msg="sim";
	}
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>