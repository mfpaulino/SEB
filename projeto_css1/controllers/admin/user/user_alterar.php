<?php
//user_alterar.php

session_start();

$inc = "sim";
include_once('../../../config.inc.php');

if(isset($_POST['flag']) and isset($_SESSION['cpf'])){

	require_once(PATH . '/controllers/autenticacao/autentica.inc.php');
	require_once(PATH . '/componentes/internos/php/validaForm.class.php');
	require_once(PATH . '/componentes/internos/php/funcoes.inc.php');

	$acao = $_POST['flag'];
	$id_usuario = $_POST['id_usuario'];//tipo hidden

	$_SESSION['botao'] = "success";

	if($acao == "alterar"){

		$id_perfil 	 = isset($_POST['perfil']) ? mysqli_real_escape_string($mysqli, $_POST['perfil']) : "";

		$id_perfil_atual =  $_POST['perfil_atual'];//tipo hidden

		$validar = new validaForm();
		$validar->set('Perfil',			$id_perfil)->is_required();

		if ($validar->validate()){
			$altera = "nao";

			if ($id_perfil <> "" and $id_perfil <> $id_perfil_atual){

				$con_perfil = $mysqli->prepare("UPDATE usuarios SET id_perfil = ? WHERE id_usuario = ?");
				$con_perfil->bind_param('ii', $id_perfil,$id_usuario);
				$resultado = $con_perfil->execute();

				if($resultado){
					$_SESSION['alterar_user'] = "O perfil foi alterado com sucesso!";
					$altera = "sim";
				}
			}
			if($altera == "nao"){
				$_SESSION['alterar_nada_user'] = "AVISO: nenhuma alteração foi realizada!";
				$_SESSION['botao'] = "warning";
			}
		}
		else {
			$_SESSION['alterar_erro_validacao_user'] = "ERRO A-011: dados inconsistentes, preencha novamente o formulário!";
			$_SESSION['alterar_lista_erro_validacao_user'] = $validar->get_errors(); //Captura os erros de todos os campos
			$_SESSION['botao'] = "danger";
		}
	}
	else if($acao == "habilitar"){
		$con_habilita = $mysqli->prepare("UPDATE usuarios SET status = 'habilitado' WHERE id_usuario = ?");
		$con_habilita->bind_param('i', $id_usuario);
		$resultado = $con_habilita->execute();

		if($resultado){
			$_SESSION['alterar_user'] = "O usuário foi habilitado com sucesso!";
		}
		else{
			$_SESSION['alterar_nada_user'] = "ERRO A-012: não foi possível habilitar o usuário, tente novamente!";
			$_SESSION['botao'] = "danger";
		}
	}
	else if($acao == "excluir"){

		$con_del   = $mysqli->query("DELETE FROM usuarios WHERE id_usuario = '$id_usuario'");
		$con_teste = $mysqli->query("SELECT id_usuario FROM usuarios WHERE id_usuario = '$id_usuario'");

		if($con_teste->num_rows == 0){
			$_SESSION['alterar_user'] = "O usuário foi excluído com sucesso!";
		}
		else {
			$_SESSION['alterar_nada_user'] = "ERRO A-013: não foi possível excluir o usuário, tente novamente!";
			$_SESSION['botao'] = "danger";
		}
	}

	$flag = md5("user_alterar");
	header("Location:../../../admin.php?flag=$flag");
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>