<?php
//select_unidade.inc.php

include_once('componentes/internos/php/conexao.inc.php');

if($id_perfil_om == 1){//cciex
	$criterio_codom = "";//todas as om
}
elseif($id_perfil_om == 2){//icfex
	//$criterio_codom = $condicao_codom; // com a "UG" ICFEx
	$criterio_codom = " AND codom IN ($lista_codom)"; //sem a "UG" ICFEx
}
elseif($id_perfil_om == 3){
	$criterio_codom = " AND codom = '$codom_usuario'";
}

$sql = "SELECT codom, sigla  FROM cciex_om WHERE op_ativa = 'sim' $criterio_codom ORDER BY sigla";
$con = $mysqli->query($sql);
//$con = $mysqli1->query($sql);
?>
<select name="unidade[]" id="unidade" multiple class="form-control <?php echo $selectpicker;?>" title="Selecione..." data-live-search="true" data-live-search-placeholder="Pesquisar..."  <?php echo $required;?> >
	<?php
	while ($row_unidade = $con->fetch_assoc()){
	?>
		<option value = "<?php echo $row_unidade['codom'];?>"><?php echo $row_unidade['sigla'];?></option>
	<?php
	}
	?>
</select>
