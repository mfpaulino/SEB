<div class="modal fade modal-wide" data-backdrop="static" id="cadastroModal" role="dialog">
	<div class="modal-dialog" >
		<div class="modal-content">
			<div class="modal-header fundo">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Solicitação de Acesso</h4>
			</div>
			<div class="modal-body">
				<form name="form_usuario_cadastrar" id="form_usuario_cadastrar" role="form" action="controllers/usuario/usuario_cadastrar.php" method="POST" enctype="multipart/form-data">
					<div class="col-sm-3">
						<div class="kv-avatar center-block text-center" style="width:200px">
							<input id="avatar-2" name="avatar-2" type="file" class="file-loading">
						</div>
					</div>
					<div class="col-sm-8">
						<div class="row">
							<!-- Select input-->
							<div class="col-sm-12">
								<div class="form-group">
									<label for="unidade_ci">Unidade Controle Interno*</label>
										<?php include('listas/select_unid_ci.inc.php');?>
								</div>
							</div>
						</div>
						<div class="row">
							<!-- Select input -->
							<div class="col-sm-12">
								<div class="form-group">
									<label for="codom" >Unidade do usuário*</label>
									<select class="form-control" name="codom" id="codom">
										<option value="">Aguardando Unidade de Controle Interno...</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<!-- Text input-->
							<div class="col-sm-12">
								<div class="form-group">
									<label for="posto">Perfil*</label>
									<?php include_once('listas/select_perfil.inc.php');?>
								</div>
							</div>
						</div>
						<div class="row">
							<!-- CPF input-->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="cpf">CPF*</label>
									<input id="cpf" name="cpf" placeholder="somente dígitos" class="form-control" type="text"  maxlength = "11">
								</div>
							</div>
							<!-- RG input-->
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label" for="rg">RG*</label>
									<input id="rg" name="rg" placeholder="Nr da identidade" class="form-control" type="text">
								</div>
							</div>
						</div>
						<div class="row">
							<!-- Password input-->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="senha">Senha*</label>
									<input id="senha" name="senha" placeholder="mínimo de 8 caracteres" class="form-control" type="password" maxlength = "20" onpaste="return false;">
								</div>
							</div>
							<!-- Password input-->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="senha1">Confirmação senha*</label>
									<input id="senha1" name="senha1" placeholder="confirme a senha" class="form-control" type="password" maxlength = "20" onpaste="return false;">
								</div>
							</div>
						</div>
						<div class="row">
							<!-- Text input-->
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
									<input id="nome_guerra" name="nome_guerra" placeholder="" class="form-control" type="text">
								</div>
							</div>
						</div>
						<div class="row">
							<!-- Select input -->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="nome">Nome*</label>
									<input id="nome" name="nome" placeholder="Nome Completo" class="form-control" type="text">
								</div>
							</div>
							<!-- Email input-->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="email">E-Mail*</label>
									<input id="email" name="email" placeholder="Para recebimento de msg do sistema" class="form-control" type="email">
								</div>
							</div>
						</div>
						<div class ="row">
							<!-- Text input-->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="ritex">RITEx:</label>
									<input id="ritex" name="ritex" placeholder="somente dígitos" class="form-control" type="text">
								</div>
							</div>
							<!-- Text input-->
							<div class="col-sm-6">
								<div class="form-group">
									<label for="celular">Celular:</label>
									<input id="celular" name="celular" placeholder="somente dígitos" class="form-control input-md" type="text">
								</div>
							</div>
						</div>
						<!--Hidden input -->
						<input  type="hidden" name="flag" />
						<!-- Button (Double) -->
						<div class="modal-footer">
							<div class="form-group">
								<button class="btn btn-success" type="submit">Enviar</button>
								<button class="btn btn-danger"  type="button" data-dismiss="modal">Cancelar</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>