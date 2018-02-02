<?php
$inc="sim";
if($inclui_config <> "nao"){
	include_once('../../../config.inc.php');
}

$id_perfil = $_POST['id_perfil'];//vem do permissao_administra.js

$sql = "SELECT id_permissao, descricao FROM adm_permissoes WHERE (permissao <> 'adm_permissoes' and permissao <> 'adm_perfis') ORDER BY descricao";//apenas o admin do CCIEx pode administrar perfis e permissões
$con_permissoes = $mysqli->query($sql);
?>

<table class="table table-striped table-hover" border = "0">
<?php

$i = 1;
$disabled = $id_perfil == 1 ? "disabled" : "";

while($row_permissoes = $con_permissoes->fetch_assoc()){

	$id_permissao = $row_permissoes['id_permissao'];
	$con_perfis_vinc = $mysqli->query("SELECT lista_perfis FROM adm_permissoes WHERE id_permissao = '$id_permissao'");
	$row_perfis_vinc = $con_perfis_vinc->fetch_array();
	$lista_id_perfil = unserialize($row_perfis_vinc[0]);

	$checked="";

	if($row_perfis_vinc[0] <> ""){//para evitar que a função in_array seja executada para um array vazio

		if (in_array($id_perfil, $lista_id_perfil)) {

			$checked="checked";

			$disabled = $id_perfil == 1 ? "disabled" : "";//garante que o perfil CCIEx-Administrador estará desabilitado
		}
	}
	?>
	<tr>
		<td>
			<?php echo $row_permissoes['descricao']; ?>
		</td>
		<td width = "50%">
			<input name= "<?php echo $i;?>" value="<?php echo $row_permissoes['id_permissao'];?>" type="checkbox" class="icheck" <?php echo $checked . ' ' . $disabled;?> />
		</td>
	<tr>
	<?php
	$i++;
}
?>
</table>