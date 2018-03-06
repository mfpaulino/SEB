<div class="modal fade" data-backdrop="static" id="modalAreaVincularSubarea" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header fundo">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Vincular Subárea/Subprocesso</h4>
			</div>
			<div class="modal-body">
				<form name="form_area_vincular_subarea" id="form_area_vincular_subarea" action="controllers/admin/area/area_vincular_subarea.php" method="POST">
					<div class="form-group">
						<label for="area" class="control-label">Área:</label>
						<textarea class="form-control" name="area" id="area"  style="resize: vertical" rows="1" disabled ></textarea>
					</div>
					<div id="area_listar_subarea" class="form-group text-justify">
					</div>
					<div class="form-group">
						<input type="hidden" name="id_area" id="id_area" />
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