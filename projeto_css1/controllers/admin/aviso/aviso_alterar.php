<?php
//categoria_alterar.php

session_start();

$inc = "sim";
include_once('../../../config.inc.php');

if(isset($_POST['flag']) and isset($_SESSION['cpf'])){

	$acao = $_POST['flag'];
	$id_aviso 	= $_POST['id_aviso'];//tipo hidden

	$_SESSION['botao'] = "success";

	require_once(PATH . '/controllers/autenticacao/autentica.inc.php');
	require_once(PATH . '/componentes/internos/php/validaForm.class.php'); //classe para validação em caso de falhar a validacao jquery
	require_once(PATH . '/componentes/internos/php/funcoes.inc.php');

	if($acao == "alterar"){

		$titulo	  = isset($_POST['titulo']) ? mysqli_real_escape_string($mysqli, $_POST['titulo']) : "";
		$texto = isset($_POST['texto']) ? $_POST['texto'] : "";
		$validade = isset($_POST['validade']) ? converter_data($_POST['validade'], 'EN') : "";

		$publico = isset($_POST['publico']) ? serialize($_POST['publico']) : "";

		$autor = $cpf; //vem do arquivo de perfil(variavel de sessao - usuario logado)

		$sql_atual = "SELECT titulo, texto, publico, dt_validade FROM adm_avisos WHERE id_aviso = '$id_aviso'";
		$con_atual = $mysqli->query($sql_atual);
		$row_atual = $con_atual->fetch_assoc(); //busca os dados atuais para comparação

		$validar = new validaForm();

		$validar->set('Título', $titulo)->is_required()
				->set('Texto',  $texto)->is_required()
				->set('Público', $publico)->is_required()
				->set('Validade', $validade)->is_required();

		if ($validar->validate()){
			$altera = "nao";

			if ($titulo <> "" and $titulo <> $row_atual['titulo']){

				$con_titulo = $mysqli->prepare("UPDATE adm_avisos SET titulo = ? WHERE id_aviso ='$id_aviso'");
				$con_titulo->bind_param('s', $titulo);
				$resultado = $con_titulo->execute();

				if($resultado){
					$altera = "sim";
				}
			}

			if ($texto <> "" and $texto <> $row_atual['texto']){

				$con_texto = $mysqli->prepare("UPDATE adm_avisos SET texto = ? WHERE id_aviso ='$id_aviso'");
				$con_texto->bind_param('s', $texto);
				$resultado = $con_texto->execute();

				if($resultado){
					$altera = "sim";
				}
			}

			if ($validade <> "" and $validade <> $row_atual['dt_validade']){

				$con_validade = $mysqli->prepare("UPDATE adm_avisos SET dt_validade = ? WHERE id_aviso ='$id_aviso'");
				$con_validade->bind_param('s', $validade);
				$resultado = $con_validade->execute();

				if($resultado){
					$altera = "sim";
				}
			}

			if ($publico <> "" and $publico <> $row_atual['publico']){

				$con_publico = $mysqli->prepare("UPDATE adm_avisos SET publico = ? WHERE id_aviso ='$id_aviso'");
				$con_publico->bind_param('s', $publico);
				$resultado = $con_publico->execute();

				if($resultado){
					$altera = "sim";
				}
			}

			if($altera == "sim"){
				$_SESSION['alterar_aviso'] = "Aviso alterado com sucesso!";
			}
			else{
				$_SESSION['alterar_nada_aviso'] = "AVISO: nenhuma alteração foi realizada!";
				$_SESSION['botao'] = "warning";
			}
		}
		else {
			$_SESSION['alterar_erro_validacao_aviso'] = "ERRO A-019: dados inconsistentes, preencha novamente o formulário!";
			$_SESSION['alterar_lista_erro_validacao_aviso'] = $validar->get_errors(); //Captura os erros de todos os campos
			$_SESSION['botao'] = "danger";
		}
	}
	else if($acao == "Habilitar" or $acao == "Desabilitar"){

		if($acao == "Habilitar"){
			$status = "Ativo";
			$aviso = "habilitado";

			$con_validade = $mysqli->query("SELECT dt_validade FROM adm_avisos WHERE id_aviso = '$id_aviso'");
			$row_validade = $con_validade->fetch_assoc();

			$dt_atual = strtotime(date("Y-m-d"));
			$dt_validade = strtotime($row_validade['dt_validade']);

			if($dt_atual > $dt_validade){
				$validade = date('Y-m-d', strtotime("+10 days"));
			}
			else {
				$validade = $row_validade['dt_validade'];
			}

			$con_status = $mysqli->prepare("UPDATE adm_avisos SET status = ?, dt_validade = ? WHERE id_aviso = '$id_aviso'");
			$con_status->bind_param('ss', $status,$validade);

		}
		else if($acao == "Desabilitar"){
			$status = "Inativo";
			$aviso = "desabilitado";

			$con_status = $mysqli->prepare("UPDATE adm_avisos SET status = ? WHERE id_aviso = '$id_aviso'");
			$con_status->bind_param('s', $status);
		}

		$resultado = $con_status->execute();

		if($resultado){

			$_SESSION['alterar_aviso'] = "Aviso $aviso com sucesso!";
		}
		else{
			$_SESSION['alterar_nada_aviso'] = "ERRO A-020: aviso não $aviso. Por favor, tente novamente!";
			$_SESSION['botao'] = "danger";
		}
	}
	else if($acao == "excluir"){

		$con_del   = $mysqli->query("DELETE FROM adm_avisos WHERE id_aviso = '$id_aviso'");
		$con_teste = $mysqli->query("SELECT id_aviso FROM adm_avisos WHERE id_aviso = '$id_aviso'");

		if($con_teste->num_rows == 0){

			$_SESSION['alterar_aviso'] = "Aviso excluído com sucesso!";
		}
		else{
			$_SESSION['alterar_nada_aviso'] = "ERRO A-020: aviso não excluído. Por favor, tente novamente!";
			$_SESSION['botao'] = "danger";
		}
	}

	$flag = md5("aviso_alterar");
	header("Location:../../../admin.php?flag=$flag");
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>