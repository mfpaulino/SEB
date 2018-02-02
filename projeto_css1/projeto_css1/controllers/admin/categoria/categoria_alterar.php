<?php
//categoria_alterar.php

session_start();

$inc = "sim";
include_once('../../../config.inc.php');

if(isset($_POST['flag']) and isset($_SESSION['cpf'])){

	$acao = $_POST['flag'];

	$_SESSION['botao'] = "success";

	require_once(PATH . '/controllers/autenticacao/autentica.inc.php');
	require_once(PATH . '/componentes/internos/php/validaForm.class.php');
	require_once(PATH . '/componentes/internos/php/funcoes.inc.php');

	if($acao == "alterar"){

		$categoria 			= isset($_POST['categoria']) ? mysqli_real_escape_string($mysqli, $_POST['categoria']) : "";
		$localidade 		= isset($_POST['localidade']) ? mysqli_real_escape_string($mysqli, $_POST['localidade']) : "";

		$categoria_atual 	= $_POST['categoria_atual'];//tipo hidden
		$localidade_atual 	= $_POST['localidade_atual'];//tipo hidden
		$id_categoria 		= $_POST['id_categoria'];//tipo hidden

		$validar = new validaForm();

		$validar->set('Categoria', 	 $categoria)->is_required()
			->set('Localidades', $localidade)->is_required();

		if ($validar->validate()){
			$altera = "nao";

			if (($categoria <> "" and $categoria <> $categoria_atual) or ($localidade <> "" and $localidade <> $localidade_atual)){

				$con_categoria = $mysqli->prepare("UPDATE adm_categorias SET categoria = ?, localidades = ? WHERE id_categoria ='$id_categoria'");
				$con_categoria->bind_param('ss', $categoria, $localidade);
				$resultado = $con_categoria->execute();

				if($resultado){

					/** log **/
					$log = "Alterou a categoria <u>" . $categoria . "</u>. De: (".$localidade_atual.") Para: (".$localidade.")";
					$con_log = $mysqli->query("INSERT INTO logs SET cpf = '$cpf', codom = '$codom_usuario', acao = '$log', tabela = 'adm_categorias'");
					/** fim log **/

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
			$_SESSION['alterar_erro_validacao_categoria'] = "ERRO 037: dados inconsistentes, preencha novamente o formulário!";
			$_SESSION['alterar_lista_erro_validacao_categoria'] = $validar->get_errors(); //Captura os erros de todos os campos
			$_SESSION['botao'] = "danger";
		}
	}
	else if($acao == "excluir"){

		$id_categoria = $_POST['categoria'];

		$con_del   = $mysqli->query("DELETE FROM adm_categorias WHERE id_categoria = '$id_categoria'");
		$con_teste = $mysqli->query("SELECT id_categoria FROM adm_categorias WHERE id_categoria = '$id_categoria'");

		if($con_teste->num_rows == 0){

			$_SESSION['alterar_categoria'] = "Categoria excluída com sucesso!";
		}
		else{
			$_SESSION['alterar_nada_categoria'] = "ERRO 038: categoria não excluída. Por favor, tente novamente!";
			$_SESSION['botao'] = "danger";
		}
	}
	$flag = md5("categoria_alterar");
	header("Location:../../../admin.php?flag=$flag");
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>