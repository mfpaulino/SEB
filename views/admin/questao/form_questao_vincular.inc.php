<div class="modal fade" data-backdrop="static" id="modalQuestaoVincular" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header fundo">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<a id="topo"></a><h4 class="modal-title">Vinculações</h4>
			</div>
			<div class="modal-body">
				<form name="form_questao_vincular" id="form_questao_vincular" action="controllers/admin/questao/questao_vincular.php" method="POST">
					<div class="form-group">
						<label for="questao" class="control-label">Questão:</label>
						<textarea class="form-control"  name="questao" id="questao"  style="resize: vertical" rows="6" disabled placeholder="" ></textarea>
					</div>
					<div id="questao_listar_subarea" class="form-group"></div>
					<div id="questao_listar_info_req" class="form-group"></div>
					<div id="questao_listar_proc_coleta" class="form-group"></div>
					<div id="questao_listar_proc_ana" class="form-group"></div>
					<div id="questao_listar_poss_achado" class="form-group"></div>
					<div class="form-group">
						<input type="hidden" name="id_questao" id="id_questao" />
						<input type="hidden" name="flag" />
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-success">Enviar</button><a id="bottom"></a>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>