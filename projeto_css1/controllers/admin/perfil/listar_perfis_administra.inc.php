<?php
$inc="sim";
include_once('../../../config.inc.php');

$id_perfil = $_POST['id_perfil'];//vem do perfil_administra.js

/*************** lista os perfis administrados pelo perfil selecionado ********************************/
$sql_lista = "SELECT lista_perfis FROM adm_perfis_administra WHERE id_perfil_admin = '$id_perfil'";
$con_lista = $mysqli->query($sql_lista);
$row_lista = $con_lista->fetch_assoc();

$lista = unserialize($row_lista['lista_perfis']);
$qtde_lista = count($lista);

/************************* lista os perfis existentes ************************/
$sql = "SELECT a.id_perfil_admin AS id, u.unidade, p.perfil, a.lista_perfis FROM adm_perfis p, adm_perfis_administra a, adm_perfis_unidade u WHERE u.id_perfil_om = a.id_perfil_om AND p.id_perfil = a.id_perfil ORDER BY u.id_perfil_om, p.perfil";
$con_perfis = $mysqli->query($sql);
?>

<table class="table table-striped table-hover" border = "0">
<?php

$i = 1;

while($row_perfis = $con_perfis->fetch_assoc()){
	if($qtde_lista <> 0 and $lista <> ""){//evita erro no caso do array estar vazio - perfil nao administra ninguem
		$checked = in_array($row_perfis['id'],$lista) ? "checked" : "";
	}
	?>
	<tr>
		<td>
			<?php echo $row_perfis['unidade'] ." - ". $row_perfis['perfil']; ?>
		</td>
		<td width = "50%">
			<input name= "<?php echo $i;?>" value="<?php echo $row_perfis['id'];?>" type="checkbox" class="icheck" <?php echo $checked;?> />
		</td>
	<tr>
	<?php
	$i++;
}
?>
</table>