<?php
$inc = "sim";
include_once ('../../../config.inc.php');

$id_area = $_POST['id_area'];
$area = $_POST['area'];

$sql = "SELECT subarea FROM adm_subareas WHERE id_area = '$id_area' ORDER BY subarea";
$con_lista = $mysqli->query($sql);
$qtde = $con_lista->num_rows;

if($qtde == 0){
	$atributo_subarea="disabled";
}
?>
<table class="table table-striped">
	<tr>
		<td><b>Área/Processo: </b><?php echo $area;?></td>
	</tr>
	<tr>
		<td><b>Subáreas/Subprocessos:</b></td>
	</tr>
	<?php
	$i = 1;
	while($row = $con_lista->fetch_assoc()){?>
		<tr>
			<td><?php echo "<b>".$i . ".</b> " .$row['subarea'];?></td>
		</tr>
	<?php
	$i++;
	}
	?>
</table>