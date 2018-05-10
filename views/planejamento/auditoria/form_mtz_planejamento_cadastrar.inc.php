<div class="modal fade modal-wide peq" data-backdrop="static" id="modalCadastrarMtzPlanejamento" tabindex="-1" role="dialog" aria-labelledby="modalCadastrarMtzPlanejamentoLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header fundo">
				<!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
				<h4 class="modal-title" id="modalCadastrarMtzPlanejamento">Cadastrar Matriz de Planejamento</h4>
			</div>
			<div class="modal-body">
				<form name="form_mtz_plan" id="form_mtz_plan_cadastrar">
					<div class="col-sm-12">
						<div class="row">
							<!-- Select input-->
							<div class="col-sm-2">
								<div class="form-group">
									<label for="ano">Ano</label>
                                    <select class="form-control selectpicker" name="ano" id="ano" required  />
										<option value="<?php echo date('Y')-1;?>"><?php echo date('Y')-1;?></option>
										<option value="<?php echo date('Y');?>" selected><?php echo date('Y');?></option>
										<option value="<?php echo date('Y')+1;?>"><?php echo date('Y')+1;?></option>
										<option value="<?php echo date('Y')+2;?>"><?php echo date('Y')+2;?></option>
                                    </select>
								</div>
							</div>
							<!-- Select input-->
							<div class="col-sm-4">
								<div class="form-group">
									<label for="ano">Natureza <abbr title="campo obrigatório">*</abbr></label>
                                    <select class="form-control selectpicker" name="natureza" id="natureza" title="Selecione.." required />
										<option value="Programada">Programada</option>
										<option value="Não programada">Não programada</option>
                                    </select>
								</div>
							</div>
							<!-- Select input-->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="ano">Tipo <abbr title="campo obrigatório">*</abbr></label>
									<?php $selectpicker = "selectpicker"; $required = ""; include('listas/admin/select_tipo_evento.inc.php');?>
								</div>
							</div>
						</div>
						<div class="row">
							<!-- Text input-->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="nup">EB <abbr title="campo obrigatório (reservar NUP no SPED)">*</abbr></label>
									<input name="nup" id="id_nup" type="text" maxlength="40" required class="form-control"  />
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="fim">Período</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input type="text" class="form-control daterange" name="periodo" id="periodo" required />
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<!-- Text input-->
							<div class="col-sm-12">
								<div class="form-group">
									<label for="unidade">Unidade(s) Examinada(s)/Auditada(s) <abbr title="campo obrigatório">*</abbr></label>
									<?php $selectpicker = "selectpicker"; $required = "required"; include('listas/planejamento/select_unidades.inc.php');?>
								</div>
							</div>
						</div>
						<div class="row">
							<!-- Text input-->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="auditor">Equipe <abbr title="campo obrigatório">*</abbr></label>
									<?php $selectpicker = "selectpicker"; $required = "required"; include('listas/planejamento/select_auditores.inc.php');?>
									</div>
							</div>
							<!-- Text input-->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="ch_equipe">Chefe da Equipe <abbr title="campo obrigatório">*</abbr></label><br />
									<select style="width:100%;" name="ch_equipe" id="ch_equipe" required >
										<option value="">Aguardando...</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row"><input type="text" id="nup1" required /></div>
						<div class="row">&nbsp;</div>
						<div class="row">&nbsp;</div>
						<div class="row">&nbsp;</div>
						<!-- Hidden input -->
						<input name="flag" id="flag" type="hidden" value="cadastrar" />
						<div class="modal-footer">
							<button type="submit" id="btn_aud_cad" class="btn btn-success">Enviar</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>