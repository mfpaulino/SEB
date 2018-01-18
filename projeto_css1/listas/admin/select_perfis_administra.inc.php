<?php
//select_perfis_administra.inc.php
include_once ('componentes/internos/php/conexao.inc.php');

$sql = "SELECT a.id_perfil_admin AS id, p.perfil, u.unidade FROM adm_perfis p, adm_perfis_unidade u, adm_perfis_administra a WHERE a.id_perfil = p.id_perfil AND a.id_perfil_om = u.id_perfil_om ORDER BY u.id_perfil_om, p.perfil";
$con_perfil = $mysqli->query($sql);
?>
<select class="form-control <?php echo $selectpicker;?>"  name="perfil" id="perfil">
	<option value = "">Selecione o perfil...</option>
	<?php
	while ($row_perfil = $con_perfil->fetch_assoc()){
		?>
		<option value = "<?php echo $row_perfil['id'] . "|" . $row_perfil['unidade']." - ".$row_perfil['perfil'];?>"><?php echo $row_perfil['unidade']." - ".$row_perfil['perfil'];?></option>
	<?php
	}
	?>
</select>

