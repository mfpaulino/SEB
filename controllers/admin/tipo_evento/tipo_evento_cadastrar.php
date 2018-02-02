<?php
/**************************************************************
* Local/nome do script: admin/tipo_evento_cadastrar.php
* Só executa se for chamado pelo formulario, senão chama o script de "acesso negado"
* primeiramente destroi as variaveis de sessao de alertas de usuario
* Recebe todos os dados do formulario de cadastro de tipo_evento
* Trata os valores recebidos com o método mysqli: mysqli_real_escape_string
* Usa a classe validaForm para fazer a validação dos dados
* Consulta o BD em busca da tipo_evento para evitar duplicidade
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

	$tipo_evento	 = isset($_POST['tipo_evento']) ? mysqli_real_escape_string($mysqli, $_POST['tipo_evento']) : "";

	$validar = new validaForm();

	$validar->set('Tipo de Evento', $tipo_evento)->is_required();

	if ($validar->validate()){

		$busca_tipo_evento = $mysqli->query("SELECT id_tipo_evento FROM adm_tipo_evento WHERE tipo_evento = '$tipo_evento'");


		if($busca_tipo_evento->num_rows > 0){

			$_SESSION['tipo_evento_duplicada'] = "ERRO 085: Tipo de Auditoria já cadastrado!";
			$_SESSION['botao'] = "danger";

			$validacao = false;
		}
		if($validacao !== false){

			$resultado = $mysqli->query("INSERT INTO adm_tipo_evento (tipo_evento) VALUES ('$tipo_evento')");

			if($resultado){

				/** log **/
				$log = "Cadastrou o Tipo de Auditoria <u>" . $tipo_evento . "</u>.";
				$con_log = $mysqli->query("INSERT INTO logs SET cpf = '$cpf', codom = '$codom_usuario', acao = '$log', tabela = 'adm_tipo_evento'");
				/** fim log **/

				$_SESSION['sucesso_cadastro_tipo_evento'] = "Cadastro realizado com sucesso!";
				$_SESSION['botao'] = "success";
			}
			else{

				$_SESSION['erro_cadastro_tipo_evento'] = "ERRO 086: cadastro não realizado, tente novamente!<br />Em caso de persistir o erro, entrar em contato com o suporte técnico.";
				$_SESSION['botao'] = "danger";
			}

		}
	}
	else {
		$_SESSION['erro_validacao_cadastrar_tipo_evento'] = "ERRO 087: dados inconsistentes, preencha novamente o formulário!";
		$_SESSION['botao'] = "danger";

		$_SESSION['lista_erro_validacao_cadastrar_tipo_evento'] = $validar->get_errors(); //Captura os erros de todos os campos
	}
	$flag = md5("tipo_evento_cadastrar");
	header(sprintf("Location:../../../admin.php?flag=$flag"));
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>
