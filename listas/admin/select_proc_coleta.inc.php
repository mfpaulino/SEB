<?php
//select_proc_coleta.inc.php
include_once ('componentes/internos/php/conexao.inc.php');

$sql = "SELECT id_proc_coleta, proc_coleta FROM adm_proc_coleta ORDER BY proc_coleta";
$con_proc_coleta = $mysqli->query($sql);
?>
<select class="form-control selectpicker" data-size="10" name="proc_coleta" id="proc_coleta">
	<option value = "">Selecione o Procedimento de Coleta...</option>
	<?php
	$i = 1;
	while ($row_proc_coleta = $con_proc_coleta->fetch_assoc()){
	?>
		<option value = "<?php echo $row_proc_coleta['id_proc_coleta'].'|'.$row_proc_coleta['proc_coleta'];?>"><?php echo $i . " - ".$row_proc_coleta['proc_coleta'];?></option>
	<?php
		$i++;
	}
	?>
</select>

