<?php
//select_perfis_administra.inc.php
include_once ('componentes/internos/php/conexao.inc.php');

$sql = "SELECT a.id_perfil_admin AS id, p.perfil, u.unidade FROM adm_perfis p, adm_perfis_unidade u, adm_perfis_administra a WHERE a.id_perfil = p.id_perfil AND a.id_perfil_om = u.id_perfil_om AND a.id_perfil_om = 1 ORDER BY u.id_perfil_om, p.perfil";
$con_perfil1 = $mysqli->query($sql);


$sql = "SELECT a.id_perfil_admin AS id, p.perfil, u.unidade FROM adm_perfis p, adm_perfis_unidade u, adm_perfis_administra a WHERE a.id_perfil = p.id_perfil AND a.id_perfil_om = u.id_perfil_om AND a.id_perfil_om = 2 ORDER BY u.id_perfil_om, p.perfil";
$con_perfil2 = $mysqli->query($sql);


$sql = "SELECT a.id_perfil_admin AS id, p.perfil, u.unidade FROM adm_perfis p, adm_perfis_unidade u, adm_perfis_administra a WHERE a.id_perfil = p.id_perfil AND a.id_perfil_om = u.id_perfil_om AND a.id_perfil_om = 3 ORDER BY u.id_perfil_om, p.perfil";
$con_perfil3 = $mysqli->query($sql);
?>
<select class="form-control <?php echo $selectpicker;?>"  name="perfil" id="perfil">


	<option value = "">Selecione o perfil...</option>
	<optgroup label="CCIEx">
	<?php
	while ($row_perfil = $con_perfil1->fetch_assoc()){
		?>
		<option value = "<?php echo $row_perfil['id'] . "|" . $row_perfil['unidade']." - ".$row_perfil['perfil'];?>"><?php echo $row_perfil['perfil'];?></option>
	<?php
	}
	?>
	</optgroup>
	<optgroup label="ICFEx">
		<?php
	while ($row_perfil = $con_perfil2->fetch_assoc()){
		?>
		<option value = "<?php echo $row_perfil['id'] . "|" . $row_perfil['unidade']." - ".$row_perfil['perfil'];?>"><?php echo $row_perfil['perfil'];?></option>
	<?php
	}
	?>
	</optgroup>
	<optgroup label="Unidade">
		<?php
	while ($row_perfil = $con_perfil3->fetch_assoc()){
		?>
		<option value = "<?php echo $row_perfil['id'] . "|" . $row_perfil['unidade']." - ".$row_perfil['perfil'];?>"><?php echo $row_perfil['perfil'];?></option>
	<?php
	}
	?>
	</optgroup>
</select>

