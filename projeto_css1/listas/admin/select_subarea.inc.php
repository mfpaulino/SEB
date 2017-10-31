<?php
//select_subarea.inc.php
include_once ('componentes/internos/php/conexao.inc.php');

if(isset($_POST['area'])){

	$area = explode("|", $_POST['area']);

	$sql = 	"SELECT id_subarea, subarea FROM adm_subareas WHERE id_area = '$area[0]' ORDER BY subarea";
	$con_subarea = $mysqli->query($sql);
	$mysqli->close();

	$num_rows_subarea = $con_subarea->num_rows;

	if($num_rows_subarea == 0){
	   echo  '<option value="">Aguardando a seleção da Área...</option>';
	}
	else {
		echo '<option value="">Selecione uma Área...</option>';
		while($rows_subarea = $con_subarea->fetch_assoc()){
			echo '<option value="' . $rows_subarea['id_subarea'] .'">' . htmlentities($rows_subarea['subarea']) . '</option>';
		}
	}
}
?>
<!--

<select class="form-control" name="subarea" id="subarea">
	<option value="">Aguardando a seleção da Área...</option>
</select>

-->