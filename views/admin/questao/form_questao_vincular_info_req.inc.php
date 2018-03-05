<div class="modal fade" data-backdrop="static" id="modalQuestaoVincularInfoReq" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header fundo">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Vincular Informação Requerida</h4>
			</div>
			<div class="modal-body">
				<form name="form_questao_vincular_info_req" id="form_questao_vincular_info_req" action="controllers/admin/questao/questao_vincular_info_req.php" method="POST">
					<div class="form-group">
						<label for="questao" class="control-label">Questão:</label>
						<textarea class="form-control" style="resize:vertical;" name="questao" id="questao"  type="text" disabled placeholder="" ></textarea>
					</div>
					<div id="questao_listar_info_req" class="form-group">
					</div>
					<div class="form-group">
						<input type="hidden" name="id_questao" id="id_questao" />
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