<?php
//select_auditores.inc.php
include_once ('componentes/internos/php/conexao.inc.php');

$sql = "SELECT u.id_usuario, u.nome_guerra, p.posto  FROM usuarios u, postos p WHERE codom = '$codom_usuario' AND id_perfil in (2,3,6) AND u.id_posto = p.id_posto ORDER BY p.id_posto, u.nome_guerra";
$con_auditor = $mysqli->query($sql);
?>
<select name="auditor[]" id="auditor" multiple class="form-control <?php echo $selectpicker;?>" title="Selecione..." data-live-search="true" data-live-search-placeholder="Pesquisar..."  <?php echo $required;?> >
	<?php
	while ($row_auditor = $con_auditor->fetch_assoc()){
	?>
		<option value = "<?php echo $row_auditor['id_usuario'];?>"><?php echo $row_auditor['posto']." ".$row_auditor['nome_guerra'];?></option>
	<?php
	}
	?>
</select>