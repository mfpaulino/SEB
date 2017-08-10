<div class="modal fade" data-backdrop="static" id="modalTrocarSenha" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Alteração de senha</h4>
			</div>
			<div class="modal-body">
				<form action="controllers/usuario/senha_alterar.php" method="POST">
					<div class="form-group">
						<label for="codom" class="control-label">Senha:</label>
						<input class="form-control" type="password" name="senha_nova"  id="senha_nova"  autofocus required placeholder="nova senha" onpaste="return false;" />
					</div>
					<div class="form-group">
						<label for="codom" class="control-label">Confirme a senha:</label>
						<input class="form-control" type="password" name="senha_nova1" id="senha_nova1" required placeholder="confirmar senha" onpaste="return false;" />
					</div>
					<div class="modal-footer">
						<input type="hidden" name="flag" value="<?php echo $_SESSION['cpf'];?>"/>
						<input type="submit" />
					</div>
				</form>
			</div>
		</div>
	</div>
</div>