<?php
/**************************************************************
* Local/nome do script: admin/info_req/info_req_cadastrar.php
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

	$info_req	 = isset($_POST['info_req']) ? mysqli_real_escape_string($mysqli, $_POST['info_req']) : "";

	$validar = new validaForm();

	$validar->set('Informação Requerida', $info_req)->is_required();

	if ($validar->validate()){

		$busca_info_req = $mysqli->query("SELECT id_info_req FROM adm_info_requeridas WHERE info_req = '$info_req'");


		if($busca_info_req->num_rows > 0){

			$_SESSION['info_req_duplicada'] = "ERRO 055: Informação Requerida já cadastrada!";
			$_SESSION['botao'] = "danger";

			$validacao = false;
		}
		if($validacao !== false){

			$resultado = $mysqli->query("INSERT INTO adm_info_requeridas (info_req) VALUES ('$info_req')");

			if($resultado){

				/** log **/
				$log = "Cadastrou a Informação Requerida <u>" . $info_req . "</u>.";
				$con_log = $mysqli->query("INSERT INTO logs SET cpf = '$cpf', codom = '$codom_usuario', acao = '$log', tabela = 'adm_info_requeridas'");
				/** fim log **/

				$_SESSION['sucesso_cadastro_info_req'] = "Cadastro realizado com sucesso!";
				$_SESSION['botao'] = "success";
			}
			else{

				$_SESSION['erro_cadastro_info_req'] = "ERRO 056: cadastro não realizado, tente novamente!<br />Em caso de persistir o erro, entrar em contato com o suporte técnico.";
				$_SESSION['botao'] = "danger";
			}

		}
	}
	else {
		$_SESSION['erro_validacao_cadastrar_info_req'] = "ERRO 057: dados inconsistentes, preencha novamente o formulário!";
		$_SESSION['botao'] = "danger";

		$_SESSION['lista_erro_validacao_cadastrar_info_req'] = $validar->get_errors(); //Captura os erros de todos os campos
	}
	$flag = md5("info_req_cadastrar");
	header(sprintf("Location:../../../admin.php?flag=$flag"));
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>
