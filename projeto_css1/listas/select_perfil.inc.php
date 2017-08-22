<?php
//postos_select.inc.php
include ('componentes/internos/php/conexao.inc.php');

//$_POST['codom'] = '11ª ICFEx';

if(isset($_POST['codom'])){
	$codom = $_POST['codom'];

	$sql = "select sigla from cciex_om WHERE codom = '$codom'";
	$con_om = $mysqli->query($sql);
	$row = $con_om->fetch_assoc();
	$unidade = substr($row['sigla'],-5);

	if ($unidade == 'cciex'){
		$perfil = "'Administrador','Supervisor','Coordenador','Auditor'";
	}
	else if ($unidade == 'icfex'){
		$perfil = "'Supervisor','Coordenador','Auditor'";
	}
	else {
		$perfil = "'Gestor','Operador'";
	}

	//$sql_ = "SELECT * FROM perfis WHERE perfil in (".$perfil.") ORDER BY perfil";
	//$con_perfil= $mysqli->query($sql_);

	//$num_rows_perfil = $con_perfil->num_rows;

	//if($num_rows_perfil == 0){
	  // echo  '<option value="">Aguardando Unidade...</option>';
	//}
	//else {
		echo '<option value="">'.$unidade.'</option>';
		//echo '<option value="">Selecione o perfil..</option>';
		//while($rows_perfil = $con_perfil->fetch_assoc()){
			//echo '<option value="' . $rows_perfil['id_perfil'] .'">' . $rows_perfil['perfil'] . '</option>';
		//}
	//}
}
else { echo  '<option value="">Aguardando ...Unidade...</option>';}
?>

