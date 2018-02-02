<?php
$inc="sim";
include_once('../../../config.inc.php');

$id_questao = $_POST['id_questao'];

$sql = "SELECT id_poss_achado_vinc FROM adm_questoes WHERE id_questao = '$id_questao'";
$con_questao = $mysqli->query($sql);//listo os ids das poss_achados vinculadas

$row_questao = $con_questao->fetch_array();
$lista_id_poss_achado = unserialize($row_questao[0]);//coloco os ids em um array

$sql = "SELECT id_poss_achado, poss_achado FROM adm_poss_achados ORDER BY poss_achado";
$con_poss_achado = $mysqli->query($sql); //listo as poss_achados cadastradas no sistema
?>
<table class="table table-striped table-hover">
	<tr>
		<td><label>Possíveis Achados:</label></td>
		<td width="15%"><label>Vinculação:</label></td>
	</tr>
<?php
$i = 1;//apenas para criar um nr de ordem para a lista
while($row_poss_achado = $con_poss_achado->fetch_assoc()){
	$checked="";
	if($row_questao[0] <> ""){//para evitar que a função in_array seja executada para um array vazio
		if (in_array($row_poss_achado['id_poss_achado'], $lista_id_poss_achado)) {
			$checked="checked";
		}
	}
	?>
	<tr>
		<td><?php echo "<b>".$i."-</b> ".$row_poss_achado['poss_achado'];?></td>
		<td width="15%">
			<input name="<?php echo $i;?>" type="checkbox" value="<?php echo $row_poss_achado['id_poss_achado'];?>" <?php echo $checked;?> />
		</td>
	</tr>
	<?php
	$i++;
}
?>
</table>
<?php
/***estiliza os checkbox***/
$qtde = $con_poss_achado->num_rows;
echo '<script>';
for ($i = 1; $i <= $qtde; $i++){
	echo '$("[name=\''.$i.'\']").bootstrapSwitch();';
}
echo '
</script>';
/***************************/
?>