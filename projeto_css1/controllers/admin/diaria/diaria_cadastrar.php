<?php
/**************************************************************
* Local/nome do script: admin/diaria_cadastrar.php
* Só executa se for chamado pelo formulario, senão chama o script de "acesso negado"
* primeiramente destroi as variaveis de sessao de alertas de usuario
* Recebe todos os dados do formulario de cadastro de diaria
* Trata os valores recebidos com o método mysqli: mysqli_real_escape_string
* Usa a classe validaForm para fazer a validação dos dados
* Consulta o BD em busca da categoria para evitar duplicidade
* Em caso de erros, cria variaveis de sessão com mensagens de alertas que serão utilizadas
* pelo script admin/alertas.inc.php(incluido pelo admin.php)
* Em caso de tudo certo, grava no BD
* Ao final de tudo, redireciona para o admin.php
* *************************************************************/

session_start();

$inc = "sim";
include_once('../../../config.inc.php');

if (isset($_POST['flag']) and isset($_SESSION['cpf'])){

	require_once(PATH . '/controllers/autenticacao/autentica.inc.php');

	require_once(PATH . '/componentes/internos/php/validaForm.class.php');
	require_once(PATH . '/componentes/internos/php/funcoes.inc.php');

	$categoria	 = isset($_POST['categoria']) ? mysqli_real_escape_string($mysqli, $_POST['categoria']) : "";
	$posto  = isset($_POST['posto']) ? mysqli_real_escape_string($mysqli, $_POST['posto']) : "";
	$valor  = isset($_POST['valor']) ? mysqli_real_escape_string($mysqli, $_POST['valor']) : "";
	$valor = str_replace(",",".",str_replace(".","",$valor));

	$validar = new validaForm();

	$validar->set('Categoria', 	 $categoria)->is_required()
			->set('Posto/grad', $posto)->is_required()
			->set('Valor', $valor)->is_required()->is_num()->is_positive();

	if ($validar->validate()){

		$busca_diaria = $mysqli->query("SELECT id_diaria FROM adm_diarias WHERE id_categoria = '$categoria' and id_posto = '$posto'");

		if($busca_diaria->num_rows > 0){

			$_SESSION['diaria_duplicada'] = "ERRO A-007: diária já cadastrada!";
			$_SESSION['botao'] = "danger";

			$validacao = false;
		}
		if($validacao !== false){

			//$dt_cad = date('Y-m-d');

			$resultado = $mysqli->query("INSERT INTO adm_diarias (id_posto, id_categoria, valor) VALUES ('$posto','$categoria','$valor')");

			if($resultado){

				$_SESSION['sucesso_cadastro_diaria'] = "Cadastro realizado com sucesso!";
				$_SESSION['botao'] = "success";
			}
			else{

				$_SESSION['erro_cadastro_diaria'] = "ERRO A-008: cadastro não realizado, tente novamente!<br />Em caso de persistir o erro, entrar em contato com o suporte técnico.";
				$_SESSION['botao'] = "danger";
			}

		}
	}
	else {
		$_SESSION['erro_validacao_cadastrar_diaria'] = "ERRO A-009: dados inconsistentes, preencha novamente o formulário!";
		$_SESSION['botao'] = "danger";

		$_SESSION['lista_erro_validacao_cadastrar_diaria'] = $validar->get_errors(); //Captura os erros de todos os campos
	}
	$flag = md5("diaria_cadastrar");
	header(sprintf("Location:../../../admin.php?flag=$flag"));
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>
