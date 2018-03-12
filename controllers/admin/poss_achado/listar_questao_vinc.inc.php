<?php
$inc="sim";
include_once('../../../config.inc.php');

$id_poss_achado = $_POST['id_poss_achado'];

$sql = "SELECT id_questao, questao FROM adm_questoes ORDER BY questao";
$con_questao = $mysqli->query($sql); //listo as questoes cadastradas no sistema
?>
<table class="table">
	<tr class="bg-primary">
		<td width="6%"class="text-center"></td>
		<td class="text-center"><label>Questões</label></td>
		<td width="6%"class="text-center"></td>

	</tr>
</table>
<table class="table table-striped table-hover">
<?php
$i = 1;//apenas para criar um nr de ordem para a lista
while($row_questao = $con_questao->fetch_assoc()){

	$id_questao = $row_questao['id_questao'];
	$con_poss_achado_vinc = $mysqli->query("SELECT id_poss_achado_vinc FROM adm_questoes WHERE id_questao = '$id_questao'");
	$row_poss_achado_vinc = $con_poss_achado_vinc->fetch_array();
	$lista_id_poss_achado = unserialize($row_poss_achado_vinc[0]);

	$checked="";
	if($row_poss_achado_vinc[0] <> ""){//para evitar que a função in_array seja executada para um array vazio
		if (in_array($id_poss_achado, $lista_id_poss_achado)) {
			$checked="checked";
		}
	}
	?>
	<tr>
		<td class="text-justify"><?php echo "<b>".$i."-</b> ".$row_questao['questao'];?></td>
		<td width="10%" class="text-right">
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