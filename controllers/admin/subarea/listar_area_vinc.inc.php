<?php
$inc="sim";
include_once('../../../config.inc.php');

$id_subarea = $_POST['id_subarea'];

$sql = "SELECT id_area, area FROM adm_areas ORDER BY area";
$con_area = $mysqli->query($sql); //listo as areas cadastradas no sistema
?>
<a id="s_area"></a>
<table class="table">
	<tr class="bg-primary">
		<td width="6%"class="text-center"><a href="#topo" title="Voltar ao topo"><i class="fa fa-arrow-circle-up"></i></a> <a href="#bottom" title="Ir para baixo"><i class="fa fa-arrow-circle-down"></i></a></td>
		<td class="text-center">&nbsp;&nbsp;<label>Áreas/Processos</label></td>
		<td width="6%"class="text-center"><a href="#topo" title="Voltar ao topo"><i class="fa fa-arrow-circle-up"></i></a> <a href="#bottom" title="Ir para baixo"><i class="fa fa-arrow-circle-down"></i></a></td>

	</tr>
</table>
<div class="text-center">
	| <a href="#s_questao">Questões</a> | <br /><br />
</div>
<table class="table table-striped table-hover">
<?php
$i = 1;//apenas para criar um nr de ordem para a lista
while($row_area = $con_area->fetch_assoc()){

	$id_area = $row_area['id_area'];
	$con_subarea_vinc = $mysqli->query("SELECT id_subarea_vinc FROM adm_areas WHERE id_area = '$id_area'");
	$row_subarea_vinc = $con_subarea_vinc->fetch_array();
	$lista_id_subarea = unserialize($row_subarea_vinc[0]);

	$checked="";
	if($row_subarea_vinc[0] <> ""){//para evitar que a função in_array seja executada para um array vazio
		if (in_array($id_subarea, $lista_id_subarea)) {
			$checked="checked";
		}
	}
	?>
	<tr>
		<td class = "text-justify"><?php echo "<b>".$i."-</b> ".$row_area['area'];?></td>
		<td width="10%" class="text-right">
			<input name="<?php echo "s_area".$i;?>" type="checkbox" value="<?php echo $row_area['id_area'];?>" <?php echo $checked;?> />
		</td>
	</tr>
	<?php
	$i++;
}
?>
</table>
<?php
/***estiliza os checkbox***/
$qtde = $con_area->num_rows;
echo '<script>';
for ($i = 1; $i <= $qtde; $i++){
	echo '$("[name=\'s_area'.$i.'\']").bootstrapSwitch();';
}
echo '
</script>';
/***************************/
?>