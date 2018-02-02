<div class="modal fade" data-backdrop="static" id="modalCadastrarQuestao" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<h4 class="modal-title">Cadastrar Questão</h4>
			</div>
			<div class="modal-body">
				<form name="form_questao_cadastrar" id="form_questao_cadastrar" action="controllers/admin/questao/questao_cadastrar.php" method="POST">
					<div class="form-group">
						<label for="questao" class="control-label">*Questão:</label>
						<input class="form-control" type="text" name="questao"  id="questao"  autofocus  placeholder="" />
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