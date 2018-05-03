<?php
//select_guarnicoes.inc.php
//usado para exibir a lista de guarnições no modal alterar categoria

$inc="sim";
if($inclui_config <> "nao"){
	include_once('../../../config.inc.php');
}

$id_categoria = $_POST['id_categoria']; //vem do ./componentes/internos/js/admin/categoria.js - linha 94

/*********** guarnicoes selecionadas ***********************************************/
$sql = "SELECT localidades FROM adm_categorias WHERE id_categoria = '$id_categoria'";
$con_guarnicao = $mysqli->query($sql);
$row_guarnicao = $con_guarnicao->fetch_assoc();

$guarnicao = unserialize($row_guarnicao['localidades']);//cria um array
natcasesort($guarnicao);//ordena por ordem alfabetica (a função sort não ordena corretamente as palavras com acentos)
$qtde = count($guarnicao);

/******************* guarnicoes disponiveis *******************************************/
$sql_1 = "SELECT localidades FROM adm_categorias";
$con_1 = $mysqli->query($sql_1);

$arr_localidades_1 = array();//cria array vazio

while($row_1 = $con_1->fetch_assoc()){
	$localidades_1 = unserialize($row_1['localidades']);//cria um array para cada registro
	$arr_localidades_1 = array_merge($arr_localidades_1, $localidades_1); //faz a uniao dos registros num unico array
}
$qtde_1 = count($arr_localidades_1);

for ($i = 0;$i < $qtde_1; $i++){
	$localidades = $localidades . $arr_localidades_1[$i] . '\',\''; //cria a string para o criterio da consulta ('guarnicao1', 'guarnicao2',...)
}
$sql = "SELECT distinct guarnicao FROM cciex_om WHERE op_ativa = 'sim' and  guarnicao not in ('$localidades') ORDER BY guarnicao";
$con_guarnicao_dsp = $mysqli->query($sql);
//$con_guarnicao_dsp = $mysqli1->query($sql);
?>
<select name="localidade[]" id="localidade" class="form-control" multiple="multiple">
	<optgroup label="Guarnições Selecionadas">
		<?php for($i = 0; $i < $qtde; $i++){?>
			<option value = "<?php echo $guarnicao[$i];?>" selected ><?php echo $guarnicao[$i];?></option>
		<?php } ?>
	</optgroup>
	<optgroup label="Guarnições Disponíveis">
	<?php while ($row_guarnicao_dsp = $con_guarnicao_dsp->fetch_assoc()){
		if($row_guarnicao_dsp['guarnicao'] <> ""){ ?>
			<option value = "<?php echo $row_guarnicao_dsp['guarnicao'];?>" ><?php echo $row_guarnicao_dsp['guarnicao'];?></option>
		<?php }
	} ?>
	</optgroup>
</select>