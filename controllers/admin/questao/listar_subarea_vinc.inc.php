<?php
$inc="sim";
include_once('../../../config.inc.php');

$id_questao = $_POST['id_questao'];

$sql = "SELECT id_subarea, subarea FROM adm_subareas ORDER BY subarea";
$con_subarea = $mysqli->query($sql); //listo as subareas cadastradas no sistema
?>
<a id="q_sub"></a>
<table class="table">
	<tr class="bg-primary">
		<td width="6%"class="text-center"><a href="#q_topo" title="Voltar ao topo"><i class="fa fa-arrow-circle-up"></i></a> <a href="#q_bottom" title="Ir para baixo"><i class="fa fa-arrow-circle-down"></i></a></td>
		<td class="text-center">&nbsp;&nbsp;<label>Subáreas/Subprocessos</label></td>
		<td width="6%"class="text-center"><a href="#q_topo" title="Voltar ao topo"><i class="fa fa-arrow-circle-up"></i></a> <a href="#q_bottom" title="Ir para baixo"><i class="fa fa-arrow-circle-down"></i></a></td>

	</tr>
</table>
<div class="text-center">
	| <a href="#q_ir">Informações Requeridas</a> | <a href="#q_pcd">Procedimentos de Coleta de Dados</a> | <a href="#q_pad">Procedimentos de Análise de Dados</a> | <a href="#q_pa">Possíveis Achados</a> |<br /><br />
</div>
<table class="table table-striped table-hover">
<?php
$i = 1;//apenas para criar um nr de ordem para a lista
while($row_subarea = $con_subarea->fetch_assoc()){

	$id_subarea = $row_subarea['id_subarea'];
	$con_questao_vinc = $mysqli->query("SELECT id_questao_vinc FROM adm_subareas WHERE id_subarea = '$id_subarea'");
	$row_questao_vinc = $con_questao_vinc->fetch_array();
	$lista_id_questao = unserialize($row_questao_vinc[0]);

	$checked="";
	if($row_questao_vinc[0] <> ""){//para evitar que a função in_array seja executada para um array vazio
		if (in_array($id_questao, $lista_id_questao)) {
			$checked="checked";
		}
	}
	?>
	<tr>
		<td class="text-justify"><?php echo "<b>".$i."-</b> ".$row_subarea['subarea'];?></td>
		<td width="10%" class="text-right">
			<input name="<?php echo "subarea".$i;?>" type="checkbox" value="<?php echo $row_subarea['id_subarea'];?>" <?php echo $checked;?> />
		</td>
	</tr>
	<?php
	$i++;
}
?>
</table>
<?php
/***estiliza os checkbox***/
$qtde = $con_subarea->num_rows;
echo '<script>';
for ($i = 1; $i <= $qtde; $i++){
	//echo '$("#'.$i.'").bootstrapSwitch();';
	echo '$("[name=\'subarea'.$i.'\']").bootstrapSwitch();';
}
echo '
</script>';
/***************************/
?>