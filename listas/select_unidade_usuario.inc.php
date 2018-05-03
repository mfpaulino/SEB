<?php
//om_select.inc.php
$inc = 'sim';
include_once('../config.inc.php');
require_once(PATH . '/controllers/autenticacao/perfil.inc.php');

if(isset($_POST['unidade_ci'])){

	$unidade_ci = $_POST['unidade_ci'];

	$sql = 	"SELECT codom, sigla, denominacao FROM cciex_om WHERE icfex = '$unidade_ci' and op_ativa = 'sim' and codom <> '$codom_usuario'";
	$con_unidade = $mysqli->query($sql);
	$mysqli->close();
	//$con_unidade = $mysqli1->query($sql);
	//$mysqli1->close();

	$num_rows_unidade = $con_unidade->num_rows;

	if($num_rows_unidade == 0){
	   echo  '<option value="">Aguardando Unidade de Controle Interno...</option>';
	}
	else {
		echo '<option value="">Selecione a unidade...</option>';
		while($rows_unidade = $con_unidade->fetch_assoc()){
			echo '<option value="' . $rows_unidade['codom'] .'">' . htmlentities($rows_unidade['denominacao']) . '</option>';
		}
	}
}