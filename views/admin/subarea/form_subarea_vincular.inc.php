<div class="modal fade" data-backdrop="static" id="modalSubareaVincular" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header fundo">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<a id="topo"></a>
				<h4 class="modal-title">Vinculações</h4>
			</div>
			<div class="modal-body">
				<form name="form_subarea_vincular" id="form_subarea_vincular" action="controllers/admin/subarea/subarea_vincular.php" method="POST">
					<div class="form-group">
						<label for="subarea" class="control-label">Subárea/Subprocesso:</label>
						<textarea class="form-control" name="subarea" id="subarea" style="resize: vertical" rows="1" disabled ></textarea>
					</div>
					<div id="subarea_listar_area"    class="form-group"></div>
					<div id="subarea_listar_questao" class="form-group"></div>
					<div class="form-group">
						<input type="hidden" name="id_subarea" id="id_subarea" />
						<input type="hidden" name="flag" />
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-success">Enviar</button><a id="bottom"></a>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>