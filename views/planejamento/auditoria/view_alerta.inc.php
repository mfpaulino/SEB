<div class="modal modal-<?php echo $botao;?> fade" id="modalAlertaAuditoria"  data-backdrop="static" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Informação do Sistema</h4>
			</div>
			<div class="modal-body">
				<?php echo $msg."<br />";
				if($lista_erro_validacao){
					foreach ($lista_erro_validacao as $msg_lista){
						echo $msg_lista[0] = "<p>" . $msg_lista[0] . "</p>";
					}
				}
				?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-<?php echo $botao;?>" data-dismiss="modal">Fechar</button>
			</div>
		</div>
	</div>
</div>