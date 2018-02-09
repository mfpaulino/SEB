<?php
//select_subarea.inc.php
include_once ('componentes/internos/php/conexao.inc.php');

$sql = 	"SELECT id_subarea, subarea FROM adm_subareas ORDER BY subarea";
$con_subarea = $mysqli->query($sql);
?>

<select class="form-control selectpicker" data-size="10" name="subarea" id="subarea">
	<option value="">Selecione a Subárea/Subprocesso...</option>
	<?php
	$i = 1;
	while($rows_subarea = $con_subarea->fetch_assoc()){?>
		<option value="<?php echo $rows_subarea['id_subarea'] .'|'.$rows_subarea['subarea'];?>"><?php echo $i . " - ".$rows_subarea['subarea'];?></option>
	<?php
		$i++;
	}
	?>
</select>