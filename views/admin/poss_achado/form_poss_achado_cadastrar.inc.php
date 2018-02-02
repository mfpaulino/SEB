<div class="modal fade" data-backdrop="static" id="modalCadastrarPossAchado" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<h4 class="modal-title">Cadastrar Possível Achado</h4>
			</div>
			<div class="modal-body">
				<form name="form_poss_achado_cadastrar" id="form_poss_achado_cadastrar" action="controllers/admin/poss_achado/poss_achado_cadastrar.php" method="POST">
					<div class="form-group">
						<label for="poss_achado" class="control-label">*Possível Achado:</label>
						<input class="form-control" type="text" name="poss_achado"  id="poss_achado"  autofocus  placeholder="" />
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