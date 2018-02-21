<?php
$inc="sim";
include_once('../../../config.inc.php');

$cpf_user = $_POST['cpf_user'];

$sql = "SELECT h.*, a.area from usuarios_habilitacao h, adm_areas a where h.cpf = '$cpf_user' and h.id_area = a.id_area order by a.area, h.tipo, h.descricao";
$con_habilitacao = $mysqli->query($sql);
?>
<!-- conteudo aqui -->
<div class="row">
	<div class="col-md-12">
		<div class="box box-solid">
			<table class="table table-striped table-advance table-hover">
			<tbody>
				<tr>
					<th>Área</th>
					<th>Tipo</th>
					<th>Descrição</th>
					<th class="text-center">Carga-horária</th>
					<th class="text-center">Conclusão</th>
				</tr>
			<?php
			while ($rows =  $con_habilitacao->fetch_assoc()){
				if ($rows['carga_horaria'] <> "---"){
					$h = "h";
				}
				else {
					$h = "";
				}?>
				<tr>
					<td><?php echo $rows['area']; ?></td>
					<td width="15%"><?php echo $rows['tipo']; ?></td>
					<td><?php echo $rows['descricao']; ?></td>
					<td width="15%" class="text-center"><?php echo $rows['carga_horaria'].$h; ?></td>
					<td width="10%" class="text-center"><?php echo $rows['ano_conclusao']; ?></td>
				</tr>
			<?php
			}
			?>
			</tbody>
			</table>
		</div>
	</div>
</div>
<!-- fim conteudo