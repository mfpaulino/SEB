<div class="modal fade" data-backdrop="static" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="modalEditarLabel"></h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" name="form_usuario_alterar" id="form_usuario_alterar" method="POST" action="controllers/usuario/usuario_alterar.php" enctype="multipart/form-data">

					<fieldset>
						<!-- Text input-->
						<div class="form-group">
							<label for="rg" class="col-md-4 control-label">*RG:</label>
							<div class="col-md-6">
							<input name="rg" id="rg" type="text" class="form-control" />
							</div>
						</div>

						<!-- Select input-->
						<div class="form-group">
							<label for="posto" class="col-md-4 control-label">*Posto/Grad:</label>
							<div class="col-md-6">
							<?php include_once('listas/select_posto.inc.php');?>
							</div>
						</div>

						<!-- Text input-->
						<div class="form-group">
							<label for="nome_guerra" class="col-md-4 control-label">*Nome de guerra:</label>
							<div class="col-md-6">
							<input name="nome_guerra" id="nome_guerra" type="text" class="form-control" />
							</div>
						</div>

						<!-- Text input-->
						<div class="form-group">
							<label for="nome" class="col-md-4 control-label">*Nome completo:</label>
							<div class="col-md-6">
							<input name="nome" id="nome" type="text" class="form-control"  />
							</div>
						</div>

						<!-- Text input-->
						<div class="form-group">
							<label for="email" class="col-md-4 control-label">*E-mail:</label>
							<div class="col-md-6">
							<input name="email" id="email" type="text" class="form-control" />
							</div>
						</div>

						<!-- Text input-->
						<div class="form-group">
							<label for="ritex" class="col-md-4 control-label">RITEx:</label>
							<div class="col-md-6">
							<input name="ritex" id="ritex" type="text" class="form-control" />
							</div>
						</div>

						<!-- Text input-->
						<div class="form-group">
							<label for="celular" class="col-md-4 control-label">Celular:</label>
							<div class="col-md-6">
							<input name="celular" id="celular" type="text" class="form-control" />
							</div>
						</div>

						<!-- Hidden input -->
						<input name="flag" type="hidden" />
						<input type="hidden" name="flag1" value="<?php echo $pagina;?>" />

						<div class="modal-footer">
							<label class="col-md-4 control-label"></label>
							<div class="col-md-8">
								<button type="submit" class="btn btn-success">Enviar</button>
								<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>