<?php
//select_questao.inc.php
include_once ('componentes/internos/php/conexao.inc.php');

$sql = "SELECT id_info_req, info_req FROM adm_info_requeridas ORDER BY info_req";
$con_info_req = $mysqli->query($sql);
?>
<select class="form-control selectpicker" data-live-search="true" data-size="10" name="info_req" id="info_req">
	<option value = "">Selecione a Informação Requerida...</option>
	<?php
	$i = 1;
	while ($row_info_req = $con_info_req->fetch_assoc()){
	?>
		<option value = "<?php echo $row_info_req['id_info_req'].'|'.$row_info_req['info_req'];?>"><?php echo $i . " - ".$row_info_req['info_req'];?></option>
	<?php
		$i++;
	}
	?>
</select>

