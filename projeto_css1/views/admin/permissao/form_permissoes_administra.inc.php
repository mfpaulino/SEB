<div class="modal fade" data-backdrop="static" id="modalAdminPermissao" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header fundo">
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<form name="form_permissoes_administra" id="form_permissoes_administra" action="controllers/admin/permissao/permissoes_administra.php" method="POST">
					<div id="listar_perfis1" class="form-group">
					</div>
					<div id="listar_permissoes" class="form-group">
					</div>
					<div class="form-group">
						<input type="hidden" name="id_permissao" id="id_permissao" />
						<input type="hidden" name="flag" />
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