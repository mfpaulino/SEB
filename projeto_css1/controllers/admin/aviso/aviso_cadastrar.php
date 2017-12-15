<?php
/**************************************************************
* Local/nome do script: admin/aviso/aviso_cadastrar.php
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

	$titulo	  = isset($_POST['titulo']) ? mysqli_real_escape_string($mysqli, $_POST['titulo']) : "";
	$texto	  = isset($_POST['texto']) ? mysqli_real_escape_string($mysqli, $_POST['texto']) : "";
	$validade = converter_data($_POST["validade"], 'EN');

	$pub_cciex   = $_POST['pub_cciex'];
	$pub_icfex   = $_POST['pub_icfex'];
	$pub_unidade = $_POST['pub_unidade'];

	$publico = serialize(array($pub_cciex, $pub_icfex, $pub_unidade));

	$status      = isset($_POST['status']) ? $_POST['status'] : "Inativo";

	$autor = $cpf;

	$validar = new validaForm();

	$validar->set('Título', $titulo)->is_required()
			->set('Texto',  $texto)->is_required()
			->set('Validade',  $validade)->is_required();

	if ($validar->validate()){

		$busca_aviso = $mysqli->query("SELECT id_aviso FROM adm_avisos WHERE titulo = '$titulo' and status = '$status'");

		if($busca_aviso->num_rows > 0){

			$_SESSION['aviso_duplicada'] = "ERRO A-016: Aviso já publicado!";
			$_SESSION['botao'] = "danger";

			$validacao = false;
		}
		if($validacao !== false){

			$resultado = $mysqli->query("INSERT INTO adm_avisos (titulo, texto, autor, dt_validade, publico, status) VALUES ('$titulo','$texto','$autor','$validade','$publico','$status')");

			if($resultado){echo "ok";

				/** log **/
				$log = "Cadastrou o Aviso <u>" . $titulo . "</u>.";
				$con_log = $mysqli->query("INSERT INTO logs SET cpf = '$cpf', codom = '$codom_usuario', acao = '$log', tabela = 'adm_avisos'");
				/** fim log **/

				$_SESSION['sucesso_cadastro_aviso'] = "Cadastro realizado com sucesso!";
				$_SESSION['botao'] = "success";
			}
			else{echo "erro";

				$_SESSION['erro_cadastro_aviso'] = "ERRO A-017: cadastro não realizado, tente novamente!<br />Em caso de persistir o erro, entrar em contato com o suporte técnico.";
				$_SESSION['botao'] = "danger";
			}

		}
	}
	else {
		$_SESSION['erro_validacao_cadastrar_aviso'] = "ERRO A-018: dados inconsistentes, preencha novamente o formulário!";
		$_SESSION['botao'] = "danger";

		$_SESSION['lista_erro_validacao_cadastrar_aviso'] = $validar->get_errors(); //Captura os erros de todos os campos
	}
	$flag = md5("aviso_cadastrar");
	header(sprintf("Location:../../../admin.php?flag=$flag"));
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>
