<div class="modal fade modal-wide" data-backdrop="static" id="modalAlterarHabilitacao" tabindex="-1" role="dialog" aria-labelledby="modalAlterarHabilitacaoLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header fundo">
				<!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
				<h4 class="modal-title" id="modalAlterarHabilitacaoLabel">Editar Habilitação</h4>
			</div>
			<div class="modal-body">
				<form name="form_habilitacao_alterar" id="form_habilitacao_alterar" method="POST" action="controllers/usuario/habilitacao_alterar.php" enctype="multipart/form-data">
					<div class="col-sm-12">
						<div class="row">
							<!-- Select input-->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="area">Área/Processo*</label>
									<?php $selectpicker="";include('listas/admin/select_area.inc.php');?>
								</div>
							</div>
							<!-- input radio-->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="tipo">Tipo de Habilitação*</label>
                                    <select class="form-control" name="tipo" id="tipo" required  />
										<option value="">Selecione o tipo de habilitação...</option>
										<option value="Curso">Curso</option>
										<option value="Estágio">Estágio</option>
										<option value="Experiência">Experiência</option>
                                    </select>
								</div>
							</div>
						</div>
						<div class="row">
							<!-- Text area-->
							<div class="col-sm-12">
								<div class="form-group">
									<label for="descricao" class="control-label">Descrição*</label>
									<textarea class="form-control" type="text" name="descricao"  id="descricao" required style="resize: vertical" ></textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<!-- Text input-->
							<div class="col-sm-6">
								<div id="div_carga_horaria">
									<div class="form-group">
										<label for="carga_horaria" id="label_carga_horaria">Carga-horária*</label>
										<input name="carga_horaria" id="carga_horaria" type="text" required class="form-control"  />
									</div>
								</div>
							</div>
							<!-- Text input-->
							<div class="col-sm-6">
								<div id="div_ano_conclusao">
									<div class="form-group">
										<label for="ano_conclusao" id="label_ano_conclusao">Ano de conclusão*</label>
										<input name="ano_conclusao" id="ano_conclusao" type="text" required  class="form-control" />
									</div>
								</div>
							</div>
						</div>
						<!-- Hidden input -->
						<input name="flag" type="hidden" value="alterar" />
						<input type="hidden" name="flag1" value="<?php echo $pagina;?>" />
						<input type="hidden" name="id_habilitacao" id="id_habilitacao" />
						<input type="hidden" name="area_atual" id="area_atual" />
						<input type="hidden" name="tipo_atual" id="tipo_atual" />
						<input type="hidden" name="descricao_atual" id="descricao_atual" />
						<input type="hidden" name="carga_horaria_atual" id="carga_horaria_atual" />
						<input type="hidden" name="ano_conclusao_atual" id="ano_conclusao_atual" />
						<div class="modal-footer">
							<button type="submit" class="btn btn-success">Enviar</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>