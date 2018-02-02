<div class="modal fade" data-backdrop="static" id="modalAlterarValidadeAviso" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<h4 class="modal-title">Alterar Validade</h4>
			</div>
			<div class="modal-body">
				<form action="controllers/admin/aviso/aviso_alterar.php" method="POST">
					<div class="form-group">
						<label>Validade:</label>
						<div class="input-group date" id="validade_altera">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input type="text" class="form-control pull-right" name="validade_altera"  required />
						</div>
					</div>
					<div class="form-group">
						<!--Hidden input -->
						<input  type="hidden" name="flag" value="alterar_validade" />
						<input  type="text" name="id_aviso" id="id_aviso" />
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