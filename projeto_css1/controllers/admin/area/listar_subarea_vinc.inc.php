<?php
$inc="sim";
include_once('../../../config.inc.php');

$id_area = $_POST['id_area'];
$sql = "select IF (id_subarea in(select id_subarea from adm_areas_subareas where id_area = '$id_area'),'sim', 'nao') as vinculada, id_subarea, subarea from adm_subareas";
$con_area = $mysqli->query($sql);
$qtde = $con_area->num_rows;
?>
<table class="table table-striped">
	<tr>
		<td><label>Subáreas:</label></td>
		<td width="15%"><label>Vinculação:</label></td>
	</tr>
<?php
$i = 1;
while($row = $con_area->fetch_assoc()){
	if ($row['vinculada'] == 'sim'){
		$checked="checked";
	}
	else{
		$checked="";
	}
?>
	<tr>
		<td><?php echo $row['subarea'];?></td>
		<td width="15%">
			<input name="<?php echo $i;?>" type="checkbox" value="<?php echo $row['id_subarea'];?>" <?php echo $checked;?> />
		</td>
	</tr>
<?php
$i++;
}
?>
</table>
<?php
echo '
<script>';
for ($i = 1; $i <= $qtde; $i++){
	echo '$("[name=\''.$i.'\']").bootstrapSwitch();';
}
echo '
</script>';
?>