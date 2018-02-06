<?php
$sql = "SELECT ad.id_diaria, ac.categoria, ac.localidades, ad.valor, p.posto FROM adm_diarias ad, adm_categorias ac, postos p WHERE ad.id_categoria = ac.id_categoria and ad.id_posto = p.id_posto ORDER BY p.id_posto, ac.categoria";
$con_lista = $mysqli->query($sql);
$qtde = $con_lista->num_rows;

if($qtde == 0){
	$atributo_diaria="disabled";
}
?>
<div class="modal fade" id="modalExibirDiaria" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Diárias Cadastradas</h4>
			</div>
			<div class="modal-body">
				<div class="box">
					<div id="area_printDiaria" class="box-body no-padding ">
						<table class="table table-striped">
							<tr>
								<td><b>Posto/grad</b></td>
								<td><b>Categoria</b></td>
								<td><b>Valor</b></td>
							</tr>
							<?php
							while($row = $con_lista->fetch_assoc()){?>
								<tr>
									<td><?php echo $row['posto'];?></td>
									<td><?php echo $row['categoria'];?></td>
									<td><?php echo 'R$ '.number_format($row['valor'], 2, ',', '.');?></td>
								</tr>
								<?php
							} ?>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button id="btnPrintDiaria" class="btn btn-default" <?php echo $atributo_diaria;?> ><i class="fa fa-print"></i> Imprimir</button>
			</div>
		</div>
	</div>
</div>