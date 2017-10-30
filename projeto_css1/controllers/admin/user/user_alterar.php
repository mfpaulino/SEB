<?php
//user_alterar.php

session_start();

$inc = "sim";
include_once('../../../config.inc.php');

if(isset($_POST['flag']) and isset($_SESSION['cpf'])){

	$cpf_usuario = $_SESSION['cpf'];

	$_SESSION['botao'] = "success";

	include_once(PATH . '/controllers/autenticacao/autentica.inc.php');
	include_once(PATH . '/componentes/internos/php/validaForm.class.php');
	include_once(PATH . '/componentes/internos/php/funcoes.inc.php');
	include_once(PATH . '/componentes/internos/php/bcript.inc.php');

	$acao = $_POST['flag'];
	$id_usuario = $_POST['id_usuario'];

	/*** dados do usuario ***/

	$sql = "select cpf, postos.posto, nome_guerra, email, usuarios.id_perfil, perfil, codom from usuarios, postos, adm_perfis where id_usuario = '$id_usuario' and usuarios.id_posto = postos.id_posto and adm_perfis.id_perfil = usuarios.id_perfil";
	$con_usuario = $mysqli->query($sql);
	$row_usuario = $con_usuario->fetch_assoc();

	$sql = "select sigla from cciex_om where codom = '$row_usuario[codom]'";
	$con_om = $mysqli1->query($sql);
	$row_om = $con_om->fetch_assoc();

	$usuario = $row_usuario['posto'] . " " . $row_usuario['nome_guerra'];
	$perfil = $row_usuario['perfil'];
	$cpf = $row_usuario['cpf'];
	$unidade = $row_om['sigla'];

	/*** fim dados do usuario ***/

	if($acao == "alterar"){

		$id_perfil 	 = isset($_POST['perfil']) ? mysqli_real_escape_string($mysqli, $_POST['perfil']) : "";

		$validar = new validaForm();
		$validar->set('Perfil',			$id_perfil)->is_required();

		if ($validar->validate()){
			$altera = "nao";

			if ($id_perfil <> "" and $id_perfil <> $row_usuario['id_perfil']){

				$con_perfil = $mysqli->prepare("UPDATE usuarios SET id_perfil = ? WHERE id_usuario = ?");
				$con_perfil->bind_param('ii', $id_perfil,$id_usuario);
				$resultado = $con_perfil->execute();

				if($resultado){

					/** log **/

					$con_perfil_novo = $mysqli->query("SELECT perfil FROM adm_perfis WHERE id_perfil = '$id_perfil'");
					$perfil_novo = $con_perfil_novo->fetch_assoc();

					$log = "Alterou o perfil do(a) " . $usuario . " do(a) " . $unidade . " de <u>" . $perfil . "</u> para <u>" . $perfil_novo['perfil'] . "</u>.";
					$con_log = $mysqli->query("INSERT INTO logs SET cpf = '$cpf_usuario', codom = '$codom_usuario', acao = '$log'");

					/** fim log **/

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

			/** log **/

			$log = "Habilitou o(a) " . $usuario . " do(a) " . $unidade . " com o perfil " . $perfil . ".";
			$con_log = $mysqli->query("INSERT INTO logs SET cpf = '$cpf_usuario', codom = '$codom_usuario', acao = '$log'");

			/** fim log **/

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

		if($resultado){

		/** log **/

		$log = "Redefiniu a senha do(a) " . $usuario . " do(a) " . $unidade . ".";
		$con_log = $mysqli->query("INSERT INTO logs SET cpf = '$cpf_usuario', codom = '$codom_usuario', acao = '$log'");

		/** fim log **/

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

			/** log **/

			$log = "Desabilitou o(a) " . $usuario . " do(a) " . $unidade . ".";
			$con_log = $mysqli->query("INSERT INTO logs SET cpf = '$cpf_usuario', codom = '$codom_usuario', acao = '$log'");

			/** fim log **/

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

			/** log **/

			$log = "Excluiu o(a) " . $usuario . " do(a) " . $unidade . ".";
			$con_log = $mysqli->query("INSERT INTO logs SET cpf = '$cpf_usuario', codom = '$codom_usuario', acao = '$log'");

			/** fim log **/

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