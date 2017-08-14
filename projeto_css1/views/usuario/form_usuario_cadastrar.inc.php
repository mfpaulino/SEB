<div class="modal fade" data-backdrop="static" id="cadastroModal" role="dialog">
	<div class="modal-dialog" >
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Solicitação de acesso</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" name="form_usuario_cadastrar" id="form_usuario_cadastrar" role="form" action="controllers/usuario/usuario_cadastrar.php" method="POST">
					<!---->
					<fieldset>
						<!-- Select input-->
						<div class="form-group">
							<label  class="col-md-4 control-label" for="unidade_ci">*Unidade Controle Interno:</label>
							<div class="col-md-8">
								<?php include('listas/select_unid_ci.inc.php');?>
							</div>
						</div>

						<!-- Select input -->
						<div class="form-group">
							<label class=" col-md-4 control-label" for="codom" >*Unidade do usuário:</label>
							<div class="col-md-8">
								<select class="form-control" name="codom" id="codom">
									<option value="">Aguardando Unidade de Controle Interno...</option>
								</select>
							</div>
						</div>

						<!-- Text input-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="cpf">*CPF:</label>
							<div class="col-md-8">
								<input id="cpf" name="cpf" placeholder="somente dígitos" class="form-control input-md" type="text"  maxlength = "11">
							</div>
						</div>
						<!-- Password input-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="senha">*Senha:</label>
							<div class="col-md-8">
								<input id="senha" name="senha" placeholder="mínimo de 8 caracteres" class="form-control input-md" type="password" maxlength = "20" onpaste="return false;">
							</div>
						</div>

						<!-- Password input-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="senha1">*Confirme a senha:</label>
							<div class="col-md-8">
								<input id="senha1" name="senha1" placeholder="confirme a senha" class="form-control input-md" type="password" maxlength = "20" onpaste="return false;">
							</div>
						</div>

						<!-- Text input-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="rg">*RG:</label>
							<div class="col-md-8">
								<input id="rg" name="rg" placeholder="Nr da identidade" class="form-control input-md" type="text">
							</div>
						</div>

						<!-- Select input -->
						<div class="form-group">
							<label for="posto" class="col-md-4 control-label">*Posto/Grad:</label>
							<div class="col-md-8">
								<?php include_once('listas/select_posto.inc.php');?>
							</div>
						</div>

						<!-- Text input-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="nome">*Nome Completo:</label>
							<div class="col-md-8">
								<input id="nome" name="nome" placeholder="Nome Completo" class="form-control input-md" type="text">
							</div>
						</div>

						<!-- Text input-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="nome_guerra">*Nome de guerra:</label>
							<div class="col-md-8">
								<input id="nome_guerra" name="nome_guerra" placeholder="" class="form-control input-md" type="text">
							</div>
						</div>

						<!-- Email input-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="email">*E-Mail:</label>
							<div class="col-md-8">
								<input id="email" name="email" placeholder="digite um e-mail válido" class="form-control input-md" type="email">
							</div>
						</div>

						<!-- Text input-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="ritex">RITEx:</label>
							<div class="col-md-8">
								<input id="ritex" name="ritex" placeholder="" class="form-control input-md" type="text">
							</div>
						</div>

						<!-- Text input-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="celular">Celular:</label>
							<div class="col-md-8">
								<input id="celular" name="celular" placeholder="" class="form-control input-md" type="text">
							</div>
						</div>

						<!--Hidden input -->
						<input  type="hidden" name="flag" />

						<!-- Button (Double) -->
						<div class="modal-footer">
							<div class="form-group">
								<label class="col-md-4 control-label"></label>
								<div class="col-md-8">
									<button class="btn btn-success" type="submit">Cadastrar</button>
									<button class="btn btn-danger"  type="button" data-dismiss="modal">Cancelar</button>
								</div>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>