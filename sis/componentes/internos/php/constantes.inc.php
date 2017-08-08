<?php
//constantes.inc.php

if (!$inc){ echo "ACESSO NEGADO"; exit;}//IMPEDE QUE SEJA CHAMADO DIRETAMENTE PELA URL

define('TEMPO_MAX_INATIVIDADE', 3600);//tempo em segundos
define('TITULO','SIAUDI');
define('PAGINA_INICIAL','index_user.php');
define('PAGINA_VISITANTE','index_visite.php');
define('ACESSO_NEGADO', 'acesso_negado.php');
define('PAGINA_BLOQUEIO', 'tela_bloqueio.php');
define('HOME', '//localhost/desenvolvimento/intranet/servidor_mamba/projeto/');
define('PATH', __DIR__);
define('ERRO_SENHA','AS SENHAS DEVEM SER IGUAIS');
?>

