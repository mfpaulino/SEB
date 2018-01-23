<?php
$inc="sim";
if($inclui_config <> "nao"){
	include_once('../../../config.inc.php');
}

$id_aviso = $_POST['id_aviso'];//vem do aviso.js

/*************** lista os perfis administrados pelo perfil selecionado ********************************/
$sql_lista = "SELECT publico FROM adm_avisos WHERE id_aviso = '$id_aviso'";
$con_lista = $mysqli->query($sql_lista);
$row_lista = $con_lista->fetch_assoc();

$lista = unserialize($row_lista['publico']);
$qtde_lista = count($lista);

/************************* lista os perfis CCIEx existentes ************************/
$sql = "SELECT a.id_perfil_admin AS id, u.unidade, p.perfil, a.lista_perfis FROM adm_perfis p, adm_perfis_administra a, adm_perfis_unidade u WHERE u.id_perfil_om = a.id_perfil_om AND p.id_perfil = a.id_perfil and a.id_perfil_om = 1 ORDER BY u.id_perfil_om, p.perfil";
$con_perfis = $mysqli->query($sql);
?>
<div class="form-group">
	<label>*Público alvo:</label>
	<br />
<table class="table table-striped table-hover" border = "0">
	<tr><td colspan="2"><b>CCIEx</b></td></tr>
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
			<input name= "publico_alt[]" value="<?php echo $row_perfis['id'];?>" type="checkbox" class="icheck" <?php echo $checked;?>  />
		</td>
	<tr>
	<?php
}
?>
</table>

<?php
/************************* lista os perfis ICFEx existentes ************************/
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
			<input name= "publico_alt[]" value="<?php echo $row_perfis['id'];?>" type="checkbox" class="icheck" <?php echo $checked;?>  />
		</td>
	<tr>
	<?php
}
?>
</table>
<?php
/************************* lista os perfis Unidade existentes ************************/
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
			<input name= "publico_alt[]" value="<?php echo $row_perfis['id'];?>" type="checkbox" class="icheck" <?php echo $checked;?>  />
		</td>
	<tr>
	<?php
}
?>
</table>


					</div>