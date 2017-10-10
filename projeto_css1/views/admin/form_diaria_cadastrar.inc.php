<div class="modal fade" data-backdrop="static" id="modalCadastrarDiaria" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<h4 class="modal-title">Cadastrar Diária</h4>
			</div>
			<div class="modal-body">
				<form name="form_diaria_cadastrar" id="form_diaria_cadastrar" action="controllers/admin/diaria_cadastrar.php" method="POST">
					<div class="form-group">
						<label for="descricao" class="control-label">*Descrição:</label>
						<input class="form-control" type="text" name="descricao"  id="descricao"  autofocus  placeholder="" />
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