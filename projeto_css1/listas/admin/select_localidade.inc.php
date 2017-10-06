<?php
//select_localidade.inc.php
include_once ('componentes/internos/php/conexao.inc.php');

$sql = "SELECT * FROM adm_localidades ORDER BY descricao";
$con_local = $mysqli->query($sql);
?>
<select class="form-control" name="localidade" id="localidade">
	<option value = "">Selecione...</option>
	<?php
	while ($row_local = $con_local->fetch_assoc()){
	?>
		<option value = "<?php echo $row_local['id_localidade'];?>"><?php echo $row_local['descricao'];?></option>
	<?php
	 }
	 ?>
</select>

