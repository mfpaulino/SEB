<div class="modal fade modal-wide" data-backdrop="static" id="modalHabilitacao" tabindex="-1" role="dialog" aria-labelledby="modalHabilitacaoLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header fundo">
				<!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
				<h4 class="modal-title" id="modalHabilitacaoLabel">Cadastrar Habilitações</h4>
			</div>
			<div class="modal-body">
				<form name="form_habilitacao_cadastrar" id="form_habilitacao_cadastrar" method="POST" action="controllers/usuario/habilitacao_cadastrar.php" enctype="multipart/form-data">
					<div class="col-sm-12">
						<div class="row">
							<!-- Select input-->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="area">Área/Processo*</label>
									<?php include_once('listas/admin/select_area.inc.php');?>
								</div>
							</div>
							<!-- RG input-->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="tipo">Tipo de Habilitação*</label>
									<select class="form-control selectpicker" data-size="10" name="tipo" id="tipo">
										<option value = "">Selecione o tipo de habilitação...</option>
										<option value = "Curso">Curso</option>
										<option value = "Estágio">Estágio</option>
										<option value = "Experiência">Experiência</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<!-- Select input-->
							<div class="col-sm-12">
								<div class="form-group">
									<label for="texto" class="control-label">*Descrição:</label>
									<textarea class="form-control" type="text" name="descricao"  id="descricao" required style="resize: vertical" ></textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<!-- Text input-->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="carga_horaria">Carga-horária</label>
									<input name="carga_horaria" id="carga_horaria" type="text" class="form-control"  />
								</div>
							</div>
							<!-- Text input-->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="ano_conclusao">Ano de conclusão</label>
									<input name="ano_conclusao" id="ano_conclusao" type="text" class="form-control" />
								</div>
							</div>
						</div>
						<!-- Hidden input -->
						<input name="flag" type="hidden" />
						<input type="hidden" name="flag1" value="<?php echo $pagina;?>" />
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