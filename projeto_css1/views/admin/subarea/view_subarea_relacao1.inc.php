<div class="modal fade" id="modalExibirSubarea" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Subáreas/Subprocessos Cadastrados</h4>
			</div>
			<div class="modal-body">
				<div class="box">
					<div id="area_printSubarea" class="box-body no-padding ">
						<div id="lista_subarea"><!--conteudo vem do script componentes/internos/js/admin/view_subarea.js--></div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button id="btnPrintSubarea" class="btn btn-default" <?php echo $atributo_subarea;?> ><i class="fa fa-print"></i> Imprimir</button>
			</div>
		</div>
	</div>
</div>