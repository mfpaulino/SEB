<div class="modal fade modal-wide" id="modalVisualizar<?php echo $cpf; ?>" tabindex="-1" role="dialog" aria-labelledby="modalVisualizarLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header fundo">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" id="modalVisualizarLabel">PERFIL DO USUÁRIO (<?php echo $perfil_usuario;?>)</h4>
			</div>
			<div class="modal-body">
				<form>
					<div class="col-sm-3">
						<div class="kv-avatar center-block text-center" style="width:200px">
							<input id="avatar-1" name="avatar-1" type="file" class="file-loading">
						</div>
					</div>
					<div class="col-sm-8">
						<div class="row">
							<!-- CPF input-->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="cpf">CPF</label>
									<input value="<?php echo $cpf;?>" class="form-control" disabled>
								</div>
							</div>
							<!-- RG input-->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="rg">RG</label>
									<input value="<?php echo $rg_usuario;?>" class="form-control" disabled>
								</div>
							</div>
						</div>
						<div class="row">
							<!-- Select input-->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="posto">Posto/Grad</label>
									<input value="<?php echo $posto_usuario;?>" class="form-control" disabled>
								</div>
							</div>
							<!-- Text input-->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="nome_guerra">Nome de guerra</label>
									<input value="<?php echo $nome_guerra_usuario;?>" class="form-control" disabled>
								</div>
							</div>
						</div>
						<div class="row">
							<!-- Text input-->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="nome">Nome completo</label>
									<input value="<?php echo $nome_usuario;?>" class="form-control" disabled>
								</div>
							</div>
							<!-- Text input-->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="email">E-mail</label>
									<input value="<?php echo $email_usuario;?>" class="form-control" disabled>
								</div>
							</div>
						</div>
						<div class="row">
							<!-- Text input-->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="ritex">RITEx</label>
									<input value="<?php echo $ritex_usuario;?>" class="form-control" disabled>
								</div>
							</div>
							<!-- Text input-->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="celular">Celular</label>
									<input value="<?php echo $celular_usuario;?>" class="form-control" disabled>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>