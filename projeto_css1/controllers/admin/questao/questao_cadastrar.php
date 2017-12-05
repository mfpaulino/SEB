<?php
/**************************************************************
* Local/nome do script: admin/questao/questao_cadastrar.php
* Só executa se for chamado pelo formulario, senão chama o script de "acesso negado"
* primeiramente destroi as variaveis de sessao de alertas de usuario
* Recebe todos os dados do formulario de cadastro de area
* Trata os valores recebidos com o método mysqli: mysqli_real_escape_string
* Usa a classe validaForm para fazer a validação dos dados
* Consulta o BD em busca da area para evitar duplicidade
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

	$questao	 = isset($_POST['questao']) ? mysqli_real_escape_string($mysqli, $_POST['questao']) : "";

	$validar = new validaForm();

	$validar->set('Questão', $questao)->is_required();

	if ($validar->validate()){

		$busca_questao = $mysqli->query("SELECT id_questao FROM adm_questoes WHERE questao = '$questao'");


		if($busca_questao->num_rows > 0){

			$_SESSION['questao_duplicada'] = "ERRO A-016: Questão já cadastrada!";
			$_SESSION['botao'] = "danger";

			$validacao = false;
		}
		if($validacao !== false){

			$resultado = $mysqli->query("INSERT INTO adm_questoes (questao) VALUES ('$questao')");

			if($resultado){

				/** log **/
				$log = "Cadastrou a Questão <u>" . $questao . "</u>.";
				$con_log = $mysqli->query("INSERT INTO logs SET cpf = '$cpf', codom = '$codom_usuario', acao = '$log', tabela = 'adm_questoes'");
				/** fim log **/

				$_SESSION['sucesso_cadastro_questao'] = "Cadastro realizado com sucesso!";
				$_SESSION['botao'] = "success";
			}
			else{

				$_SESSION['erro_cadastro_questao'] = "ERRO A-017: cadastro não realizado, tente novamente!<br />Em caso de persistir o erro, entrar em contato com o suporte técnico.";
				$_SESSION['botao'] = "danger";
			}

		}
	}
	else {
		$_SESSION['erro_validacao_cadastrar_questao'] = "ERRO A-018: dados inconsistentes, preencha novamente o formulário!";
		$_SESSION['botao'] = "danger";

		$_SESSION['lista_erro_validacao_cadastrar_questao'] = $validar->get_errors(); //Captura os erros de todos os campos
	}
	$flag = md5("questao_cadastrar");
	header(sprintf("Location:../../../admin.php?flag=$flag"));
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>
