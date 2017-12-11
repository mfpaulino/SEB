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

		if($flag == md5("subarea_vincular")){

			$msg0 = $_SESSION['subarea_vincular'];
		}
		else {
			unset($_SESSION['subarea_vincular']);
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

		if($flag == md5("questao_cadastrar")){

			$msg0 = $_SESSION['erro_validacao_cadastrar_questao'];
			$msg1 = $_SESSION['sucesso_cadastro_questao'];
			$msg2 = $_SESSION['questao_duplicada'];
			$msg4 = $_SESSION['erro_cadastro_questao'];
			$lista_erro_validacao = $_SESSION['lista_erro_validacao_cadastrar_questao'];
		}
		else {
			unset($_SESSION['erro_validacao_cadastrar_questao']);
			unset($_SESSION['sucesso_cadastro_questao']);
			unset($_SESSION['questao_duplicada']);
			unset($_SESSION['erro_cadastro_questao']);
			unset($_SESSION['lista_erro_validacao_cadastrar_questao']);
		}

		if($flag == md5("questao_vincular")){

			$msg0 = $_SESSION['questao_vincular'];
		}
		else {
			unset($_SESSION['questao_vincular']);
		}

		if($flag == md5("questao_alterar")){
			$msg0 = $_SESSION['alterar_erro_validacao_questao'];
			$msg1 = $_SESSION['alterar_questao'];
			$msg2 = $_SESSION['alterar_nada_questao'];
			$lista_erro_validacao = $_SESSION['alterar_lista_erro_validacao_questao'];
		}
		else {
			unset($_SESSION['alterar_erro_validacao_questao']);
			unset($_SESSION['alterar_questao']);
			unset($_SESSION['alterar_nada_questao']);
			unset($_SESSION['alterar_lista_erro_validacao_questao']);
		}

		if($flag == md5("info_req_cadastrar")){

			$msg0 = $_SESSION['erro_validacao_cadastrar_info_req'];
			$msg1 = $_SESSION['sucesso_cadastro_info_req'];
			$msg2 = $_SESSION['info_req_duplicada'];
			$msg4 = $_SESSION['erro_cadastro_info_req'];
			$lista_erro_validacao = $_SESSION['lista_erro_validacao_cadastrar_info_req'];
		}
		else {
			unset($_SESSION['erro_validacao_cadastrar_info_req']);
			unset($_SESSION['sucesso_cadastro_info_req']);
			unset($_SESSION['info_req_duplicada']);
			unset($_SESSION['erro_cadastro_info_req']);
			unset($_SESSION['lista_erro_validacao_cadastrar_info_req']);
		}

		if($flag == md5("info_req_vincular")){

			$msg0 = $_SESSION['info_req_vincular'];
		}
		else {
			unset($_SESSION['info_req_vincular']);
		}

		if($flag == md5("info_req_alterar")){
			$msg0 = $_SESSION['alterar_erro_validacao_info_req'];
			$msg1 = $_SESSION['alterar_info_req'];
			$msg2 = $_SESSION['alterar_nada_info_req'];
			$lista_erro_validacao = $_SESSION['alterar_lista_erro_validacao_info_req'];
		}
		else {
			unset($_SESSION['alterar_erro_validacao_info_req']);
			unset($_SESSION['alterar_info_req']);
			unset($_SESSION['alterar_nada_info_req']);
			unset($_SESSION['alterar_lista_erro_validacao_info_req']);
		}

		if($flag == md5("poss_achado_cadastrar")){

			$msg0 = $_SESSION['erro_validacao_cadastrar_poss_achado'];
			$msg1 = $_SESSION['sucesso_cadastro_poss_achado'];
			$msg2 = $_SESSION['poss_achado_duplicada'];
			$msg4 = $_SESSION['erro_cadastro_poss_achado'];
			$lista_erro_validacao = $_SESSION['lista_erro_validacao_cadastrar_poss_achado'];
		}
		else {
			unset($_SESSION['erro_validacao_cadastrar_poss_achado']);
			unset($_SESSION['sucesso_cadastro_poss_achado']);
			unset($_SESSION['poss_achado_duplicada']);
			unset($_SESSION['erro_cadastro_poss_achado']);
			unset($_SESSION['lista_erro_validacao_cadastrar_poss_achado']);
		}

		if($flag == md5("poss_achado_vincular")){

			$msg0 = $_SESSION['poss_achado_vincular'];
		}
		else {
			unset($_SESSION['poss_achado_vincular']);
		}

		if($flag == md5("poss_achado_alterar")){
			$msg0 = $_SESSION['alterar_erro_validacao_poss_achado'];
			$msg1 = $_SESSION['alterar_poss_achado'];
			$msg2 = $_SESSION['alterar_nada_poss_achado'];
			$lista_erro_validacao = $_SESSION['alterar_lista_erro_validacao_poss_achado'];
		}
		else {
			unset($_SESSION['alterar_erro_validacao_poss_achado']);
			unset($_SESSION['alterar_poss_achado']);
			unset($_SESSION['alterar_nada_poss_achado']);
			unset($_SESSION['alterar_lista_erro_validacao_poss_achado']);
		}

		if($flag == md5("proc_ana_cadastrar")){

			$msg0 = $_SESSION['erro_validacao_cadastrar_proc_ana'];
			$msg1 = $_SESSION['sucesso_cadastro_proc_ana'];
			$msg2 = $_SESSION['proc_ana_duplicada'];
			$msg4 = $_SESSION['erro_cadastro_proc_ana'];
			$lista_erro_validacao = $_SESSION['lista_erro_validacao_cadastrar_proc_ana'];
		}
		else {
			unset($_SESSION['erro_validacao_cadastrar_proc_ana']);
			unset($_SESSION['sucesso_cadastro_proc_ana']);
			unset($_SESSION['proc_ana_duplicada']);
			unset($_SESSION['erro_cadastro_proc_ana']);
			unset($_SESSION['lista_erro_validacao_cadastrar_proc_ana']);
		}

		if($flag == md5("proc_ana_vincular")){

			$msg0 = $_SESSION['proc_ana_vincular'];
		}
		else {
			unset($_SESSION['proc_ana_vincular']);
		}

		if($flag == md5("proc_ana_alterar")){
			$msg0 = $_SESSION['alterar_erro_validacao_proc_ana'];
			$msg1 = $_SESSION['alterar_proc_ana'];
			$msg2 = $_SESSION['alterar_nada_proc_ana'];
			$lista_erro_validacao = $_SESSION['alterar_lista_erro_validacao_proc_ana'];
		}
		else {
			unset($_SESSION['alterar_erro_validacao_proc_ana']);
			unset($_SESSION['alterar_proc_ana']);
			unset($_SESSION['alterar_nada_proc_ana']);
			unset($_SESSION['alterar_lista_erro_validacao_proc_ana']);
		}

		if($flag == md5("proc_coleta_cadastrar")){

			$msg0 = $_SESSION['erro_validacao_cadastrar_proc_coleta'];
			$msg1 = $_SESSION['sucesso_cadastro_proc_coleta'];
			$msg2 = $_SESSION['proc_coleta_duplicada'];
			$msg4 = $_SESSION['erro_cadastro_proc_coleta'];
			$lista_erro_validacao = $_SESSION['lista_erro_validacao_cadastrar_proc_coleta'];
		}
		else {
			unset($_SESSION['erro_validacao_cadastrar_proc_coleta']);
			unset($_SESSION['sucesso_cadastro_proc_coleta']);
			unset($_SESSION['proc_coleta_duplicada']);
			unset($_SESSION['erro_cadastro_proc_coleta']);
			unset($_SESSION['lista_erro_validacao_cadastrar_proc_coleta']);
		}

		if($flag == md5("proc_coleta_vincular")){

			$msg0 = $_SESSION['proc_coleta_vincular'];
		}
		else {
			unset($_SESSION['proc_coleta_vincular']);
		}

		if($flag == md5("proc_coleta_alterar")){
			$msg0 = $_SESSION['alterar_erro_validacao_proc_coleta'];
			$msg1 = $_SESSION['alterar_proc_coleta'];
			$msg2 = $_SESSION['alterar_nada_proc_coleta'];
			$lista_erro_validacao = $_SESSION['alterar_lista_erro_validacao_proc_coleta'];
		}
		else {
			unset($_SESSION['alterar_erro_validacao_proc_coleta']);
			unset($_SESSION['alterar_proc_coleta']);
			unset($_SESSION['alterar_nada_proc_coleta']);
			unset($_SESSION['alterar_lista_erro_validacao_proc_coleta']);
		}


		$msg="sim";
	}
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>