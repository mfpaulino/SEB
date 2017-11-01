<?php
$inc = "sim";
include ('../../../config.inc.php');

$id_area = $_POST['id_area'];

$sql = "SELECT subarea FROM adm_subareas WHERE id_area = '$id_area' ORDER BY subarea";
$con_lista = $mysqli->query($sql);
$qtde = $con_lista->num_rows;

if($qtde == 0){
	$atributo_subarea="disabled";
}
?>
<?php
while($row = $con_lista->fetch_assoc()){?>
	<tr>
		<td>- <?php echo $row['subarea'];?></td>
	</tr>
<?php
}
?>