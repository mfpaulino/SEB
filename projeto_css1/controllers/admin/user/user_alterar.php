<?php
//user_alterar.php

session_start();

$inc = "sim";
include_once('../../../config.inc.php');

if(isset($_POST['flag']) and isset($_SESSION['cpf'])){

	include_once(PATH . '/controllers/autenticacao/autentica.inc.php');
	include_once(PATH . '/componentes/internos/php/validaForm.class.php');
	include_once(PATH . '/componentes/internos/php/funcoes.inc.php');
	include_once(PATH . '/componentes/internos/php/bcript.inc.php');

	$acao = $_POST['flag'];
	$id_usuario = $_POST['id_usuario'];//tipo hidden
	$cpf = $_POST['cpf'];

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
		$con_habilita = $mysqli->prepare("UPDATE usuarios SET status = 'Habilitado' WHERE id_usuario = ?");
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
	else if ($acao == "resetar_senha"){
		$nova_senha = Bcrypt::hash($cpf);

		$con_nova_senha = $mysqli->prepare("UPDATE usuarios SET senha = ? WHERE id_usuario ='$id_usuario'");
		$con_nova_senha->bind_param('s', $nova_senha);
		$resultado = $con_nova_senha->execute();

		$sql = "select cpf, postos.posto, nome_guerra, email from usuarios, postos where cpf = '$cpf' and usuarios.id_posto = postos.id_posto";
		$con_usuario = $mysqli->query($sql);
		$row_usuario = $con_usuario->fetch_assoc();

		if($resultado){
			$_SESSION['alterar_user'] = 'A senha foi redefinida com sucesso!<br /><br />Avise a(o) <kbd>&nbsp;'.strtoupper($row_usuario['posto'] . " " . $row_usuario['nome_guerra'] ).  '&nbsp;</kbd> que a nova senha é igual ao CPF.';
		}
		else{
			$_SESSION['alterar_nada_user'] = "ERRO A-013: a nova senha não pode ser redefinida!<br />Tente novamente.";
			$_SESSION['botao'] = "danger";
		}
	}
	else if($acao == "desabilitar"){
		$con_desabilita = $mysqli->prepare("UPDATE usuarios SET status = 'Desabilitado' WHERE id_usuario = ?");
		$con_desabilita->bind_param('i', $id_usuario);
		$resultado = $con_desabilita->execute();

		if($resultado){
			$_SESSION['alterar_user'] = "O usuário foi desabilitado com sucesso!";
		}
		else{
			$_SESSION['alterar_nada_user'] = "ERRO A-012: não foi possível desabilitar o usuário, tente novamente!";
			$_SESSION['botao'] = "danger";
		}
	}
	else if($acao == "excluir"){

		$con_del   = $mysqli->query("DELETE FROM usuarios WHERE id_usuario = '$id_usuario'");
		$con_teste = $mysqli->query("SELECT id_usuario FROM usuarios WHERE id_usuario = '$id_usuario'");

		if($con_teste->num_rows == 0){

			$dir = PATH . '/views/avatar/'; //Diretório para uploads
			unlink($dir.$cpf.'.jpg');//apaga os arquivos de imagem do usuario
			unlink($dir.$cpf.'.gif');
			unlink($dir.$cpf.'.png');

			$_SESSION['alterar_user'] = "O usuário foi excluído com sucesso!";
		}
		else {
			$_SESSION['alterar_nada_user'] = "ERRO A-014: não foi possível excluir o usuário, tente novamente!";
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