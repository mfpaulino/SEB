<div class="modal fade" data-backdrop="static" id="modalAlterarProcAna" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<h4 class="modal-title">Editar Procedimento de Análise</h4>
			</div>
			<div class="modal-body">
				<form name="form_proc_ana_alterar" id="form_proc_ana_alterar" action="controllers/admin/proc_ana/proc_ana_alterar.php" method="POST">
					<div class="form-group">
						<label for="proc_ana" class="control-label">*Descrição:</label>
						<input class="form-control" type="text" name="proc_ana"  id="proc_ana" autofocus  placeholder="" />
					</div>
					<div class="form-group">
						<input type="hidden" name="proc_ana_atual"   id="proc_ana_atual" />
						<input type="hidden" name="id_proc_ana"      id="id_proc_ana" />
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