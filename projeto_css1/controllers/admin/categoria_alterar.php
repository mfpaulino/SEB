<?php
//categoria_alterar.php

session_start();

$inc = "sim";
include_once('../../config.inc.php');

if(isset($_POST['flag']) and isset($_SESSION['cpf'])){

	require_once(PATH . '/controllers/autenticacao/autentica.inc.php');

	require_once(PATH . '/componentes/internos/php/validaForm.class.php');
	require_once(PATH . '/componentes/internos/php/funcoes.inc.php');

	$categoria 			= isset($_POST['categoria']) ? mysqli_real_escape_string($mysqli, $_POST['categoria']) : "";
	$categoria_atual 	= isset($_POST['categoria_atual']) ? mysqli_real_escape_string($mysqli, $_POST['categoria_atual']) : "";
	$localidade 		= isset($_POST['localidade']) ? mysqli_real_escape_string($mysqli, $_POST['localidade']) : "";
	$localidade_atual 	= isset($_POST['localidade_atual']) ? mysqli_real_escape_string($mysqli, $_POST['localidade_atual']) : "";
	$id_categoria		= isset($_POST['id_categoria']) ? mysqli_real_escape_string($mysqli, $_POST['id_categoria']) : "";

	$validar = new validaForm();

	$validar->set('Categoria', 	 $categoria)->is_required()
			->set('Localidades', $localidade)->is_required();

	$_SESSION['botao'] = "success";

	if ($validar->validate()){
		$altera = "nao";

		if (($categoria <> "" and $categoria <> $categoria_atual) or ($localidade <> "" and $localidade <> $localidade_atual)){

			$con_categoria = $mysqli->prepare("UPDATE adm_categorias SET categoria = ?, localidades = ? WHERE id_categoria ='$id_categoria'");
			$con_categoria->bind_param('ss', $categoria, $localidade);
			$resultado = $con_categoria->execute();

			if($resultado){
				$_SESSION['alterar_categoria'] = "A Categoria foi alterada com sucesso!";
				$altera = "sim";
			}
		}
		if($altera == "nao"){
			$_SESSION['alterar_nada_categoria'] = "AVISO: nenhuma alteração foi realizada!";
			$_SESSION['botao'] = "warning";
		}
	}
	else {
		$_SESSION['alterar_erro_validacao_categoria'] = "ERRO A-005: dados inconsistentes, preencha novamente o formulário!";
		$_SESSION['alterar_lista_erro_validacao_categoria'] = $validar->get_errors(); //Captura os erros de todos os campos
		$_SESSION['botao'] = "danger";
	}
	$flag = md5("categoria_alterar");
	header("Location:../../admin.php?flag=$flag");
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>