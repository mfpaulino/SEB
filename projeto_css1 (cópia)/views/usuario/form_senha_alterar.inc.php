<div class="modal fade" data-backdrop="static" id="modalTrocarSenha" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
				<h4 class="modal-title">Alterar Senha</h4>
			</div>
			<div class="modal-body">
				<form name="form_senha_alterar" id="form_senha_alterar" action="controllers/usuario/senha_alterar.php" method="POST">
					<div class="form-group">
						<label for="codom" class="control-label">*Nova senha:</label>
						<input class="form-control" type="password" name="senha_nova"  id="senha_nova"  autofocus  placeholder="nova senha" onpaste="return false;" />
					</div>
					<div class="form-group">
						<label for="codom" class="control-label">*Confirmar senha:</label>
						<input class="form-control" type="password" name="senha_nova1" id="senha_nova1" placeholder="confirmar senha" onpaste="return false;" />
					</div>
					<div class="modal-footer">
						<input type="hidden" name="flag" value="<?php echo $_SESSION['cpf'];?>"/>
						<input type="hidden" name="flag1" value="<?php echo $pagina;?>" />
						<button type="submit" class="btn btn-success">Enviar</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>