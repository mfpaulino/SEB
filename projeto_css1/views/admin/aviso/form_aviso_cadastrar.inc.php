<div class="modal fade" data-backdrop="static" id="modalCadastrarAviso" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<h4 class="modal-title">Cadastrar Aviso</h4>
			</div>
			<div class="modal-body">
				<form name="form_aviso_cadastrar" id="form_aviso_cadastrar" action="controllers/admin/aviso/aviso_cadastrar.php" method="POST">
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
						<?php
						$inclui_config = "nao";//para nao dar erro de caminho no script abaixo em relacao à inclusao do config.inc.php
						include_once(PATH.'/controllers/admin/aviso/aviso_listar_publico_cad.inc.php');
						?>
					</div>
					<div class="form-group">
						<label>*Validade:</label>
						<div class="input-group date" id="validade">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input type="text" class="form-control pull-right" name="validade" required value="<?php echo date('d/m/Y', strtotime("+10 days"));?>" />
						</div>
					</div>
					<div class="form-group">
						<label>Habilitar? </label><br />
						<input name="status" type="checkbox" data-toggle="toggle" data-size="small" data-on="Sim" data-off="Não"  value="Ativo"   />&nbsp;&nbsp;
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
