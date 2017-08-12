<?php
//altera_usuario.php
session_start();
$inc = 'sim';
include_once('../../path.inc.php');
include_once(PATH .'/controllers/usuario/usuario_alertas_destruir.inc.php');

if(isset($_POST['flag'])){

	require_once(PATH .'/componentes/internos/php/constantes.inc.php');
	require_once(PATH .'/componentes/internos/php/conexao.inc.php');
	require_once(PATH . '/componentes/internos/php/validaForm.class.php');


	$pagina 	 = $_POST['flag1'];
	$cpf 		 = $_SESSION['cpf'];
	$codom_atual = $_POST['flag'];
	$codom 		 = isset($_POST['codom']) ? mysqli_real_escape_string($mysqli, $_POST['codom']) : "";

	$validar = new validaForm();

	$validar->set('Unidade', $codom)->is_required();

	if ($validar->validate()){

		$con_update = $mysqli->prepare("UPDATE usuarios SET codom = ? WHERE cpf = '$cpf'");
		$con_update->bind_param('s', $codom);
		$con_update->execute();

		if($con_update->affected_rows <> 0 ){

			$con_om = $mysqli->query("SELECT denominacao FROM cciex_om  WHERE codom = '$codom'");
			$row_om = $con_om->fetch_assoc();
			$mysqli->close();

			$_SESSION['alterar_om_sucesso'] = "Alteração da Unidade realizada com sucesso!<br /><br />Nova Unidade: ".$row_om['denominacao'];
			$_SESSION['botao'] = 'success';
		}
		else{
			$_SESSION['alterar_om_erro_bd'] = "ERRO U-01: Unidade não alterada, tente novamente!";
			$_SESSION['botao'] = "danger";
		}
	}
	else{
		$_SESSION['alterar_om_erro_validacao'] = "ERRO U-02: dados inconsistentes, preencha novamente o formulário!";
		$_SESSION['botao'] = "danger";

		$_SESSION['alterar_om_erro_validacao_lista'] = $validar->get_errors(); //Captura os erros de todos os campos
		$_SESSION['botao'] = "danger";
	}

	$_SESSION['pagina'] = $pagina;

	$flag = md5("om_alterar");
	header(sprintf("Location:../../".$pagina."?flag=$flag"));

}
else {

	include_once(PATH . '/contollers/autenticacao/'. ACESSO_NEGADO);
}
?>
