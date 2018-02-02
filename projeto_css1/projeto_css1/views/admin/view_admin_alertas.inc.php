<!-- Incio modalAlerta -->
<div class="modal modal-<?php echo $botao;?> fade" id="modalAlerta"  data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
				<h4 class="modal-title" id="modalAlertaLabel">Informação do Sistema</h4>
			</div>
			<div class="modal-body">
				<?php
				echo "<b>";
				for($i = 0; $i < 15; $i++){
					if(${"msg{$i}"} <> ""){
						echo ${"msg{$i}"}."<br />";
					}
				}
				if($lista_erro_validacao){
					foreach ($lista_erro_validacao as $msg_lista){
						echo $msg_lista[0] = "<p>" . $msg_lista[0] . "</p>";
					}
				}
				echo "</b>";
				?>
			</div>
			<div class="modal-footer">
				<a href="<?php echo $pagina;?>"><button type="button" class="btn btn-<?php echo $botao;?>">Fechar</button></a>
			</div>
		</div>
	</div>
</div>
<!-- fim modalalerta-->