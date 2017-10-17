<div class="modal fade modal-wide" id="modalUserVisualizar<?php echo $user_cpf; ?>" tabindex="-1" role="dialog" aria-labelledby="modalUserVisualizarLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header fundo">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" id="modalUserVisualizarLabel">PERFIL DO USUÁRIO (<?php echo $user_perfil;?> - <?php echo $user_sigla;?>)</h4>
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
									<input value="<?php echo $user_cpf;?>" class="form-control" disabled>
								</div>
							</div>
							<!-- RG input-->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="rg">RG</label>
									<input value="<?php echo $user_rg;?>" class="form-control" disabled>
								</div>
							</div>
						</div>
						<div class="row">
							<!-- Select input-->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="posto">Posto/Grad</label>
									<input value="<?php echo $user_posto;?>" class="form-control" disabled>
								</div>
							</div>
							<!-- Text input-->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="nome_guerra">Nome de guerra</label>
									<input value="<?php echo $user_nome_guerra;?>" class="form-control" disabled>
								</div>
							</div>
						</div>
						<div class="row">
							<!-- Text input-->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="nome">Nome completo</label>
									<input value="<?php echo $user_nome;?>" class="form-control" disabled>
								</div>
							</div>
							<!-- Text input-->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="email">E-mail</label>
									<input value="<?php echo $user_email;?>" class="form-control" disabled>
								</div>
							</div>
						</div>
						<div class="row">
							<!-- Text input-->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="ritex">RITEx</label>
									<input value="<?php echo $user_ritex;?>" class="form-control" disabled>
								</div>
							</div>
							<!-- Text input-->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="celular">Celular</label>
									<input value="<?php echo $user_celular;?>" class="form-control" disabled>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>