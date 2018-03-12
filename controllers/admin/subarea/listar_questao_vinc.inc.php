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
<a id="s_questao"></a>
<table class="table">
	<tr class="bg-primary">
		<td width="6%"class="text-center"><a href="#topo" title="Voltar ao topo"><i class="fa fa-arrow-circle-up"></i></a> <a href="#bottom" title="Ir para baixo"><i class="fa fa-arrow-circle-down"></i></a></td>
		<td class="text-center">&nbsp;&nbsp;<label>Questões</label></td>
		<td width="6%"class="text-center"><a href="#topo" title="Voltar ao topo"><i class="fa fa-arrow-circle-up"></i></a> <a href="#bottom" title="Ir para baixo"><i class="fa fa-arrow-circle-down"></i></a></td>

	</tr>
</table>
<div class="text-center">
	| <a href="#s_area">Áreas/Processos</a> | <br /><br />
</div>
<table class="table  table-striped table-hover">
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
		<td class="text-justify"><?php echo "<b>".$i."-</b> ".$row_questao['questao'];?></td>
		<td width="10%" class="text-right">
			<input name="<?php echo "s_questao".$i;?>" type="checkbox" value="<?php echo $row_questao['id_questao'];?>" <?php echo $checked;?> />
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
	echo '$("[name=\'s_questao'.$i.'\']").bootstrapSwitch();';
}
echo '
</script>';
/***************************/
?>