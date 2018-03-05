<div class="modal fade" data-backdrop="static" id="modalInfoReqVincularFonteInfo" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header fundo">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Vincular Fonte de Informação</h4>
			</div>
			<div class="modal-body">
				<form name="form_info_req_vincular_fonte_info" id="form_info_req_vincular_fonte_info" action="controllers/admin/info_req/info_req_vincular_fonte_info.php" method="POST">
					<div class="form-group">
						<label for="info_req" class="control-label">Informação Requerida:</label>
						<textarea class="form-control" style="resize:vertical;" name="info_req" id="info_req"  type="text" disabled placeholder="" ></textarea>
					</div>
					<div id="info_req_listar_fonte_info" class="form-group">
					</div>
					<div class="form-group">
						<input type="hidden" name="id_info_req" id="id_info_req" />
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