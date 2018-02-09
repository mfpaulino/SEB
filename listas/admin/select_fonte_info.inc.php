<?php
//select_fonte_info.inc.php
include_once ('componentes/internos/php/conexao.inc.php');

$sql = "SELECT id_fonte_info, fonte_info FROM adm_fontes_informacao ORDER BY fonte_info";
$con_fonte_info = $mysqli->query($sql);
?>
<select class="form-control selectpicker" data-size="10" name="fonte_info" id="fonte_info">
	<option value = "">Selecione a Fonte de Informação...</option>
	<?php
	$i = 1;
	while ($row_fonte_info = $con_fonte_info->fetch_assoc()){
	?>
		<option value = "<?php echo $row_fonte_info['id_fonte_info'].'|'.$row_fonte_info['fonte_info'];?>"><?php echo $i . " - ".$row_fonte_info['fonte_info'];?></option>
	<?php
		$i++;
	}
	?>
</select>

