<?php
/*************************************************************************************************
 ./status_menu_top_msg.inc.php
 As alterações realizadas aqui devem ser replicadas para o script views/menu/menu_top_msg.inc.php
**************************************************************************************************/
session_start();

$inc ="sim";

include_once('config.inc.php');
include_once(PATH . '/controllers/autenticacao/perfil.inc.php');
include_once(PATH . '/componentes/internos/php/funcoes.inc.php');

$con_correio = $mysqli->query("SELECT COUNT(id) AS qtde_msg FROM correio_recebidos WHERE lida = 'nao' AND pasta = 'entrada' AND destinatario = '$id_usuario'");
$row_correio = $con_correio->fetch_assoc();

$con_ultimo_correio = $mysqli->query("SELECT ce.id_correio, ce.assunto, ce.data, cr.lida, p.posto, u.nome_guerra, u.codom, u.avatar FROM correio_enviados ce, correio_recebidos cr, postos p, usuarios u WHERE cr.destinatario = '$id_usuario' and cr.lida = 'nao' and ce.id_correio = cr.id_correio and ce.remetente = u.cpf and p.id_posto = u.id_posto  ORDER BY ce.data desc");
$row_ultimo_correio = $con_ultimo_correio->fetch_assoc();

$sql_sigla_ultimo_correio = "SELECT sigla FROM cciex_om WHERE codom = '$row_ultimo_correio[codom]' limit 1";
$con_sigla_ultimo_correio = $mysqli1->query($sql_sigla_ultimo_correio);
$row_sigla_ultimo_correio = $con_sigla_ultimo_correio->fetch_assoc();

if($row_correio['qtde_msg'] == 0){
	$qtde_msg = 0;
}
else {
	$qtde_msg = $row_correio['qtde_msg'];
}

if(date('d/m/Y') - 1 == date('d/m/Y', strtotime($row_ultimo_correio['data']))){
	$data = "Ontem " . date('H:i',strtotime($row_ultimo_correio['data']));
}
else if(date('d/m/Y') == date('d/m/Y', strtotime($row_ultimo_correios['data']))){
	$data = "Hoje " . date('H:i',strtotime($row_ultimo_correio['data']));
}
else{
	$data = date('d/m/Y H:i', strtotime($row_ultimo_correio['data']));
}

$remetente = $row_ultimo_correio['posto']." ". $row_ultimo_correio['nome_guerra'];
$flag1 = $row_ultimo_correio['posto']." ". $row_ultimo_correio['nome_guerra'] . " - " . $row_sigla_ultimo_correio['sigla'];

if(strlen($remetente) > 26){
	$remetente = substr($remetente, 0, 26)."...";
}

if(strlen($row_ultimo_correio['assunto']) > 31){
	$assunto = substr($row_ultimo_correio['assunto'], 0, 36)."...";
}
else {
	$assunto =  $row_ultimo_correio['assunto'];
}
/********** AVISOS ADM *****************************/
include_once('controllers/menu/menu_top_msg.inc.php');

/********** ALERTAS DO SISTEMA ********************/
include_once('views/menu/menu_top_msg.inc.php');
?>