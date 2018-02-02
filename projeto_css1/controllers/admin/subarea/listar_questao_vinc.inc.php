<?php
$inc="sim";
include_once('../../../config.inc.php');

$id_subarea = $_POST['id_subarea'];

$sql = "SELECT id_questao_vinc FROM adm_subareas WHERE id_subarea = '$id_subarea'";
$con_subarea = $mysqli->query($sql);//listo os ids das questoes vinculadas

$row_subarea = $con_subarea->fetch_array();
$lista_id_questao = unserialize($row_subarea[0]);//coloco os ids em um array

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
	$checked="";
	if($row_subarea[0] <> ""){//para evitar que a função in_array seja executada para um array vazio
		if (in_array($row_questao['id_questao'], $lista_id_questao)) {
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