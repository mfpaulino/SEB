<div class="modal fade" data-backdrop="static" id="modalInfoReqVincular" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header fundo">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<a id="ir_topo"></a>
				<h4 class="modal-title">Vinculações</h4>
			</div>
			<div class="modal-body">
				<form name="form_info_req_vincular" id="form_info_req_vincular" action="controllers/admin/info_req/info_req_vincular.php" method="POST">
					<div class="form-group">
						<label for="info_req" class="control-label">Informação Requerida:</label>
						<textarea class="form-control"  name="info_req" id="info_req"  style="resize: vertical" rows="6" disabled ></textarea>
					</div>
					<div id="info_req_listar_fonte_info" class="form-group text-justify"></div>
					<div id="info_req_listar_questao" class="form-group text-justify"></div>
					<div class="form-group">
						<input type="hidden" name="id_info_req" id="id_info_req" />
						<input type="hidden" name="flag" />
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-success">Enviar</button><a id="ir_bottom"></a>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>