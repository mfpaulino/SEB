<div class="modal fade" data-backdrop="static" id="modalCadastrarDiaria" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<h4 class="modal-title">Cadastrar Diária</h4>
			</div>
			<div class="modal-body">
				<form name="form_diaria_cadastrar" id="form_diaria_cadastrar" action="controllers/admin/diaria_cadastrar.php" method="POST">
					<div class="form-group">
						<label for="categoria" class="control-label">*Categoria:</label>
						<?php include('listas/admin/select_alterar_categoria.inc.php');?>
					</div>
					<div class="form-group">
						<label for="posto" class="control-label">*Posto/Grad:</label>
						<?php include('listas/select_posto.inc.php');?>
					</div>
					<div class="form-group">
						<label for="valor">*Valor (R$):</label>
						<input type="text" class="form-control" name="valor" id="valor" />
					</div>
					<div class="form-group">
						<!--Hidden input -->
						<input  type="hidden" name="flag" />
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