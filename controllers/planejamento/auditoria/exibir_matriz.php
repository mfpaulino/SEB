<?php
$inc = "sim";
include('../../../config.inc.php');
include(PATH . '/componentes/internos/php/funcoes.inc.php');
include(PATH . '/controllers/autenticacao/autentica.inc.php');

//$id = $_POST['id'];
$id = '1';
$outuput = array();
$output[] = array(
		'id' => $id
	);
	echo json_encode($output);
?>