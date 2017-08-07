<div class="modal fade" data-backdrop="static" id="senhaModal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Solicitação de nova senha</h4>
			</div>
			<div class="modal-body">
				<p>Confirme o CPF:</p>
				<form action="usuario/solicita_nova_senha.php" method="POST">
					<input type="text" name="cpf" id="cpf" required pattern="[0-9]{11}" autofocus placeholder="CPF" maxlength="11" />
					<input type="hidden" name="flag" />
					<input type="submit" />
				</form>
			</div>
		</div>
	</div>
</div>
