<div class="modal fade" data-backdrop="static" id="modalProcAnaVincularQuestao" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header fundo">
				<h4 class="modal-title">Vincular Questão</h4>
			</div>
			<div class="modal-body">
				<form name="form_proc_ana_vincular_questao" id="form_proc_ana_vincular_questao" action="controllers/admin/proc_ana/proc_ana_vincular_questao.php" method="POST">
					<div class="form-group">
						<label for="proc_ana" class="control-label">Procedimento de Análise:</label>
						<textarea class="form-control" style="resize:vertical;" name="proc_ana" id="proc_ana"  type="text" disabled placeholder="" ></textarea>
					</div>
					<div id="proc_ana_listar_questao" class="form-group">
					</div>
					<div class="form-group">
						<input type="hidden" name="id_proc_ana" id="id_proc_ana" />
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