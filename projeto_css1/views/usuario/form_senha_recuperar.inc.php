<div class="modal fade" data-backdrop="static" id="esqueciModal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
				<h4 class="modal-title">Resgatar Senha</h4>
			</div>
			<div class="modal-body">
				<form name = "form_senha_recuperar" id = "form_senha_recuperar" action="controllers/usuario/senha_recuperar.php" method="POST" role="form">
					<div class="form-group">
						<label for="cpf" class="control-label">CPF*</label>
						<input class="form-control" type="text" name="cpf" autofocus placeholder="CPF" maxlength="11" />
						<input type="hidden" name="flag" />
						<input type="hidden" name="flag1" value = "<?php echo $pagina;?>" />
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-success">Enviar</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
