<?php
/**************************************************************
* Local/nome do script: admin/localidade_cadastrar.php
* Só executa se for chamado pelo formulario, senão chama o script de "acesso negado"
* primeiramente destroi as variaveis de sessao de alertas de usuario
* Recebe todos os dados do formulario de cadastro de usuario
* Trata os valores recebidos com o método mysqli: mysqli_real_escape_string
* Usa a classe validaForm para fazer a validação dos dados
* Consulta o BD em busca da Localidade para evitar duplicidade
* Em caso de erros, cria variaveis de sessão com mensagens de alertas que serão utilizadas
* pelo script admin/alertas.inc.php(incluido pelo admin.php)
* Em caso de tudo certo, grava no BD
* Ao final de tudo, redireciona para o admin.php
* *************************************************************/

session_start();

$inc = "sim";
include_once('../../config.inc.php');

if (isset($_POST['flag']) and isset($_SESSION['cpf'])){

	require_once(PATH . '/controllers/autenticacao/autentica.inc.php');

	require_once(PATH . '/componentes/internos/php/validaForm.class.php');
	require_once(PATH . '/componentes/internos/php/funcoes.inc.php');

	$descricao	 = isset($_POST['descricao']) ? mysqli_real_escape_string($mysqli, $_POST['descricao']) : "";

	$validar = new validaForm();

	$validar->set('Descrição', 		$descricao)->is_required();

	if ($validar->validate()){

		$busca_localidade = $mysqli->query("SELECT id_localidade FROM admin_localidades WHERE descricao = '$descricao'");

		if($busca_localidade->num_rows == 1){

			$_SESSION['dupla_localidade'] = "ERRO A-001: Localidade já cadastrada!";
			$_SESSION['botao'] = "danger";

			$validacao = false;
		}

		if($validacao !== false){


			$dt_cad = date('Y-m-d');

			$resultado = $mysqli->query("INSERT INTO adm_localidades (descricao) VALUES ('$descricao')");

			if($resultado){

				$_SESSION['sucesso_cadastro'] = "Cadastro realizado com sucesso!";
				$_SESSION['botao'] = "success";
			}
			else{

				$_SESSION['erro_cadastro'] = "ERRO A-002: cadastro não realizado, tente novamente!<br />Em caso de persistir o erro, entrar em contato com o suporte técnico.";
				$_SESSION['botao'] = "danger";
			}

		}
	}
	else {
		$_SESSION['erro_validacao_cadastrar'] = "ERRO A-003: dados inconsistentes, preencha novamente o formulário!";
		$_SESSION['botao'] = "danger";

		$_SESSION['lista_erro_validacao_cadastrar'] = $validar->get_errors(); //Captura os erros de todos os campos
	}
	$flag = md5("localidade_cadastrar");
	header(sprintf("Location:../../admin.php?flag=$flag"));
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>
