<?php
//diaria_alterar.php

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

		$valor 			= isset($_POST['valor']) ? mysqli_real_escape_string($mysqli, $_POST['valor']) : "";

		$valor_atual 	= $_POST['valor_atual'];//tipo hidden
		$id_diaria		= $_POST['id_diaria'];//tipo hidden

		$valor = str_replace(",",".",str_replace(".","",$valor));
		$valor_atual = str_replace(",",".",str_replace(".","",$valor_atual));

		$validar = new validaForm();

		$validar->set('Valor', 	 $valor)->is_required();

		if ($validar->validate()){
			$altera = "nao";

			if ($valor <> "" and $valor <> $valor_atual){

				$con_diaria = $mysqli->prepare("UPDATE adm_diarias SET valor = ? WHERE id_diaria ='$id_diaria'");
				$con_diaria->bind_param('d', $valor);
				$resultado = $con_diaria->execute();

				if($resultado){

					$con_resultado = $mysqli->query("SELECT posto, categoria FROM adm_diarias ad, adm_categorias ac, postos p WHERE id_diaria = '$id_diaria' and ad.id_categoria = ac.id_categoria and ad.id_posto = p.id_posto");
					$row_resultado = $con_resultado->fetch_assoc();

					/** log **/
					$log = "Alterou o valor da diária (" . $row_resultado['posto'] . " x " . $row_resultado['categoria'] . ") de R$" . $valor_atual . " para R$" . $valor . ".";
					$con_log = $mysqli->query("INSERT INTO logs SET cpf = '$cpf', codom = '$codom_usuario', acao = '$log', tabela = 'adm_diarias'");
					/** fim log **/

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
			$_SESSION['alterar_erro_validacao_diaria'] = "ERRO A-010: dados inconsistentes, preencha novamente o formulário!";
			$_SESSION['alterar_lista_erro_validacao_diaria'] = $validar->get_errors(); //Captura os erros de todos os campos
			$_SESSION['botao'] = "danger";
		}
	}
	else if ($acao == "excluir"){

		$id_diaria = $_POST['diaria'];

		$con_del   = $mysqli->query("DELETE FROM adm_diarias WHERE id_diaria = '$id_diaria'");

		if($con_teste->num_rows == 0){

			$_SESSION['alterar_diaria'] = "Diária excluída com sucesso!";
		}
		else{
			$_SESSION['alterar_nada_diaria'] = "ERRO A-011: diária não excluída. Por favor, tente novamente!";
			$_SESSION['botao'] = "danger";
		}
	}
	$flag = md5("diaria_alterar");
	header("Location:../../../admin.php?flag=$flag");
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>