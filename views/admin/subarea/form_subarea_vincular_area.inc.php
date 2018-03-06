<div class="modal fade" data-backdrop="static" id="modalSubareaVincularArea" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header fundo">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Vincular Área/Processo</h4>
			</div>
			<div class="modal-body">
				<form name="form_subarea_vincular_area" id="form_subarea_vincular_area" action="controllers/admin/subarea/subarea_vincular_area.php" method="POST">
					<div class="form-group">
						<label for="subarea" class="control-label">Subárea/Subprocesso:</label>
						<textarea class="form-control" name="subarea" id="subarea" style="resize: vertical" rows="1" disabled ></textarea>
					</div>
					<div id="subarea_listar_area" class="form-group text-justify">
					</div>
					<div class="form-group">
						<input type="hidden" name="id_subarea" id="id_subarea" />
						<input type="hidden" name="flag" />
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-success">Enviar</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>