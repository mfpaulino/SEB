<?php
include_once("componentes/internos/php/constantes.inc.php");
if ($inc == "sim"){
	define('PATH', __DIR__ );
}
else {
	include_once("controllers/autenticacao/".ACESSO_NEGADO);
}
?>