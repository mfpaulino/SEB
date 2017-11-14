<?php
$inc="sim";
include_once('../../../config.inc.php');

$id_subarea = $_POST['id_subarea'];

//$sql = "SELECT id_area_vinc FROM adm_subareas WHERE id_subarea = '$id_subarea'";
//$con_subarea = $mysqli->query($sql);//listo os ids das areas vinculadas

//$row_subarea = $con_subarea->fetch_array();
//$lista_id_area = unserialize($row_subarea[0]);//coloco os ids em um array

$sql = "SELECT id_area, area FROM adm_areas ORDER BY area";
$con_area = $mysqli->query($sql); //listo as areas cadastradas no sistema
?>
<table class="table table-striped table-hover">
	<tr>
		<td><label>Áreas:</label></td>
		<td width="15%"><label>Vinculação:</label></td>
	</tr>
<?php
$i = 1;//apenas para criar um nr de ordem para a lista
while($row_area = $con_area->fetch_assoc()){

	$id_area = $row_area['id_area'];
	$con_subarea_vinc = $mysqli->query("SELECT id_subarea_vinc FROM adm_areas WHERE id_area = '$id_area'");
	$row_subarea_vinc = $con_subarea_vinc->fetch_array();
	$lista_id_subarea = unserialize($row_subarea_vinc[0]);

	$checked="";
	if($row_subarea_vinc[0] <> ""){//para evitar que a função in_array seja executada para um array vazio
		if (in_array($id_subarea, $lista_id_subarea)) {
			$checked="checked";
		}
	}
	?>
	<tr>
		<td><?php echo "<b>".$i."-</b> ".$row_area['area'];?></td>
		<td width="15%">
			<input name="<?php echo $i;?>" type="checkbox" value="<?php echo $row_area['id_area'];?>" <?php echo $checked;?> />
		</td>
	</tr>
	<?php
	$i++;
}
?>
</table>
<?php
/***estiliza os checkbox***/
$qtde = $con_area->num_rows;
echo '<script>';
for ($i = 1; $i <= $qtde; $i++){
	echo '$("[name=\''.$i.'\']").bootstrapSwitch();';
}
echo '
</script>';
/***************************/
?>