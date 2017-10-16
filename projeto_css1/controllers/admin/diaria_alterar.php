<?php
//diaria_alterar.php

session_start();

$inc = "sim";
include_once('../../config.inc.php');

if(isset($_POST['flag']) and isset($_SESSION['cpf'])){

	require_once(PATH . '/controllers/autenticacao/autentica.inc.php');

	require_once(PATH . '/componentes/internos/php/validaForm.class.php');
	require_once(PATH . '/componentes/internos/php/funcoes.inc.php');

	$valor 			= isset($_POST['valor']) ? mysqli_real_escape_string($mysqli, $_POST['valor']) : "";
	$valor_atual 	= isset($_POST['valor_atual']) ? mysqli_real_escape_string($mysqli, $_POST['valor_atual']) : "";
	$id_diaria		= isset($_POST['id_diaria']) ? mysqli_real_escape_string($mysqli, $_POST['id_diaria']) : "";

	$valor = str_replace(",",".",str_replace(".","",$valor));
	$valor_atual = str_replace(",",".",str_replace(".","",$valor_atual));

	$validar = new validaForm();

	$validar->set('Valor', 	 $valor)->is_required();

	$_SESSION['botao'] = "success";

	if ($validar->validate()){
		$altera = "nao";

		if ($valor <> "" and $valor <> $valor_atual){

			$con_diaria = $mysqli->prepare("UPDATE adm_diarias SET valor = ? WHERE id_diaria ='$id_diaria'");
			$con_diaria->bind_param('d', $valor);
			$resultado = $con_diaria->execute();

			if($resultado){
				$_SESSION['alterar_diaria'] = "A Diária foi alterada com sucesso!";
				$altera = "sim";
			}
		}
		if($altera == "nao"){
			$_SESSION['alterar_nada_diaria'] = "AVISO: nenhuma alteração foi realizada!";
			$_SESSION['botao'] = "warning";
		}
	}
	else {
		$_SESSION['alterar_erro_validacao_diaria'] = "ERRO A-004: dados inconsistentes, preencha novamente o formulário!";
		$_SESSION['alterar_lista_erro_validacao_diaria'] = $validar->get_errors(); //Captura os erros de todos os campos
		$_SESSION['botao'] = "danger";
	}
	$flag = md5("diaria_alterar");
	header("Location:../../admin.php?flag=$flag");
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>