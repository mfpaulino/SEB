<?php
//altera_usuario.php
$inc = "sim";
require_once('../../config.inc.php');

if(isset($_GET['flag']) and $_GET['flag'] == md5("usuario_excluir") and isset($_SESSION['cpf'])){

	$pagina = $_GET['flag1'].".php";

	if ($pagina == PAGINA_VISITANTE){

		require_once(PATH . '/controllers/autenticacao/autentica_visite.inc.php');
	}
	else{

		require_once(PATH . '/controllers/autenticacao/autentica.inc.php');
	}

	$con_del   = $mysqli->query("DELETE FROM usuarios WHERE cpf = '$cpf'");
	$con_teste = $mysqli->query("SELECT cpf FROM usuarios WHERE cpf = '$cpf'");

	if($con_teste->num_rows == 0){

		$dir = PATH . '/views/avatar/'; //Diretório para uploads
		unlink($dir.$cpf.'.jpg');//apaga os arquivos de imagem do usuario
		unlink($dir.$cpf.'.gif');
		unlink($dir.$cpf.'.png');

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
