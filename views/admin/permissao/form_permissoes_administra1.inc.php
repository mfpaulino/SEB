<div class="modal fade" data-backdrop="static" id="modalAdminPermissao1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header fundo">
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<form name="form_permissoes_administra1" id="form_permissoes_administra1" action="controllers/admin/permissao/permissoes_administra1.php" method="POST">
					<div id="listar_permissoes" class="form-group">
					</div>
					<div class="form-group">
						<input type="hidden" name="id_perfil" id="id_perfil" />
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