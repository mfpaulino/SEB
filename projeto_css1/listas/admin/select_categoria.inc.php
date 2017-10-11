<?php
//select_categoria.inc.php
include_once ('componentes/internos/php/conexao.inc.php');

$sql = "SELECT * FROM adm_categorias ORDER BY categoria";
$con_local = $mysqli->query($sql);
?>
<select class="form-control" name="categoria" id="categoria">
	<option value = "">Selecione a categoria...</option>
	<?php
	while ($row_local = $con_local->fetch_assoc()){
	?>
		<option value = "<?php echo $row_local['id_categoria'];?>"><?php echo $row_local['categoria'];?></option>
	<?php
	 }
	 ?>
</select>

