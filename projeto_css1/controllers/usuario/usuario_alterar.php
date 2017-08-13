<?php
$inc = "sim";
include_once('../../config.inc.php');
include_once(PATH . '/controllers/autenticacao/perfil.inc.php');

if(isset($_POST['flag'])){

	session_start();
	require_once(PATH . '/controllers/autenticacao/perfil.inc.php');
	require_once(PATH . '/componentes/internos/php/conexao.inc.php');
	require_once(PATH . '/componentes/internos/php/validaForm.class.php');

	$pagina = $_POST['flag1'];

	$cpf 				= $_SESSION['cpf'];

	$rg_atual			= $_SESSION['rg_usuario'];
	$posto_atual 		= $_SESSION['posto_usuario'];
	$nome_guerra_atual  = $_SESSION['nome_guerra_usuario'];
	$nome_atual			= $_SESSION['nome_usuario'];
	$email_atual 		= $_SESSION['email_usuario'];
	$ritex_atual 		= $_SESSION['ritex_usuario'];
	$celular_atual 		= $_SESSION['celular_usuario'];

	$rg 				= $_POST['rg'];
	$posto 				= $_POST['posto'];
	$nome_guerra 		= $_POST['nome_guerra'];
	$nome 				= $_POST['nome'];
	$email 				= $_POST['email'];
	$ritex 				= $_POST['ritex'];
	$celular 			= $_POST['celular'];

	$validar = new validaForm();

	$validar->set('RG', 			$rg)->is_required()->is_num()
			->set('Posto/Grad', 	$posto)->is_required()
			->set('Nome', 			$nome)->is_required()
			->set('Nome de guerra', $nome_guerra)->is_required()
			->set('E-mail',			$email)->is_email();
			//->set('RITEx',			$ritex)->is_required()->is_num()->min_length(7)->max_length(7)
			//->set('Celular',		$celular)->is_required()->is_num()->min_length(10)->max_length(11)

	$_SESSION['botao'] = "success";
	$_SESSION['pagina'] = $pagina;

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
		if ($ritex <> "" and $ritex <> $ritex_atual){
			$con_update = $mysqli->prepare("UPDATE usuarios SET ritex = ? WHERE cpf ='$cpf'");
			$con_update->bind_param('i', $ritex);
			$con_update->execute();

			if($con_update->affected_rows <> 0 ){
				$_SESSION['alterar_ritex'] = "O RITEx foi alterado com sucesso!";
			}
		}
		if ($celular <> "" and $celular <> $celular_atual){
			$con_update = $mysqli->prepare("UPDATE usuarios SET celular = ? WHERE cpf ='$cpf'");
			$con_update->bind_param('i', $celular);
			$con_update->execute();

			if($con_update->affected_rows <> 0 ){
				$_SESSION['alterar_celular'] = "O celular foi alterado com sucesso!";
			}
		}
	}
	else {
		$_SESSION['alterar_erro_validacao'] = "ERRO: dados inconsistentes, preencha novamente o formulário!";
		$_SESSION['alterar_lista_erro_validacao'] = $validar->get_errors(); //Captura os erros de todos os campos
		$_SESSION['botao'] = "danger";
	}
	$flag = md5("usuario_alterar");
	header(sprintf("Location:../../".$pagina."?flag=$flag"));
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>
