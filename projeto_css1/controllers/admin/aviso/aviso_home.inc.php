<?php
//controllers/admin/aviso/aviso_home.inc.php

session_start();
if ($inc == "sim"){//variavel criada nos scripts que incluem o arquivo atual - para evitar que seja chamado pela URL

	$sql_avisos = "SELECT * FROM adm_avisos WHERE status = 'Ativo' ORDER BY dt_aviso DESC ";
	$con_avisos = $mysqli->query($sql_avisos);
	$tot_avisos = $con_avisos->num_rows;
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>