<?php
/**************************************************************
* Local/nome do script: usuario/habilitacao_cadastrar.php
* Só executa se for chamado pelo formulario, senão chama o script de "acesso negado"
* primeiramente destroi as variaveis de sessao de alertas de usuario
* Recebe todos os dados do formulario de cadastro de usuario
* Trata os valores recebidos com o método mysqli: mysqli_real_escape_string
* Usa a classe validaForm para fazer a validação dos dados
* Em caso de erros, cria variaveis de sessão com mensagens de alertas que serão utilizadas
* pelo script usuario/alertas.inc.php(incluido pelo index.php)
* Em caso de tudo certo, grava no BD
* Ao final de tudo, redireciona para o index.php
* *************************************************************/
session_start();

$inc = "sim";
include_once('../../config.inc.php');

if (isset($_POST['flag'])){

	require_once(PATH . '/componentes/internos/php/bcript.inc.php');
	require_once(PATH . '/componentes/internos/php/validaForm.class.php');
	require_once(PATH . '/componentes/internos/php/funcoes.inc.php');

	$area 		   = isset($_POST['area'])  ? mysqli_real_escape_string($mysqli, $_POST['area']) : "";
	$tipo 	 	   = isset($_POST['tipo']) ? mysqli_real_escape_string($mysqli, $_POST['tipo']) : "";
	$descricao 	   = isset($_POST['descricao']) ? mysqli_real_escape_string($mysqli, $_POST['descricao']) : "";
	$carga_horaria = isset($_POST['carga_horaria']) ? mysqli_real_escape_string($mysqli, formata_nome($_POST['carga_horaria'])) : "";
	$ano_conclusao = isset($_POST['ano_conclusao']) ? mysqli_real_escape_string($mysqli, $_POST['ano_conclusao']) : "";

	$validar = new validaForm();

	$validar->set('CPF', 			$cpf)->is_cpf()
			->set('Senha', 			$senha)->is_not_equals($cpf, true,"CPF")->min_length(8)->is_equals($senha1, true, "Confirmação da senha")
			->set('RG', 			$rg)->is_required()->is_num()
			->set('Posto', 			$posto)->is_required()
			->set('Nome', 			$nome)->is_required()
			->set('Nome de guerra', $nome_guerra)->is_required()
			->set('E-mail',			$email)->is_email()
			//->set('RITEx', 			$ritex)->is_num()
			//->set('Celular', 		$celular)->is_num()
			->set('Unidade', 		$codom)->is_required()
			->set('Perfil', 		$perfil)->is_required();


	if ($validar->validate()){

		$busca_cpf = $mysqli->query("SELECT id_usuario FROM usuarios WHERE cpf = '$cpf'");

		if($busca_cpf->num_rows == 1){

			$_SESSION['duplo_cpf'] = "ERRO U-01: CPF já existe!";
			$_SESSION['botao'] = "danger";

			$validacao = false;
		}

		$busca_email = $mysqli->query("SELECT id_usuario FROM usuarios WHERE email = '$email'");

		if($busca_email->num_rows == 1){

			$_SESSION['duplo_email'] = "ERRO U-02: e-mail já foi cadastrado para outro usuário!";
			$_SESSION['botao'] = "danger";

			$validacao = false;
		}

		if($validacao !== false){

			if ($_FILES['avatar']['name'] <> ''){

			  $ext = strtolower(substr($_FILES['avatar']['name'],-4)); //Pegando extensão do arquivo
			  $avatar = $cpf . $ext; //Definindo um novo nome para o arquivo
			  $dir = PATH . '/views/avatar/'; //Diretório para uploads

			  move_uploaded_file($_FILES['avatar']['tmp_name'], $dir.$avatar); //Fazer upload do arquivo
		    }
		    else {
				$avatar = "default_avatar.jpg";
			}

			$senha_criptografada = Bcrypt::hash($senha);

			$dt_cad = date('Y-m-d');

			$resultado = $mysqli->query("INSERT INTO usuarios (cpf, senha, rg, nome_guerra, nome, email, ritex, celular, avatar, dt_cad, id_posto, codom, id_perfil,status) VALUES ('$cpf', '$senha_criptografada', '$rg', '$nome_guerra', '$nome', '$email', '$ritex', '$celular', '$avatar', '$dt_cad','$posto', '$codom', '$perfil', 'Recebido')");

			if($resultado){

				$_SESSION['sucesso_cadastro'] = "Cadastro realizado com sucesso!";
				$_SESSION['botao'] = "success";
			}
			else{

				$_SESSION['erro_cadastro'] = "ERRO U-03: cadastro não realizado, tente novamente!<br />Em caso de persistir o erro, entrar em contato com o suporte técnico.";
				$_SESSION['botao'] = "danger";
			}

		}
	}
	else {
		$_SESSION['erro_validacao_cadastrar'] = "ERRO U-04: dados inconsistentes, preencha novamente o formulário!";
		$_SESSION['botao'] = "danger";

		$_SESSION['lista_erro_validacao_cadastrar'] = $validar->get_errors(); //Captura os erros de todos os campos
	}
	$flag = md5("usuario_cadastrar");
	header(sprintf("Location:../../index.php?flag=$flag"));
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>
