<div class="modal fade" id="modalExibirSubarea" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Subáreas Cadastradas</h4>
			</div>
			<div class="modal-body">
				<div class="box">
					<div id="area_printSubarea" class="box-body no-padding ">
						<table class="table table-striped">
							<tr class="text-bold">
								<td>Área:</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
							<tr class="text-bold">
								<td>Subáreas:</td>
							</tr>
							<div id="lista_subarea">
								<?php include_once('controllers/admin/subarea/subarea_listar.inc.php');?>
							</div>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button id="btnPrintSubarea" class="btn btn-default" <?php echo $atributo_subarea;?> ><i class="fa fa-print"></i> Imprimir</button>
			</div>
		</div>
	</div>
</div>