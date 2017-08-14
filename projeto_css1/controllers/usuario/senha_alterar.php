<?php
session_start();

$inc = "sim";
include_once('../../config.inc.php');

include_once(PATH. '/componentes/internos/php/bcript.inc.php');
include_once(PATH .'/componentes/internos/php/conexao.inc.php');
include_once(PATH . '/componentes/internos/php/validaForm.class.php');

if(isset($_POST['flag'])){

	$cpf 	= $_SESSION['cpf'];
	$pagina = $_POST['flag1'];

	$senha 		 = isset($_POST['senha_nova'])  ? mysqli_real_escape_string($mysqli, $_POST['senha_nova']) : "";
	$senha1 	 = isset($_POST['senha_nova1']) ? mysqli_real_escape_string($mysqli, $_POST['senha_nova1']) : "";

	$validar = new validaForm();

	$validar->set('Senha', $senha)->is_not_equals($cpf, true,"CPF")->min_length(7)->is_equals($senha1, true, "Confirmação da senha");

	if ($validar->validate()){

		$senha_cript = Bcrypt::hash($senha1);

		$con_update = $mysqli->prepare("UPDATE usuarios SET senha = ? WHERE cpf ='$cpf'");
		$con_update->bind_param('s', $senha_cript);
		$con_update->execute();
		$mysqli->close();

		if($con_update->affected_rows <> 0 ){

			$_SESSION['alterar_senha_sucesso'] = "Senha alterada com sucesso!<br />Faça login com a nova senha.";
			$_SESSION['botao'] = "success";
		}
		else{
			$_SESSION['alterar_senha_erro_bd'] = "ERRO S-01: senha não alterada, tente novamente!";
			$_SESSION['botao'] = "danger";
		}

	}
	else{
		$_SESSION['alterar_senha_erro_validacao'] = "ERRO S-02: dados inconsistentes, preencha novamente o formulário!";
		$_SESSION['alterar_senha_erro_validacao_lista'] = $validar->get_errors(); //Captura os erros de todos os campos
		$_SESSION['botao'] = "danger";
	}
	$_SESSION['pagina'] = $pagina;
	$flag = md5("senha_alterar");
	header(sprintf("Location:../../".$pagina."?flag=$flag"));
}
else {
	include_once('../autenticacao/'.ACESSO_NEGADO);
}
?>
