<?php
/**************************************************************
* Local/nome do script: usuario/cadastra.php
* Só executa se for chamado pelo formulario, senão chama o script de "acesso negado"
* Recebe todos os dados do formulario de cadastro de usuario
* Trata os valores recebidos com o método mysqli: mysqli_real_escape_string
* Usa a classe validaForm para fazer a validação dos dados
* Consulta o BD em busca de CPF e email para evitar duplicidade
* Em caso de erros, cria variaveis de sessão com mensagens de alertas que serão utilizadas
* pelo script usuario/alertas.inc.php(incluido pelo index.php)
* Em caso de tudo certo, grava no BD
* Ao final de tudo, redireciona para o index.php
* *************************************************************/
session_start();

require_once(__DIR__ . '/../componentes/internos/php/constantes.inc.php');

$_POST['flag'] = 1;

if (isset($_POST['flag'])){

	require_once(PATH . '/../componentes/internos/php/conexao.inc.php');
	require_once(PATH . '/../componentes/internos/php/cript.inc.php');
	require_once(PATH . '/../componentes/internos/php/validaForm.class.php');

	$cpf 		 = isset($_POST['cpf']) ? mysqli_real_escape_string($mysqli, $_POST['cpf']) : "";
	$senha 		 = isset($_POST['senha'])  ? mysqli_real_escape_string($mysqli, $_POST['senha']) : "";
	$senha1 	 = isset($_POST['senha1']) ? mysqli_real_escape_string($mysqli, $_POST['senha1']) : "";
	$rg 		 = isset($_POST['rg']) ? mysqli_real_escape_string($mysqli, $_POST['rg']) : "";
	$nome_guerra = isset($_POST['nome_guerra']) ? mysqli_real_escape_string($mysqli, $_POST['nome_guerra']) : "";
	$posto 		 = isset($_POST['posto']) ? mysqli_real_escape_string($mysqli, $_POST['posto']) : "";
	$nome 		 = isset($_POST['nome']) ? mysqli_real_escape_string($mysqli, $_POST['nome']) : "";
	$email 		 = isset($_POST['email']) ? mysqli_real_escape_string($mysqli, $_POST['email']) : "";
	$codom 		 = isset($_POST['codom']) ? mysqli_real_escape_string($mysqli, $_POST['codom']) : "";

	$validar = new validaForm();

	$validar->set('CPF', 			$cpf)->is_cpf()
			->set('Senha', 			$senha)->is_not_equals($cpf, true,"CPF")->min_length(8)->is_equals($senha1, true, "Confirmação da senha")
			->set('RG', 			$rg)->is_required()->is_num()
			->set('Posto', 			$posto)->is_required()
			->set('Nome', 			$nome)->is_required()
			->set('Nome de guerra', $nome_guerra)->is_required()
			->set('E-mail',			$email)->is_email()
			->set('Unidade', 		$codom)->is_required();

	if ($validar->validate()){

		$validacao == true;

		$busca_cpf = $mysqli->query("SELECT id_usuario FROM usuarios WHERE cpf = '$cpf'");

		if($busca_cpf->num_rows == 1){

			$_SESSION['duplo_cpf'] = "ERRO: CPF já existe!";

			$validacao = false;
		}

		$busca_email = $mysqli->query("SELECT id_usuario FROM usuarios WHERE email = '$email'");

		if($busca_email->num_rows == 1){

			$_SESSION['duplo_email'] = "ERRO: e-mail já foi cadastrado para outro usuário!";

			$validacao = false;
		}

		if($validacao == true){

			$senha_criptografada = encripta($cpf,$senha);

			$resultado = $mysqli->query("INSERT INTO usuarios (cpf, senha, rg, nome_guerra, nome, email, id_posto, codom) VALUES ('$cpf', '$senha_criptografada', '$rg', '$nome_guerra', '$nome', '$email', '$posto', '$codom')");

			if($resultado){

				$_SESSION['sucesso_cadastro'] = "Cadastro realizado com sucesso!";
			}
			else{

				$_SESSION['erro_cadastro'] = "ERRO: cadastro não realizado, tente novamente!<br />Em caso de persistir o erro, entrar em contato com o suporte técnico.";
			}

		}
	}
	else {
		$_SESSION['erro_validacao'] = "ERRO: dados inconsistentes, preencha novamente o formulário!";

		$_SESSION['lista_erro_validacao'] = $validar->get_errors(); //Captura os erros de todos os campos
	}

	header(sprintf("Location:../index.php?flag=cadastro_usuario"));
}
else {
	include_once(PATH . '/../autenticacao/'.ACESSO_NEGADO);
}
?>
