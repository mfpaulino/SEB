<div class="modal fade" data-backdrop="static" id="modalVincularSubarea" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header fundo">
				<h4 class="modal-title">Vincular Subárea/Subprocesso</h4>
			</div>
			<div class="modal-body">
				<form name="form_subarea_vincular" id="form_subarea_vincular" action="controllers/admin/subarea/subarea_vincular.php" method="POST">
					<div class="form-group">
						<label for="subarea" class="control-label">Subárea:</label>
						<textarea class="form-control" style="resize:vertical;" name="subarea" id="subarea"  type="text" disabled placeholder="" ></textarea>
					</div>
					<div id="listar_area" class="form-group">
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