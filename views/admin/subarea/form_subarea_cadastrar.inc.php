<div class="modal fade" data-backdrop="static" id="modalCadastrarSubarea" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<h4 class="modal-title">Cadastrar Subárea/Subprocesso</h4>
			</div>
			<div class="modal-body">
				<form name="form_subarea_cadastrar" id="form_subarea_cadastrar" action="controllers/admin/subarea/subarea_cadastrar.php" method="POST">
					<div class="form-group">
						<label for="subarea" class="control-label">*Subárea/Subprocesso:</label>
						<textarea class="form-control" type="text" name="subarea"  id="subarea"  style="resize: vertical" rows="6" autofocus ></textarea>
					</div>
					<div class="form-group">
						<!--Hidden input -->
						<input  type="hidden" name="flag" />
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