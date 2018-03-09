<?php
$inc="sim";
include_once('../../../config.inc.php');

$id_info_req = $_POST['id_info_req'];

$sql = "SELECT id_questao, questao FROM adm_questoes ORDER BY questao";
$con_questao = $mysqli->query($sql); //listo as questoes cadastradas no sistema
?>
<a id="ir_questao"></a>
<table class="table">
	<tr class="bg-primary">
		<td width="6%"class="text-center"><a href="#ir_topo" title="Ir para cima"><i class="fa fa-arrow-circle-up"></i></a> <a href="#ir_bottom" title="Ir para baixo"><i class="fa fa-arrow-circle-down"></i></a></td>
		<td class="text-center">&nbsp;&nbsp;<label>Questões</label></td>
		<td width="6%"class="text-center"><a href="#ir_topo" title="Ir para cima"><i class="fa fa-arrow-circle-up"></i></a> <a href="#ir_bottom" title="Ir para baixo"><i class="fa fa-arrow-circle-down"></i></a></td>

	</tr>
</table>
<div class="text-center">
	| <a href="#ir_fi">Fontes de Informação</a> | <br /><br />
</div>
<table class="table table-striped table-hover">
<?php
$j = 1;//apenas para criar um nr de ordem para a lista
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
		<td><?php echo "<b>".$j."-</b> ".$row_questao['questao'];?></td>
		<td width="10%" class="text-right">
			<input name="<?php echo "questao".$j;?>" type="checkbox" value="<?php echo $row_questao['id_questao'];?>" <?php echo $checked;?> />
		</td>
	</tr>
	<?php
	$j++;
}
?>
</table>
<?php
/***estiliza os checkbox***/
$qtde = $con_questao->num_rows;
echo '<script>';
for ($j = 1; $j <= $qtde; $j++){
	echo '$("[name=\'questao'.$j.'\']").bootstrapSwitch();';
}
echo '
</script>';
/***************************/
?>