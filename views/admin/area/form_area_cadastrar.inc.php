<div class="modal fade" data-backdrop="static" id="modalCadastrarArea" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<h4 class="modal-title">Cadastrar Área/Processo</h4>
			</div>
			<div class="modal-body">
				<form name="form_area_cadastrar" id="form_area_cadastrar" action="controllers/admin/area/area_cadastrar.php" method="POST">
					<div class="form-group">
						<label for="area" class="control-label">*Área/Processo:</label>
						<input class="form-control" type="text" name="area"  id="area"  autofocus  placeholder="" />
					</div>
					<div class="form-group">
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