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
<table class="table table-striped table-hover">
	<tr>
		<td><label>Subáreas:</label></td>
		<td width="15%"><label>Vinculação:</label></td>
	</tr>
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
		<td width="15%">
			<input name="<?php echo $i;?>" type="checkbox" value="<?php echo $row_fonte_info['id_fonte_info'];?>" <?php echo $checked;?> />
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
	echo '$("[name=\''.$i.'\']").bootstrapSwitch();';
}
echo '
</script>';
/***************************/
?>