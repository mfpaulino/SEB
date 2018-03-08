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
<a id="ir"></a>
<table class="table">
	<tr class="bg-primary">
		<td width="6%"class="text-center"><a href="#topo" title="Ir para cima"><i class="fa fa-arrow-circle-up"></i></a> <a href="#bottom" title="Ir para baixo"><i class="fa fa-arrow-circle-down"></i></a></td>
		<td class="text-center">&nbsp;&nbsp;<label>Informações Requeridas</label></td>
		<td width="6%"class="text-center"><a href="#topo" title="Ir para cima"><i class="fa fa-arrow-circle-up"></i></a> <a href="#bottom" title="Ir para baixo"><i class="fa fa-arrow-circle-down"></i></a></td>

	</tr>
</table>
<div class="text-center">
	| <a href="#sub">Subáreas/subprocessos</a> | <a href="#pcd">Procedimentos de Coleta de Dados</a> | <a href="#pad">Procedimentos de Análise de Dados</a> | <a href="#pa">Possíveis Achados</a> |<br /><br />
</div>
<table class="table table-striped table-hover">
<?php
$j = 1;//apenas para criar um nr de ordem para a lista
while($row_info_req = $con_info_req->fetch_assoc()){
	$checked="";
	if($row_questao[0] <> ""){//para evitar que a função in_array seja executada para um array vazio
		if (in_array($row_info_req['id_info_req'], $lista_id_info_req)) {
			$checked="checked";
		}
	}
	?>
	<tr>
		<td class="text-justify"><?php echo "<b>".$j."-</b> ".$row_info_req['info_req'];?></td>
		<td width="10%" class="text-center">
			<input name="<?php echo "info_req".$j;?>" type="checkbox" value="<?php echo $row_info_req['id_info_req'];?>" <?php echo $checked;?> />
		</td>
	</tr>
	<?php
	$j++;
}
?>
</table>
<?php
/***estiliza os checkbox***/
$qtde = $con_info_req->num_rows;
echo '<script>';
for ($j = 1; $j <= $qtde; $j++){
	echo '$("[name=\'info_req'.$j.'\']").bootstrapSwitch();';
}
echo '
</script>';
/***************************/
?>