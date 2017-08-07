<?php
//usuario/cadastra.php

require_once(__DIR__ . '/../componentes/internos/php/constantes.inc.php');
$_POST['flag'] = 1;
if (isset($_POST['flag'])){

	require_once(__DIR__ . '/../componentes/internos/php/conexao.inc.php');
	require_once(__DIR__ . '/../componentes/internos/php/cript.inc.php');
	require_once(__DIR__ . '/../componentes/internos/php/validaForm.class.php');

/*
	$_POST['cpf'] = "9172517840";
	$_POST['senha'] = "9172517840";
	$_POST['senha1'] = "01038889";
	$_POST['rg'] = "0623900644";
	$_POST['nome_guerra'] = "mmmm";
	$_POST['posto'] = "2";
	$_POST['nome'] = "lll";
	$_POST['email'] = "mfpaulino2uol.com.br";
	$_POST['codom'] = "016139";
*/
	$cpf 		 = isset($_POST['cpf']) ? mysqli_real_escape_string($mysqli, $_POST['cpf']) : "";
	$senha 		 = isset($_POST['senha'])  ? mysqli_real_escape_string($mysqli, $_POST['senha']) : "";
	$senha1 	 = isset($_POST['senha1']) ? mysqli_real_escape_string($mysqli, $_POST['senha1']) : "";
	$rg 		 = isset($_POST['rg']) ? mysqli_real_escape_string($mysqli, $_POST['rg']) : "";
	$nome_guerra = isset($_POST['nome_guerra']) ? mysqli_real_escape_string($mysqli, $_POST['nome_guerra']) : "";
	$posto 		 = isset($_POST['posto']) ? mysqli_real_escape_string($mysqli, $_POST['posto']) : "";
	$nome 		 = isset($_POST['nome']) ? mysqli_real_escape_string($mysqli, $_POST['nome']) : "";
	$email 		 = isset($_POST['email']) ? mysqli_real_escape_string($mysqli, $_POST['email']) : "";
	$codom 		 = isset($_POST['codom']) ? mysqli_real_escape_string($mysqli, $_POST['codom']) : "";

		$valida1 = true;
		$valida2 = true;

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

		$busca_cpf = $mysqli->query("SELECT id_usuario FROM usuarios WHERE cpf = '$cpf'");

		if($busca_cpf->num_rows == 1){
			$flag = md5("ERRO: CPF já existe!");
			$valida1 = false;
			$msg = "cpf ja existe";
		}
		else{
			$busca_email = $mysqli->query("SELECT id_usuario FROM usuarios WHERE email = '$email'");

			if($busca_email->num_rows == 1){
				$flag = md5("ERRO: E-mail já foi cadastrado para outro usuário!");
				$valida1 = false;
				echo "email ja existe";
			}
		}
		if($valida1 == true){

			$senha_criptografada = encripta($cpf,$senha);

			$resultado = $mysqli->query("INSERT INTO usuarios (cpf, senha, rg, nome_guerra, nome, email, id_posto, codom) VALUES ('$cpf', '$senha_criptografada', '$rg', '$nome_guerra', '$nome', '$email', '$posto', '$codom')");

			if($resultado){ echo "cadastro ok";

				//$flag = md5("cadastro_ok");//cadastro com sucesso
				//header(sprintf("Location:../index.php?flag=$flag"));
			}
			else{echo "tudo certo mas nao cadastrou";

				//$flag = md5("cadastro_erro");//cadastro com erro
				//header(sprintf("Location:../index.php?flag=$flag"));
			}
		}
	}
	else {
		$valida2 = false;
	}
	if($valida2 == false){
		echo "erro da classe validarForm";
		$todos_erros = $validar->get_errors(); //Captura os erros de todos os campos
		//foreach ($validar->get_errors() as $erro){
			///echo '<p>' . $erro[0] . '</p>';
			 //$erros_senha = $validar->get_errors('Senha'); //Captura apenas os erros do campo 'nome'
			 //$qtde = count($erros_senha);
       //foreach ($erros_senha as $erro){
            //echo '<p>' . $erro . '</p>';
            $flag = array ($todos_erros['Senha'][0],$todos_erros['Senha'][1],$todos_erros['Senha'][2]);
			$flag1 = serialize($flag);
			//$flag1 = "sss";

		//$flag = md5("cadastro_erro");//cadastro com erro
		header(sprintf("Location:../index.php?flag=$flag1"));

       // }

		//}
	}
		/*
		$todos_erros = $validar->get_errors(); //Captura os erros de todos os campos
		foreach ($validar->get_errors() as $erro){
			echo '<p>' . $erro[0] . '</p>';
		}
		* */
		//$flag = md5("cadastro_erro");//cadastro com erro
		//header(sprintf("Location:../index.php?flag=$flag&fl=1"));

}
else {
	include_once(__DIR__ . '/../autenticacao/'.ACESSO_NEGADO);
}
?>
