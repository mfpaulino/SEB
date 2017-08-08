<?php
//form_usuario_editar.inc.php
//if ( ! defined('PATH')){ echo "ACESSO NEGADO"; exit;}//IMPEDE QUE SEJA CHAMADO DIRETAMENTE PELA URL
?>
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="modalEditarLabel"></h4>
			</div>
			<div class="modal-body">
				<form name="form_editar" id="form_editar" method="POST" action="usuario/altera_usuario.php" enctype="multipart/form-data">
				<div class="form-group">
					<label for="rg" class="control-label">RG:</label>
					<input name="rg" id="rg" type="text" class="form-control" />
				</div>
				<div class="form-group">
					<label for="posto" class="control-label">Posto/Grad:</label>
					<?php include_once('listas/postos_select.inc.php');?>
				</div>
				<div class="form-group">
					<label for="nome_guerra" class="control-label">Nome de guerra:</label>
					<input name="nome_guerra" id="nome_guerra" type="text" class="form-control" />
				</div>
				<div class="form-group">
					<label for="nome" class="control-label">Nome completo:</label>
					<input name="nome" id="nome" type="text" class="form-control"  />
				</div>
				<div class="form-group">
					<label for="email" class="control-label">E-mail:</label>
					<input name="email" id="email" type="text" class="form-control" />
				</div>
				<div class="form-group">
					<label for="ritex" class="control-label">RITEx:</label>
					<input name="ritex" id="ritex" type="text" class="form-control" />
				</div>
				<div class="form-group">
					<label for="celular" class="control-label">Celular:</label>
					<input name="celular" id="celular" type="text" class="form-control" />
				</div>
				<div class="modal-footer">
					<input name="flag" type="hidden" />
					<input name="rg_atual" type="hidden" value="<?php echo $rg_usuario;?>" />
					<input name="posto_atual" type="hidden" value="<?php echo $posto_usuario;?>" />
					<input name="nome_guerra_atual" type="hidden" value="<?php echo $nome_guerra_usuario;?>" />
					<input name="nome_atual" type="hidden" value="<?php echo $nome_usuario;?>" />
					<input name="email_atual" type="hidden" value="<?php echo $email_usuario;?>" />
					<input name="codom_atual" type="hidden" value="<?php echo $codom_usuario;?>" />
					<button type="submit" class="btn btn-primary">Alterar</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>