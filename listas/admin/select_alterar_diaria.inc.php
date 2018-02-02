<?php
//select_alterar_diaria.inc.php
include_once ('componentes/internos/php/conexao.inc.php');

$sql = "SELECT ad.id_diaria, ac.categoria, ac.localidades, ad.valor, p.posto FROM adm_diarias ad, adm_categorias ac, postos p WHERE ad.id_categoria = ac.id_categoria and ad.id_posto = p.id_posto ORDER BY p.id_posto, ac.categoria";
$con_diaria = $mysqli->query($sql);
?>
<select class="form-control selectpicker" name="diaria" id="diaria">
	<option value = "">Selecione a diaria...</option>
	<?php
	while ($row_diaria = $con_diaria->fetch_assoc()){
	?>
		<option value = "<?php echo $row_diaria['id_diaria'].'|'.$row_diaria['categoria'].' ('.$row_diaria['localidades'].')'.'|'.$row_diaria['posto'].'|'.number_format($row_diaria['valor'], 2, ',', '.');?>"><?php echo $row_diaria['posto'].' ('.$row_diaria['categoria'].': '.$row_diaria['localidades'].') = R$'.number_format($row_diaria['valor'], 2, ',', '.');?></option>
	<?php
	 }
	 ?>
</select>

