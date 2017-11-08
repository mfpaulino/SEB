<div class="modal fade" data-backdrop="static" id="modalAlterarSubarea" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<h4 class="modal-title">Editar Subárea/Subprocesso</h4>
			</div>
			<div class="modal-body">
				<form name="form_subarea_alterar" id="form_subarea_alterar" action="controllers/admin/subarea/subarea_alterar.php" method="POST">
					<div class="form-group">
						<label for="subarea" class="control-label">*Subárea:</label>
						<input class="form-control" type="text" name="subarea"  id="subarea" autofocus  placeholder="" />
					</div>
					<div class="form-group">
						<input type="hidden" name="subarea_atual"   id="subarea_atual" />
						<input type="hidden" name="id_subarea"      id="id_subarea" />
						<input type="hidden" name="flag" value="alterar" />
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