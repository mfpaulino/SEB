<div class="modal fade" id="modalVisualizar<?php echo $cpf; ?>" tabindex="-1" role="dialog" aria-labelledby="modalVisualizarLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header fundo">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="modalVisualizarLabel">Perfil do Usuário</h4>
			</div>
			<div class="modal-body">
				<!--<p><b>Unidade:</b> <?php echo $sigla_usuario; ?></p>-->
				<p><b>CPF:</b> <?php echo $cpf; ?></p>
				<p><b>RG:</b> <?php echo $rg_usuario; ?></p>
				<p><b>Posto/grad:</b> <?php echo $posto_usuario; ?></p>
				<p><b>Nome de guerra:</b> <?php echo $nome_guerra_usuario; ?></p>
				<p><b>Nome completo:</b> <?php echo $nome_usuario; ?></p>
				<p><b>E-mail:</b> <?php echo $email_usuario; ?></p>
				<p><b>RITEx:</b> <?php echo $ritex_usuario; ?></p>
				<p><b>Celular:</b> <?php echo $celular_usuario; ?></p>
			</div>
		</div>
	</div>
</div>