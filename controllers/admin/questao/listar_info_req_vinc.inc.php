<?php
$inc="sim";
include_once('../../../config.inc.php');

$id_questao = $_POST['id_questao'];

$sql = "SELECT id_info_req_vinc FROM adm_questoes WHERE id_questao = '$id_questao'";
$con_questao = $mysqli->query($sql);//listo os ids das info_reqs vinculadas

$row_questao = $con_questao->fetch_array();
$lista_id_info_req = unserialize($row_questao[0]);//coloco os ids em um array

$sql = "SELECT id_info_req, info_req FROM adm_info_requeridas ORDER BY info_req";
$con_info_req = $mysqli->query($sql); //listo as info_reqs cadastradas no sistema
?>
<table class="table table-striped table-hover">
	<tr>
		<td><label>Informações Requeridas:</label></td>
		<td width="15%"><label>Vinculação:</label></td>
	</tr>
<?php
$i = 1;//apenas para criar um nr de ordem para a lista
while($row_info_req = $con_info_req->fetch_assoc()){
	$checked="";
	if($row_questao[0] <> ""){//para evitar que a função in_array seja executada para um array vazio
		if (in_array($row_info_req['id_info_req'], $lista_id_info_req)) {
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