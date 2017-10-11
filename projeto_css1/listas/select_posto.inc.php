<?php
//postos_select.inc.php
include_once ('componentes/internos/php/conexao.inc.php');

$sql = "SELECT postos.* FROM postos ORDER BY postos.id_posto";
$con_postos = $mysqli->query($sql);
?>
<select class="form-control" name="posto" id="posto">
	<option value = "">Selecione o Posto/Grad...</option>
	<?php
	while ($row_postos = $con_postos->fetch_assoc()){
	?>
		<option value = "<?php echo $row_postos['id_posto'];?>"><?php echo $row_postos['posto'];?></option>
	<?php
	 }
	 ?>
</select>

