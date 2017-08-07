<div class="modal modal-warning- fade" data-backdrop="static" id="esqueciModal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Solicitação de nova senha</h4>
			</div>
			<div class="modal-body">
				<form name = "form_esqueci_senha" id = "form_esqueci_senha" action="usuario/solicita_nova_senha.php" method="POST" role="form">
					<div class="form-group">
						<label for="cpf" class="control-label">CPF: </label>
						<input class="form-control" type="text" name="cpf" autofocus placeholder="CPF" maxlength="11" />
						<input type="hidden" name="flag" />
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Enviar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
