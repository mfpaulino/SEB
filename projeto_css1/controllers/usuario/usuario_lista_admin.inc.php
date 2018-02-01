<?php
//controllers/usuario/lista_admin.inc.php

session_start();
if ($inc == "sim"){//variavel criada nos scripts que incluem o arquivo atual - para evitar que seja chamado pela URL

	$sql = "SELECT id_perfil_admin, lista_perfis FROM adm_perfis_administra";
	$con = $mysqli->query($sql);

	while($row = $con->fetch_assoc()){

		$lista = unserialize($row['lista_perfis']);
		if($lista <> ""){
			if (in_array($id_perfil_admin, $lista)){//verifica se o usuario logado faz parte da lista de perfis de algum outo usuario
				$lista_admin = $lista_admin . $row['id_perfil_admin']. ',';
			}
		}
	}

	$lista_admin = substr($lista_admin, 0, -1); //elimino a ultima "," da string.

	$sql_admin = "SELECT p.posto, usuarios.nome_guerra, usuarios.codom FROM postos p, usuarios, adm_perfis_administra a WHERE p.id_posto = usuarios.id_posto and usuarios.id_perfil = a.id_perfil and usuarios.id_perfil_om = a.id_perfil_om and id_perfil_admin in ($lista_admin) and cpf <> '$cpf' and status = 'Habilitado' $condicao_codom_admin order by p.id_posto ";
	$con_admin = $mysqli->query($sql_admin);//usado no views/usuario/usuario_lista_admin.inc.php
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>