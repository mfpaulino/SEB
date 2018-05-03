<?php
//select_proc_ana.inc.php
include_once ('componentes/internos/php/conexao.inc.php');

$sql = "SELECT id_proc_ana, proc_ana FROM adm_proc_analise ORDER BY proc_ana";
$con_proc_ana = $mysqli->query($sql);
?>
<select class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Pesquisar..." data-size="10" name="proc_ana" id="proc_ana">
	<option value = "">Selecione o Procedimento de Análise de Dados...</option>
	<?php
	$i = 1;
	while ($row_proc_ana = $con_proc_ana->fetch_assoc()){
	?>
		<option value = "<?php echo $row_proc_ana['id_proc_ana'].'|'.$row_proc_ana['proc_ana'];?>"><?php echo $i . " - ".$row_proc_ana['proc_ana'];?></option>
	<?php
		$i++;
	}
	?>
</select>

