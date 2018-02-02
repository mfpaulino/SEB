<?php
//select_permissoes_administra.inc.php
include_once ('componentes/internos/php/conexao.inc.php');

$sql = "SELECT id_permissao, descricao FROM adm_permissoes WHERE (permissao <> 'adm_permissoes' and permissao <> 'adm_perfis') ORDER BY descricao";//apenas o admin do CCIEx pode administrar perfis e permissões
$con_permissao1 = $mysqli->query($sql);
?>
<select class="form-control <?php echo $selectpicker;?>"  name="permissao" id="permissao">


	<option value = "">Selecione a permissão...</option>
	<?php
	while ($row_permissao = $con_permissao1->fetch_assoc()){
		?>
		<option value = "<?php echo $row_permissao['id_permissao'] . '|'.$row_permissao['descricao'];?>"><?php echo $row_permissao['descricao'];?></option>
	<?php
	}
	?>
</select>

