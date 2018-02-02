<?php
$inc="sim";
if($inclui_config <> "nao"){
	include_once('../../../config.inc.php');
}

$id_permissao = $_POST['id_permissao'];//vem do permissao_administra.js

/*************** lista os perfis com acesso à permissao selecionada ********************************/
$sql_lista = "SELECT lista_perfis FROM adm_permissoes WHERE id_permissao = '$id_permissao'";
$con_lista = $mysqli->query($sql_lista);
$row_lista = $con_lista->fetch_assoc();

$lista = unserialize($row_lista['lista_perfis']);
$qtde_lista = count($lista);

/************************* lista os perfis existentes ************************/
$sql = "SELECT a.id_perfil_admin AS id, u.unidade, p.perfil, a.lista_perfis FROM adm_perfis p, adm_perfis_administra a, adm_perfis_unidade u WHERE u.id_perfil_om = a.id_perfil_om AND p.id_perfil = a.id_perfil and a.id_perfil_om = 1 ORDER BY u.id_perfil_om, p.perfil";
$con_perfis = $mysqli->query($sql);
?>

<table class="table table-striped table-hover" border = "0">
	<tr><td colspan="2"><b>CCIEx</b></td></tr>
<?php

$i = 1;

while($row_perfis = $con_perfis->fetch_assoc()){

	if($qtde_lista <> 0 and $lista <> ""){//evita erro no caso do array estar vazio - perfil nao administra ninguem

		$checked = in_array($row_perfis['id'],$lista) ? "checked" : "";

		$disabled = $row_perfis['id'] == 1 ? "disabled" : "";//garante que o perfil CCIEx-Administrador estará desabilitado
	}
	?>
	<tr>
		<td>
			<?php echo $row_perfis['perfil']; ?>
		</td>
		<td width = "50%">
			<input name= "<?php echo $i;?>" value="<?php echo $row_perfis['id'];?>" type="checkbox" class="icheck" <?php echo $checked . ' ' . $disabled;?> />
		</td>
	<tr>
	<?php
	$i++;
}
?>
</table>

<?php
/************************* lista os perfis existentes ************************/
$sql = "SELECT a.id_perfil_admin AS id, u.unidade, p.perfil, a.lista_perfis FROM adm_perfis p, adm_perfis_administra a, adm_perfis_unidade u WHERE u.id_perfil_om = a.id_perfil_om AND p.id_perfil = a.id_perfil and a.id_perfil_om = 2 ORDER BY u.id_perfil_om, p.perfil";
$con_perfis = $mysqli->query($sql);
?>

<table class="table table-striped table-hover" border = "0">
	<tr><td colspan="2"><b>ICFEx</b></td></tr>
<?php
while($row_perfis = $con_perfis->fetch_assoc()){
	if($qtde_lista <> 0 and $lista <> ""){//evita erro no caso do array estar vazio - perfil nao administra ninguem
		$checked = in_array($row_perfis['id'],$lista) ? "checked" : "";
	}
	?>
	<tr>
		<td>
			<?php echo $row_perfis['perfil']; ?>
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
<?php
/************************* lista os perfis existentes ************************/
$sql = "SELECT a.id_perfil_admin AS id, u.unidade, p.perfil, a.lista_perfis FROM adm_perfis p, adm_perfis_administra a, adm_perfis_unidade u WHERE u.id_perfil_om = a.id_perfil_om AND p.id_perfil = a.id_perfil and a.id_perfil_om = 3 ORDER BY u.id_perfil_om, p.perfil";
$con_perfis = $mysqli->query($sql);
?>

<table class="table table-striped table-hover" border = "0">
	<tr><td colspan="2"><b>Unidade</b></td></tr>
<?php

while($row_perfis = $con_perfis->fetch_assoc()){
	if($qtde_lista <> 0 and $lista <> ""){//evita erro no caso do array estar vazio - perfil nao administra ninguem
		$checked = in_array($row_perfis['id'],$lista) ? "checked" : "";
	}
	?>
	<tr>
		<td>
			<?php echo $row_perfis['perfil']; ?>
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