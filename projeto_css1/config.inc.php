<?php
/*************************************************************************************************
* local/script name: ./config.inc.php                                                            *
* define a constante PATH para uso do caminho absoluto na hora da inclusao de outros scripts     *
* inclui o arquivo de constates e conexao com o banco (ambos uilzados pela maioria dos scripts)) *
* ***********************************************************************************************/
define('PATH', __DIR__ );

if ($inc == "sim"){//variavel criada nos scripts que incluem o arquivo atual - para evitar que seja chamado pela URL

	include_once(PATH . '/componentes/internos/php/constantes.inc.php'); //arquivo de definicao de constantes
	include_once(PATH . '/componentes/internos/php/conexao.inc.php'); //arquivo de conexao com o BD
}
else {
	include_once(PATH . '/controllers/autenticacao/acesso_negado.php');//exibe msg de ACESSO NEGADO
}
?>