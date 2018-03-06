<?php
//select_area.inc.php
include_once ('componentes/internos/php/conexao.inc.php');

$sql = "SELECT id_area, area FROM adm_areas ORDER BY area";
$con_area = $mysqli->query($sql);
?>
<select class="form-control <?php echo $selectpicker;?>" data-live-search="true" data-size="10" name="area" id="area">
	<option value = "">Selecione a Área/Processo...</option>
	<?php
	$i = 1;
	while ($row_area = $con_area->fetch_assoc()){
	?>
		<option value = "<?php echo $row_area['id_area'].'|'.$row_area['area'];?>"><?php echo $i . " - ".$row_area['area'];?></option>
	<?php
		$i++;
	}
	?>
</select>

