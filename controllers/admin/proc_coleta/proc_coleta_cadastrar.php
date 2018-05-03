<?php
/**************************************************************
* Local/nome do script: admin/proc_coleta/proc_coleta_cadastrar.php
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

	$proc_coleta	 = isset($_POST['proc_coleta']) ? $_POST['proc_coleta'] : "";

	$validar = new validaForm();

	$validar->set('Procedimento de Coleta de Dados', $proc_coleta)->is_required();

	if ($validar->validate()){

		$busca_proc_coleta = $mysqli->query("SELECT id_proc_coleta FROM adm_proc_coleta WHERE proc_coleta = '$proc_coleta'");


		if($busca_proc_coleta->num_rows > 0){

			$_SESSION['proc_coleta_duplicada'] = "ERRO 070: Procedimento de Análise já cadastrado!";
			$_SESSION['botao'] = "danger";

			$validacao = false;
		}
		if($validacao !== false){

			$resultado = $mysqli->query("INSERT INTO adm_proc_coleta (proc_coleta) VALUES ('$proc_coleta')");

			if($resultado){

				/** log **/
				$log = "Cadastrou o Procedimento de Análise <u>" . $proc_coleta . "</u>.";
				$con_log = $mysqli->query("INSERT INTO logs SET cpf = '$cpf', codom = '$codom_usuario', acao = '$log', tabela = 'adm_proc_coleta'");
				/** fim log **/

				$_SESSION['sucesso_cadastro_proc_coleta'] = "Cadastro realizado com sucesso!";
				$_SESSION['botao'] = "success";
			}
			else{

				$_SESSION['erro_cadastro_proc_coleta'] = "ERRO 071: cadastro não realizado, tente novamente!<br />Em caso de persistir o erro, entrar em contato com o suporte técnico.";
				$_SESSION['botao'] = "danger";
			}

		}
	}
	else {
		$_SESSION['erro_validacao_cadastrar_proc_coleta'] = "ERRO 072: dados inconsistentes, preencha novamente o formulário!";
		$_SESSION['botao'] = "danger";

		$_SESSION['lista_erro_validacao_cadastrar_proc_coleta'] = $validar->get_errors(); //Captura os erros de todos os campos
	}
	$flag = md5("proc_coleta_cadastrar");
	header(sprintf("Location:../../../admin.php?flag=$flag"));
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>
