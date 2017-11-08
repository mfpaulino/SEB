<?php
/**************************************************************
* Local/nome do script: admin/subarea_cadastrar.php
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

	$area = isset($_POST['area']) ? $_POST['area'] : "";
	$subarea = isset($_POST['subarea']) ? $_POST['subarea'] : "";

	$area = explode("|", $area);
	$id_area = $area[0];

	$validar = new validaForm();

	$validar->set('Área', $area)->is_required()
			->set('Subárea', $subarea)->is_required();

	if ($validar->validate()){

		$busca_subarea = $mysqli->query("SELECT id_subarea FROM adm_subareas WHERE subarea = '$subarea' and id_area = '$id_area'");


		if($busca_subarea->num_rows > 0){

			$_SESSION['subarea_duplicada'] = "ERRO A-021: Subárea já cadastrada!";
			$_SESSION['botao'] = "danger";

			$validacao = false;
		}
		if($validacao !== false){

			$resultado = $mysqli->query("INSERT INTO adm_subareas (subarea, id_area) VALUES ('$subarea','$id_area')");

			if($resultado){

				/** log **/
				$log = "Cadastrou a Subárea <u>" . $subarea . "</u> para a Área <u>".$area[1]."</u>.";
				$con_log = $mysqli->query("INSERT INTO logs SET cpf = '$cpf', codom = '$codom_usuario', acao = '$log', tabela = 'adm_subareas'");
				/** fim log **/

				$_SESSION['sucesso_cadastro_subarea'] = "Cadastro realizado com sucesso!";
				$_SESSION['botao'] = "success";
			}
			else{

				$_SESSION['erro_cadastro_subarea'] = "ERRO A-022: cadastro não realizado, tente novamente!<br />Em caso de persistir o erro, entrar em contato com o suporte técnico.";
				$_SESSION['botao'] = "danger";
			}

		}
	}
	else {
		$_SESSION['erro_validacao_cadastrar_subarea'] = "ERRO A-023: dados inconsistentes, preencha novamente o formulário!";
		$_SESSION['botao'] = "danger";

		$_SESSION['lista_erro_validacao_cadastrar_subarea'] = $validar->get_errors(); //Captura os erros de todos os campos
	}
	$flag = md5("subarea_cadastrar");
	header(sprintf("Location:../../../admin.php?flag=$flag"));
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>
