<?php
/*************************************************************************************************
 ./status_menu_top_msg.inc.php
 * esse script é chamado a cada 5s para atualizar a qtde de correios/alertas/avisos no menu top
**************************************************************************************************/
session_start();

$inc ="sim";

include_once('config.inc.php');

include_once(PATH . '/controllers/autenticacao/perfil.inc.php');
include_once(PATH . '/componentes/internos/php/funcoes.inc.php');

include_once('views/menu/menu_top_msg.inc.php');
?>