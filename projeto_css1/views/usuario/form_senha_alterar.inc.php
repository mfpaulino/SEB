<div class="modal fade" data-backdrop="static" id="alteraModal" role="dialog">
<div class="modal-dialog">
  <div class="modal-content"><div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title">Alteração de senha</h4>
  </div>
	<div class="modal-body">
		<form action="../controllers/usuario/senha_alterar.php" method="POST">
			<input type="password" name="senha_nova"  id="senha_nova"  autofocus required placeholder="nova senha" />
			<input type="password" name="senha_nova1" id="senha_nova1" required placeholder="confirmar senha" />
			<input type="hidden" name="flag" value="<?php echo $_SESSION['cpf'];?>"/>
			<input type="submit" />
		</form>
	</div>
  </div>
</div>
</div>