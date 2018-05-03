<?php
//select_poss_achado.inc.php
include_once ('componentes/internos/php/conexao.inc.php');

$sql = "SELECT id_poss_achado, poss_achado FROM adm_poss_achados ORDER BY poss_achado";
$con_poss_achado = $mysqli->query($sql);
?>
<select class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Pesquisar..." data-size="10" name="poss_achado" id="poss_achado">
	<option value = "">Selecione o Possível Achado...</option>
	<?php
	$i = 1;
	while ($row_poss_achado = $con_poss_achado->fetch_assoc()){
	?>
		<option value = "<?php echo $row_poss_achado['id_poss_achado'].'|'.$row_poss_achado['poss_achado'];?>"><?php echo $i . " - ".$row_poss_achado['poss_achado'];?></option>
	<?php
		$i++;
	}
	?>
</select>

