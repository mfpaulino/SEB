<?php
//om_select.inc.php
$inc = 'sim';
include_once('../config.inc.php');

include_once(PATH .'/componentes/internos/php/conexao.inc.php');


if(isset($_POST['unidade_ci'])){

	$unidade_ci = $_POST['unidade_ci'];

	$sql = 	"SELECT codom, sigla, denominacao FROM cciex_om WHERE icfex = '$unidade_ci' and op_ativa = 'sim'";
	$con_om = $mysqli1->query($sql);
	$mysqli->close();

	$num_rows_om = $con_om->num_rows;

	if($num_rows_om == 0){
	   echo  '<option value="">Aguardando Unidade de Controle Interno...</option>';
	}
	else {
		echo '<option value="">Selecione a unidade...</option>';
		while($rows_om = $con_om->fetch_assoc()){
			echo '<option value="' . $rows_om['codom'] .'">' . htmlentities($rows_om['denominacao']) . '</option>';
		}
	}
}