<?php
//select_subarea.inc.php
include_once ('componentes/internos/php/conexao.inc.php');

$sql = 	"SELECT id_subarea, subarea FROM adm_subareas ORDER BY subarea";
$con_subarea = $mysqli->query($sql);
?>

<select class="form-control" name="subarea" id="subarea">
	<option value="">Selecione a Subárea/Subprocesso...</option>
	<?php
	while($rows_subarea = $con_subarea->fetch_assoc()){?>
		<option value="<?php echo $rows_subarea['id_subarea'] .'|'.$rows_subarea['subarea'];?>"><?php echo $rows_subarea['subarea'];?></option>
	<?php
	}
	?>
</select>