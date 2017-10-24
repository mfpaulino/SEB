<div class="modal fade" data-backdrop="static" id="modalAlterarDiaria" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<h4 class="modal-title">Alterar Diária</h4>
			</div>
			<div class="modal-body">
				<form name="form_diaria_alterar" id="form_diaria_alterar" action="controllers/admin/diaria_alterar.php" method="POST">
					<div class="form-group">
						<label for="posto" class="control-label">Posto/grad:</label>
						<input class="form-control" type="text" name="posto"  id="posto" disabled />
					</div>
					<div class="form-group">
						<label for="categoria" class="control-label">Categoria:</label>
						<input class="form-control" type="text" name="categoria"  id="categoria" disabled />
					</div>
					<div class="form-group">
						<label for="valor" class="control-label">*Valor (R$):</label>
						<input class="form-control" type="text" name="valor"  id="valor_altera" />
					</div>
					<div class="form-group">
						<input type="hidden" name="valor_atual"   id="valor_atual" />
						<input type="hidden" name="id_diaria"      id="id_diaria" />
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