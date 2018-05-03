<div class="modal fade" data-backdrop="static" id="modalCadastrarFonteInfo" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<h4 class="modal-title">Cadastrar Fontes de Informação</h4>
			</div>
			<div class="modal-body">
				<form name="form_fonte_info_cadastrar" id="form_fonte_info_cadastrar" action="controllers/admin/fonte_info/fonte_info_cadastrar.php" method="POST">
					<div class="form-group">
						<label for="fonte_info" class="control-label">*Fonte de Informação:</label>
						<textarea class="form-control" type="text" name="fonte_info"  id="fonte_info" style="resize: vertical" rows="6" autofocus ></textarea>
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