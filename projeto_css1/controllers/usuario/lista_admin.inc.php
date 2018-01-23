<?php
//controllers/admin/aviso/aviso_home.inc.php

session_start();
if ($inc == "sim"){//variavel criada nos scripts que incluem o arquivo atual - para evitar que seja chamado pela URL

	$sql = "SELECT id_perfil_admin, lista_perfis FROM adm_perfis_administra";
	$con = $mysqli->query($sql);

	while($row = $con->fetch_assoc()){

		$lista = unserialize($row['publico']);

		if (in_array($id_perfil_admin, $lista)){//verifica se o usuario logado faz parte da lista de perfis de algum outo usuario
			$lista_admin = $lista_admin . $row['id_perfil_admin']. ',';
		}
	}

	$lista_admin = substr($lista_admin, 0, -1); //elimino a ultima "," da string.

	$sql_admin = "SELECT id_perfil_admin FROM adm_perfis_administra WHERE id_perfil_admin in ($lista_admin) ";
	$con_admin = $mysqli->query($sql_admin);//usado no views/usuario/usuario_lista_admin.inc.php
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>