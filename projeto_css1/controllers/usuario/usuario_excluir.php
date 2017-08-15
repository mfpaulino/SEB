<?php
//altera_usuario.php
$inc = "sim";
require_once('../../config.inc.php');

if(isset($_GET['flag']) and $_GET['flag'] == md5("usuario_excluir")){

	$pagina = $_GET['pagina'];

	session_start();

	$cpf = $_SESSION['cpf'];

	$con_del   = $mysqli->query("DELETE FROM usuarios WHERE cpf = '$cpf'");
	$con_teste = $mysqli->query("SELECT cpf FROM usuarios WHERE cpf = '$cpf'");

	if($con_teste->num_rows == 0){

		if($_SESSION['acesso'] == "nao_liberado"){
			session_destroy();
		}
		else{
			$_SESSION['usuario_excluir_sucesso'] = "Usuário excluído com sucesso!";
		}
	}
	else{
		$_SESSION['usuario_excluir_erro'] = "ERRO U05: usuário não excluído. Por favor, tente novamente!";
		$_SESSION['botao'] = "danger";
	}
	header(sprintf("Location:../../".$pagina));
}
else {
	include_once(PATH .'/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>
