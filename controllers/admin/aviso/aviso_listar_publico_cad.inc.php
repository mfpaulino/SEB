<?php
$inc="sim";
if($inclui_config <> "nao"){
	include_once('../../../config.inc.php');
}

/************************* lista os perfis CCIEx existentes ************************/
$sql = "SELECT a.id_perfil_admin AS id, u.unidade, p.perfil, a.lista_perfis FROM adm_perfis p, adm_perfis_administra a, adm_perfis_unidade u WHERE u.id_perfil_om = a.id_perfil_om AND p.id_perfil = a.id_perfil and a.id_perfil_om = 1 ORDER BY u.id_perfil_om, p.perfil";
$con_perfis = $mysqli->query($sql);
?>

<table class="table table-striped table-hover" border = "0">
	<tr><td colspan="2"><b>CCIEx</b></td></tr>
<?php

while($row_perfis = $con_perfis->fetch_assoc()){?>
	<tr>
		<td>
			<?php echo $row_perfis['perfil']; ?>
		</td>
		<td width = "50%">
			<input name= "publico_cad[]" value="<?php echo $row_perfis['id'];?>" type="checkbox" class="icheck"  />
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
while($row_perfis = $con_perfis->fetch_assoc()){?>
	<tr>
		<td>
			<?php echo $row_perfis['perfil']; ?>
		</td>
		<td width = "50%">
			<input name= "publico_cad[]" value="<?php echo $row_perfis['id'];?>" type="checkbox" class="icheck"  />
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

while($row_perfis = $con_perfis->fetch_assoc()){?>
	<tr>
		<td>
			<?php echo $row_perfis['perfil']; ?>
		</td>
		<td width = "50%">
			<input name= "publico_cad[]" value="<?php echo $row_perfis['id'];?>" type="checkbox" class="icheck"  />
		</td>
	<tr>
	<?php
}
?>
</table>