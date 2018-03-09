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
<a id="pad"></a>
<table class="table">
	<tr class="bg-primary">
		<td width="6%"class="text-center"><a href="#topo" title="Voltar ao topo"><i class="fa fa-arrow-circle-up"></i></a> <a href="#bottom" title="Ir para baixo"><i class="fa fa-arrow-circle-down"></i></a></td>
		<td class="text-center">&nbsp;&nbsp;<label>Procedimentos de Análise de Dados</label></td>
		<td width="6%"class="text-center"><a href="#topo" title="Voltar ao topo"><i class="fa fa-arrow-circle-up"></i></a> <a href="#bottom" title="Ir para baixo"><i class="fa fa-arrow-circle-down"></i></a></td>

	</tr>
</table>
<div class="text-center">
	| <a href="#sub">Subáreas/subprocessos</a> | <a href="#ir">Informações Requeridas</a> | <a href="#pcd">Procedimentos de Coleta de Dados</a> | <a href="#pa">Possíveis Achados</a> |<br /><br />
</div>
<table class="table table-striped table-hover">
<?php
$l = 1;//apenas para criar um nr de ordem para a lista
while($row_proc_ana = $con_proc_ana->fetch_assoc()){
	$checked="";
	if($row_questao[0] <> ""){//para evitar que a função in_array seja executada para um array vazio
		if (in_array($row_proc_ana['id_proc_ana'], $lista_id_proc_ana)) {
			$checked="checked";
		}
	}
	?>
	<tr>
		<td class="text-justify"><?php echo "<b>".$l."-</b> ".$row_proc_ana['proc_ana'];?></td>
		<td width="10%" class="text-right">
			<input name="<?php echo "proc_ana".$l;?>"  type="checkbox" value="<?php echo $row_proc_ana['id_proc_ana'];?>" <?php echo $checked;?> />
		</td>
	</tr>
	<?php
	$l++;
}
?>
</table>
<?php
/***estiliza os checkbox***/
$qtde = $con_proc_ana->num_rows;
echo '<script>';
for ($l = 1; $l <= $qtde; $l++){
	echo '$("[name=\'proc_ana'.$l.'\']").bootstrapSwitch();';
}
echo '
</script>';
/***************************/
?>