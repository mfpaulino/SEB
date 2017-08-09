<?php
$inc = "sim";
include_once(__DIR__ .'/../../path.inc.php');

if(isset($_POST['flag'])){

	session_start();

	require_once(PATH . '/componentes/internos/php/cript.inc.php');
	require_once(PATH . '/componentes/internos/php/conexao.inc.php');
	require_once(PATH . '/componentes/internos/php/validaForm.class.php');

	$cpf 				= $_SESSION['cpf'];

	$rg_atual			= $_POST['rg_atual'];
	$posto_atual 		= $_POST['posto_atual'];
	$nome_guerra_atual  = $_POST['nome_guerra_atual'];
	$nome_atual			= $_POST['nome_atual'];
	$email_atual 		= $_POST['email_atual'];

	$rg 				= $_POST['rg'];
	$posto 				= $_POST['posto'];
	$nome_guerra 		= $_POST['nome_guerra'];
	$nome 				= $_POST['nome'];
	$email 				= $_POST['email'];

	$validar = new validaForm();

	$validar->set('RG', 			$rg)->is_required()->is_num()
			->set('Posto/Grad', 			$posto)->is_required()
			->set('Nome', 			$nome)->is_required()
			->set('Nome de guerra', $nome_guerra)->is_required()
			->set('E-mail',			$email)->is_email();

	$_SESSION['botao'] = "success";

	if ($validar->validate()){

		if ($rg <> "" and $rg <> $rg_atual){

			$con_rg = $mysqli->prepare("UPDATE usuarios SET rg = ? WHERE cpf ='$cpf'");
			$con_rg->bind_param('s', $rg);
			$con_rg->execute();

			if($con_rg->affected_rows <> 0 ){
					$_SESSION['alterar_rg'] = "O RG foi alterado com sucesso!";
			}
		}
		if ($posto <> "" and $posto <> $posto_atual){
			$con_update = $mysqli->prepare("UPDATE usuarios SET id_posto = ? WHERE cpf ='$cpf'");
			$con_update->bind_param('s', $posto);
			$con_update->execute();

			if($con_update->affected_rows <> 0 ){
				$_SESSION['alterar_posto'] = "O Posto/Grad foi alterado com sucesso!";
			}
		}
		if ($nome_guerra <> "" and $nome_guerra <> $nome_guerra_atual){
			$con_update = $mysqli->prepare("UPDATE usuarios SET nome_guerra = ? WHERE cpf ='$cpf'");
			$con_update->bind_param('s', $nome_guerra);
			$con_update->execute();

			if($con_update->affected_rows <> 0 ){
				$_SESSION['alterar_nome_guerra'] = "O nome de guerra foi alterado com sucesso!";
			}
		}
		if ($nome <> "" and $nome <> $nome_atual){
			$con_update = $mysqli->prepare("UPDATE usuarios SET nome = ? WHERE cpf ='$cpf'");
			$con_update->bind_param('s', $nome);
			$con_update->execute();

			if($con_update->affected_rows <> 0 ){
				$_SESSION['alterar_nome'] = "O nome foi alterado com sucesso!";
			}
		}
		if ($email <> "" and $email <> $email_atual){

			$sql = "SELECT email FROM usuarios WHERE email = '$email'";
			$con = $mysqli->query($sql);

			if ($con->affected_rows <> 0){
				$_SESSION['alterar_email_erro'] = "ERRO: e-mail já foi cadastrado para outro usuário!";
				$_SESSION['botao'] = "danger";
				$validacao = false;
			}
			else {
				$con_update = $mysqli->prepare("UPDATE usuarios SET email = ? WHERE cpf ='$cpf'");
				$con_update->bind_param('s', $email);
				$con_update->execute();

				if($con_update->affected_rows <> 0 ){
					$_SESSION['alterar_email'] = "O e-mail foi alterado com sucesso!";
				}
			}
		}
	}
	else {
		$_SESSION['alterar_erro_validacao'] = "ERRO: dados inconsistentes, preencha novamente o formulário!";
		$_SESSION['alterar_lista_erro_validacao'] = $validar->get_errors(); //Captura os erros de todos os campos
		$_SESSION['botao'] = "danger";
	}
	$flag = md5("usuario_alterar");
	header(sprintf("Location:../../index_visite.php?flag=$flag"));
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>
