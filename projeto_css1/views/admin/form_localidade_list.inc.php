<table class="table">
	<tbody>
		<tr>
			<td>
				<?php include_once('listas/admin/select_localidade.inc.php');?>
			</td>
			<td>
				<!--botao Alterar localidade-->
				<button type="button" class="btn btn-xs btn-warning"
					data-tooltip="tooltip" title=""
					data-toggle="modal"
					data-target="#modalAlterarLocalidade"
					data-unidade="<?php echo $sigla_usuario; ?>">
					<i class="fa fa-pencil"></i> Alterar
				</button>
				<!--botao Excluir localidade-->
				<?php $flag = md5("localidade_excluir");?>
				<a href="controllers/admin/localidade_excluir.php?flag=<?php echo $flag; ?>&flag1=<?php echo str_replace('.php','',$pagina);?>" data-tooltip="tooltip" title="" >
					<button type="button" class="btn btn-xs btn-danger" data-toggle="confirmation"
						data-placement="left"
						data-btn-ok-label="Continuar"
						data-btn-ok-icon="glyphicon glyphicon-share-alt"
						data-btn-ok-class="btn-success"
						data-btn-cancel-label="Parar"
						data-btn-cancel-icon="glyphicon glyphicon-ban-circle"
						data-btn-cancel-class="btn-danger"
						data-title="Confirma exclusão da Localidade?"
						data-content="">
						<i class="fa fa-trash"></i> Excluir
					</button>
				</a>
			</td>
		</tr>
	</tbody>
</table>