<?php
$inc="sim";
include_once('../../../config.inc.php');

$id_area = $_POST['id_area'];

$sql = "SELECT id_subarea_vinc FROM adm_areas WHERE id_area = '$id_area'";
$con_area = $mysqli->query($sql);//listo os ids das subareas vinculadas

$row_area = $con_area->fetch_array();
$lista_id_subarea = unserialize($row_area[0]);//coloco os ids em um array

$sql = "SELECT id_subarea, subarea FROM adm_subareas ORDER BY subarea";
$con_subarea = $mysqli->query($sql); //listo as subareas cadastradas no sistema
?>
<table class="table">
	<tr class="bg-primary">
		<td width="6%"class="text-center"></td>
		<td class="text-center"><label>Subáreas/Subprocessos</label></td>
		<td width="6%"class="text-center"></td>

	</tr>
</table>
<table class="table table-striped table-hover">
<?php
$i = 1;//apenas para criar um nr de ordem para a lista
while($row_subarea = $con_subarea->fetch_assoc()){
	$checked="";
	if($row_area[0] <> ""){//para evitar que a função in_array seja executada para um array vazio
		if (in_array($row_subarea['id_subarea'], $lista_id_subarea)) {
			$checked="checked";
		}
	}
	?>
	<tr>
		<td class="text-justify"><?php echo "<b>".$i."-</b> ".$row_subarea['subarea'];?></td>
		<td width="10%" class="text-right">
			<input name="<?php echo $i;?>" type="checkbox" value="<?php echo $row_subarea['id_subarea'];?>" <?php echo $checked;?> />
		</td>
	</tr>
	<?php
	$i++;
}
?>
</table>
<?php
/***estiliza os checkbox***/
$qtde = $con_subarea->num_rows;
echo '<script>';
for ($i = 1; $i <= $qtde; $i++){
	echo '$("[name=\''.$i.'\']").bootstrapSwitch();';
}
echo '
</script>';
/***************************/
?>