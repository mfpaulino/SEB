<div class="modal fade" data-backdrop="static" id="modalAlterarQuestao" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<h4 class="modal-title">Editar Questão</h4>
			</div>
			<div class="modal-body">
				<form name="form_questao_alterar" id="form_questao_alterar" action="controllers/admin/questao/questao_alterar.php" method="POST">
					<div class="form-group">
						<label for="questao" class="control-label">*Descrição:</label>
						<textarea class="form-control text-justify" type="text" name="questao"  id="questao"  style="resize: vertical" rows="6" autofocus ></textarea>
					</div>
					<div class="form-group">
						<input type="hidden" name="questao_atual"   id="questao_atual" />
						<input type="hidden" name="id_questao"      id="id_questao" />
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