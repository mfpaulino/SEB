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
<a id="pa"></a>
<table class="table">
	<tr class="bg-primary">
		<td width="6%"class="text-center"><a href="#topo" title="Voltar ao topo"><i class="fa fa-arrow-circle-up"></i></a> <a href="#bottom" title="Ir para baixo"><i class="fa fa-arrow-circle-down"></i></a></td>
		<td class="text-center">&nbsp;&nbsp;<label>Possíveis Achados</label></td>
		<td width="6%"class="text-center"><a href="#topo" title="Voltar ao topo"><i class="fa fa-arrow-circle-up"></i></a> <a href="#bottom" title="Ir para baixo"><i class="fa fa-arrow-circle-down"></i></a></td>

	</tr>
</table>
<div class="text-center">
	| <a href="#sub">Subáreas/subprocessos</a> | <a href="#ir">Informações Requeridas</a> | <a href="#pcd">Procedimentos de Coleta de Dados</a> | <a href="#pad">Procedimentos de Análise de Dados</a> |<br /><br />
</div>
<table class="table table-striped table-hover">
<?php
$m = 1;//apenas para criar um nr de ordem para a lista
while($row_poss_achado = $con_poss_achado->fetch_assoc()){
	$checked="";
	if($row_questao[0] <> ""){//para evitar que a função in_array seja executada para um array vazio
		if (in_array($row_poss_achado['id_poss_achado'], $lista_id_poss_achado)) {
			$checked="checked";
		}
	}
	?>
	<tr>
		<td class="text-justify"><?php echo "<b>".$m."-</b> ".$row_poss_achado['poss_achado'];?></td>
		<td width="10%" class="text-center">
			<input name="<?php echo "poss_achado".$m;?>" type="checkbox" value="<?php echo $row_poss_achado['id_poss_achado'];?>" <?php echo $checked;?> />
		</td>
	</tr>
	<?php
	$m++;
}
?>
</table>
<?php
/***estiliza os checkbox***/
$qtde = $con_poss_achado->num_rows;
echo '<script>';
for ($m = 1; $m <= $qtde; $m++){
	echo '$("[name=\'poss_achado'.$m.'\']").bootstrapSwitch();';
}
echo '
</script>';
/***************************/
?>