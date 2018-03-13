<?php
/**************************************************************
* Local/nome do script: admin/fonte_info_cadastrar.php
* Só executa se for chamado pelo formulario, senão chama o script de "acesso negado"
* primeiramente destroi as variaveis de sessao de alertas de usuario
* Recebe todos os dados do formulario de cadastro de fonte_info
* Trata os valores recebidos com o método mysqli: mysqli_real_escape_string
* Usa a classe validaForm para fazer a validação dos dados
* Consulta o BD em busca da fonte_info para evitar duplicidade
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

	$fonte_info	 = isset($_POST['fonte_info']) ? $_POST['fonte_info'] : "";

	$validar = new validaForm();

	$validar->set('Fonte de Informação', $fonte_info)->is_required();

	if ($validar->validate()){

		$busca_fonte_info = $mysqli->query("SELECT id_fonte_info FROM adm_fontes_informacao WHERE fonte_info = '$fonte_info'");


		if($busca_fonte_info->num_rows > 0){

			$_SESSION['fonte_info_duplicada'] = "ERRO 050: Fonte de Informação já cadastrada!";
			$_SESSION['botao'] = "danger";

			$validacao = false;
		}
		if($validacao !== false){

			$resultado = $mysqli->query("INSERT INTO adm_fontes_informacao (fonte_info) VALUES ('$fonte_info')");

			if($resultado){

				/** log **/
				$log = "Cadastrou a Fonte de Informação <u>" . $fonte_info . "</u>.";
				$con_log = $mysqli->query("INSERT INTO logs SET cpf = '$cpf', codom = '$codom_usuario', acao = '$log', tabela = 'adm_fontes_informacao'");
				/** fim log **/

				$_SESSION['sucesso_cadastro_fonte_info'] = "Cadastro realizado com sucesso!";
				$_SESSION['botao'] = "success";
			}
			else{

				$_SESSION['erro_cadastro_fonte_info'] = "ERRO 051: cadastro não realizado, tente novamente!<br />Em caso de persistir o erro, entrar em contato com o suporte técnico.";
				$_SESSION['botao'] = "danger";
			}

		}
	}
	else {
		$_SESSION['erro_validacao_cadastrar_fonte_info'] = "ERRO 052: dados inconsistentes, preencha novamente o formulário!";
		$_SESSION['botao'] = "danger";

		$_SESSION['lista_erro_validacao_cadastrar_fonte_info'] = $validar->get_errors(); //Captura os erros de todos os campos
	}
	$flag = md5("fonte_info_cadastrar");
	header(sprintf("Location:../../../admin.php?flag=$flag"));
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>
