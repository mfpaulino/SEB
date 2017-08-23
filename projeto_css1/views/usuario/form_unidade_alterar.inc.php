<div class="modal fade" id="modalTrocarUnidade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalTrocarUnidadeLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header fundo">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" id="modalTrocarUnidadeLabel"></h4>
			</div>
			<div class="modal-body">
				<form name="form_altera_unidade" id="form_altera_unidade" method="POST" action="controllers/usuario/usuario_alterar.php" enctype="multipart/form-data" >
					<div class="form-group">
						<label for="unidade_ci" class="control-label">*Unidade Controle Interno:</label>
						<?php include('listas/select_unid_ci.inc.php');?>
					</div>
					<div class="form-group">
						<label for="codom" class="control-label">*Unidade usuário:</label>
						<select class="form-control" name="codom" id="codom">
							<option value="">Aguardando Unidade de Controle Interno...</option>
						</select>
					</div>
					<div class="modal-footer">
						<input name="flag" type="hidden" value="<?php $codom_usuario;?>"/>
						<button type="submit" class="btn btn-success"
							data-toggle="confirmation"
							data-placement="left"
							data-btn-ok-label="Continuar"
							data-btn-ok-icon="glyphicon glyphicon-share-alt"
							data-btn-ok-class="btn-success"
							data-btn-cancel-label="Parar"
							data-btn-cancel-icon="glyphicon glyphicon-ban-circle"
							data-btn-cancel-class="btn-danger"
							data-title="Confirma alteração da Unidade?"
							data-content="">
						Enviar
						</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
						<input type="hidden" name="flag1" value="<?php echo $pagina;?>" />
					</div>
				</form>
			</div>
		</div>
	</div>
</div>