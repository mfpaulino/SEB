<?php
//select_questao.inc.php
include_once ('componentes/internos/php/conexao.inc.php');

$sql = "SELECT id_questao, questao FROM adm_questoes ORDER BY questao";
$con_questao = $mysqli->query($sql);
?>

<select class="form-control selectpicker" data-live-search="true" data-size="10" name="questao" id="questao">
	<option value = "">Selecione a Questão...</option>
	<?php
	$i = 1;
	while ($row_questao = $con_questao->fetch_assoc()){
	?>
		<option  value = "<?php echo $row_questao['id_questao'].'|'.$row_questao['questao'];?>"><?php echo $i . " - ".$row_questao['questao'];?></option>
		<?php
		$i++;
	}
	?>
</select>

