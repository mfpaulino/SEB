<div class="modal fade" data-backdrop="static" id="modalCadastrarInfoReq" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<h4 class="modal-title">Cadastrar Informação Requerida</h4>
			</div>
			<div class="modal-body">
				<form name="form_info_req_cadastrar" id="form_info_req_cadastrar" action="controllers/admin/info_req/info_req_cadastrar.php" method="POST">
					<div class="form-group">
						<label for="info_req" class="control-label">*Informação Requerida:</label>
						<textarea class="form-control" type="text" name="info_req"  id="info_req" style="resize: vertical" rows="6" autofocus ></textarea>
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