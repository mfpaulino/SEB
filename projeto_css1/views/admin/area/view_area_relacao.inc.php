<?php
$sql = "SELECT area FROM adm_areas ORDER BY area";
$con_lista = $mysqli->query($sql);
$qtde = $con_lista->num_rows;

if($qtde == 0){
	$atributo_area="disabled";
}
?>
<div class="modal fade" id="modalExibirArea" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Áreas Cadastradas</h4>
			</div>
			<div class="modal-body">
				<div class="box">
					<div id="area_printArea" class="box-body no-padding">
						<table class="table table-striped">
							<tr>
								<td><b>Descrição</b></td>
							</tr>
							<?php
							while($row = $con_lista->fetch_assoc()){?>
								<tr>
									<td><?php echo $row['area'];?></td>
								</tr>
								<?php
							} ?>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button id="btnPrintArea" class="btn btn-default" <?php echo $atributo_area;?> ><i class="fa fa-print"></i> Imprimir</button>
			</div>
		</div>
	</div>
</div>