<?php
//select_perfil.inc.php

include_once ('componentes/internos/php/conexao.inc.php');

$unidade = strtolower(substr($sigla_usuario, -5));//pega os 5 ultimos caracteres da sigla

$unidade = ($unidade == 'cciex' or $unidade == 'icfex') ? $unidade : 'unidades';

$sql_perfis = "SELECT perfis FROM adm_perfis_unidade WHERE unidade = '$unidade'";
$con_perfis = $mysqli->query($sql_perfis);

$row_perfis = $con_perfis->fetch_assoc();
$perfis = unserialize($row_perfis['perfis']);

$perfis  = implode(',',$perfis);//separa os valores do array com uma virgula
$perfis  = "'".$perfis."'";//coloca um ' no inicio e fim da string
$perfis = str_replace(",","','",$perfis);//substitui a virgula por "','".

$sql_perfil = "SELECT * FROM adm_perfis WHERE perfil in (".$perfis.") ORDER BY perfil";
$con_perfil= $mysqli->query($sql_perfil);

$num_rows_perfil = $con_perfil->num_rows;
?>
<select class="form-control" name="perfil" id="perfil" <?php if ($status_usuario <> "recebido") {echo "disabled";}?>>
	<option value = "">Selecione...</option>
	<?php

	if($num_rows_perfil == 0){
	}
	else {
		while($rows_perfil = $con_perfil->fetch_assoc()){
			echo '<option value="' . $rows_perfil['id_perfil'] .'">' . $rows_perfil['perfil'] . ' - '. $rows_perfil['descricao'] .'</option>';
		}
	}
	?>
</select>