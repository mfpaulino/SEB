<?php
$inc="sim";
include_once('../../../config.inc.php');

$id_questao = $_POST['id_questao'];

$sql = "SELECT id_subarea, subarea FROM adm_subareas ORDER BY subarea";
$con_subarea = $mysqli->query($sql); //listo as subareas cadastradas no sistema
?>
<table class="table table-striped table-hover">
	<tr>
		<td><label>Subáreas/Subprocessos:</label></td>
		<td width="15%"><label>Vinculação:</label></td>
	</tr>
<?php
$i = 1;//apenas para criar um nr de ordem para a lista
while($row_subarea = $con_subarea->fetch_assoc()){

	$id_subarea = $row_subarea['id_subarea'];
	$con_questao_vinc = $mysqli->query("SELECT id_questao_vinc FROM adm_subareas WHERE id_subarea = '$id_subarea'");
	$row_questao_vinc = $con_questao_vinc->fetch_array();
	$lista_id_questao = unserialize($row_questao_vinc[0]);

	$checked="";
	if($row_questao_vinc[0] <> ""){//para evitar que a função in_array seja executada para um array vazio
		if (in_array($id_questao, $lista_id_questao)) {
			$checked="checked";
		}
	}
	?>
	<tr>
		<td><?php echo "<b>".$i."-</b> ".$row_subarea['subarea'];?></td>
		<td width="15%">
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