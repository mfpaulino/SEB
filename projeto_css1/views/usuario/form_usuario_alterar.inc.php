<div class="modal fade modal-wide" data-backdrop="static" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header fundo">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" id="modalEditarLabel"></h4>
			</div>
			<div class="modal-body">
				<form name="form_usuario_alterar" id="form_usuario_alterar" method="POST" action="controllers/usuario/usuario_alterar.php" enctype="multipart/form-data">
					<div class="col-sm-3">
						<div class="kv-avatar center-block text-center" style="width:200px">
							<input id="avatar-2" name="avatar-2" type="file" class="file-loading">
						</div>
					</div>
					<div class="col-sm-8">
						<div class="row">
							<!-- Text input-->
							<div class="col-sm-12">
								<div class="form-group">
									<label for="posto">Perfil*</label>
									<?php //include_once('listas/select_perfil.inc.php');?>
								</div>
							</div>
						</div>
						<div class="row">
							<!-- CPF input-->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="cpf">CPF</label>
									<input id="cpf" name="cpf" class="form-control" type="text"  disabled>
								</div>
							</div>
							<!-- RG input-->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="rg">RG*</label>
									<input id="rg" name="rg" placeholder="Nr da identidade" class="form-control" type="text">
								</div>
							</div>
						</div>
						<div class="row">
							<!-- Select input-->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="posto">Posto/Grad*</label>
									<?php include_once('listas/select_posto.inc.php');?>
								</div>
							</div>
							<!-- Text input-->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="nome_guerra">Nome de guerra*</label>
									<input name="nome_guerra" id="nome_guerra" type="text" class="form-control" />
								</div>
							</div>
						</div>
						<div class="row">
							<!-- Text input-->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="nome">Nome completo*</label>
									<input name="nome" id="nome" type="text" class="form-control"  />
								</div>
							</div>
							<!-- Text input-->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="email">E-mail*</label>
									<input name="email" id="email" type="text" class="form-control" />
								</div>
							</div>
						</div>
						<div class="row">
							<!-- Text input-->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="ritex">RITEx</label>
									<input name="ritex" id="ritex" type="text" class="form-control" />
								</div>
							</div>
							<!-- Text input-->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="celular">Celular</label>
									<input name="celular" id="celular" type="text" class="form-control" />
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