<?php
/**************************************************************
* Local/nome do script: usuario/habilitacao_cadastrar.php
* Só executa se for chamado pelo formulario, senão chama o script de "acesso negado"
* primeiramente destroi as variaveis de sessao de alertas de usuario
* Recebe todos os dados do formulario de cadastro de usuario
* Trata os valores recebidos com o método mysqli: mysqli_real_escape_string
* Usa a classe validaForm para fazer a validação dos dados
* Em caso de erros, cria variaveis de sessão com mensagens de alertas que serão utilizadas
* pelo script usuario/alertas.inc.php(incluido pelo index.php)
* Em caso de tudo certo, grava no BD
* Ao final de tudo, redireciona para o index.php
* *************************************************************/
session_start();

$inc = "sim";
include_once('../../config.inc.php');

if (isset($_POST['flag']) and isset($_SESSION['cpf'])){

	require_once(PATH . '/controllers/autenticacao/autentica.inc.php');
	require_once(PATH . '/componentes/internos/php/validaForm.class.php');

	$pagina 	 = $_POST['flag1'];

	$area 		   = isset($_POST['area'])  ? mysqli_real_escape_string($mysqli, $_POST['area']) : "";
	$tipo 	 	   = isset($_POST['tipo']) ? mysqli_real_escape_string($mysqli, $_POST['tipo']) : "";
	$descricao 	   = isset($_POST['descricao']) ? mysqli_real_escape_string($mysqli, $_POST['descricao']) : "";
	$carga_horaria = isset($_POST['carga_horaria']) ? mysqli_real_escape_string($mysqli, $_POST['carga_horaria']) : "";
	$ano_conclusao = isset($_POST['ano_conclusao']) ? mysqli_real_escape_string($mysqli, $_POST['ano_conclusao']) : "";

	$validar = new validaForm();

	if($tipo == "Experiência"){
		$validar->set('Área', 		$area)->is_required()
			->set('Tipo', 			$tipo)->is_required()
			->set('Descrição', 		$descricao)->is_required();
	}
	else{
		$ano2 = date('Y');
		$ano1 = $ano2 - 19;

		$validar->set('Área', 		$area)->is_required()
			->set('Tipo', 			$tipo)->is_required()
			->set('Descrição', 		$descricao)->is_required()
			->set('Carga-horária', 	$carga_horaria)->is_required()
			->set('Ano de conclusão',  $ano_conclusao)->is_required()->between_values($ano1, $ano2);//aceita cursos dos ultimos 20 anos
	}

	if ($validar->validate()){

			$resultado = $mysqli->query("INSERT INTO usuarios_habilitacao (cpf, id_area, tipo, descricao, carga_horaria, ano_conclusao) VALUES ('$cpf', '$area', '$tipo', '$descricao', '$carga_horaria', '$ano_conclusao')");

			if($resultado){

				$_SESSION['sucesso_cadastro_habilitacao'] = "Cadastro realizado com sucesso!";
				$_SESSION['botao'] = "success";
			}
			else{

				$_SESSION['erro_cadastro_habilitacao'] = "ERRO U-03: cadastro não realizado, tente novamente!<br />Em caso de persistir o erro, entrar em contato com o suporte técnico.";
				$_SESSION['botao'] = "danger";
			}
	}
	else {
		$_SESSION['erro_validacao_cadastrar_habilitacao'] = "ERRO U-04: dados inconsistentes, preencha novamente o formulário!";
		$_SESSION['botao'] = "danger";

		$_SESSION['lista_erro_validacao_cadastrar_habilitacao'] = $validar->get_errors(); //Captura os erros de todos os campos
	}
	$flag = md5("habilitacao_cadastrar");
	header(sprintf("Location:../../".$pagina."?flag=$flag"));//redireciona para a pagina que chamou o script
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>
