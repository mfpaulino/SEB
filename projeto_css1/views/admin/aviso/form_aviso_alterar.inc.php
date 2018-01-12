<div class="modal fade" data-backdrop="static" id="modalAlterarAviso" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<h4 class="modal-title">Alterar Aviso</h4>
			</div>
			<div class="modal-body">
				<form name="form_aviso_alterar" id="form_aviso_alterar" action="controllers/admin/aviso/aviso_alterar.php" method="POST">
					<div class="form-group">
						<label for="titulo" class="control-label">*Título:</label>
						<input class="form-control" type="text" name="titulo"  id="titulo" required autofocus  placeholder="" />
					</div>
					<div class="form-group">
						<label for="texto" class="control-label">*Texto:</label>
						<textarea class="form-control" type="text" name="texto"  id="texto" required style="resize: vertical" ></textarea>
					</div>
					<div class="form-group">
						<label>*Público alvo:</label>
						<br />
						<input name="publico[]" type="checkbox" id="pub_cciex"    class="icheck" value="CCIEx"   /> CCIEx <br />
						<input name="publico[]" type="checkbox" id="pub_icfex"    class="icheck" value="ICFEx"   /> ICFEx <br />
						<input name="publico[]" type="checkbox" id="pub_unidades" class="icheck" value="Unidade" /> Unidade
					</div>
					<div class="form-group">
						<label>*Validade:</label>
						<div class="input-group date" id="validade_altera">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input type="text" class="form-control pull-right" name="validade"  required />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">Última atualização:</label>
						<input class="form-control" type="text" name="atualizacao" readonly id="atualizacao"  ></textarea>
					</div>
					<div class="form-group">
						<!--Hidden input -->
						<input  type="hidden" name="flag" value = "alterar" />
						<input  type="hidden" name="id_aviso" id="id_aviso" />
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