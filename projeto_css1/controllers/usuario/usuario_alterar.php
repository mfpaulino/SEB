<?php
$inc = "sim";
include_once('../../config.inc.php');

if(isset($_POST['flag'])){

	//session_start();
	require_once(PATH . '/controllers/autenticacao/autentica.inc.php');
	require_once(PATH . '/componentes/internos/php/validaForm.class.php');
	require_once(PATH . '/componentes/internos/php/funcoes.inc.php');

	$pagina = $_POST['flag1'];

	$rg 		 = isset($_POST['rg']) ? mysqli_real_escape_string($mysqli, $_POST['rg']) : $rg_usuario;
	$id_posto 	 = isset($_POST['posto']) ? mysqli_real_escape_string($mysqli, $_POST['posto']) : $id_posto_usuario;
	$nome 		 = isset($_POST['nome']) ? mysqli_real_escape_string($mysqli, $_POST['nome']) : $nome_usuario;
	$nome_guerra = isset($_POST['nome_guerra']) ? mysqli_real_escape_string($mysqli, $_POST['nome_guerra']) : $nome_guerra_usuario;
	$email 		 = isset($_POST['email']) ? mysqli_real_escape_string($mysqli, $_POST['email']) : $email_usuario;
	$ritex 		 = isset($_POST['ritex']) ? mysqli_real_escape_string($mysqli, $_POST['ritex']) : $ritex_usuario;
	$celular 	 = isset($_POST['celular']) ? mysqli_real_escape_string($mysqli, $_POST['celular']) : $celular_usuario;
	$codom 		 = isset($_POST['codom']) ? mysqli_real_escape_string($mysqli, $_POST['codom']) : $codom_usuario;

	$validar = new validaForm();

	$validar->set('RG', 			$rg)->is_required()->is_num()
			->set('Posto/Grad', 	$id_posto)->is_required()
			->set('Nome', 			$nome)->is_required()
			->set('Nome de guerra', $nome_guerra)->is_required()
			->set('E-mail',			$email)->is_email()
			->set('Unidade',		$codom)->is_required();
			//->set('RITEx',		$ritex)->is_required()->is_num()->min_length(7)->max_length(7)
			//->set('Celular',		$celular)->is_required()->is_num()->min_length(10)->max_length(11)

	$_SESSION['botao'] = "success";
	$_SESSION['pagina'] = $pagina;

	if ($validar->validate()){
		$altera = "nao";

		if ($rg <> "" and $rg <> $rg_usuario){

			$con_rg = $mysqli->prepare("UPDATE usuarios SET rg = ? WHERE cpf ='$cpf'");
			$con_rg->bind_param('s', $rg);
			$con_rg->execute();

			if($con_rg->affected_rows <> 0 ){
				$_SESSION['alterar_rg'] = "O RG foi alterado com sucesso!";
				$altera = "sim";
			}
		}
		if ($id_posto <> "" and $id_posto <> $id_posto_usuario){
			$con_update = $mysqli->prepare("UPDATE usuarios SET id_posto = ? WHERE cpf ='$cpf'");
			$con_update->bind_param('i', $id_posto);
			$con_update->execute();

			if($con_update->affected_rows <> 0 ){
				$_SESSION['alterar_posto'] = "O Posto/Grad foi alterado com sucesso!";
				$altera = "sim";
			}
		}
		if (formata_nome($nome) <> "" and formata_nome($nome) <> formata_nome($nome_usuario)){
			$con_update = $mysqli->prepare("UPDATE usuarios SET nome = ? WHERE cpf ='$cpf'");
			$con_update->bind_param('s', formata_nome($nome));
			$con_update->execute();

			if($con_update->affected_rows <> 0 ){
				$_SESSION['alterar_nome'] = "O nome foi alterado com sucesso!";
				$altera = "sim";
			}
		}
		if (formata_nome($nome_guerra) <> "" and formata_nome($nome_guerra) <> formata_nome($nome_guerra_usuario)){
			$con_update = $mysqli->prepare("UPDATE usuarios SET nome_guerra = ? WHERE cpf ='$cpf'");
			$con_update->bind_param('s', formata_nome($nome_guerra));
			$con_update->execute();

			if($con_update->affected_rows <> 0 ){
				$_SESSION['alterar_nome_guerra'] = "O nome de guerra foi alterado com sucesso!";
				$altera = "sim";
			}
		}
		if ($email <> "" and $email <> $email_usuario){

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
					$altera = "sim";
				}
			}
		}
		if ($ritex <> "" and $ritex <> $ritex_usuario){
			$con_update = $mysqli->prepare("UPDATE usuarios SET ritex = ? WHERE cpf ='$cpf'");
			$con_update->bind_param('i', $ritex);
			$con_update->execute();

			if($con_update->affected_rows <> 0 ){
				$_SESSION['alterar_ritex'] = "O RITEx foi alterado com sucesso!";
				$altera = "sim";
			}
		}
		if ($celular <> "" and $celular <> $celular_usuario){
			$con_update = $mysqli->prepare("UPDATE usuarios SET celular = ? WHERE cpf ='$cpf'");
			$con_update->bind_param('i', $celular);
			$con_update->execute();

			if($con_update->affected_rows <> 0 ){
				$_SESSION['alterar_celular'] = "O celular foi alterado com sucesso!";
				$altera = "sim";
			}
		}
		if ($codom <> "" and $codom <> $codom_usuario){
			$con_update = $mysqli->prepare("UPDATE usuarios SET codom = ? WHERE cpf ='$cpf'");
			$con_update->bind_param('s', $codom);
			$con_update->execute();

			if($con_update->affected_rows <> 0 ){
				$con_om = $mysqli1->query("SELECT denominacao FROM cciex_om  WHERE codom = '$codom'");
				$row_om = $con_om->fetch_assoc();
				$mysqli1->close();

				$_SESSION['alterar_codom'] = "Alteração da Unidade realizada com sucesso!<br /><br />Nova Unidade: ".$row_om['denominacao'];
				$altera = "sim";
			}
		}
		if($altera == "nao"){
			$_SESSION['alterar_nada'] = "AVISO: nenhuma alteração foi realizada!";
			$_SESSION['botao'] = "warning";
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
