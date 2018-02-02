<div class="modal fade" data-backdrop="static" id="modalAlterarInfoReq" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<h4 class="modal-title">Editar Informação Requerida</h4>
			</div>
			<div class="modal-body">
				<form name="form_info_req_alterar" id="form_info_req_alterar" action="controllers/admin/info_req/info_req_alterar.php" method="POST">
					<div class="form-group">
						<label for="info_req" class="control-label">*Descrição:</label>
						<input class="form-control" type="text" name="info_req"  id="info_req" autofocus  placeholder="" />
					</div>
					<div class="form-group">
						<input type="hidden" name="info_req_atual"   id="info_req_atual" />
						<input type="hidden" name="id_info_req"      id="id_info_req" />
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