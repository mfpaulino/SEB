<div class="modal fade" data-backdrop="static" id="alteraModal" role="dialog">
<div class="modal-dialog">
  <div class="modal-content"><div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title">Alteração de senha</h4>
  </div>
	<div class="modal-body">
		<form action="usuario/altera_senha.php" method="POST">
			<input type="password" name="senha_nova"  id="senha_nova"  autofocus required placeholder="nova senha" />
			<input type="password" name="senha_nova1" id="senha_nova1" required placeholder="confirmar senha" />
			<input type="hidden" name="flag" value="<?php echo $_SESSION['cpf'];?>"/>
			<input type="submit" />
		</form>
	</div>
  </div>
</div>
</div>
<script>
  var senha_nova = document.getElementById("senha_nova");
  var senha_nova1 = document.getElementById("senha_nova1");

	function validatePassword(){
		if(senha_nova.value.length < 8){
			senha_nova.setCustomValidity("Senha com menos de 8 caracteres!");
		}
		else {
			senha_nova.setCustomValidity('');
			}
		if(senha_nova.value != senha_nova1.value) {
			senha_nova1.setCustomValidity("Senhas diferentes!");
		} else {
			senha_nova1.setCustomValidity('');
		}
	}
	senha_nova.onkeyup  = validatePassword;
	senha_nova.onchange = validatePassword;
	senha_nova1.onkeyup = validatePassword;
</script>