<?php
$inc="sim";
include_once('../../../config.inc.php');

$id_info_req = $_POST['id_info_req'];

$sql = "SELECT id_questao, questao FROM adm_questoes ORDER BY questao";
$con_questao = $mysqli->query($sql); //listo as questoes cadastradas no sistema
?>
<table class="table table-striped table-hover">
	<tr>
		<td><label>Questões:</label></td>
		<td width="15%"><label>Vinculação:</label></td>
	</tr>
<?php
$i = 1;//apenas para criar um nr de ordem para a lista
while($row_questao = $con_questao->fetch_assoc()){

	$id_questao = $row_questao['id_questao'];
	$con_info_req_vinc = $mysqli->query("SELECT id_info_req_vinc FROM adm_questoes WHERE id_questao = '$id_questao'");
	$row_info_req_vinc = $con_info_req_vinc->fetch_array();
	$lista_id_info_req = unserialize($row_info_req_vinc[0]);

	$checked="";
	if($row_info_req_vinc[0] <> ""){//para evitar que a função in_array seja executada para um array vazio
		if (in_array($id_info_req, $lista_id_info_req)) {
			$checked="checked";
		}
	}
	?>
	<tr>
		<td><?php echo "<b>".$i."-</b> ".$row_questao['questao'];?></td>
		<td width="15%">
			<input name="<?php echo $i;?>" type="checkbox" value="<?php echo $row_questao['id_questao'];?>" <?php echo $checked;?> />
		</td>
	</tr>
	<?php
	$i++;
}
?>
</table>
<?php
/***estiliza os checkbox***/
$qtde = $con_questao->num_rows;
echo '<script>';
for ($i = 1; $i <= $qtde; $i++){
	echo '$("[name=\''.$i.'\']").bootstrapSwitch();';
}
echo '
</script>';
/***************************/
?>