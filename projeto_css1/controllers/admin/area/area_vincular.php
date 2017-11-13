<?php
/**************************************************************
* Local/nome do script: admin/area/area_vincular.php
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

	//require_once(PATH . '/componentes/internos/php/validaForm.class.php');
	//require_once(PATH . '/componentes/internos/php/funcoes.inc.php');

	//$area	 = isset($_POST['id_area']) ? mysqli_real_escape_string($mysqli, $_POST['id_area']) : "";

	//$validar = new validaForm();

	//$validar->set('Área', $area)->is_required();

	//if ($validar->validate()){

		$busca_subarea = $mysqli->query("SELECT id_subarea FROM adm_subareas");
		$qtde = $busca_subarea->num_rows;
		for($i = 1; $i <= $qtde; $i++){
			$id_subarea = $_POST[$i];
			echo $id_subarea;
		}

/*
		if($busca_subarea->num_rows > 0){

			$_SESSION['area_duplicada'] = "ERRO A-016: Área já cadastrada!";
			$_SESSION['botao'] = "danger";

			$validacao = false;
		}
		if($validacao !== false){

			$resultado = $mysqli->query("INSERT INTO adm_areas (area) VALUES ('$area')");

			if($resultado){

				/** log **/
	//			$log = "Cadastrou a Área <u>" . $area . "</u>.";
		//		$con_log = $mysqli->query("INSERT INTO logs SET cpf = '$cpf', codom = '$codom_usuario', acao = '$log', tabela = 'adm_areas'");
				/** fim log **/

	//			$_SESSION['sucesso_cadastro_area'] = "Cadastro realizado com sucesso!";
		//		$_SESSION['botao'] = "success";
	//		}
	//		else{

	//			$_SESSION['erro_cadastro_area'] = "ERRO A-017: cadastro não realizado, tente novamente!<br />Em caso de persistir o erro, entrar em contato com o suporte técnico.";
	//			$_SESSION['botao'] = "danger";
	//		}

//		}
	//}
	//else {
		//$_SESSION['erro_validacao_cadastrar_area'] = "ERRO A-018: dados inconsistentes, preencha novamente o formulário!";
		//$_SESSION['botao'] = "danger";

		//$_SESSION['lista_erro_validacao_cadastrar_area'] = $validar->get_errors(); //Captura os erros de todos os campos
	//}
	$flag = md5("area_cadastrar");
	//header(sprintf("Location:../../../admin.php?flag=$flag"));
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>
