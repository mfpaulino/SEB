<?php
$inc="sim";
include_once('../../../config.inc.php');

$id_questao = $_POST['id_questao'];

$sql = "SELECT id_proc_coleta_vinc FROM adm_questoes WHERE id_questao = '$id_questao'";
$con_questao = $mysqli->query($sql);//listo os ids das proc_coletas vinculadas

$row_questao = $con_questao->fetch_array();
$lista_id_proc_coleta = unserialize($row_questao[0]);//coloco os ids em um array

$sql = "SELECT id_proc_coleta, proc_coleta FROM adm_proc_coleta ORDER BY proc_coleta";
$con_proc_coleta = $mysqli->query($sql); //listo as proc_coletas cadastradas no sistema
?>
<table class="table table-striped table-hover">
	<tr>
		<td><label>Procedimentos de Coleta de Dados:</label></td>
		<td width="15%"><label>Vinculação:</label></td>
	</tr>
<?php
$i = 1;//apenas para criar um nr de ordem para a lista
while($row_proc_coleta = $con_proc_coleta->fetch_assoc()){
	$checked="";
	if($row_questao[0] <> ""){//para evitar que a função in_array seja executada para um array vazio
		if (in_array($row_proc_coleta['id_proc_coleta'], $lista_id_proc_coleta)) {
			$checked="checked";
		}
	}
	?>
	<tr>
		<td><?php echo "<b>".$i."-</b> ".$row_proc_coleta['proc_coleta'];?></td>
		<td width="15%">
			<input name="<?php echo $i;?>" type="checkbox" value="<?php echo $row_proc_coleta['id_proc_coleta'];?>" <?php echo $checked;?> />
		</td>
	</tr>
	<?php
	$i++;
}
?>
</table>
<?php
/***estiliza os checkbox***/
$qtde = $con_proc_coleta->num_rows;
echo '<script>';
for ($i = 1; $i <= $qtde; $i++){
	echo '$("[name=\''.$i.'\']").bootstrapSwitch();';
}
echo '
</script>';
/***************************/
?>