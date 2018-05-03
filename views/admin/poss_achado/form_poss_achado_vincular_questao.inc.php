<div class="modal fade" data-backdrop="static" id="modalPossAchadoVincularQuestao" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header fundo">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Vinculações</h4>
			</div>
			<div class="modal-body">
				<form name="form_poss_achado_vincular_questao" id="form_poss_achado_vincular_questao" action="controllers/admin/poss_achado/poss_achado_vincular_questao.php" method="POST">
					<div class="form-group">
						<label for="poss_achado" class="control-label">Possível Achado:</label>
						<textarea class="form-control" name="poss_achado" id="poss_achado" style="resize: vertical" rows="6" disabled ></textarea>
					</div>
					<div id="poss_achado_listar_questao" class="form-group text-justify">
					</div>
					<div class="form-group">
						<input type="hidden" name="id_poss_achado" id="id_poss_achado" />
						<input type="hidden" name="flag" />
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