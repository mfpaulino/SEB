<?php
//select_questao.inc.php
include_once ('componentes/internos/php/conexao.inc.php');

$sql = "SELECT id_questao, questao FROM adm_questoes ORDER BY questao";
$con_questao = $mysqli->query($sql);
?>


          <select class="selectpicker" multiple data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true">
            <optgroup label="filter1">
              <option>option1</option>
              <option>option2</option>
              <option>option3</option>
              <option>option4</option>
            </optgroup>
            <optgroup label="filter2">
              <option>option1</option>
              <option>option2</option>
              <option>option3</option>
              <option>option4</option>
            </optgroup>
            <optgroup label="filter3">
              <option>option1</option>
              <option>option2</option>
              <option>option3</option>
              <option>option4</option>
            </optgroup>
          </select>
<select class="form-control selectpicker"  data-size="10" name="questao" id="questao">
	<option value = "">Selecione a Questão...</option>
	<?php
	$i = 1;
	while ($row_questao = $con_questao->fetch_assoc()){
	?>
		<option  value = "<?php echo $row_questao['id_questao'].'|'.$row_questao['questao']; ?>"><?php echo $i . " - ".$row_questao['questao'];?></option>
		<?php
		$i++;
	}
	?>
</select>

