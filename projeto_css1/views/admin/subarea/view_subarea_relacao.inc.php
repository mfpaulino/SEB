<div class="modal fade" data-backdrop="static" id="modalListarSubarea" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<h4 class="modal-title">Listar Subáreas</h4>
			</div>
			<div class="modal-body">
				<div class="box-body">
					<label for="area" >Área*</label>
					<?php include('listas/admin/select_area_lista_subarea.inc.php');?>
				</div>
				<div class="modal-footer">
					<!--botao Listar subareas-->
					<button id="btnExibeSubarea" type="button" class="btn btn-success"
						data-tooltip="tooltip" title=""
						data-toggle="modal"
						data-target="#modalExibirSubarea"
						data-dismiss="modal">Enviar
					</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
				</div>
			</div>
		</div>
	</div>
</div>