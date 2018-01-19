<?php
//controllers/admin/aviso/aviso_home.inc.php

session_start();
if ($inc == "sim"){//variavel criada nos scripts que incluem o arquivo atual - para evitar que seja chamado pela URL

	$sql_avisos = "SELECT * FROM adm_avisos WHERE status = 'Ativo' AND publico like '%$perfil_om%' ORDER BY dt_aviso DESC ";

	$con_avisos_home = $mysqli->query($sql_avisos);//usado no views/admin/aviso/view_aviso_home.inc.php

	$con_avisos_menu = $mysqli->query($sql_avisos);//usado no views/menu/menu_top_msg.inc.php
	$row_avisos = $con_avisos_menu->fetch_assoc();

	$tot_avisos = $con_avisos_menu->num_rows;
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>