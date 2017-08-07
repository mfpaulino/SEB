<?php
//autentica.inc.php

//if (!isset($inc)){$flag = md5("acesso_indevido"); header("Location: logout.php?flag=$flag");}

require_once(__DIR__ .'/../componentes/internos/php/constantes.inc.php');

session_start();

if (!isset($_SESSION['cpf'])){
	if($nivel == "1"){//usado para arquivos 1 nivel acima da raiz
		header(sprintf("Location: ../index.php"));
	}
	else{
		header(sprintf("Location: index.php"));
	}
}
else {
	$cpf = $_SESSION['cpf'];
	$ultimoAcesso = $_SESSION['ultimoAcesso'];

	$agora = date("Y-m-d H:i:s");
	$tempo_inatividade = (strtotime($agora)-strtotime($ultimoAcesso));

	if($tempo_inatividade >= TEMPO_MAX_INATIVIDADE){ // TEMPO_SESSAO vem de constantes.inc.php
		session_destroy();
		$flag = md5("msg_inatividade");
		if($nivel == "1"){//usado para arquivos 1 nivel acima da raiz
			header(sprintf("Location: ../index.php?flag=$flag"));
		}
		else{
			header(sprintf("Location: index.php?flag=$flag"));
		}
	}
	else {
		$_SESSION["ultimoAcesso"] = $agora; //renovo o ultimo acesso
	}

	/* consultando os dados do usuario */
	$sql = "select * from usuarios where cpf = '$cpf'";
	$con_dados = $mysqli->query($sql);
	$mysqli->close();
	$row = $con_dados->fetch_assoc();

	$nome_usuario = $row['nome'];
	$codom_usuario = $row['om'];
	$email_usuario = $row['email'];
	$ultimo_acesso = date('d-m-Y H:i:s', strtotime($row['ultimo_acesso']));

	/**nova conexao para acessar o banco de om **/
	$servidor = "localhost";
	$bd = "cciex_sistemas";
	$usuario = "cciex_siaudi-con";
	$senha = "adintra#$@";

	$mysqli = new mysqli($servidor, $usuario, $senha, $bd);
	$sql = "select sigla from cciex_om where codom = '$codom_usuario'";
	$con_om = $mysqli->query($sql);
	$mysqli->close();

	$row = $con_om->fetch_assoc();
	$sigla_usuario = $row['sigla'];

	if($_SESSION['acesso']=='nao_liberado'){
		if($nivel == "1"){//usado para arquivos 1 nivel acima da raiz
			header(sprintf("Location: ../".PAGINA_VISITANTE."?flag="));
			return;
		}
		else{
			header(sprintf("Location: ". PAGINA_VISITANTE."?flag="));
			return;
		}
	}
	/**********************************/
}
?>
