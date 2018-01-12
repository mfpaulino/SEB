<?php
//select_perfil.inc.php

$inc = 'sim';
include_once('../config.inc.php');

if(isset($_POST['codom'])){

	$codom = $_POST['codom'];

	$sql_unidade = "select sigla from cciex_om WHERE codom = '$codom'";
	$con_unidade = $mysqli1->query($sql_unidade);

	$row_unidade = $con_unidade->fetch_assoc();
	$unidade = strtolower(substr($row_unidade['sigla'], -5));//pega os 5 ultimos caracteres da sigla

	$unidade = ($unidade == 'cciex' or $unidade == 'icfex') ? $unidade : 'unidades';

	$sql_perfis = "SELECT perfis FROM adm_perfis_unidade WHERE unidade = '$unidade'";
	$con_perfis = $mysqli->query($sql_perfis);

	$row_perfis = $con_perfis->fetch_assoc();
	$perfis = unserialize($row_perfis['perfis']);

	$perfis  = implode(',',$perfis);//separa os valores do array com uma virgula
	$perfis  = "'".$perfis."'";//coloca um ' no inicio e fim da string
	$perfis = str_replace(",","','",$perfis);//substitui a virgula por "','".

	$sql_perfil = "SELECT * FROM adm_perfis WHERE perfil in (".$perfis.") ORDER BY perfil";
	$con_perfil= $mysqli->query($sql_perfil);

	$num_rows_perfil = $con_perfil->num_rows;

	if($num_rows_perfil == 0){
	   echo  '<option value="">Aguardando Unidade...</option>';
	}
	else {
		echo '<option value="">Selecione o perfil...</option>';
		while($rows_perfil = $con_perfil->fetch_assoc()){
			echo '<option value="' . $rows_perfil['perfil'] .'">' . $rows_perfil['perfil'] . ' - '. $rows_perfil['descricao'] .'</option>';
		}
	}
}
?>