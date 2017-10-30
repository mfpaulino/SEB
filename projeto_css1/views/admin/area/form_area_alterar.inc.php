<div class="modal fade" data-backdrop="static" id="modalAlterarArea" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<h4 class="modal-title">Editar Área</h4>
			</div>
			<div class="modal-body">
				<form name="form_area_alterar" id="form_area_alterar" action="controllers/admin/area/area_alterar.php" method="POST">
					<div class="form-group">
						<label for="area" class="control-label">*Descrição:</label>
						<input class="form-control" type="text" name="area"  id="area" autofocus  placeholder="" />
					</div>
					<div class="form-group">
						<input type="hidden" name="area_atual"   id="categoria_atual" />
						<input type="hidden" name="id_area"      id="id_area" />
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