<?php
//select_tipo_evento.inc.php
include_once ('componentes/internos/php/conexao.inc.php');

$sql = "SELECT id_tipo_evento, tipo_evento FROM adm_tipo_evento ORDER BY tipo_evento";
$con_tipo_evento = $mysqli->query($sql);
?>
<select class="form-control <?php echo $selectpicker;?>" data-live-search="true" data-live-search-placeholder="Pesquisar..." title="Selecione.." data-size="10" name="tipo_evento" id="tipo_evento" <?php echo $required;?> >

	<?php
	$i = 1;
	while ($row_tipo_evento = $con_tipo_evento->fetch_assoc()){
	?>
		<option value = "<?php echo $row_tipo_evento['id_tipo_evento'].'|'.$row_tipo_evento['tipo_evento'];?>"><?php echo $i . " - ".$row_tipo_evento['tipo_evento'];?></option>
	<?php
	$i ++;
	}
	?>
</select>

