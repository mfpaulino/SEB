<?php
/**************************************************************
* Local/nome do script: correio/correio_cadastrar.php
* Só executa se for chamado pelo formulario, senão chama o script de "acesso negado"
* primeiramente destroi as variaveis de sessao de alertas de usuario
* Recebe todos os dados do formulario de criacao de msg
* Trata os valores recebidos com o método mysqli: mysqli_real_escape_string
* Usa a classe validaForm para fazer a validação dos dados
* Em caso de erros, cria variaveis de sessão com mensagens de alertas que serão utilizadas
* pelo script usuario/alertas.inc.php(incluido pelo index.php)
* Em caso de tudo certo, grava no BD
* Ao final de tudo, redireciona para o mailbox_input.php
* *************************************************************/
session_start();

$inc = "sim";

		include_once('../../config.inc.php');

if (isset($_POST['flag'])){
	require_once(PATH . '/controllers/autenticacao/autentica.inc.php');
	require_once(PATH . '/componentes/internos/php/validaForm.class.php');

	$assunto		= isset($_POST['assunto'])  ? mysqli_real_escape_string($mysqli, $_POST['assunto']) : "";
	$assunto		= ($assunto <> "") ? $assunto : "Sem assunto";
	$texto 	 		= isset($_POST['texto']) ? mysqli_real_escape_string($mysqli, $_POST['texto']) : "";
	$data			= isset($_POST['data']) ? mysqli_real_escape_string($mysqli, $_POST['data']) : "";

	foreach($_POST['destinatario'] as $destinatario){
		$lista_destinatario = $lista_destinatario . $destinatario . ";";
	}

	$validar = new validaForm();

	$validar->set('Destinatário', 	$lista_destinatario)->is_required()
			->set('Texto', 			$texto)->is_required();


	if ($validar->validate()){

		if($validacao !== false){
			$data = date('Y-m-d H:i:s');

			$resultado = $mysqli->query("INSERT INTO correio_enviados (destinatario, assunto, texto, remetente, data) VALUES ('$lista_destinatario', '$assunto', '$texto', '$cpf', '$data')");

			//verifica o id_correio do email enviado
			$sql_correio = "SELECT MAX(id_correio) as id_correio FROM correio_enviados WHERE remetente = '$cpf'";
			$con_correio = $mysqli->query($sql_correio);
			$row_correio = $con_correio->fetch_assoc();

			//insere uma linha para cadas destinatario na tabela de correio_recebidos
			foreach($_POST['destinatario'] as $destinatario){
				$mysqli->query("INSERT INTO correio_recebidos (id_correio, destinatario) VALUES ('$row_correio[id_correio]', '$destinatario')");
			}

			if($resultado){

				$_SESSION['correio_envio_sucesso'] = "Correio enviado com sucesso!";
				$_SESSION['botao'] = "success";
			}
			else{

				$_SESSION['correio_envio_erro'] = "ERRO C-01: envio não realizado, tente novamente!<br />Em caso de persistir o erro, entrar em contato com o suporte técnico.";
				$_SESSION['botao'] = "danger";
			}

		}
	}
	else {
		$_SESSION['erro_validacao_correio'] = "ERRO C-02: campos deixados em branco, preencha novamente o formulário!";
		$_SESSION['botao'] = "danger";

		$_SESSION['lista_erro_validacao_correio'] = $validar->get_errors(); //Captura os erros de todos os campos
	}
	$flag = md5("correio_cadastrar");
	header(sprintf("Location:../../mailbox_sent.php?flag=$flag"));
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>
