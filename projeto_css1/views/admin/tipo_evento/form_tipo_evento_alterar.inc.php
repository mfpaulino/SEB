<div class="modal fade" data-backdrop="static" id="modalAlterarTipoEvento" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<h4 class="modal-title">Editar Tipo de Evento</h4>
			</div>
			<div class="modal-body">
				<form name="form_tipo_evento_alterar" id="form_tipo_evento_alterar" action="controllers/admin/tipo_evento/tipo_evento_alterar.php" method="POST">
					<div class="form-group">
						<label for="tipo_evento" class="control-label">*Descrição:</label>
						<input class="form-control" type="text" name="tipo_evento"  id="tipo_evento" autofocus  placeholder="" />
					</div>
					<div class="form-group">
						<input type="hidden" name="tipo_evento_atual"   id="tipo_evento_atual" />
						<input type="hidden" name="id_tipo_evento"      id="id_tipo_evento" />
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