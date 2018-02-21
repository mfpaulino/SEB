<?php
//habilitacao_alterar.php

session_start();

$inc = "sim";
include_once('../../config.inc.php');

if(isset($_POST['flag']) and isset($_SESSION['cpf'])){

	$acao = $_POST['flag'];

	$pagina = $_POST['flag1'];

	$id_habilitacao = $_POST['id_habilitacao'];//tipo hidden

	$_SESSION['botao'] = "success";

	require_once(PATH . '/controllers/autenticacao/autentica.inc.php');
	require_once(PATH . '/componentes/internos/php/validaForm.class.php');

	if($acao == "alterar"){

		$area 		   = isset($_POST['area'])  ? mysqli_real_escape_string($mysqli, $_POST['area']) : "";
		$tipo 	 	   = isset($_POST['tipo']) ? mysqli_real_escape_string($mysqli, $_POST['tipo']) : "";
		$descricao 	   = isset($_POST['descricao']) ? mysqli_real_escape_string($mysqli, $_POST['descricao']) : "";
		$carga_horaria = isset($_POST['carga_horaria']) ? mysqli_real_escape_string($mysqli, $_POST['carga_horaria']) : "";
		$ano_conclusao = isset($_POST['ano_conclusao']) ? mysqli_real_escape_string($mysqli, $_POST['ano_conclusao']) : "";

		$area_atual 			= $_POST['area_atual'];//tipo hidden
		$tipo_atual				= $_POST['tipo_atual'];//tipo hidden
		$descricao_atual		= $_POST['descricao_atual'];//tipo hidden
		$carga_horaria_atual	= $_POST['carga_horaria_atual'];//tipo hidden
		$ano_conclusao_atual	= $_POST['ano_conclusao_atual'];//tipo hidden


		$validar = new validaForm();

		if($tipo == "Experiência profissional"){

			$carga_horaria = "---";
			$ano_conclusao = "---";

			$validar->set('Área', 		$area)->is_required()
				->set('Tipo', 			$tipo)->is_required()
				->set('Descrição', 		$descricao)->is_required();
		}
		else{
			$ano2 = date('Y');
			$ano1 = $ano2 - 39;

			$validar->set('Área', 		$area)->is_required()
				->set('Tipo', 			$tipo)->is_required()
				->set('Descrição', 		$descricao)->is_required()
				->set('Carga-horária', 	$carga_horaria)->is_required()->is_num()
				->set('Ano de conclusão',  $ano_conclusao)->is_required()->between_values($ano1, $ano2);//aceita cursos dos ultimos 40 anos
		}

		if ($validar->validate()){
			$altera = "nao";

			$arr_area = explode('|',$area);//o select arrea retorna o id_area|area
			$area = $arr_area[0];

			if ($area <> "" and $area <> $area_atual){

				$con_area = $mysqli->prepare("UPDATE usuarios_habilitacao SET id_area = ? WHERE id_habilitacao ='$id_habilitacao'");
				$con_area->bind_param('i', $area);
				$resultado = $con_area->execute();
			}

			if ($tipo <> "" and $tipo <> $tipo_atual){

				$con_tipo = $mysqli->prepare("UPDATE usuarios_habilitacao SET tipo = ? WHERE id_habilitacao ='$id_habilitacao'");
				$con_tipo->bind_param('s', $tipo);
				$resultado = $con_tipo->execute();
			}

			if ($descricao <> "" and $descricao <> $descricao_atual){

				$con_descricao = $mysqli->prepare("UPDATE usuarios_habilitacao SET descricao = ? WHERE id_habilitacao ='$id_habilitacao'");
				$con_descricao->bind_param('s', $descricao);
				$resultado = $con_descricao->execute();
			}

			if ($carga_horaria <> "" and $carga_horaria <> $carga_horaria_atual){

				$con_carga_horaria = $mysqli->prepare("UPDATE usuarios_habilitacao SET carga_horaria = ? WHERE id_habilitacao ='$id_habilitacao'");
				$con_carga_horaria->bind_param('s', $carga_horaria);
				$resultado = $con_carga_horaria->execute();
			}

			if ($ano_conclusao <> "" and $ano_conclusao <> $ano_conclusao_atual){

				$con_ano_conclusao = $mysqli->prepare("UPDATE usuarios_habilitacao SET ano_conclusao = ? WHERE id_habilitacao ='$id_habilitacao'");
				$con_ano_conclusao->bind_param('s', $ano_conclusao);
				$ano_conclusao = $con_ano_conclusao->execute();
			}

			if($resultado){

				/** log **/
				$log = "Alterou dados referentes à habilitação.";
				$con_log = $mysqli->query("INSERT INTO logs SET cpf = '$cpf', codom = '$codom_usuario', acao = '$log', tabela = 'usuarios_habilitacao'");
				/** fim log **/

				$_SESSION['alterar_habilitacao'] = "Habilitação alterada com sucesso!";
				$altera = "sim";
			}
			if($altera == "nao"){
				$_SESSION['alterar_nada_habilitacao'] = "AVISO: nenhuma alteração foi realizada!";
				$_SESSION['botao'] = "warning";
			}
		}
		else {
			$_SESSION['alterar_erro_validacao_habilitacao'] = "ERRO 011: dados inconsistentes, preencha novamente o formulário!";
			$_SESSION['alterar_lista_erro_validacao_habilitacao'] = $validar->get_errors(); //Captura os erros de todos os campos
			$_SESSION['botao'] = "danger";
		}
	}
	else if($acao == "excluir"){

		$con_del   = $mysqli->query("DELETE FROM usuarios_habilitacao WHERE id_habilitacao = '$id_habilitacao'");
		$con_teste = $mysqli->query("SELECT id_habilitacao FROM usuarios_habilitacao WHERE id_habilitacao = '$id_habilitacao'");

		if($con_teste->num_rows == 0){

			/** log **/
			$log = "Excluiu uma de suas habilitações.";
			$con_log = $mysqli->query("INSERT INTO logs SET cpf = '$cpf', codom = '$codom_usuario', acao = '$log', tabela = 'usuarios_habilitacao'");
			/** fim log **/

			$_SESSION['excluir_habilitacao'] = "Habilitacao excluída com sucesso!";
		}
		else{
			$_SESSION['excluir_erro_habilitacao'] = "ERRO 012: habilitação não excluída. Por favor, tente novamente!";
			$_SESSION['botao'] = "danger";
		}
	}
	$flag = md5("habilitacao_alterar");
	header(sprintf("Location:../../".$pagina."?flag=$flag"));//redireciona para a pagina que chamou o script
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>