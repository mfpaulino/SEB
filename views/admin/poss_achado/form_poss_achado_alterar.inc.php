<div class="modal fade" data-backdrop="static" id="modalAlterarPossAchado" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<h4 class="modal-title">Editar Possível Achado</h4>
			</div>
			<div class="modal-body">
				<form name="form_poss_achado_alterar" id="form_poss_achado_alterar" action="controllers/admin/poss_achado/poss_achado_alterar.php" method="POST">
					<div class="form-group">
						<label for="poss_achado" class="control-label">*Descrição:</label>
						<textarea class="form-control" type="text" name="poss_achado"  id="poss_achado" style="resize: vertical" rows="6" autofocus ></textarea>
					</div>
					<div class="form-group">
						<input type="hidden" name="poss_achado_atual"   id="poss_achado_atual" />
						<input type="hidden" name="id_poss_achado"      id="id_poss_achado" />
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