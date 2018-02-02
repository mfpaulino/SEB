<?php
//controllers/admin/alerta/alerta_home.inc.php

session_start();
if ($inc == "sim"){

	//$lista_perfis_admin: vem do script perfil.inc.php
	//$condicao_codom: vem do script perfil.inc.php

	$sql = "SELECT count(id_usuario) as pedidos_cadastro, MAX(usuarios.data_cad) as data_cad from usuarios, adm_perfis_administra pa where usuarios.status = 'Recebido' and pa.id_perfil_admin in ($lista_perfis_admin) and (pa.id_perfil = usuarios.id_perfil and pa.id_perfil_om = usuarios.id_perfil_om) $condicao_codom";
	$con = $mysqli->query($sql);

	$tot_alertas = 0;

	if($con){

		$rows = $con->fetch_assoc();

		if ($rows['pedidos_cadastro'] > 0){
				$tot_alertas++;
		}
	}

	if($tot_alertas > 0){
		$status_alertas = "(Quantidade: ". $tot_alertas. ")";
	}
	else {
		$status_alertas = "(Nenhum alerta)";
	}
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>