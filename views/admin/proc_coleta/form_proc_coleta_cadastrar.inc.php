<div class="modal fade" data-backdrop="static" id="modalCadastrarProcColeta" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<h4 class="modal-title">Cadastrar Procedimento de Coleta de Dados</h4>
			</div>
			<div class="modal-body">
				<form name="form_proc_coleta_cadastrar" id="form_proc_coleta_cadastrar" action="controllers/admin/proc_coleta/proc_coleta_cadastrar.php" method="POST">
					<div class="form-group">
						<label for="proc_coleta" class="control-label">*Procedimento de Coleta de Dados:</label>
						<textarea class="form-control" type="text" name="proc_coleta"  id="proc_coleta"  style="resize: vertical" rows="6" autofocus ></textarea>
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