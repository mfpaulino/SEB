<?php
$inc="sim";
include_once('../../../config.inc.php');

$id_questao = $_POST['id_questao'];

$sql = "SELECT id_proc_ana_vinc FROM adm_questoes WHERE id_questao = '$id_questao'";
$con_questao = $mysqli->query($sql);//listo os ids das proc_anas vinculadas

$row_questao = $con_questao->fetch_array();
$lista_id_proc_ana = unserialize($row_questao[0]);//coloco os ids em um array

$sql = "SELECT id_proc_ana, proc_ana FROM adm_proc_analise ORDER BY proc_ana";
$con_proc_ana = $mysqli->query($sql); //listo as proc_anas cadastradas no sistema
?>
<table class="table table-striped table-hover">
	<tr>
		<td><label>Procedimentos de Análise de Dados:</label></td>
		<td width="15%"><label>Vinculação:</label></td>
	</tr>
<?php
$i = 1;//apenas para criar um nr de ordem para a lista
while($row_proc_ana = $con_proc_ana->fetch_assoc()){
	$checked="";
	if($row_questao[0] <> ""){//para evitar que a função in_array seja executada para um array vazio
		if (in_array($row_proc_ana['id_proc_ana'], $lista_id_proc_ana)) {
			$checked="checked";
		}
	}
	?>
	<tr>
		<td><?php echo "<b>".$i."-</b> ".$row_proc_ana['proc_ana'];?></td>
		<td width="15%">
			<input name="<?php echo $i;?>" type="checkbox" value="<?php echo $row_proc_ana['id_proc_ana'];?>" <?php echo $checked;?> />
		</td>
	</tr>
	<?php
	$i++;
}
?>
</table>
<?php
/***estiliza os checkbox***/
$qtde = $con_proc_ana->num_rows;
echo '<script>';
for ($i = 1; $i <= $qtde; $i++){
	echo '$("[name=\''.$i.'\']").bootstrapSwitch();';
}
echo '
</script>';
/***************************/
?>