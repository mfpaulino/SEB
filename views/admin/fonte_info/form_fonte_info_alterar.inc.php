<div class="modal fade" data-backdrop="static" id="modalAlterarFonteInfo" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<h4 class="modal-title">Editar Fonte de Informação</h4>
			</div>
			<div class="modal-body">
				<form name="form_fonte_info_alterar" id="form_fonte_info_alterar" action="controllers/admin/fonte_info/fonte_info_alterar.php" method="POST">
					<div class="form-group">
						<label for="fonte_info" class="control-label">*Descrição:</label>
						<textarea class="form-control" type="text" name="fonte_info"  id="fonte_info" style="resize: vertical" rows="6" autofocus ></textarea>
					</div>
					<div class="form-group">
						<input type="hidden" name="fonte_info_atual"   id="fonte_info_atual" />
						<input type="hidden" name="id_fonte_info"      id="id_fonte_info" />
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