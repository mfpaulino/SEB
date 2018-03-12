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
<a id="q_pcd"></a>
<table class="table">
	<tr class="bg-primary">
		<td width="6%"class="text-center"><a href="#q_topo" title="Voltar ao topo"><i class="fa fa-arrow-circle-up"></i></a> <a href="#q_bottom" title="Ir para baixo"><i class="fa fa-arrow-circle-down"></i></a></td>
		<td class="text-center">&nbsp;&nbsp;<label>Procedimentos de Coleta de Dados</label></td>
		<td width="6%"class="text-center"><a href="#q_topo" title="Voltar ao topo"><i class="fa fa-arrow-circle-up"></i></a> <a href="#q_bottom" title="Ir para baixo"><i class="fa fa-arrow-circle-down"></i></a></td>

	</tr>
</table>
<div class="text-center">
	| <a href="#q_sub">Subáreas/subprocessos</a> | <a href="#q_ir">Informações Requeridas</a> | <a href="#q_pad">Procedimentos de Análise de Dados</a> | <a href="#q_pa">Possíveis Achados</a> |<br /><br />
</div>
<table class="table table-striped table-hover">
<?php
$k = 1;//apenas para criar um nr de ordem para a lista
while($row_proc_coleta = $con_proc_coleta->fetch_assoc()){
	$checked="";
	if($row_questao[0] <> ""){//para evitar que a função in_array seja executada para um array vazio
		if (in_array($row_proc_coleta['id_proc_coleta'], $lista_id_proc_coleta)) {
			$checked="checked";
		}
	}
	?>
	<tr>
		<td class="text-justify"><?php echo "<b>".$k."-</b> ".$row_proc_coleta['proc_coleta'];?></td>
		<td width="10%" class="text-right">
			<input name="<?php echo "proc_coleta".$k;?>" type="checkbox" value="<?php echo $row_proc_coleta['id_proc_coleta'];?>" <?php echo $checked;?> />
		</td>
	</tr>
	<?php
	$k++;
}
?>
</table>
<?php
/***estiliza os checkbox***/
$qtde = $con_proc_coleta->num_rows;
echo '<script>';
for ($k = 1; $k <= $qtde; $k++){
	echo '$("[name=\'proc_coleta'.$k.'\']").bootstrapSwitch();';
}
echo '
</script>';
/***************************/
?>