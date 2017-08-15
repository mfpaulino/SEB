<?php
define('PATH', __DIR__ );

if ($inc == "sim"){

	include_once(PATH . '/componentes/internos/php/constantes.inc.php');
	include_once(PATH . '/componentes/internos/php/conexao.inc.php');
}
else {
	include_once(PATH . '/controllers/autenticacao/acesso_negado.php');
}
?>