<div class="modal fade" data-backdrop="static" id="modalAlterarProcColeta" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<h4 class="modal-title">Editar Procedimento de Coleta de Dados</h4>
			</div>
			<div class="modal-body">
				<form name="form_proc_coleta_alterar" id="form_proc_coleta_alterar" action="controllers/admin/proc_coleta/proc_coleta_alterar.php" method="POST">
					<div class="form-group">
						<label for="proc_coleta" class="control-label">*Descrição:</label>
						<textarea class="form-control" type="text" name="proc_coleta"  id="proc_coleta"  style="resize: vertical" rows="6" autofocus ></textarea>
					</div>
					<div class="form-group">
						<input type="hidden" name="proc_coleta_atual"   id="proc_coleta_atual" />
						<input type="hidden" name="id_proc_coleta"      id="id_proc_coleta" />
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