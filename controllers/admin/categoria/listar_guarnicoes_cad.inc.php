<?php
//select_guarnicoes.inc.php
$inc="sim";

if($inclui_config <> "nao"){
	include_once('../../../config.inc.php');
}

/*********** cria uma string com as guarnicoes já selecionadas para o criterio da consulta ***********************************************/
$sql_1 = "SELECT localidades FROM adm_categorias";
$con_1 = $mysqli->query($sql_1);

$arr_localidades_1 = array(); //cria array vazio

while($row_1 = $con_1->fetch_assoc()){
	$localidades_1 = unserialize($row_1['localidades']); //cria um array para cada registro
	$arr_localidades_1 = array_merge($arr_localidades_1, $localidades_1); //array com a uniao de todos os registros
}
$qtde_1 = count($arr_localidades_1);

for ($i = 0;$i < $qtde_1; $i++){
	$localidades = $localidades . $arr_localidades_1[$i] . '\',\''; //string para o criterio ('guarnicao1','guarnicao2',...)
}

$sql = "SELECT distinct guarnicao FROM cciex_om WHERE op_ativa ='sim' and  guarnicao not in ('$localidades') ORDER BY guarnicao"; //and guarnicao not like '%$localidades%'
$con_guarnicao = $mysqli->query($sql);
//$con_guarnicao = $mysqli1->query($sql);
?>
<select name="localidade[]" id="localidade" class="form-control" multiple="multiple">
	<?php
	while ($row_guarnicao = $con_guarnicao->fetch_assoc()){
		?>
		<option value = "<?php echo $row_guarnicao['guarnicao'];?>"><?php echo $row_guarnicao['guarnicao'];?></option>
	<?php
	}
	?>
</select>

