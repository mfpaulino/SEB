<?php
/**************************************************************
* Local/nome do script: admin/poss_achado/poss_achado_cadastrar.php
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

	$poss_achado	 = isset($_POST['poss_achado']) ? mysqli_real_escape_string($mysqli, $_POST['poss_achado']) : "";

	$validar = new validaForm();

	$validar->set('Possível Achado', $poss_achado)->is_required();

	if ($validar->validate()){

		$busca_poss_achado = $mysqli->query("SELECT id_poss_achado FROM adm_poss_achados WHERE poss_achado = '$poss_achado'");


		if($busca_poss_achado->num_rows > 0){

			$_SESSION['poss_achado_duplicada'] = "ERRO 060: Possível Achado já cadastrado!";
			$_SESSION['botao'] = "danger";

			$validacao = false;
		}
		if($validacao !== false){

			$resultado = $mysqli->query("INSERT INTO adm_poss_achados (poss_achado) VALUES ('$poss_achado')");

			if($resultado){

				/** log **/
				$log = "Cadastrou o Possível Achado <u>" . $poss_achado . "</u>.";
				$con_log = $mysqli->query("INSERT INTO logs SET cpf = '$cpf', codom = '$codom_usuario', acao = '$log', tabela = 'adm_poss_achados'");
				/** fim log **/

				$_SESSION['sucesso_cadastro_poss_achado'] = "Cadastro realizado com sucesso!";
				$_SESSION['botao'] = "success";
			}
			else{

				$_SESSION['erro_cadastro_poss_achado'] = "ERRO 061: cadastro não realizado, tente novamente!<br />Em caso de persistir o erro, entrar em contato com o suporte técnico.";
				$_SESSION['botao'] = "danger";
			}

		}
	}
	else {
		$_SESSION['erro_validacao_cadastrar_poss_achado'] = "ERRO 062: dados inconsistentes, preencha novamente o formulário!";
		$_SESSION['botao'] = "danger";

		$_SESSION['lista_erro_validacao_cadastrar_poss_achado'] = $validar->get_errors(); //Captura os erros de todos os campos
	}
	$flag = md5("poss_achado_cadastrar");
	header(sprintf("Location:../../../admin.php?flag=$flag"));
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>
