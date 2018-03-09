<?php
$inc="sim";
include_once('../../../config.inc.php');

$id_info_req = $_POST['id_info_req'];

$sql = "SELECT id_fonte_info_vinc FROM adm_info_requeridas WHERE id_info_req = '$id_info_req'";
$con_info_req = $mysqli->query($sql);//listo os ids das fonte_infos vinculadas

$row_info_req = $con_info_req->fetch_array();
$lista_id_fonte_info = unserialize($row_info_req[0]);//coloco os ids em um array

$sql = "SELECT id_fonte_info, fonte_info FROM adm_fontes_informacao ORDER BY fonte_info";
$con_fonte_info = $mysqli->query($sql); //listo as fonte_infos cadastradas no sistema
?>
<a id="ir_fi"></a>
<table class="table">
	<tr class="bg-primary">
		<td width="6%"class="text-center"><a href="#ir_topo" title="Ir para cima"><i class="fa fa-arrow-circle-up"></i></a> <a href="#ir_bottom" title="Ir para baixo"><i class="fa fa-arrow-circle-down"></i></a></td>
		<td class="text-center">&nbsp;&nbsp;<label>Fontes de Informação</label></td>
		<td width="6%"class="text-center"><a href="#ir_topo" title="Ir para cima"><i class="fa fa-arrow-circle-up"></i></a> <a href="#ir_bottom" title="Ir para baixo"><i class="fa fa-arrow-circle-down"></i></a></td>

	</tr>
</table>
<div class="text-center">
	| <a href="#ir_questao">Questões</a> | <br /><br />
</div>
<table class="table table-striped table-hover">
<?php
$i = 1;//apenas para criar um nr de ordem para a lista
while($row_fonte_info = $con_fonte_info->fetch_assoc()){
	$checked="";
	if($row_info_req[0] <> ""){//para evitar que a função in_array seja executada para um array vazio
		if (in_array($row_fonte_info['id_fonte_info'], $lista_id_fonte_info)) {
			$checked="checked";
		}
	}
	?>
	<tr>
		<td><?php echo "<b>".$i."-</b> ".$row_fonte_info['fonte_info'];?></td>
		<td width="10%" class="text-right">
			<input name="<?php echo "fonte_info".$i;?>" type="checkbox" value="<?php echo $row_fonte_info['id_fonte_info'];?>" <?php echo $checked;?> />
		</td>
	</tr>
	<?php
	$i++;
}
?>
</table>
<?php
/***estiliza os checkbox***/
$qtde = $con_fonte_info->num_rows;
echo '<script>';
for ($i = 1; $i <= $qtde; $i++){
	echo '$("[name=\'fonte_info'.$i.'\']").bootstrapSwitch();';
}
echo '
</script>';
/***************************/
?>