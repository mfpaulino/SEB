<?php
//select_area.inc.php
include_once ('componentes/internos/php/conexao.inc.php');

$sql = "SELECT id_area, area FROM adm_areas WHERE id_area in (SELECT id_area FROM adm_subareas) ORDER BY area";
$con_area = $mysqli->query($sql);
?>
<select class="form-control" name="area" id="area">
	<option value = "">Selecione a Área/Processo...</option>
	<?php
	while ($row_area = $con_area->fetch_assoc()){
	?>
		<option value = "<?php echo $row_area['id_area'].'|'.$row_area['area'];?>"><?php echo $row_area['area'];?></option>
	<?php
	}
	?>
</select>

