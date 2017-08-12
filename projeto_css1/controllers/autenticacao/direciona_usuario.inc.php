<?php

if($inc == "sim"){
include_once(__DIR__ .'/../../path.inc.php');


	session_start();

	if ($_SESSION['acesso'] == "nao_liberado"){

		header(sprintf("Location:../". PATH . "/" . PAGINA_VISITANTE));
	}
	else if ($_SESSION['acesso'] == "liberado"){
		header(sprintf("Location:". "/" . PAGINA_INICIAL));
	}
	else {
		$flag = md5("usuario_acessar");
		$_SESSION['botao'] = "danger";
		header(sprintf("Location:" . PATH . "/index.php?flag=$flag"));
	}

}
else {
	include_once(PATH . '/controllers/autenticacao/'. ACESSO_NEGADO);
}
?>