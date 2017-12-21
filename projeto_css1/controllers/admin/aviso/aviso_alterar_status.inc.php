<?php
//controllers/admin/aviso/aviso_alterar_status.inc.php

session_start();
if ($inc == "sim"){//variavel criada nos scripts que incluem o arquivo atual - para evitar que seja chamado pela URL

	$dt_atual = strtotime(date("Y-m-d")); // data atual

	$sql_avisos = "SELECT id_aviso, dt_validade FROM adm_avisos WHERE status = 'Ativo'";
	$con_avisos = $mysqli->query($sql_avisos);

	while($row_avisos = $con_avisos->fetch_assoc()){
		$id_aviso = $row_avisos['id_aviso'];
		$dt_validade = strtotime($row_avisos['dt_validade']);

		if($dt_atual > $dt_validade){
			$con = $mysqli->query("UPDATE adm_avisos SET status = 'Inativo' WHERE id_aviso ='$id_aviso'");
		}
	}
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>