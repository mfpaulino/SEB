<div class="modal fade" data-backdrop="static" id="modalAlterarCategoria" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<h4 class="modal-title">Editar Categoria</h4>
			</div>
			<div class="modal-body">
				<form name="form_categoria_alterar" id="form_categoria_alterar" action="controllers/admin/categoria/categoria_alterar.php" method="POST">
					<div class="form-group">
						<label for="categoria" class="control-label">*Categoria:</label>
						<input class="form-control" type="text" name="categoria"  id="categoria" autofocus  placeholder="" />
					</div>
					<div class="form-group">
						<label for="localidade" class="control-label">*Localidades:</label>
						<textarea class="form-control" type="text" name="localidade"  id="localidade" style="resize: vertical" maxlength="1000" rows="4" placeholder="localidade1; localidade2; localidade3..." /></textarea>
					</div>
					<div class="form-group">
						<input type="hidden" name="categoria_atual"   id="categoria_atual" />
						<input type="hidden" name="localidade_atual"  id="localidade_atual" />
						<input type="hidden" name="id_categoria"      id="id_categoria" />
						<input type="hidden" name="flag" value="alterar" />
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