<?php
$inc="sim";
include_once('../../../config.inc.php');

$id_fonte_info = $_POST['id_fonte_info'];

$sql = "SELECT id_info_req, info_req FROM adm_info_requeridas ORDER BY info_req";
$con_info_req = $mysqli->query($sql); //listo as info_reqs cadastradas no sistema
?>
<table class="table table-striped table-hover">
	<tr>
		<td><label>Áreas/Processos:</label></td>
		<td width="15%"><label>Vinculação:</label></td>
	</tr>
<?php
$i = 1;//apenas para criar um nr de ordem para a lista
while($row_info_req = $con_info_req->fetch_assoc()){

	$id_info_req = $row_info_req['id_info_req'];
	$con_fonte_info_vinc = $mysqli->query("SELECT id_fonte_info_vinc FROM adm_info_requeridas WHERE id_info_req = '$id_info_req'");
	$row_fonte_info_vinc = $con_fonte_info_vinc->fetch_array();
	$lista_id_fonte_info = unserialize($row_fonte_info_vinc[0]);

	$checked="";
	if($row_fonte_info_vinc[0] <> ""){//para evitar que a função in_array seja executada para um array vazio
		if (in_array($id_fonte_info, $lista_id_fonte_info)) {
			$checked="checked";
		}
	}
	?>
	<tr>
		<td><?php echo "<b>".$i."-</b> ".$row_info_req['info_req'];?></td>
		<td width="15%">
			<input name="<?php echo $i;?>" type="checkbox" value="<?php echo $row_info_req['id_info_req'];?>" <?php echo $checked;?> />
		</td>
	</tr>
	<?php
	$i++;
}
?>
</table>
<?php
/***estiliza os checkbox***/
$qtde = $con_info_req->num_rows;
echo '<script>';
for ($i = 1; $i <= $qtde; $i++){
	echo '$("[name=\''.$i.'\']").bootstrapSwitch();';
}
echo '
</script>';
/***************************/
?>