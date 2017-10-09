<?php
//localidade_alterar.php
$inc = "sim";
include_once('../../config.inc.php');

if(isset($_POST['flag'])){

	require_once(PATH . '/controllers/autenticacao/autentica.inc.php');

	require_once(PATH . '/componentes/internos/php/validaForm.class.php');
	require_once(PATH . '/componentes/internos/php/funcoes.inc.php');

	$descricao 		= isset($_POST['descricao']) ? mysqli_real_escape_string($mysqli, $_POST['descricao']) : "";
	$descricao_atual = isset($_POST['descricao_atual']) ? mysqli_real_escape_string($mysqli, $_POST['descricao_atual']) : "";
	$id_localidade	= isset($_POST['id_localidade']) ? mysqli_real_escape_string($mysqli, $_POST['id_localidade']) : "";

	$validar = new validaForm();

	$validar->set('Descrição', 	$descricao)->is_required();

	$_SESSION['botao'] = "success";

	if ($validar->validate()){
		$altera = "nao";

		if ($descricao <> "" and $descricao <> $descricao_atual){

			$con_descricao = $mysqli->prepare("UPDATE adm_localidades SET descricao = ? WHERE id_localidade ='$id_localidade'");
			$con_descricao->bind_param('s', $descricao);
			$con_descricao->execute();

			if($con_descricao->affected_rows <> 0 ){
				$_SESSION['alterar_localidade'] = "A Localidade foi alterada com sucesso!";
				$altera = "sim";
			}
		}
		if($altera == "nao"){
			$_SESSION['alterar_nada'] = "AVISO: nenhuma alteração foi realizada!";
			$_SESSION['botao'] = "warning";
		}
	}
	else {
		$_SESSION['alterar_erro_validacao'] = "ERRO A-004: dados inconsistentes, preencha novamente o formulário!";
		$_SESSION['alterar_lista_erro_validacao'] = $validar->get_errors(); //Captura os erros de todos os campos
		$_SESSION['botao'] = "danger";
	}
	$flag = md5("localidade_alterar");
	header("Location:../../admin.php?flag=$flag");
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>