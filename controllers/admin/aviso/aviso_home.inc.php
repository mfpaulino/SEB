<?php
//controllers/admin/aviso/aviso_home.inc.php

session_start();
if ($inc == "sim"){//variavel criada nos scripts que incluem o arquivo atual - para evitar que seja chamado pela URL

	$sql = "SELECT id_aviso, publico FROM adm_avisos WHERE status = 'Ativo' ORDER BY dt_aviso DESC";
	$con = $mysqli->query($sql);

	while($row = $con->fetch_assoc()){

		$lista = unserialize($row['publico']);

		if (in_array($id_perfil_admin, $lista)){//verifica se o usuario logado faz parte do publico-alvo do aviso
			$lista_aviso = $lista_aviso . $row['id_aviso']. ',';
		}
	}

	$lista_aviso = substr($lista_aviso, 0, -1); //elimino a ultima "," da string.

	$sql_avisos = "SELECT * FROM adm_avisos WHERE status = 'Ativo' AND id_aviso in ($lista_aviso) ";

	$con_avisos_home = $mysqli->query($sql_avisos);//usado no views/admin/aviso/view_aviso_home.inc.php
	$con_avisos_menu = $mysqli->query($sql_avisos);//usado no views/menu/menu_top_msg.inc.php

	if ($con_avisos_menu->num_rows > 0){

		$tot_avisos = $con_avisos_menu->num_rows;
		$row_avisos = $con_avisos_menu->fetch_assoc();
	}
	else{
		$tot_avisos = 0;
	}
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>