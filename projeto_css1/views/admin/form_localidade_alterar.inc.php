<div class="modal fade" data-backdrop="static" id="modalAlterarLocalidade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<h4 class="modal-title">Alterar Localidade</h4>
			</div>
			<div class="modal-body">
				<form name="form_localidade_alterar" id="form_localidade_alterar" action="controllers/admin/localidade_alterar.php" method="POST">
					<div class="form-group">
						<label for="descricao" class="control-label">*Descrição:</label>
						<input class="form-control" type="text" name="descricao"  id="descricao"  autofocus  placeholder="" />
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